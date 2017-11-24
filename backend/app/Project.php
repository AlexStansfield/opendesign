<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 * @package App
 */
class Project extends Model
{
    protected $fillable = [
        'github_id', 'name', 'description', 'repo', 'link', 'type'
    ];
    /**
     * @var string Table name
     */
    protected $table = 'project';
}
