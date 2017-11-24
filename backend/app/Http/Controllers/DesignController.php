<?php

namespace App\Http\Controllers;

use App\Design;
use App\Like;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function show(DesignController $design)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function edit(DesignController $design)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DesignController $design)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function destroy(DesignController $design)
    {
        //
    }
}
