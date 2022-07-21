<?php

namespace App\Http\Controllers;

use App\Models\JobTitle;
use App\Models\SchoolApi;
use App\Models\User;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class UserController extends Controller
{
    public function index()
    {
        $this_semester = get_date_semester(date('Y-m-d'));

        $school_api = SchoolApi::where('school_code', auth()->user()->current_school_code)
            ->first();

        $students = Student::where('school_code', auth()->user()->current_school_code)
            ->where('semester', $this_semester)
            ->get();
        $student_classes = StudentClass::where('school_code', auth()->user()->current_school_code)
            ->where('semester', $this_semester)
            ->get();
        $student_data = [];
        if (!empty($students)) {
            foreach ($students as $student) {
                if (!isset($student_data[$student->semester])) $student_data[$student->semester] = 0;
                $student_data[$student->semester]++;
            }
        }
        if (!empty($student_classes)) {
            $class_data = [];
            foreach ($student_classes as $student_class) {
                if (!isset($class_data[$student_class->semester])) $class_data[$student_class->semester] = 0;
                $class_data[$student_class->semester]++;
            }
        }

        $users = User::orderBy('disable')
            ->get();

        $data = [
            'school_api' => $school_api,
            'this_semester' => $this_semester,
            'class_data' => $class_data,
            'student_data' => $student_data,
            'users' => $users,
        ];
        return view('users.index', $data);
    }

    public function api_store(Request $request)
    {
        $att = $request->all();
        if (!isset($att['client_id']) or !isset($att['client_secret'])) {
            return back()->withErrors(['error' => '用戶或密碼不能空值']);
        }
        $school_api = SchoolApi::where('school_code', auth()->user()->current_school_code)
            ->first();
        if (empty($school_api)) {
            SchoolApi::create($att);
        } else {
            $school_api->update($att);
        }

        return redirect()->route('users.index');
    }

    public function teach_api()
    {
        return view('users.teach_api');
    }

    public function teach_excel()
    {
        return view('users.teach_excel');
    }

    public function api_destroy(SchoolApi $school_api)
    {
        if ($school_api->school_code == auth()->user()->current_school_code) {
            $school_api->delete();
        }
        return back();
    }

    public function api_pull()
    {
        $school_api = SchoolApi::where('school_code', auth()->user()->current_school_code)->first();

        $API_client_id = $school_api->client_id;
        $API_client_secret = $school_api->client_secret;

        $data = $this->get_API($API_client_id, $API_client_secret);

        if (empty($data)) {
            return back()->withErrors(['error' => ['沒有資料']]);
        }
        if (!isset($data->學年)) {
            return back()->withErrors(['error' => ['沒有學年資料']]);
        }
        if (!isset($data->學期)) {
            return back()->withErrors(['error' => ['沒有學期資料']]);
        }
        if (!isset($data->學期教職員)) {
            return back()->withErrors(['error' => ['沒有學期教職員資料']]);
        }

        $semester = $data->學年 . $data->學期;

        $techer_data = $data->學期教職員;
        foreach ($techer_data as $k => $v) {
            $edu_key = $v->身分證編碼;
            $user = User::where('edu_key', $edu_key)->first();
            $att_user['edu_key'] = $v->身分證編碼;
            $att_user['name'] = $v->姓名;
            $att_user['login_type'] = "gsuite";
            $att_user['current_school_code'] = auth()->user()->current_school_code;

            if (empty($user)) {
                $user = User::create($att_user);

                $att_job_title['user_id'] = $user->id;
                $att_job_title['semester'] = $semester;
                $att_job_title['school_code'] = auth()->user()->current_school_code;
                $att_job_title['title'] = $v->職稱;

                JobTitle::where('user_id', $att_job_title['user_id'])
                    ->where('semester', $semester)
                    ->where('school_code', $att_job_title['school_code'])
                    ->delete();
                JobTitle::create($att_job_title);
            } else {
                $user->update($att_user);

                $att_job_title['user_id'] = $user->id;
                $att_job_title['semester'] = $semester;
                $att_job_title['school_code'] = auth()->user()->current_school_code;
                $att_job_title['title'] = $v->職稱;

                $job_title = JobTitle::where('user_id', $att_job_title['user_id'])
                    ->where('semester', $semester)
                    ->where('school_code', auth()->user()->current_school_code)
                    ->first();

                if (empty($job_title)) {
                    JobTitle::create($att_job_title);
                } else {
                    $job_title->update($att_job_title);
                }
            }
        }



        $class_data = $data->學期編班; //各班資料
        foreach ($class_data as $k => $v) {
            $student_teacher_data = $v->導師;
            $user_ids = "";
            foreach ($student_teacher_data as $k1 => $v1) {
                $user = User::where('edu_key', $v1->身分證編碼)->first();
                $user_ids .= $user->id . ',';
            }
            $user_ids = substr($user_ids, 0, -1);
            $att_student_class['school_code'] = auth()->user()->current_school_code;
            $att_student_class['semester'] = $semester;
            $att_student_class['student_year'] = $v->年級;
            $att_student_class['student_class'] = $v->班序;
            $att_student_class['user_ids'] = $user_ids;
            $student_class = StudentClass::where('school_code', $att_student_class['school_code'])
                ->where('semester', $att_student_class['semester'])
                ->where('student_year', $att_student_class['student_year'])
                ->where('student_class', $att_student_class['student_class'])
                ->first();
            if (empty($student_class)) {
                StudentClass::create($att_student_class);
            } else {
                //避免先前有匯入過excel
                $att_student_class['user_names'] = null;
                $student_class->update($att_student_class);
            }

            $student_array = $v->學期編班;
            foreach ($student_array as $k3 => $v3) {
                $att_student['school_code'] = auth()->user()->current_school_code;
                $att_student['semester'] = $semester;
                $att_student['edu_key'] = $v3->身分證編碼;
                $att_student['name'] = $v3->姓名;
                $att_student['sex'] = $v3->性別;
                //$att_student['birthday'] = $v3->生日;//api沒有帶出生日
                $att_student['student_sn'] = $v3->學號;
                $att_student['student_year'] = $v->年級;
                $att_student['student_class'] = $v->班序;
                $att_student['num'] = $v3->座號;
                $student = Student::where('school_code', $att_student['school_code'])
                    ->where('semester', $att_student['semester'])
                    ->where('student_year', $att_student['student_year'])
                    ->where('student_class', $att_student['student_class'])
                    ->where('num', $att_student['num'])
                    ->first();

                if (empty($student)) {
                    Student::create($att_student);
                } else {
                    $student->update($att_student);
                }
            }
        }

        return redirect()->route('users.index');
    }

    public function excel_import(Request $request)
    {
        //處理檔案上傳
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $collection = (new FastExcel)->import($file);
            //dd($collection);
            foreach ($collection as $line) {
                if (!isset($line['姓名']) or !isset($line['性別']) or !isset($line['年級(數字)']) or !isset($line['班序(數字)']) or !isset($line['班序(數字)']) or !isset($line['生日(西元)']) or !isset($line['學號']) or !isset($line['座號']) or !isset($line['導師姓名'])) {
                    return back()->withErrors(['欄位有錯，請檢查 excel 檔']);
                }

                if (empty($line['姓名']) and empty($line['年級(數字)'])) {
                    break;
                }
                $class_teacher[$line['年級(數字)']][$line['班序(數字)']] = $line['導師姓名'];

                $att['school_code'] = auth()->user()->current_school_code;
                $att['semester'] = $request->input('semester');
                $att['name'] = $line['姓名'];
                $att['sex'] = $line['性別'];
                $att['birthday'] = $line['生日(西元)'];
                $att['student_sn'] = $line['學號'];
                $att['student_year'] = $line['年級(數字)'];
                $att['student_class'] = $line['班序(數字)'];
                $att['num'] = $line['座號'];
                if (isset($line['身分證號'])) {
                    $att['edu_key'] = hash('sha256', $line['身分證號']);
                }

                $student = Student::where('school_code', $att['school_code'])
                    ->where('semester', $att['semester'])
                    ->where('student_year', $att['student_year'])
                    ->where('student_class', $att['student_class'])
                    ->where('num', $att['num'])
                    ->first();
                if (empty($student)) {
                    Student::create($att);
                } else {
                    $student->update($att);
                }
            }
            foreach ($class_teacher as $k => $v) {
                foreach ($v as $k1 => $v1) {
                    $att2['school_code'] = auth()->user()->current_school_code;
                    $att2['semester'] = $request->input('semester');
                    $att2['student_year'] = $k;
                    $att2['student_class'] = $k1;
                    $att2['user_names'] = $v1;

                    $student_class = StudentClass::where('school_code', $att2['school_code'])
                        ->where('semester', $att2['semester'])
                        ->where('student_year', $att2['student_year'])
                        ->where('student_class', $att2['student_class'])
                        ->first();
                    if (empty($student_class)) {
                        StudentClass::create($att2);
                    } else {
                        //避免先前拉過API 已經有導師了
                        $att2['user_ids'] = null;
                        $student_class->update($att2);
                    }
                }
            }
        }

        return redirect()->route('users.index');
    }

    public function get_API($API_client_id, $API_client_secret)
    {

        // =================================================
        //    學生榮譽榜 (url: https://api.chc.edu.tw)
        //    校務佈告欄 (url: https://api.chc.edu.tw/school-news)
        //    同步學期資料 (url: https://api.chc.edu.tw/semester-data)
        //    更改師生密碼 (url: https://api.chc.edu.tw/change-password)

        // API NAME
        $api_name = '/semester-data';
        //$api_name = '/school-news';
        // 更改師生密碼 (url: https://api.chc.edu.tw/change-password)

        // API URL
        $api_url = 'https://api.chc.edu.tw';
        //: https://api.chc.edu.tw/school-news
        // 建立 CURL 連線
        $ch = curl_init();
        // 取 access token
        curl_setopt($ch, CURLOPT_URL, $api_url . "/oauth?authorize");
        // 設定擷取的URL網址
        curl_setopt($ch, CURLOPT_POST, TRUE);
        // the variable
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'client_id' => $API_client_id,
            'client_secret' => $API_client_secret,
            'grant_type' => 'client_credentials'
        ));

        $data = curl_exec($ch);
        $data = json_decode($data);

        $access_token = $data->access_token;
        $authorization = "Authorization: Bearer " . $access_token;

        curl_setopt($ch, CURLOPT_URL, $api_url . $api_name);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization)); // **Inject Token into Header**
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        return json_decode($result);
    }

    public function show_class($semester, $student_year = null, $student_class = null)
    {
        if (empty($student_year)) $student_year = 1;
        if (empty($student_class)) $student_class = 1;
        $students = Student::where('school_code', auth()->user()->current_school_code)
            ->where('semester', $semester)
            ->where('student_year', $student_year)
            ->where('student_class', $student_class)
            ->orderBy('num')
            ->get();
        $student_classes = StudentClass::where('school_code', auth()->user()->current_school_code)
            ->where('semester', $semester)
            ->orderBy('student_year')
            ->orderBy('student_class')
            ->get();
        $data = [
            'semester' => $semester,
            'students' => $students,
            'student_classes' => $student_classes,
        ];
        return view('users.show_class', $data);
    }
    public function user_disable(User $user)
    {
        if (empty($user->disable)) {
            $att['disable'] = 1;
        } else {
            $att['disable'] = null;
        }
        $user->update($att);
        return redirect()->route('users.index');
    }
}
