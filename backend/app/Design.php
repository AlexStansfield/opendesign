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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
