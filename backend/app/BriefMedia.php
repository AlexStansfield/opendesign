<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BriefMedia extends Model
{
    protected $table = 'brief_media';

    protected $fillable = [
        'brief_id', 'file_name'
    ];

    public function setUpdatedAtAttribute($value)
    {
        // to Disable updated_at
    }
}
