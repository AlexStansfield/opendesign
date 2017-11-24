<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brief;
use App\Http\Resources\Brief as BriefResource;
use Intervention\Image\Facades\Image;

class BriefController extends Controller
{
    public function show() {
        return new BriefResource();
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
                'type']) +
            ['status' => 'open']
        );

        foreach ($request->only('images') as $imagebase64) {
            $path = public_path('uploads/brief-media/' . uniqid());
            try {
                if (isset($imagebase64[0])) {
                    Image::make(file_get_contents($imagebase64[0]))->save($path);
                }
            }catch (Exception $e) {}

            $brief->briefMedias()->create(['file_name' => $path]);
        }

        return $brief;
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
        }catch (\Exception $e) {
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
        }catch (\Exception $e) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $user = Auth::user();
        if ($user->id !== $brief->user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $brief->delete();

        return 204;
    }

}
