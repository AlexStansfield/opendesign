<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brief extends Model
{
    protected $table = 'brief';

    public static $types = [
        'project',
        'proposal'
    ];

    public static $status = [
        'open',
        'closed'
    ];

    protected $fillable = [
        'title', 'description', 'project_id', 'user_id', 'type', 'status'
    ];

    /**
     * Get the comments for the blog post.
     */
    public function briefMedias()
    {
        return $this->hasMany('App\BriefMedia');
    }
}
