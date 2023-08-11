<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\ClubBlack;
use App\Models\ClubRegister;
use App\Models\ClubNotRegister;
use App\Models\ClubSemester;
use App\Models\ClubStudent;
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

    
}
