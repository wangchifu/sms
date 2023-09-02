<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportAction extends Model
{
    protected $fillable = [
        'semester',        
        'name',
        'track',
        'field',
        'frequency',
        'numbers',
        'disable',        
        'started_at',
        'stopped_at',
    ];
}
