<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use App\Models\SchoolPower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function sms_login($action = null)
    {
        $data = [
            'action' => $action,
        ];
        return view('auth.sms_login', $data);
    }
    public function g_auth(Request $request)
    {
        $semester = get_date_semester(date('Y-m-d'));

        //是否已有此帳號
        $u = explode('@', $request->input('username'));
        $username = $u[0];


        if ($request->input('chaptcha') != session('chaptcha')) {
            return back()->withInput()->withErrors(['error' => '驗證碼錯誤']);
        }


        if ($request->input('login_type') == "gsuite") {
            //檢驗gsuite帳密
            $data = array("email" => $username, "password" => $request->input('password'));
            $data_string = json_encode($data);
            $ch = curl_init('https://school.chc.edu.tw/api/auth');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt(
                $ch,
                CURLOPT_HTTPHEADER,
                array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string)
                )
            );
            $result = curl_exec($ch);
            $obj = json_decode($result, true);

            if (empty($obj)) {
                return back()->withInput()->withErrors(['error' => 'GSuite 認證系統無法認證']);
            }

            if ($obj['success']) {
                //非教職員，即跳開
                if ($obj['kind'] == "學生") {
                    return back()->withInput()->withErrors(['error' => '學生不能登入']);
                }

                //非本校教職員不能登入
                $database = config('app.database');
                if (isset($_SERVER['HTTP_HOST'])) {
                    $d = $database[$_SERVER['HTTP_HOST']];
                } else {
                    $d = env('DB_DATABASE');
                }

                $code = $obj['code'];
                $school = $obj['school'];

                if ($obj['code'] != substr($d, 3, 6)) {
                    $check_code = 0;
                    foreach ($obj['schools'] as $v) {
                        if ($v['code'] == substr($d, 3, 6)) {
                            $check_code = 1;
                            $code = $v['code'];
                            $school = $v['name'];
                        }
                    }
                    if ($check_code == 0) {
                        //return back()->withErrors(['gsuite_error' => ['非本校教職員 GSuite 帳號']]);
                    }
                }

                $user = User::where('username', $username)
                    ->where('login_type', 'gsuite')
                    ->first();

                $user_att['uid'] = $obj['uid'];
                $user_att['edu_key'] = $obj['edu_key'];
                $user_att['name'] = $obj['name'];
                $user_att['email'] = $obj['email'];
                $user_att['username'] = $username;
                $user_att['password'] = bcrypt($request->input('password'));
                $user_att['login_type'] = "gsuite";

                if (empty($user)) {
                    //無使用者，即建立使用者資料
                    $user = User::create($user_att);
                } else {
                    //被停用了，換校要啟用
                    if ($user->disable == 1) {
                        return back()->withInput()->withErrors(['error' => '你被停用了']);
                    } else {
                        $user_att['disable'] = null;
                    }
                    $user->update($user_att);
                }

                $job_title = JobTitle::where('user_id', $user->id)
                    ->where('semester', $semester)
                    ->first();

                $att_job_title['user_id'] = $user->id;
                $att_job_title['semester'] = $semester;
                $att_job_title['schools'] = serialize($obj['schools']); //陣列序列化
                $att_job_title['kind'] = $obj['kind'];

                //$att_job_title['title_kind'] = null;//要從api來
                $att_job_title['title'] = $obj['title'];
                //$att_job_title['cloudschool_username'] = null;//要從api來
                //$att_job_title['role'] = null;//要從api來
                //$att_job_title['group'] = null;//要從api來

                if (empty($job_title)) {
                    $job_title = JobTitle::create($att_job_title);
                } else {
                    $job_title->update($att_job_title);
                }

                //第一個登入的特定組長主任是學校管理者
                //若是特定組長主任，自動為該校管理者
                $title = [
                    '資訊組長',
                    '資訊組',
                    '資訊教師',
                    '註冊組長',
                    '註冊組',
                    '教學組長',
                    '教學組',
                    '教導組長',
                    '教務主任',
                    '教導主任',
                ];

                if (in_array($obj['title'], $title)) {
                    $check = SchoolPower::where('module', 'school_admin')
                        ->where('power_type', 1)
                        ->first();
                    if (empty($check)) {
                        $school_power_att['user_id'] = $user->id;
                        $school_power_att['module'] = "school_admin";
                        $school_power_att['power_type'] = 1;
                        SchoolPower::create($school_power_att);
                    }
                }
            } else {
                return back()->withInput()->withErrors(['error' => 'GSuite認證錯誤']);
            };
        } elseif ($request->input('login_type') == "local") {
            //是否已有此帳號

            $user = User::where('username', $username)
                ->where('login_type', 'local')
                ->first();
            if (empty($user)) {
                return back()->withInput()->withErrors(['error' => '本機帳號密碼錯誤！']);
            } else {
                if ($user->disable == 1) {
                    return back()->withInput()->withErrors(['error' => '你被停用了']);
                }
            }
        }

        //登入
        if (Auth::attempt([
            'username' => $username,
            'password' => $request->input('password')
        ])) {
            if (auth()->check()) {
                $user_power = get_user_power(auth()->user()->id);
            } else {
                $user_power = [];
            }
            session(['user_power' => $user_power]);

            //$login_att['last_login'] = date('Y-m-d H:i:s');
            //$user->update($login_att);
        } else {
            return back()->withInput()->withErrors(['error' => '本機帳號密碼錯誤！']);
        }

        if (empty($request->session()->get('url.intended'))) {
            return redirect()->route('index');
        } else {
            return redirect($request->session()->get('url.intended'));
        }


        /**
        if(Auth::attempt(['username' => $username,
            'password' => $request->input('password')])){

            //$a['last_login'] = date('Y-m-d H:i:s');
            //$user->update($a);
            if (empty($request->session()->get('url.intended'))) {
                return redirect()->route('index');
            } else {
                return redirect($request->session()->get('url.intended'));
            }
        }else{
            return back()->withErrors(['error'=>'帳號或密碼錯誤2']);
        }
         * */
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        if (empty($request->input('action'))) {
            return redirect()->route('index');
        } else {
            return redirect(env('APP_URL') . '/' . $request->input('action') . '/index');
        }
    }

    /**
    public function openid_get(Request $request)
    {
        $openid = $request->input('openid');//學校代碼-帳號
        $guid = $request->input('guid');//edu_key
        $name = $request->input('name');
        $unit = $request->input('unit');//學校代碼
        $title = $request->input('title');//教師或學生或....

        if($title == "學生"){
            $words = "僅限國中小學校教職員登入";
            $data = [
                'words'=>$words,
            ];
            return view('errors.others',$data);
        }else{

            //查是否有edu_key登入
            $user = User::where('edu_key',$guid)
                ->first();
            if(empty($user)){
                //無使用者，即建立使用者資料
                $att['edu_key'] = $guid;
                $att['name'] = $name;
                $att['code'] = $unit;
                $schools = config('chcschool.schools');
                $att['school'] = $schools[$unit];
                $user = User::create($att);

            }else{
                //被停用了
                if($user->disable){
                    $words = "這個帳號被停用了";
                    $data = [
                        'words'=>$words,
                    ];
                    return view('errors.others',$data);
                };

                //有此使用者，即更新使用者資料
                $att['name'] = $name;
                $att['code'] = $unit;
                $schools = config('chcschool.schools');
                $att['school'] = $schools[$unit];

                $user->update($att);
            }

            Auth::loginUsingId($user->id);

            return redirect()->route('index');
        }

    }

    public function cloudschool_auth(Request $request)
    {
        $school_code = $request->input('school_code');
        $school_api = SchoolApi::where('code',$school_code)->first();
        $clientId = $school_api->client_id;
        $apiUrl = 'https://api.chc.edu.tw/school-oauth/authorize?client_id='.$clientId.'&response_type=code&state=abc';

        return redirect($apiUrl);
    }

    public function cloudschool_back(Request $request)
    {
        $data = json_decode($request->input('data'));

        if($data->role == "student"){
            $words = "僅限國中小學校教職員登入";
            $data = [
                'words'=>$words,
            ];
            return view('errors.others',$data);
        }else{

            //查是否有edu_key登入
            $user = User::where('edu_key',$data->edu_key)
                ->first();
            if(empty($user)){
                //無使用者，即建立使用者資料
                $att['edu_key'] = $data->edu_key;
                $att['name'] = $data->name;
                $att['code'] = $data->school_no;
                $schools = config('chcschool.schools');
                $att['school'] = $schools[$data->school_no];
                $att['title'] = $data->title_name;
                $att['role'] = $data->role;
                $att['title_kind'] = $data->title_kind;
                $att['group'] = $data->group;

                $user = User::create($att);

                //若是特定組長主任，自動為該校管理者
                $title = [
                    '資訊組長',
                    '資訊組',
                    '體衛組長',
                    '體衛組',
                    '體育衛生組長',
                    '體育衛生組',
                    '體育組長',
                    '體育組',
                    '訓導組長',
                    '訓導組',
                    '學務主任',
                    '訓導主任',
                    '教導主任',
                ];
                if(in_array($user->title,$title)){
                    $att2['code'] = $user->code;
                    $att2['user_id'] = $user->id;
                    $att2['type'] = 1;
                    $check = SchoolAdmin::where('code',$user->code)->where('user_id',$user->id)->first();
                    if(empty($check)){
                        SchoolAdmin::create($att2);
                    }
                }

            }else{
                //被停用了
                if($user->disable){
                    $words = "這個帳號被停用了";
                    $data = [
                        'words'=>$words,
                    ];
                    return view('errors.others',$data);
                };

                //有此使用者，即更新使用者資料
                $att['name'] = $data->name;
                $att['code'] = $data->school_no;
                $schools = config('chcschool.schools');
                $att['school'] = $schools[$data->school_no];
                $att['title'] = $data->title_name;
                $att['role'] = $data->role;
                $att['title_kind'] = $data->title_kind;
                $att['group'] = $data->group;

                $user->update($att);
            }

            Auth::loginUsingId($user->id);

            return redirect()->route('index');
        }


    }
     * */
}
