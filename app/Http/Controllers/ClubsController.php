<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ClubBlack;
use App\Models\ClubRegister;
use App\Models\ClubNotRegister;
use App\Models\ClubSemester;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Rap2hpoutre\FastExcel\FastExcel;
use PHPExcel_IOFactory;
use PHPExcel;

class ClubsController extends Controller
{
    public function __construct()
    {
        $admin = check_admin('club_admin');
        if(!$admin){
            return back();
        }
    }

    public function index()
    {
        $club_semesters = ClubSemester::orderby('semester', 'DESC')->get();
        
        $data = [
            'club_semesters' => $club_semesters,            
        ];
        return view('clubs.index', $data);
    }

    public function semester_create()
    {
        return view('clubs.create');
    }

    public function semester_store(Request $request)
    {
        $semester = $request->input('semester');
        $check = ClubSemester::where('semester', $semester)->first();

        if (!$check) {
            $att = $request->all();
            $att['start_date'] = $request->input('year_1') . '-' . sprintf("%02s", $request->input('month_1')) . '-' . sprintf("%02s", $request->input('day_1')) . '-' . sprintf("%02s", $request->input('hour_1')) . '-' . sprintf("%02s", $request->input('min_1'));
            $att['stop_date'] = $request->input('year_2') . '-' . sprintf("%02s", $request->input('month_2')) . '-' . sprintf("%02s", $request->input('day_2')) . '-' . sprintf("%02s", $request->input('hour_2')) . '-' . sprintf("%02s", $request->input('min_2'));
            $att['start_date2'] = $request->input('year2_1') . '-' . sprintf("%02s", $request->input('month2_1')) . '-' . sprintf("%02s", $request->input('day2_1')) . '-' . sprintf("%02s", $request->input('hour2_1')) . '-' . sprintf("%02s", $request->input('min2_1'));
            $att['stop_date2'] = $request->input('year2_2') . '-' . sprintf("%02s", $request->input('month2_2')) . '-' . sprintf("%02s", $request->input('day2_2')) . '-' . sprintf("%02s", $request->input('hour2_2')) . '-' . sprintf("%02s", $request->input('min2_2'));
            ClubSemester::create($att);
        } else {
            return back()->withErrors(['errors' => [$semester . '學期已經有設定了！']]);
        }

        return redirect()->route('clubs.index');
    }

    public function semester_delete($semester)
    {
        ClubSemester::where('semester', $semester)->delete();
        Club::where('semester', $semester)->delete();        
        ClubRegister::where('semester', $semester)->delete();
        ClubNotRegister::where('semester', $semester)->delete();
        ClubBlack::where('semester', $semester)->delete();
        return redirect()->route('clubs.index');
    }

    public function semester_edit(ClubSemester $club_semester)
    {
        $data = [
            'club_semester' => $club_semester
        ];
        return view('clubs.edit', $data);
    }

    public function semester_update(Request $request, ClubSemester $club_semester)
    {
        $att = $request->all();
        $att['start_date'] = $request->input('year_1') . '-' . sprintf("%02s", $request->input('month_1')) . '-' . sprintf("%02s", $request->input('day_1')) . '-' . sprintf("%02s", $request->input('hour_1')) . '-' . sprintf("%02s", $request->input('min_1'));
        $att['stop_date'] = $request->input('year_2') . '-' . sprintf("%02s", $request->input('month_2')) . '-' . sprintf("%02s", $request->input('day_2')) . '-' . sprintf("%02s", $request->input('hour_2')) . '-' . sprintf("%02s", $request->input('min_2'));
        $att['start_date2'] = $request->input('year2_1') . '-' . sprintf("%02s", $request->input('month2_1')) . '-' . sprintf("%02s", $request->input('day2_1')) . '-' . sprintf("%02s", $request->input('hour2_1')) . '-' . sprintf("%02s", $request->input('min2_1'));
        $att['stop_date2'] = $request->input('year2_2') . '-' . sprintf("%02s", $request->input('month2_2')) . '-' . sprintf("%02s", $request->input('day2_2')) . '-' . sprintf("%02s", $request->input('hour2_2')) . '-' . sprintf("%02s", $request->input('min2_2'));
        $club_semester->update($att);
        return redirect()->route('clubs.index');
    }

    public function setup($semester = null)
    {
        $club_semesters_array = ClubSemester::orderby('semester', 'DESC')->pluck('semester', 'semester')->toArray();
        $clubs = [];
        if ($semester == null) {
            $s = ClubSemester::orderBy('semester', 'DESC')->first();
            if ($s) {
                $semester = $s->semester;
            } else {
                $semester = null;
            }
        }
        $clubs1 = [];
        $clubs2 = [];
        if ($semester) {
            $clubs1 = Club::where('semester', $semester)->where('class_id', '1')->orderBy('no')->get();
            $clubs2 = Club::where('semester', $semester)->where('class_id', '2')->orderBy('no')->get();
        }

        $data = [
            'club_semesters_array' => $club_semesters_array,
            'clubs1' => $clubs1,
            'clubs2' => $clubs2,
            'semester' => $semester,
        ];
        return view('clubs.setup', $data);
    }

    public function club_create($semester)
    {
        $club_classes = [
            '1' => '學生特色社團',
            '2' => '學生課後活動',
        ];
        $club_classes = [
            '1' => '學生特色社團',
            '2' => '學生課後活動',
        ];
        $data = [
            'semester' => $semester,
            'club_classes' => $club_classes,
        ];
        return view('clubs.club_create', $data);
    }

    public function club_store(Request $request)
    {
        $no_array = [
            '1' => 'A',
            '2' => 'B',
            '3' => 'C',
            '4' => 'D',
            '5' => 'E',
            '6' => 'F',
            '7' => 'G',
            '8' => 'H',
            '9' => 'I',
            '10' => 'J',
            '11' => 'K',
            '12' => 'L',
            '13' => 'M',
            '14' => 'N',
            '15' => 'O',
            '16' => 'P',
            '17' => 'Q',
            '18' => 'R',
            '19' => 'S',
            '20' => 'T',
            '21' => 'U',
            '22' => 'V',
            '23' => 'W',
            '24' => 'X',
            '25' => 'Y',
            '26' => 'Z',
            '27' => 'AA',
            '28' => 'AB',
            '29' => 'AC',
            '30' => 'AD',
            '31' => 'AE',
            '32' => 'AF',
            '33' => 'AG',
            '34' => 'AH',
            '35' => 'AI',
            '36' => 'AJ',
            '37' => 'AK',
            '38' => 'AL',
            '39' => 'AM',
            '40' => 'AN',
            '41' => 'AO',
            '42' => 'AP',
            '43' => 'AQ',
            '44' => 'AR',
            '45' => 'AS',
            '46' => 'AT',
            '47' => 'AU',
            '48' => 'AV',
            '49' => 'AW',
            '50' => 'AX',
            '51' => 'AY',
            '52' => 'AZ',
            '53' => 'BA',
            '54' => 'BB',
            '55' => 'BC',
            '56' => 'BD',
            '57' => 'BE',
            '58' => 'BF',
            '59' => 'BG',
            '60' => 'BH',
            '61' => 'BI',
            '62' => 'BJ',
            '63' => 'BK',
            '64' => 'BL',
            '65' => 'BM',
            '66' => 'BN',
            '67' => 'BO',
            '68' => 'BP',
            '69' => 'BQ',
            '70' => 'BR',
            '71' => 'BS',
            '72' => 'BT',
            '73' => 'BU',
            '74' => 'BV',
            '75' => 'BW',
            '76' => 'BX',
            '77' => 'BY',
            '78' => 'BZ',
            '79' => 'CA',
            '80' => 'CB',
            '81' => 'CC',
            '82' => 'CD',
            '83' => 'CE',
            '84' => 'CF',
            '85' => 'CG',
            '86' => 'CH',
            '87' => 'CI',
            '88' => 'CJ',
            '89' => 'CK',
            '90' => 'CL',
            '91' => 'CM',
            '92' => 'CN',
            '93' => 'CO',
            '94' => 'CP',
            '95' => 'CQ',
            '96' => 'CR',
            '97' => 'CS',
            '98' => 'CT',
            '99' => 'CU',
            '100' => 'CV',
            '101' => 'CW',
            '102' => 'CX',
            '103' => 'CY',
            '104' => 'CZ',

        ];
        $semester = $request->input('semester');
        $name = $request->input('name');
        $class_id = $request->input('class_id');
        $count = Club::where('semester', $semester)
            ->where('class_id', $class_id)
            ->count();
        $no = $no_array[$count + 1];

        /**
        $check1 = Club::where('semester',$semester)
            ->where('no',$no)
            ->where('class_id',$class_id)
            ->first();
         */
        $check2 = Club::where('semester', $semester)
            ->where('no', $no)
            ->where('name', $name)
            ->where('class_id', $class_id)
            ->first();
        if ($check2) {
            return back()->withErrors(['errors' => [$request->input['name'] . ' 此類別中已經有設定此名稱的社團！']]);
        } else {
            $att = $request->all();
            $att['no'] = $no;
            $s1 = $att['start1_time1'] . "-" . $att['start1_time2'] . "-" . $att['start1_time3'];
            $s2 = $att['start2_time1'] . "-" . $att['start2_time2'] . "-" . $att['start2_time3'];
            $s3 = $att['start3_time1'] . "-" . $att['start3_time2'] . "-" . $att['start3_time3'];
            $s4 = $att['start4_time1'] . "-" . $att['start4_time2'] . "-" . $att['start4_time3'];
            $s5 = $att['start5_time1'] . "-" . $att['start5_time2'] . "-" . $att['start5_time3'];
            if ($att['start2_time1'] === "0") {
                $att['start_time'] = $s1;
            } else {
                $att['start_time'] = $s1 . ';' . $s2;
            }
            if ($att['start3_time1'] != "0") {
                $att['start_time'] = $att['start_time'] . ';' . $s3;
            }
            if ($att['start4_time1'] != "0") {
                $att['start_time'] = $att['start_time'] . ';' . $s4;
            }
            if ($att['start5_time1'] != "0") {
                $att['start_time'] = $att['start_time'] . ';' . $s5;
            }

            Club::create($att);

            return redirect()->route('clubs.setup', $semester);
        }
    }

    public function club_copy(Request $request)
    {
        $clubs = Club::where('semester', $request->input('semester1'))->get();

        foreach ($clubs as $club) {
            $att['no'] = $club->no;
            $att['class_id'] = $club->class_id;
            $att['semester'] = $request->input('semester2');
            $att['name'] = $club->name;
            $att['contact_person'] = $club->contact_person;
            $att['telephone_num'] = $club->telephone_num;
            $att['money'] = $club->money;
            $att['people'] = $club->people;
            $att['teacher_info'] = $club->teacher_info;
            $att['start_date'] = $club->start_date;
            $att['start_time'] = $club->start_time;
            $att['place'] = $club->place;
            $att['ps'] = $club->ps;
            $att['taking'] = $club->taking;
            $att['prepare'] = $club->prepare;
            $att['year_limit'] = $club->year_limit;
            $att['no_check'] = $club->no_check;

            Club::create($att);
        }

        return redirect()->route('clubs.setup', $att['semester']);
    }

    public function club_edit(Club $club)
    {
        $club_classes = [
            '1' => '學生特色社團',
            '2' => '學生課後活動',
        ];
        $data = [
            'club' => $club,
            'club_classes' => $club_classes,
        ];

        return view('clubs.club_edit', $data);
    }

    public function club_update(Request $request, Club $club)
    {
        $att = $request->all();
        $att['no_check'] = ($request->input('no_check'))?1:null;
        $s1 = $att['start1_time1'] . "-" . $att['start1_time2'] . "-" . $att['start1_time3'];
        $s2 = $att['start2_time1'] . "-" . $att['start2_time2'] . "-" . $att['start2_time3'];
        $s3 = $att['start3_time1'] . "-" . $att['start3_time2'] . "-" . $att['start3_time3'];
        $s4 = $att['start4_time1'] . "-" . $att['start4_time2'] . "-" . $att['start4_time3'];
        $s5 = $att['start5_time1'] . "-" . $att['start5_time2'] . "-" . $att['start5_time3'];
        if ($att['start2_time1'] === "0") {
            $att['start_time'] = $s1;
        } else {
            $att['start_time'] = $s1 . ';' . $s2;
        }
        if ($att['start3_time1'] != "0") {
            $att['start_time'] = $att['start_time'] . ';' . $s3;
        }
        if ($att['start4_time1'] != "0") {
            $att['start_time'] = $att['start_time'] . ';' . $s4;
        }
        if ($att['start5_time1'] != "0") {
            $att['start_time'] = $att['start_time'] . ';' . $s5;
        }
        $club->update($att);
        return redirect()->route('clubs.setup', $club->semester);
    }

    public function club_delete(Club $club)
    {
        ClubRegister::where('club_id', $club->id)->delete();
        $club->delete();
        return redirect()->route('clubs.setup', $club->semester);
    }

    public function report()
    {
        return view('clubs.report');
    }

    public function semester_select()
    {
        if (!empty(session('parents'))) {
            return redirect()->route('clubs.parents_do',['class_id'=>'1']);
        }
        session(['parents' => null]);
        //$semester = get_date_semester(date('Y-m-d'));
        //改列尚在報名中的
        $this_date = date('Y-m-d-H-i');
        $club_semesters = ClubSemester::where('stop_date', '>=', $this_date)->orWhere('stop_date2', '>=', $this_date)->orderBy('semester')->get();
        $data = [
            'club_semesters' => $club_semesters,
        ];
        return view('clubs.semester_select', $data);
    }

    public function parents_login($semester, $class_id)
    {
        $club_semester = ClubSemester::where('semester', $semester)->first();
        if ($class_id == '1') {
            if (date('YmdHi') >= str_replace('-', '', $club_semester->start_date) and date('YmdHi') <= str_replace('-', '', $club_semester->stop_date)) {
                $data = [
                    'semester' => $semester,
                    'class_id' => $class_id,
                ];
                return view('clubs.parents_login', $data);
            } else {
                return back();
            }
        }
        if ($class_id == '2') {
            if (date('YmdHi') >= str_replace('-', '', $club_semester->start_date2) and date('YmdHi') <= str_replace('-', '', $club_semester->stop_date2)) {
                $data = [
                    'semester' => $semester,
                    'class_id' => $class_id,
                ];
                return view('clubs.parents_login', $data);
            } else {
                return back();
            }
        }
    }

    public function do_login(Request $request)
    {
        if ($request->input('class_num')) {
            $student_year = substr($request->input('class_num'),0,1);
            $student_class = (int)substr($request->input('class_num'),1,2);
            $num = (int)substr($request->input('class_num'),3,2);

            $check = Student::where('student_year', $student_year)
                ->where('student_class', $student_class)
                ->where('num', $num)
                ->where('semester', $request->input('semester'))
                ->first();

            if (!$check) {
                return back()->withErrors(['error' => ['查無此帳號！']]);
            } else {
                if ($check->disable == 1) {
                    return back()->withErrors(['error' => ['此帳號已被停用！']]);
                }
                if ($request->input('pwd') != $check->pwd) {
                    return back()->withErrors(['error' => ['密碼錯誤！']]);
                } else {
                    session(['parents' => $check->id]);
                    return redirect()->route('clubs.parents_do', $request->input('class_id'));
                };
            }
        }
    }

    public function parents_do($class_id)
    {
        if (empty(session('parents'))) {
            return redirect()->route('clubs.semester_select');
        }

        $user = Student::where('id', session('parents'))
            ->first();


        //檢查是否為黑名單
        $black = ClubBlack::where('semester', $user->semester)
            ->where('student_id', $user->id)
            ->where('class_id', $class_id)
            ->first();
        if ($class_id == 1) {
            $n = "1.學生特色社團";
        }
        if ($class_id == 2) {
            $n = "2.學生課後活動";
        }
        if (!empty($black)) {
            session(['parents' => null]);
            echo "<body onload=alert('你被處罰此學期無法報名" . $n . "')>";
            header("refresh:3;url=" . route('clubs.semester_select'));
            die();
        }


        $class_id = ($class_id) ? $class_id : 1;

        $clubs = Club::where('semester', $user->semester)
            ->where('class_id', $class_id)
            ->orderBy('no')
            ->get();

        $club_semester = ClubSemester::where('semester', $user->semester)
            ->first();


        //檢查是否非可報名時間
        if ($class_id == '1') {
            if (date('YmdHi') >= str_replace('-', '', $club_semester->start_date) and date('YmdHi') <= str_replace('-', '', $club_semester->stop_date)) {
            } else {
                echo "<body onload=alert('非報名時間')>";
                echo "<a href=2 onclick =history.back()>返回</a>";
                die();
            }
        }
        if ($class_id == '2') {
            if (date('YmdHi') >= str_replace('-', '', $club_semester->start_date2) and date('YmdHi') <= str_replace('-', '', $club_semester->stop_date2)) {
            } else {
                echo "<body onload=alert('非報名時間')>";
                echo "<a href=1 onclick =history.back()>返回</a>";
                die();
            }
        }


        $club_classes = [
            '1' => '1.學生特色社團 (' . $club_semester->start_date . '~' . $club_semester->stop_date . ')',
            '2' => '2.學生課後活動 (' . $club_semester->start_date2 . '~' . $club_semester->stop_date2 . ')',
        ];

        $data = [
            'user' => $user,
            'clubs' => $clubs,
            'club_semester' => $club_semester,
            'club_classes' => $club_classes,
            'class_id' => $class_id,
        ];
        return view('clubs.parents_do', $data);
    }

    public function get_telephone(Request $request, Student $student)
    {
        $att = $request->all();
        $student->update($att);
        return redirect()->route('clubs.parents_do', $request->input('class_id'));
    }

    public function parents_logout()
    {
        session(['parents' => null]);
        return redirect()->route('clubs.semester_select');
    }

    public function change_pwd($class_id)
    {        
        if (empty(session('parents'))) {
            return redirect()->route('clubs.semester_select');
        }        
        $user = Student::where('id', session('parents'))
            ->first();
        $data = [
            'user' => $user,
            'class_id' => $class_id,
        ];
        return view('clubs.change_pwd', $data);
    }

    public function change_pwd_do(Request $request)
    {
        $user = Student::where('id', session('parents'))
            ->first();

        if ($request->input('password0') != $user->pwd) {
            return back()->withErrors(['error' => ['舊密碼錯誤！你不是本人！？']]);
        }
        if ($request->input('password1') != $request->input('password2')) {
            return back()->withErrors(['error' => ['兩次新密碼不相同']]);
        }


        $att['pwd'] = $request->input('password1');
        $user->update($att);
        return redirect()->route('clubs.parents_logout');
    }

    public function show_club(Club $club,$class_id)
    {
        if (empty(session('parents'))) {
            return redirect()->route('clubs.semester_select');
        }
        $user = Student::where('id', session('parents'))
        ->first();
        $data = [
            'user'=>$user,
            'club' => $club,
            'class_id'=>$class_id,
        ];

        return view('clubs.show_club', $data);
    }

    public function sign_up(Club $club)
    {
        if (empty(session('parents'))) {
            return redirect()->route('clubs.semester_select');
        }

        $user = Student::where('id', session('parents'))
            ->first();
        $club_register = ClubRegister::where('semester', $user->semester)
            ->where('club_id', $club->id)
            ->where('student_id', $user->id)
            ->first();
        $club_semester = ClubSemester::where('semester', $user->semester)
            ->first();

        if ($club->class_id == 1) {
            if (date('YmdHi') >= str_replace('-', '', $club_semester->start_date) and date('YmdHi') <= str_replace('-', '', $club_semester->stop_date)) {
            } else {
                return back();
            }
        }

        if ($club->class_id == 2) {
            if (date('YmdHi') >= str_replace('-', '', $club_semester->start_date2) and date('YmdHi') <= str_replace('-', '', $club_semester->stop_date2)) {
            } else {
                return back();
            }
        }


        $check_num = ClubRegister::where('semester', $user->semester)
            ->where('student_id', $user->id)
            ->where('class_id', $club->class_id)
            ->count();

        $count_num = ClubRegister::where('semester', $user->semester)
            ->where('club_id', $club->id)
            ->where('class_id', $club->class_id)
            ->count();

        //時間重疊就不能報名
        if(!$club->no_check){
            $tt = explode(';', $club->start_time);
            $check_registers = ClubRegister::where('semester', $user->semester)
                ->where('student_id', $user->id)
                ->get();
            foreach ($check_registers as $check_register) {
                $ss = explode(';', $check_register->club->start_time);
                foreach ($ss as $k => $v) {
                    $check_t = explode('-', $v);
    
                    foreach ($tt as $k2 => $v2) {
                        $want_t = explode('-', $v2);
                        if ($want_t[0] == $check_t[0]) {
                            $beginTime1 = strtotime(date('Y-m-d') . ' ' . $want_t[1]);
                            $endTime1 = strtotime(date('Y-m-d') . ' ' . $want_t[2]);
                            $beginTime2 = strtotime(date('Y-m-d') . ' ' . $check_t[1]);
                            $endTime2 = strtotime(date('Y-m-d') . ' ' . $check_t[2]);
    
                            if ($this->is_time_cross($beginTime1, $endTime1, $beginTime2, $endTime2)) {
                                return back()->withErrors(['errors' => [$club->name . ' 此社團和已報名的社團時間衝突！']]);
                            }
                        }
                    }
                }
            }
        }
        
        //年級不對
        if (!in_array($user->student_year, explode(',', $club->year_limit))) {
            return back()->withErrors(['errors' => [$club->name . ' 此社團有年級限制，與你不符！']]);
        }


        if (empty($club_register) and $check_num < $club_semester->club_limit and $count_num < ($club->taking + $club->prepare)) {
            $att['semester'] = $user->semester;
            $att['club_id'] = $club->id;
            $att['student_id'] = $user->id;
            $att['class_id'] = $club->class_id;            
            ClubRegister::create($att);
        }

        return redirect()->route('clubs.parents_do', $club->class_id);
    }

    public function sign_down($club_id)
    {
        if (empty(session('parents'))) {
            return redirect()->route('clubs.semester_select');
        }

        $user = Student::where('id', session('parents'))
            ->first();

        $club = Club::find($club_id);

        ClubRegister::where('semester', $user->semester)
            ->where('club_id', $club_id)
            ->where('student_id', $user->id)
            ->delete();

        $att['semester'] = $user->semester;
        $att['ip'] = GetIP();
        $att['event'] = "學號：" . $user->student_sn . " 班級座號：" . $user->student_year."年".$user->student_class."班".$user->num."號" . " " . $user->name . " 取消報名了「" . $club->name . "」";
        ClubNotRegister::create($att);

        return redirect()->route('clubs.parents_do', $club->class_id);
    }

    public function sign_show(Club $club, $class_id)
    {
        if (empty(session('parents'))) {
            return redirect()->route('clubs.semester_select');
        }

        $user = Student::where('id', session('parents'))
            ->first();

        $club_registers = ClubRegister::where('semester', $user->semester)
            ->where('club_id', $club->id)
            ->orderBy('created_at')
            ->get();
        $data = [
            'user' => $user,
            'club' => $club,
            'club_registers' => $club_registers,
            'class_id' => $class_id,
        ];

        return view('clubs.sign_show', $data);
    }

    public function report_situation($semester = null)
    {
        $user = Student::where('id', session('parents'))
            ->first();
        $club_semesters_array = ClubSemester::orderby('semester', 'DESC')->pluck('semester', 'semester')->toArray();
        if ($semester == null) {
            $s = ClubSemester::orderBy('semester', 'DESC')->first();
            if ($s) {
                $semester = $s->semester;
            } else {
                $semester = null;
            }
        }

        if ($semester) {
            $clubs1 = Club::where('semester', $semester)->where('class_id', '1')->orderBy('no')->get();
            $clubs2 = Club::where('semester', $semester)->where('class_id', '2')->orderBy('no')->get();
        } else {
            $clubs1 = [];
            $clubs2 = [];
        }

        $data = [
            'user' => $user,
            'club_semesters_array' => $club_semesters_array,
            'semester' => $semester,
            'clubs1' => $clubs1,
            'clubs2' => $clubs2,
        ];

        return view('clubs.report_situation', $data);
    }

    public function report_not_situation($semester = null)
    {
        $club_semesters_array = ClubSemester::orderby('semester', 'DESC')->pluck('semester', 'semester')->toArray();
        $not_registers = [];
        if ($semester == null) {
            $s = ClubSemester::orderBy('semester', 'DESC')->first();
            if ($s) {
                $semester = $s->semester;
                $not_registers = ClubNotRegister::where('semester', $semester)->get();
            } else {
                $semester = null;
            }
        } else {
            $not_registers = ClubNotRegister::where('semester', $semester)->get();
        }


        $data = [
            'club_semesters_array' => $club_semesters_array,
            'semester' => $semester,
            'not_registers' => $not_registers,
        ];

        return view('clubs.report_not_situation', $data);
    }

    public function report_register_delete(ClubRegister $club_register)
    {
        $att['semester'] = $club_register->semester;
        $att['ip'] = GetIP();
        $att['event'] = "管理員幫 學號：" . $club_register->user->student_sn . " 班級座號：" . $club_register->user->student_year."年".$club_register->user->student_class."班".$club_register->user->num."號" . " " . $club_register->user->name . " 取消報名了「" . $club_register->club->name . "」";
        ClubNotRegister::create($att);
        $club_register->delete();        
        return redirect()->route('clubs.report_situation');
    }

    public function report_situation_download($semester, $class_id)
    {
        $clubs = Club::where('semester', $semester)->where('class_id', $class_id)->get();
        $n = 1;
        foreach ($clubs as $club) {
            $club_registers = ClubRegister::where('semester', $semester)
                ->where('club_id', $club->id)
                ->get();
            $taking = $club->taking;
            $prepare = $club->prepare;
            $i = 1;
            $j = 1;
            if (count($club_registers) < $club->people) {
                $open = "不開班";
            } else {
                $open = "開班成功";
            }
            if (count($club_registers) > 0) {
                foreach ($club_registers as $club_register) {
                    if ($i <= $taking) $order = "正取" . $i;
                    if ($i > $taking and $j <= $prepare) {
                        $order = "備取" . $j;
                        $j++;
                    }

                    $data[$n] = [
                        '社團' => $club->name,
                        '班級座號' => $club_register->user->student_year."年".$club_register->user->student_class."班".$club_register->user->num."號",
                        '姓名' => $club_register->user->name,
                        '姓名(藏)' => mb_substr($club_register->user->name, 0, 1) . "O" . mb_substr($club_register->user->name, -1),
                        '家長電話' => $club_register->user->parents_telephone,
                        '錄取狀況' => $order,
                        '報名時間' => date('Y-m-d H:i:s', strtotime($club_register->created_at)),
                        '開班狀態' => $open,
                    ];
                    $i++;
                    $n++;
                }
            } else {
                $data[$n] = [
                    '社團' => $club->name,
                    '班級座號' => '',
                    '姓名' => '',
                    '姓名(藏)' => '',
                    '家長電話' => '',
                    '錄取狀況' => '',
                    '報名時間' => '',
                    '開班狀態' => $open,
                ];
                $i++;
                $n++;
            }
        }


        $list = collect($data);

        return (new FastExcel($list))->download($semester . '_社團報名結果.xlsx');
    }

    
}
