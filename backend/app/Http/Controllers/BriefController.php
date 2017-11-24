<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brief;
use App\Http\Resources\Brief as BriefResource;

class BriefController extends Controller
{
    public function show() {
        return new BriefResource();
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'exists:project',
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:10',
            'type' => 'required|in:' . implode(',', Brief::$types),
            'status' => 'open'
        ]);

        return Brief::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $article = Brief::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    public function delete($id)
    {
        $article = Brief::findOrFail($id);
        $article->delete();

        return 204;
    }

}
