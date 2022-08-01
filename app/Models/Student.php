<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'semester',
        'name',
        'sex',
        'birthday',
        'pwd',
        'parents_telephone',
        'student_sn',
        'student_year',
        'student_class',
        'num',
        'disable',
    ];
}
