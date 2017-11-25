<?php

namespace App\Http\Controllers;

use App\Brief;
use App\Http\Resources\Brief as BriefResource;
use App\Http\Resources\DesignCollection;
use App\Services\ImageUploaderService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class BriefController
 * @package App\Http\Controllers
 */
class BriefController extends Controller
{
    /**
     * @var ImageUploaderService
     */
    private $imageUploaderService;

    public function __construct(ImageUploaderService $imageUploaderService)
    {
        $this->imageUploaderService = $imageUploaderService;
    }

    public function show($id)
    {
        try {
            $brief = Brief::findOrFail($id);
        } catch (Exception $e) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return new BriefResource($brief);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:project,id',
            'user_id' => 'required|exists:user,id',
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:10',
            'type' => 'required|in:' . implode(',', Brief::$types),
        ]);

        $brief = Brief::create(
            $request->only([
                'project_id',
                'title',
                'description',
                'type'
            ]) +
            ['status' => 'open']
        );

        $user = Auth::user();
        $brief->user()->associate($user);

        foreach ($request->only('images') as $imageBase64) {
            try {
                $image = $this->imageUploaderService->storeBase64(
                    $request->input($imageBase64[0]),
                    ImageUploaderService::PATH_BRIEF
                );
            } catch (Exception $e) {
                return new JsonResponse(['message' => 'Error decoding image'], 400);
            }

            $brief->briefMedias()->create(['file_name' => $image->basename]);
        }

        return new BriefResource($brief);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        try {
            $brief = Brief::findOrFail($id);
        } catch (Exception $e) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:10',
            'type' => 'required|in:' . implode(',', Brief::$types),
        ]);

        $user = Auth::user();
        if ($user->id !== $brief->user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $brief->update($request->all());

        return $brief;
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        try {
            $brief = Brief::findOrFail($id);
        } catch (Exception $e) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $user = Auth::user();
        if ($user->id !== $brief->user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $brief->delete();

        return 204;
    }

    /**
     * @param $id
     * @return DesignCollection|\Illuminate\Http\JsonResponse
     */
    public function getDesigns($id)
    {
        try {
            $brief = Brief::findOrFail($id);
        } catch (Exception $e) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return new DesignCollection($brief->designs);
    }
}
