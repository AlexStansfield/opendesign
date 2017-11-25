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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assets()
    {
        return $this->hasMany('App\DesignAsset');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
