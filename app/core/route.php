<?php
// error_reporting(0);
require_once "../app/Controllers/Controller.php";
require_once "../app/Controllers/ChatController.php";
require_once "../app/Controllers/OnlineController.php";
require_once "../app/core/core.php";
// $arr = ['show-like'];   
if (isset($_GET['id'])) {
    //  $_SESSION['dfdsfdfdsfdfdsfdsf'] = $_GET['id']; 
    setcookie('hhdasdhashd', $_GET['id'],  time() + (86400 * 30), '/');
} else {
    if (isset($_COOKIE['hhdasdhashd'])) {
        setcookie('hhdasdhashd', null,  time() - (86400 * 30), '/');
    }
}
(new OnlineController)->online();
$url = $_GET['url'] ?? '/';
switch ($url) {
    case 'loadImageStory':
        (new Controller)->loadImageStory();
        break;
    case '/':
        checkLogin('member');
        (new Controller)->index();
        break;
    case 'login':
        checkNotLogin('member');
        (new Controller)->login();
        break;
    case 'logki':
        (new Controller)->logki();
        break;
    case 'logout':
        (new Controller)->logout();
        break;
    case 'checklogin':
        (new Controller)->checklogin();
        break;
    case 'checkLogki':
        (new Controller)->checkLogki();
        break;
    case 'createPost':
        checkLogin('member');
        (new Controller)->create();
        break;
    case 'load_status':
        checkLogin('member');
        (new Controller)->load_status();
        break;
    case 'show-post':
        checkLogin('member');
        (new Controller)->show_post($_GET['id']);
        break;
    case 'update_like_status':
        checkLogin('member');
        (new Controller)->update_like_status();
        break;
    case 'share_post':
        checkLogin('member');
        (new Controller)->share_post();
        break;
    case 'load_edit':
        checkLogin('member');
        (new Controller)->load_edit();
        break;
    case 'create-coment':
        checkLogin('member');
        (new Controller)->coment();
        break;
    case 'show-image':
        checkLogin('member');
        (new Controller)->show_iamge();
        break;
    case 'check-ajax':
        (new Controller)->check_ajax();
        break;
    case 'show-like':
        checkLogin('member');
        (new Controller)->show_like($_GET['id'] ?? 0);
        break;
    case 'show-like-post':
        checkLogin('member');
        (new Controller)->show_like_post();
        break;
    case 'loadImg':
        checkLogin('member');
        (new Controller)->loadImg();
        break;
    case 'loadCmt':
        checkLogin('member');
        (new Controller)->loadCmt();
        break;
    case 'show-cmt':
        checkLogin('member');
        (new Controller)->showcmt();
        break;
    case 'user-me':
        checkLogin('member');
        (new Controller)->user_me();
        break;
    case 'load_detail_contact':
        checkLogin('member');
        (new Controller)->load_detail_contact();
        break;
    case 'show_wall':
        checkLogin('member');
        (new Controller)->show_wall();
        break;
    case 'load_content_contact':
        checkLogin('member');
        (new Controller)->load_content_contact();
        break;
    case 'load_kp_friends':
        checkLogin('member');
        (new Controller)->load_kp_friends();
        break;
    case 'show_friend':
        checkLogin('member');
        (new Controller)->show_friend();
        break;
    case 'click_chapnhan':
        checkLogin('member');
        (new Controller)->click_chapnhan();
        break;
    case 'click_khongchapnhan':
        checkLogin('member');
        (new Controller)->click_khongchapnhan();
        break;
    case 'load_kp_unfriends':
        checkLogin('member');
        (new Controller)->load_kp_unfriends();
        break;
    case 'listFriend':
        checkLogin('member');
        (new Controller)->listFriend();
        break;
    case 'wall-me':
        checkLogin('member');
        (new Controller)->wall_me();
        break;
    case 'loadAvatar':
        checkLogin('member');
        (new Controller)->loadAvatar();
        break;
    case 'del-post':
        checkLogin('member');
        (new Controller)->del_post($_GET['uyweugtewggduyu76uyewrguergew2367twetetfdgvbdf']);
        break;
    case 'del-post-wall-me':
        checkLogin('member');
        (new Controller)->del_post_wall_me($_GET['uyweugtewggduyu76uyewrguergew2367twetetfdgvbdf']);
        break;
    case 'chat-box':
        checkLogin('member');
        (new ChatController)->index();
        break;
    case 'showUserChat':
        checkLogin('member');
        (new ChatController)->showUserChat();
        break;
    case 'loadChat':
        checkLogin('member');
        (new ChatController)->loadChat();
        break;
    case 'loadChat2':
        checkLogin('member');
        (new ChatController)->loadChat2();
        break;
    case 'loadChat22':
        checkLogin('member');
        (new ChatController)->loadChat22();
        break;
    case 'loadImageSend':
        checkLogin('member');
        (new ChatController)->loadImageSend();
        break;
    case 'loadImageSend2':
        checkLogin('member');
        (new ChatController)->loadImageSend2();
        break;
    case 'loadDataChat':
        checkLogin('member');
        (new ChatController)->loadDataChat();
        break;
    case 'loadDataChat2':
        checkLogin('member');
        (new ChatController)->loadDataChat2();
        break;
    case 'loadAllChat':
        checkLogin('member');
        (new ChatController)->loadAllChat();
        break;
    case 'loadAllChat2':
        checkLogin('member');
        (new ChatController)->loadAllChat2();
        break;
    case 'loadAllChat22':
        checkLogin('member');
        (new ChatController)->loadAllChat22();
        break;
    case 'loadThongBao':
        checkLogin('member');
        (new Controller)->loadThongBao();
        break;
    case 'show_thongbao':
        checkLogin('member');
        (new Controller)->show_thongbao();
        break;
    case 'thongbao':
        checkLogin('member');
        (new Controller)->thongbao();
        break;
    case 'cmt_load_rep':
        checkLogin('member');
        (new Controller)->cmt_load_rep();
        break;
    case 'gruop':
        (new Controller)->gruop();
        break;
    case 'page':
        (new Controller)->page();
        break;
    case 'create_gruop':
        (new Controller)->create_gruop();
        break;
    case 'store_gr':
        (new Controller)->store_gr();
        break;
    case 'show-gruop':
        (new Controller)->show_gruop($_GET['id']);
        break;
    case 'loadBaner':
        (new Controller)->loadBaner();
        break;
    default:
        echo "404.ERROR";
}