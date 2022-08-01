<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'semester',
        'schools',
        'kind',
        'title_kind',
        'title',
        'cloudschool_username',
        'role',
        'group',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
