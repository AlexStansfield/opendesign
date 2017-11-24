<?php

namespace App\Http\Controllers;

use App\Design;
use App\Http\Resources\CommentCollection;
use App\Like;
use DateTime;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Filter options would be helpful for users
        // $filterOptions = $request->all();
        $userId = Auth::user()->id;
        return new JsonResponse(Design::where('user_id', $userId)->get());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'brief_id' => 'required|int|exists:brief,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'file_name' => 'required|string',
            'user_id' => 'required|int|exists:user,id',
            'status' => 'required|string'
        ];

        try {
            $validData = $request->validate($rules);
        } catch (ValidationException $exception) {
            return new JsonResponse($exception->errors(), JsonResponse::HTTP_BAD_REQUEST);
        }

        $design = new Design($validData);
        $design->save();

        return new JsonResponse($design, JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id Design id
     * @return JsonResponse
     */
    public function show($id)
    {
        $design = Design::find($id);

        if (null === $design) {
            return new JsonResponse(['Design not found', JsonResponse::HTTP_NOT_FOUND]);
        }

        $brief = $design->brief();
        return new JsonResponse(
            array_merge(['brief' => $brief], $design->toArray())
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Design $design)
    {
        $rules = [
            'brief_id' => 'int|exists:brief,id',
            'title' => 'string',
            'description' => 'string',
            'file_name' => 'string',
            'user_id' => 'int|exists:user,id',
            'status' => 'string'
        ];

        try {
            $request->validate($rules);
            $toSave = $request->all() + $design->toArray();

            Design::where('id', $toSave['id'])->update($toSave);

            return new JsonResponse($toSave, JsonResponse::HTTP_OK);
        } catch (ValidationException $exception) {
            return new JsonResponse($exception->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id Design id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $design = Design::find($id);

            if (null === $design) {
                return new JsonResponse(sprintf("Design %d not Found.", $id), JsonResponse::HTTP_NOT_FOUND);
            }
            Design::destroy($id);

            return new JsonResponse(sprintf("Design %d has been deleted.", $id));
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }
}
