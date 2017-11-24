<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'github_id', 'name', 'description', 'repo', 'link', 'type'
    ];
}
