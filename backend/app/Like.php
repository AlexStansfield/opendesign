<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Like
 * @package App
 */
class Like extends Model
{
    /**
     * @var string
     */
    protected $table = 'like';

    /**
     * @var array
     */
    protected $fillable = [
        'design_id', 'user_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function design()
    {
        return $this->belongsTo('App\Design');
    }

    /**
     * @param $value
     */
    public function setUpdatedAtAttribute($value)
    {
        // to Disable updated_at
    }
}
