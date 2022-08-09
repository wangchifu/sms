<?php

namespace App\Http\Controllers;

use App\Models\SchoolPower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{

    public function index()
    {
        $database = config('app.database');
        $url = $_SERVER['HTTP_HOST'];
        if ($url = "sms.chc.edu.tw") {
            return redirect()->route('about');
        }

        $data = [];
        return view('index', $data);
    }

    public function about()
    {
        return view('about');
    }
    public function pic($d = null)
    {
        if (empty($d)) {
            $key = rand(10000, 99999);
        } else {
            $key = substr($d, 0, 5);
        }
        $back = rand(0, 9);
        /*
        $r = rand(0,255);
        $g = rand(0,255);
        $b = rand(0,255);
        */
        $r = 0;
        $g = 0;
        $b = 0;

        session(['chaptcha' => $key]);

        //$cht = array(0=>"零",1=>"壹",2=>"貳",3=>"參",4=>"肆",5=>"伍",6=>"陸",7=>"柒",8=>"捌",9=>"玖");
        $cht = array(0 => "0", 1 => "1", 2 => "2", 3 => "3", 4 => "4", 5 => "5", 6 => "6", 7 => "7", 8 => "8", 9 => "9");
        $cht_key = "";
        for ($i = 0; $i < 5; $i++) $cht_key .= $cht[substr($key, $i, 1)];

        header("Content-type: image/gif");
        $im = imagecreatefromgif(asset('images/back/01.gif')) or die("無法建立GD圖片");
        $text_color = imagecolorallocate($im, $r, $g, $b);

        imagettftext($im, 25, 0, 5, 32, $text_color, public_path('font/AdobeGothicStd-Bold.otf'), $cht_key);
        imagegif($im);
        imagedestroy($im);
    }

    public function module_index()
    {
        $users = User::where('disable', null)->get();

        $school_powers = SchoolPower::all();
        foreach ($school_powers as $school_power) {
            $power_data[$school_power->module][$school_power->user_id] = $school_power->id;
            $user_id2name[$school_power->user_id] = $school_power->user->name;
        }

        $data = [
            'users' => $users,
            'power_data' => $power_data,
            'user_id2name' => $user_id2name,
        ];
        return view('modules.index', $data);
    }

    public function module_store(Request $request)
    {
        $att = $request->all();
        $user_power = get_user_power($att['user_id']);
        if (isset($user_power[$att['module']])) {
            if ($user_power[$att['module']] == $att['power_type']) {
                return back();
            }
        }
        SchoolPower::create($att);
        if ($att['user_id'] == auth()->user()->id) {
            $user_power = get_user_power(auth()->user()->id);
            session(['user_power' => $user_power]);
        }

        return redirect()->route('module.index');
    }

    public function module_delete(SchoolPower $school_power)
    {
        $user_id = $school_power->user_id;
        $school_power->delete();

        if ($user_id == auth()->user()->id) {
            $user_power = get_user_power(auth()->user()->id);
            session(['user_power' => $user_power]);
        }
        return redirect()->route('module.index');
    }

    public function getImg($path)
    {
        $school_code = school_code();
        $path = str_replace('&', '/', $path);
        $path = storage_path('app/privacy/' . $school_code . '/' . $path);
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
