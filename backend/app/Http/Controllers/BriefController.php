<?php

namespace App\Http\Controllers;

use App\Brief;
use App\Http\Resources\Brief as BriefResource;
use App\Http\Resources\DesignCollection;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Design as DesignResource;

class BriefController extends Controller
{
    public function show($id) {
        try {
            $brief = Brief::findOrFail($id);
        }catch (\Exception $e) {
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
                'user_id',
                'title',
                'description',
                'type'
            ]) +
            ['status' => 'open']
        );

        foreach ($request->only('images') as $imagebase64) {
            $imageName = uniqid() . '.jpg';
            $path = public_path('uploads/brief-media/' . $imageName);
            try {
                if (isset($imagebase64[0])) {
                    Image::make(file_get_contents($imagebase64[0]))->save($path);
                }
            } catch (Exception $e) {
            }

            $brief->briefMedias()->create(['file_name' => $path]);
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
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $request->validate([
            'project_id' => 'required|exists:project,id',
            'user_id' => 'required|exists:user,id',
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
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return new DesignCollection($brief->designs);
    }
}
