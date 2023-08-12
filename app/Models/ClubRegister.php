<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubRegister extends Model
{
    protected $fillable = [
        'semester',
        'club_id',
        'student_id',
        'class_id',
    ];
    public function user()
    {
        return $this->belongsTo(Student::class,'student_id','id');
    }

    public function club()
    {
        return $this->belongsTo(Club::class,'club_id','id');
    }
}
