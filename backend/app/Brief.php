<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Brief
 * @package App
 */
class Brief extends Model
{
    /**
     * @var string
     */
    protected $table = 'brief';

    /**
     * @var array
     */
    public static $types = [
        'project',
        'proposal'
    ];

    /**
     * @var array
     */
    public static $status = [
        'open',
        'closed'
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'project_id', 'user_id', 'type', 'status'
    ];

    /**
     * Get the comments for the blog post.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function briefMedias()
    {
        return $this->hasMany('App\BriefMedia');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function designs()
    {
        return $this->hasMany('App\Design');
    }

    public function project()
    {
        $project = $this->belongsTo('App\Project');
        return $project->get()->first();
    }
}
