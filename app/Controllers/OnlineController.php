<?php
require_once "../app/Models/User.php";
require_once "../app/Models/Post.php";
require_once "../app/Models/thongbao.php";
require_once "../app/Models/Online.php";
require_once "../app/core/core.php";
class OnlineController
{
    public function online()
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $timeOnline = date('Y-m-d H:i:s', strtotime('+5 minutes'));
        if (isset($_SESSION["member"])) {
            if (count((new Online)->where('id_user', $_SESSION["member"]['id'])) > 0) {
                $check = (new Online)->whereOne('id_user', $_SESSION["member"]['id']);
                $timeupdate = date('Y-m-d H:i:s', strtotime(' +2 minutes'));
                (new Online)->update([
                    'id_user' => $_SESSION["member"]['id'],
                    'time_onl' => $timeupdate,
                ], $check['id']);
            } else {
                (new Online)->create([
                    'id_user' => $_SESSION["member"]['id'],
                    'time_onl' => $timeOnline,
                ]);
            }
        };
    }

    public function checkOnline()
    {
        $model = (new Online)->all();
        $now = date('H:i:s');
        foreach ($model as $value) {
            if ($value['time_onl'] > $now) {
            }
        }
    }
}