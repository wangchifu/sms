<?php
//顯示某目錄下的檔案
use App\Models\SchoolPower;

if (!function_exists('get_files')) {
    function get_files($folder)
    {
        $files = [];
        $i = 0;
        if (is_dir($folder)) {
            if ($handle = opendir($folder)) {
                while (false !== ($name = readdir($handle))) {
                    if ($name != "." && $name != "..") {
                        //去除掉..跟.
                        $files[$i] = $name;
                        $i++;
                    }
                }
                closedir($handle);
            }
        }
        return $files;
    }
}


//刪除某目錄下的任何東西
if (!function_exists('delete_dir')) {
    function delete_dir($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir) || is_link($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!delete_dir($dir . "/" . $item)) {
                chmod($dir . "/" . $item, 0777);

                if (!delete_dir($dir . "/" . $item)) {
                    return false;
                }
            }
        }

        return rmdir($dir);
    }
}

//查某日為中文星期幾
if (!function_exists('get_chinese_weekday')) {
    function get_chinese_weekday($datetime)
    {
        $weekday = date('w', strtotime($datetime));
        return '星期' . ['日', '一', '二', '三', '四', '五', '六'][$weekday];
    }
}

//查某日為中文星期幾
if (!function_exists('get_chinese_weekday2')) {
    function get_chinese_weekday2($datetime)
    {
        $weekday = date('w', strtotime($datetime));
        return ['日', '一', '二', '三', '四', '五', '六'][$weekday];
    }
}

//查指定日期為哪一個學期
if (!function_exists('get_date_semester')) {
    function get_date_semester($date)
    {
        $d = explode('-', $date);
        //查目前學期
        $y = (int)$d[0] - 1911;
        $array1 = array(8, 9, 10, 11, 12, 1);
        $array2 = array(2, 3, 4, 5, 6, 7);
        if (in_array($d[1], $array1)) {
            if ($d[1] == 1) {
                $this_semester = ($y - 1) . "1";
            } else {
                $this_semester = $y . "1";
            }
        } else {
            $this_semester = ($y - 1) . "2";
        }

        return $this_semester;
    }
}

//中文數字轉阿拉伯數字
if (!function_exists('cht2num')) {
    function cht2num($c)
    {
        $cht = [
            '一' => '1',
            '二' => '2',
            '三' => '3',
            '四' => '4',
            '五' => '5',
            '六' => '6',
            '七' => '7',
            '八' => '8',
            '九' => '9',
        ];
        return $cht[$c];
    }
}

//發email
if (!function_exists('send_mail')) {
    function send_mail($to, $subject, $body)
    {
        $data = array("subject" => $subject, "body" => $body, "receipt" => "{$to}");
        $data_string = json_encode($data);
        $ch = curl_init('https://school.chc.edu.tw/api/mail');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'AUTHKEY: #chc7237182#'
            )
        );
        $result = curl_exec($ch);
        $obj = json_decode($result, true);
        if ($obj["success"] == true) {
            //echo "<body onload=alert('已mail通知')>";
        };
    }
}


if (!function_exists('get_user_power')) {
    function get_user_power($user_id)
    {
        $school_powers = SchoolPower::where('user_id', $user_id)
            ->get();

        $user_power = [];
        foreach ($school_powers as $school_power) {
            $user_power[$school_power->module] = $school_power->power_type;
        }
        return $user_power;
    }
}

if (!function_exists('check_admin')) {
    function check_admin($module,$id=null)
    {
        $system_admin = (isset($user_power['school_admin'])) ? 1 : null;
        if(is_null($id)){
            $user_power = session('user_power');            
            $module_admin = (isset($user_power[$module])) ? 1 : null;
        }else{
            $school_power = \App\Models\SchoolPower::where('module',$module)->where('user_id',$id)->first();
            $module_admin = ($school_power) ? 1 : null;
        }                
        if ($system_admin != 1 and $module_admin != 1) {
            return null;
        } else {
            return 1;
        }
    }
}

//取登入的學校代碼
if (!function_exists('school_code')) {
    function school_code()
    {
        $database = config('app.database');
        if (isset($_SERVER['HTTP_HOST'])) {
            $code = substr($database[$_SERVER['HTTP_HOST']], 3, 6);
        } else {
            $code = "";
        }
        return $code;
    }
}

//秀某學期的每一天
if (!function_exists('get_semester_dates')) {
    function get_semester_dates($semester)
    {
        $this_year = substr($semester, 0, 3) + 1911;
        $this_seme = substr($semester, -1, 1);
        $next_year = $this_year + 1;
        if ($this_seme == 1) {
            $month_array = ["八月" => $this_year . "-08", "九月" => $this_year . "-09", "十月" => $this_year . "-10", "十一月" => $this_year . "-11", "十二月" => $this_year . "-12", "一月" => $next_year . "-01"];
        } else {
            $month_array = ["二月" => $next_year . "-02", "三月" => $next_year . "-03", "四月" => $next_year . "-04", "五月" => $next_year . "-05", "六月" => $next_year . "-06"];
        }


        foreach ($month_array as $k => $v) {
            $semester_dates[$k] = get_month_date($v);
        }
        return $semester_dates;
    }
}

if (!function_exists('get_month_date')) {
    //秀某年某月的每一天
    function get_month_date($year_month)
    {
        $this_date = explode("-", $year_month);
        $days = array("01" => "31", "02" => "28", "03" => "31", "04" => "30", "05" => "31", "06" => "30", "07" => "31", "08" => "31", "09" => "30", "10" => "31", "11" => "30", "12" => "31");
        //潤年的話，二月29天
        if (checkdate(2, 29, $this_date[0])) {
            $days['02'] = 29;
        } else {
            $days['02'] = 28;
        }

        for ($i = 1; $i <= $days[$this_date[1]]; $i++) {
            $order_date[$i] = $this_date[0] . "-" . $this_date[1] . "-" . sprintf("%02s", $i);
        }
        return $order_date;
    }
}

//查某日星期幾
if (!function_exists('get_date_w')) {
    function get_date_w($d)
    {
        $arrDate = explode("-", $d);
        $week = date("w", mktime(0, 0, 0, $arrDate[1], $arrDate[2], $arrDate[0]));
        return $week;
    }
}

function num2str($num)
{
    $string = "";
    $numc = "零,壹,貳,參,肆,伍,陸,柒,捌,玖";
    $unic = ",拾,佰,仟";
    $unic1 = "元整,萬,億,兆,京";
    $numc_arr = explode(",", $numc);
    $unic_arr = explode(",", $unic);
    $unic1_arr = explode(",", $unic1);
    $i = str_replace(",", "", $num);
    $c0 = 0;
    $str = array();
    do {
        $aa = 0;
        $c1 = 0;
        $s = "";
        $lan = (strlen($i) >= 4) ? 4 : strlen($i);
        $j = substr($i, -$lan);
        while ($j > 0) {
            $k = $j % 10;
            if ($k > 0) {
                $aa = 1;
                $s = $numc_arr[$k] . $unic_arr[$c1] . $s;
            } elseif ($k == 0) {
                if ($aa == 1) $s = "0" . $s;
            }
            $j = intval($j / 10);
            $c1 += 1;
        }
        $str[$c0] = ($s == '') ? '' : $s . $unic1_arr[$c0];
        $count_len = strlen($i) - 4;
        $i = ($count_len > 0) ? substr($i, 0, $count_len) : '';
        $c0 += 1;
    } while ($i != '');
    foreach ($str as $v) $string .= array_pop($str);
    $string = preg_replace('/0+/', '零', $string);
    return $string;
}

function GetIP()
{
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } elseif (!empty($_SERVER["REMOTE_ADDR"])) {
        $cip = $_SERVER["REMOTE_ADDR"];
    } else {
        $cip = "無法取得IP位址！";
    }
    return $cip;
}

function line_notify($token,$string){
    $headers = array(
        'Content-Type: multipart/form-data',
        'Authorization:'.$token
    );
    $message = array(
        'message' => $string
    );
    $ch = curl_init();
    curl_setopt($ch , CURLOPT_URL , "https://notify-api.line.me/api/notify");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    $result = curl_exec($ch);
    curl_close($ch);
}
