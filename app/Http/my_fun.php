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

//刪除某目錄所有檔案
if (!function_exists('deldir')) {
    function deldir($dir)
    {
        if (is_dir($dir)) {
            $dh = opendir($dir);
            while ($file = readdir($dh)) {
                if ($file != "." && $file != "..") {
                    $fullpath = $dir . "/" . $file;
                    if (!is_dir($fullpath)) {
                        unlink($fullpath);
                    } else {
                        deldir($fullpath);
                    }
                }
            }
            closedir($dh);

            //删除当前文件夹：
            if (rmdir($dir)) {
                return true;
            } else {
                return false;
            }
        }
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
    function get_user_power($school_code, $user_id)
    {
        $school_powers = SchoolPower::where('school_code', $school_code)
            ->where('user_id', $user_id)
            ->get();

        $user_power = [];
        foreach ($school_powers as $school_power) {
            $user_power[$school_power->module] = $school_power->power_type;
        }
        return $user_power;
    }
}
