<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\Resource;

class Design extends Resource
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
            'brief_id' => $this->brief_id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'filename' => $this->filename,
            'status' => $this->status,
            'created_at' => $this->created_at->format(DateTime::ATOM),
            'updated_at' => $this->updated_at->format(DateTime::ATOM)
        ];
    }
}
