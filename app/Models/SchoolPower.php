<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolPower extends Model
{
    use HasFactory;
    protected $fillable = [
        'school_code',
        'user_id',
        'module',
        'power_type',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
