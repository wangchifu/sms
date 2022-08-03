<?php

namespace App\Http\Controllers;

use App\Models\LunchFactory;
use App\Models\LunchOrder;
use App\Models\LunchOrderDate;
use App\Models\LunchPlace;
use App\Models\LunchSetup;
use App\Models\LunchTeaDate;
use App\Models\StudentClass;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LunchStuController extends Controller
{
    public function index($lunch_order_id = null)
    {
        $admin = check_admin('lunch_admin');

        $lunch_order_array = LunchOrder::orderBy('name', 'DESC')
            ->pluck('name', 'id')
            ->toArray();
        $lunch_order_dates = [];
        $student_classes = [];
        if ($lunch_order_id) {
            $lunch_order =  LunchOrder::find($lunch_order_id);
            $lunch_order_dates = LunchOrderDate::where('lunch_order_id', $lunch_order_id)
                ->where('enable', '1')
                ->orderBy('order_date')
                ->get();
            $student_classes = StudentClass::where('semester', $lunch_order->semester)
                ->orderBy('student_year')
                ->orderBy('student_class')
                ->get();
        }
        $data = [
            'admin' => $admin,
            'lunch_order_array' => $lunch_order_array,
            'lunch_order_id' => $lunch_order_id,
            'lunch_order_dates' => $lunch_order_dates,
            'student_classes' => $student_classes,
        ];
        return view('lunch_stus.index', $data);
    }
}
