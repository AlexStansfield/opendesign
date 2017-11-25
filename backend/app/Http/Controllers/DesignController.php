<?php

namespace App\Http\Controllers;

use App\Design;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\Design as DesignResource;
use App\Http\Resources\DesignCollection;
use App\Like;
use App\Services\ImageUploaderService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class DesignController
 * @package App\Http\Controllers
 */
class DesignController extends Controller
{
    /**
     * @var ImageUploaderService
     */
    private $imageUploaderService;

    public function __construct(ImageUploaderService $imageUploaderService)
    {
        $this->imageUploaderService = $imageUploaderService;
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLikes($id)
    {
        $design = Design::find($id);

        if (null === $design) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(['likes' => count($design->likes)]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addLike($id)
    {
        $design = Design::find($id);

        if (null === $design) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $user = Auth::user();

        // Check if already Liked
        $existingLike = Like::where('user_id', $user->id)->where('design_id', $design->id)->first();
        if (null !== $existingLike) {
            return response()->json(['message' => 'Like exists'], 400);
        }

        // Create like
        $like = new Like();
        $like->user()->associate($user);
        $like->design()->associate($design);
        $like->save();

        return response()->json(['success' => true], 201);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeLike($id)
    {
        $design = Design::find($id);

        if (null === $design) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $user = Auth::user();

        // Get like and delete
        $like = Like::where('user_id', $user->id)->where('design_id', $design->id)->first();
        if (null !== $like) {
            $like->delete();
        }

        return response()->json(['success' => true]);
    }

    /**
     * @param int $id
     * @return CommentCollection|\Illuminate\Http\JsonResponse
     */
    public function getComments($id)
    {
        $design = Design::find($id);

        // Check design exists
        if (null === $design) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return new CommentCollection($design->comments);
    }

    /**
     * Display a listing of the resource.
     *
     * @return DesignCollection
     */
    public function getAll()
    {
        return new DesignCollection(Design::all());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'brief_id' => 'required|int|exists:brief,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'mock' => 'required|string',
        ]);

        // Save the Image
        try {
            $image = $this->imageUploaderService->storeBase64(
                $request->input('mock'),
                ImageUploaderService::PATH_MOCKS
            );
        } catch (Exception $e) {
            return new JsonResponse(['message' => 'Error decoding image'], 400);
        }

        $user = Auth::user();
        $design = new Design();
        $design->brief_id = $request->input('brief_id');
        $design->title = $request->input('title');
        $design->description = $request->input('description');
        $design->status = 'pending';
        $design->file_name = $image->basename;
        $design->user()->associate($user);
        $design->save();

        return new JsonResponse(new DesignResource($design), JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id Design id
     * @return DesignResource|JsonResponse
     */
    public function getOne($id)
    {
        $design = Design::find($id);

        if (null === $design) {
            return new JsonResponse(['Design not found', JsonResponse::HTTP_NOT_FOUND]);
        }

        DesignResource::withoutWrapping();
        return new DesignResource($design);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return DesignResource|JsonResponse
     */
    public function update(Request $request, $id)
    {
        $design = Design::find($id);

        if (null === $design) {
            return new JsonResponse(['Design not found', JsonResponse::HTTP_NOT_FOUND]);
        }

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'mock' => 'string'
        ]);


        $user = Auth::user();
        if ($user->id !== $design->user_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // Replace the image if they supplied a new one
        if ($request->input('mock')) {
            // Save the Image
            try {
                $image = $this->imageUploaderService->storeBase64(
                    $request->input('mock'),
                    ImageUploaderService::PATH_MOCKS
                );
            } catch (Exception $e) {
                return new JsonResponse(['message' => 'Error decoding image'], 400);
            }

            $design->file_name = $image->basename;
        }

        $design->title = $request->input('title');
        $design->description = $request->input('description');
        $design->save();

        DesignResource::withoutWrapping();
        return new DesignResource($design);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id Design id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $design = Design::find($id);

        if (null === $design) {
            return new JsonResponse(sprintf("Design %d not Found.", $id), JsonResponse::HTTP_NOT_FOUND);
        }

        $user = Auth::user();
        if ($user->id !== $design->user_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $design->delete();

        return response()->json(['success' => true]);
    }
}
