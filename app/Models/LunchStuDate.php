<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LunchStuDate extends Model
{
    protected $fillable = [
        'student_id',
        'order_date',
        'enable',
        'semester',
        'lunch_order_id',
        'lunch_factory_id',
        'eat_style',
    ];
    public function lunch_stu()
    {
        return $this->belongsTo(LunchStu::class);
    }
    public function lunch_order()
    {
        return $this->belongsTo(LunchOrder::class);
    }
    public function lunch_factory()
    {
        return $this->belongsTo(LunchFactory::class);
    }
}
