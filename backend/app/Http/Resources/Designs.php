<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Designs extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'file_name' => $this->file_name,
            'brief' => '', // brief object information
            'user' => '', // user object information
            'status' => '',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
