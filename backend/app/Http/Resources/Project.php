<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Project extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'avatar' => $this->avatar,
            'description' => $this->description,
            'repo' => $this->repo,
            'link' => $this->link
        ];
    }
}
