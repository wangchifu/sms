<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportItem extends Model
{
    protected $fillable = [
        'sport_action_id',
        'order',
        'game_type',
        'official',
        'reserve',
        'name',
        'group',
        'type',
        'years',
        'limit',
        'people',
        'reward',
        'disable',
    ];

    public function action()
    {
        return $this->belongsTo(SportAction::class);
    }
}
