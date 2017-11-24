<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Design
 * @package App
 */
class Design extends Model
{
    /**
     * @var string Table name
     */
    protected $table = 'design';

    protected $fillable = [
        'title', 'description', 'file_name', 'brief_id', 'user_id', 'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brief()
    {
        return $this->belongsTo('App\Brief');
    }

    public function assets()
    {
        return $this->hasMany('App\DesignAsset');
    }

    public function user()
    {
        return $this->belongsTo('App\User')->get()->first();
    }
}
