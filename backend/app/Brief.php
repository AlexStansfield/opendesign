<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brief extends Model
{
    public static $types = [
        'project',
        'proposal'
    ];

    public static $status = [
        'open',
        'closed'
    ];

    protected $fillable = [
        'title', 'description', 'type', 'status'
    ];
}
