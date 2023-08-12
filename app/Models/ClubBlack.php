<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubBlack extends Model
{
    protected $fillable = [
        'semester',
        'student_id',
        'class_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class,'id','id');
    }
}
