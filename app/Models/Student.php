<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'school_code',
        'semester',
        'edu_key',
        'name',
        'sex',
        'birthday',
        'student_sn',
        'student_year',
        'student_class',
        'num',
        'number',
        'disable',
    ];
}
