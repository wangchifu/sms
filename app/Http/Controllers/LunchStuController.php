<?php

namespace App\Http\Controllers;

use App\Models\LunchFactory;
use App\Models\LunchOrder;
use App\Models\LunchOrderDate;
use App\Models\LunchClassDate;
use App\Models\LunchSetup;
use App\Models\LunchStuDate;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class LunchStuController extends Controller
{
    public function index($semester = null)
    {
        $admin = check_admin('lunch_admin');

        $semester_array = LunchSetup::orderBy('semester', 'DESC')
            ->pluck('semester', 'id')
            ->toArray();
        $semester = (empty($semester)) ? reset($semester_array) : $semester;

        $student_classes = [];

        $lunch_class_dates = LunchClassDate::where('semester', $semester)
            ->orderBy('student_class_id')
            ->orderBy('order_date')
            ->get();

        $lunch_class_data = [];
        foreach ($lunch_class_dates as $lunch_class_date) {
            $lunch_class_data[$lunch_class_date->student_class_id][$lunch_class_date->order_date][1] = $lunch_class_date->eat_style1;
            $lunch_class_data[$lunch_class_date->student_class_id][$lunch_class_date->order_date][4] = $lunch_class_date->eat_style4;
        }

        if (!empty($semester)) {
            $lunch_orders = LunchOrder::where('semester', $semester)
                ->orderBy('name')
                ->get();
            $student_classes = StudentClass::where('semester', $semester)
                ->orderBy('student_year')
                ->orderBy('student_class')
                ->get();
        }
        $factory_array = LunchFactory::where('disable', null)
            ->pluck('name', 'id')
            ->toArray();


        $data = [
            'admin' => $admin,
            'semester' => $semester,
            'semester_array' => $semester_array,
            'lunch_orders' => $lunch_orders,
            'student_classes' => $student_classes,
            'factory_array' => $factory_array,
            'lunch_class_dates' => $lunch_class_dates,
            'lunch_class_data' => $lunch_class_data,
        ];
        return view('lunch_stus.index', $data);
    }

    public function store(Request $request, $semester)
    {

        $eat_data1 = $request->input('eat_data1');
        $eat_data4 = $request->input('eat_data4');
        $lunch_factory_id = $request->input('lunch_factory_id');


        $lunch_order_dates = LunchOrderDate::where('semester', $semester)
            ->orderBy('order_date')
            ->get();
        foreach ($lunch_order_dates as $lunch_order_date) {
            $all = [];
            foreach ($eat_data1 as $k => $v) {
                $eat_style1 = ($lunch_order_date->enable == 1) ? $eat_data1[$k] : null;
                $eat_style4 = ($lunch_order_date->enable == 1) ? $eat_data4[$k] : null;
                $one = [
                    'student_class_id' => $k,
                    'order_date' => $lunch_order_date->order_date,
                    'semester' => $semester,
                    'lunch_order_id' => $lunch_order_date->lunch_order_id,
                    'lunch_factory_id' => $lunch_factory_id,
                    'eat_style1' => $eat_style1,
                    'eat_style2' => null,
                    'eat_style3' => null,
                    'eat_style4' => $eat_style4,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                array_push($all, $one);
            }
            LunchClassDate::insert($all);
        }


        return redirect()->route('lunch_stus.index', $semester);
    }

    public function delete($semester)
    {
        $admin = check_admin('lunch_admin');
        if ($admin) {
            LunchClassDate::where('semester', $semester)->delete();
        }
        return redirect()->route('lunch_stus.index');
    }

    public function change_num(Request $request)
    {
        $request->validate([
            'student_class_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'eat_style1' => 'required',
        ]);
        $admin = check_admin('lunch_admin');
        if ($admin) {
            $att['eat_style1'] = $request->input('eat_style1');
            $att['eat_style4'] = (empty($request->input('eat_style4'))) ? null : $request->input('eat_style4');
            LunchClassDate::where('student_class_id', $request->input('student_class_id'))
                ->where('order_date', '>=', $request->input('start_date'))
                ->where('order_date', '<=', $request->input('end_date'))
                ->where('eat_style1', '<>', null)
                ->update($att);
        }

        return redirect()->route('lunch_stus.index');
    }
}
