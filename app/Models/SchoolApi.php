<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolApi extends Model
{
    protected $fillable = [
        'school_code',
        'client_id',
        'client_secret',
    ];
}
