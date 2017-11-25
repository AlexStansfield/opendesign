<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Design;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class CommentController
 * @package App\Http\Controllers
 */
class CommentController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $request->validate([
            'design_id' => 'required|exists:design,id',
            'comment' => 'required|min:5'
        ]);

        // Get the Design
        $design = Design::find($request->input('design_id'));
        $user = Auth::user();

        // Create the Comment
        $comment = new Comment();
        $comment->user()->associate($user);
        $comment->design()->associate($design);
        $comment->comment = $request->input('comment');
        $comment->save();

        CommentResource::withoutWrapping();
        return response()->json(new CommentResource($comment), 201);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|min:5'
        ]);

        $comment = Comment::find($id);

        // Check comment exists
        if (null === $comment) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        // Check it belongs to the user
        $user = Auth::user();
        if ($user->id !== $comment->user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // Update the comment
        $comment->comment = $request->input('comment');
        $comment->save();

        CommentResource::withoutWrapping();
        return new CommentResource($comment);
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $comment = Comment::find($id);

        // Check comment exists
        if (null === $comment) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        // Check it belongs to the user
        $user = Auth::user();
        if ($user->id !== $comment->user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $comment->delete();

        return response()->json(['success' => true]);
    }
}
