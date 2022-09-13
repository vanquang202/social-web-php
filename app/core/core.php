<?php
function view($view, $array = [], $errors = [], $support = [], $support_2 = [], $support_3 = [], $support_4 = [], $abc = [])
{
    $view = explode('.', $view);
    extract($abc);
    $view = implode('/', $view);
    echo require_once "../app/" . $view . ".php";
}
function view2($view, $array = [])
{
    extract($array);
    $view = explode('.', $view);
    $view = implode('/', $view);
    echo require_once "../app/" . $view . ".php";
}
function redirect($link)
{
    header('Location:' . $link);
}
function checkLogin($value)
{

    if (!isset($_SESSION[$value])) {
        redirect('login');
    }
}
function checkNotLogin($value)
{
    if (isset($_SESSION[$value])) {
        redirect('');
    }
}
function errors($arr)
{
    $errors = "";
    foreach ($arr as $key => $val) {
        $keyKt = explode('.', $key);
        $keyStar = array_shift($keyKt);
        $keyEnd = end($keyKt);
        if ($keyEnd == 'required') {
            if (empty($val)) {
                $keyStar = ucfirst($keyStar);
                $errors .= " $keyStar không được bỏ trống ! ,";
            }
        } elseif ($keyEnd == 'min') {
            if (strlen($val) < 6) {
                $keyStar = ucfirst($keyStar);
                $errors .= " $keyStar không được nhỏ hơn 6 kí tự ! ,";
            }
        } elseif ($keyEnd == 'required|min') {
            if (empty($val)) {
                $keyStar = ucfirst($keyStar);
                $errors .= " $keyStar không được bỏ trống ! ,";
            } elseif (strlen($val) < 6) {
                $keyStar = ucfirst($keyStar);
                $errors .= " $keyStar không được nhỏ hơn 6 kí tự ! ,";
            }
        } elseif ($keyEnd == 'image') {
            if (empty($val['name'])) {
                $keyStar = ucfirst($keyStar);
                $errors .= " $keyStar bạn phải nhạp lên ảnh ! ,";
            }
        }
    }
    $errors = explode(",", $errors);
    $errors = array_filter($errors);
    return $errors;
}
// $time_elapsed = timeAgo($time_ago); //The argument $time_ago is in timestamp (Y-m-d H:i:s)format.

//Function definition

function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed;
    $minutes    = round($time_elapsed / 60);
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400);
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640);
    $years      = round($time_elapsed / 31207680);
    // Seconds
    if ($seconds <= 60) {
        return "just now";
    }
    //Minutes
    else if ($minutes <= 60) {
        if ($minutes == 1) {
            return "1 phút trước";
        } else {
            return "$minutes phút trước";
        }
    }
    //Hours
    else if ($hours <= 24) {
        if ($hours == 1) {
            return "1 giờ ";
        } else {
            return "$hours giờ ";
        }
    }
    //Days
    else if ($days <= 7) {
        if ($days == 1) {
            return "Hôm qua";
        } else {
            return "$days ngày ";
        }
    }
    //Weeks
    else if ($weeks <= 4.3) {
        if ($weeks == 1) {
            return "1 tuần ";
        } else {
            return "$weeks tuần ";
        }
    }
    //Months
    else if ($months <= 12) {
        if ($months == 1) {
            return "1 tháng ";
        } else {
            return "$months tháng ";
        }
    }
    //Years
    else {
        if ($years == 1) {
            return "1 năm ";
        } else {
            return "$years năm ";
        }
    }
}