<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\Resource;

class Comment extends Resource
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
            'design_id' => $this->design_id,
            'user_id' => $this->user_id,
            'username' => $this->user->username,
            'comment' => $this->comment,
            'created_at' => $this->created_at->format(DateTime::ATOM),
            'updated_at' => $this->updated_at->format(DateTime::ATOM)
        ];
    }
}
