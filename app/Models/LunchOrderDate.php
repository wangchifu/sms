<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LunchOrderDate extends Model
{
    protected $fillable = [
        'order_date',
        'enable',
        'semester',
        'lunch_order_id',
        'date_ps',
    ];
    public function lunch_order()
    {
        return $this->belongsTo(LunchOrder::class);
    }
}
