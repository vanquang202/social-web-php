<?php
require_once "../app/Models/User.php";
require_once "../app/Models/Post.php";
require_once "../app/Models/Chat.php";
require_once "../app/Models/Friends.php";
require_once "../app/core/core.php";
class ChatController
{

    public function showUserChat()
    {
        unset($_SESSION['idFr']);
        // echo $_SESSION['idFr'];
        $array2 = (new User)->all();

        $checkAllFriend = (new Friends)->find($_SESSION['member']['id']);
        $friend =  explode(',', $checkAllFriend['list_frend']);
        $support = [];
        if (isset($_POST['data'])) {
            $sql = "select * from user where name like '%" . $_POST['data'] . "%'";
            $search = (new User)->sql($sql);
            foreach ($search as $value) {
                foreach ($friend as $vax) {
                    if ($vax == $value['id']) {
                        $list = [
                            'id' => $value['id'],
                            'name' => $value['name'],
                            'image' => $value['image'],
                            'email' => $value['email'],
                        ];
                        array_push($support, $list);
                    }
                }
            }
        } else {
            foreach ($array2 as $value) {
                foreach ($friend as $vax) {
                    if ($vax == $value['id']) {
                        $list = [
                            'id' => $value['id'],
                            'name' => $value['name'],
                            'image' => $value['image'],
                            'email' => $value['email'],
                        ];
                        array_push($support, $list);
                    }
                }
            }
        }

        $suport_2 = (new User)->find($_SESSION['member']['id'] ?? 0);
        unset($array2['password']);
        $support_3 = (new Online)->all();
?>

<?php foreach ($support as $value) {
            if ($_SESSION['member']['id'] != $value['id']) {
        ?>
<form>
    <button style="border:none;background:none; outline:none;width:100%" class="click"
        data-id="<?php echo $value['id'] ?>" type="button">
        <div style="align-items:center " class="row border my-1">
            <div class="col-sm-3">
                <img style="border-radius:50%" src="./upload/<?= $value['image'] ?>" alt="" width="70" height="70">
            </div>
            <div class="col-sm-9 row">
                <h3><?= $value['name'] ?></h3>
                <p><?php

                                    foreach ($support_3 as $vax) {
                                        $now = date('Y-m-d H:i:s');
                                        if ($vax['id_user'] == $value['id']) {
                                            if ($vax['time_onl'] > $now) {
                                                echo 'Đang online ';
                                            } else {
                                                echo 'Online ' . timeAgo($vax['time_onl']) . ' trước';
                                                break;
                                            }
                                        }
                                    }

                                    ?></p>
            </div>
            <!-- <p style="float:right;font-size:100px">.</p>  -->
        </div>
    </button>
</form>
<?php }
        } ?>

<?php

    }

    public function loadImageSend2()
    {
        if (!empty($_FILES['image']['name'])) {
            $name = $_FILES['image']['name'];
            $new = explode('.', $name);
            $name = uniqid() . "." . end($new);
            move_uploaded_file($_FILES['image']['tmp_name'], './upload/' . $name);
        ?>
<img src="./upload/<?= $name ?>" width="200" height="200" alt="">
<input type="hidden" name="" class="imageHidden2" value="<?= $name ?? 0 ?>">
<?php } ?>
<?php

    }
    public function loadImageSend()
    {
        if (!empty($_FILES['image']['name'])) {
            $name = $_FILES['image']['name'];
            $new = explode('.', $name);
            $name = uniqid() . "." . end($new);
            move_uploaded_file($_FILES['image']['tmp_name'], './upload/' . $name);
        ?>
<img src="./upload/<?= $name ?>" width="200" height="200" alt="">
<input type="hidden" name="" class="imageHidden" value="<?= $name ?? 0 ?>">
<?php } ?>
<?php

    }

    public function loadAllChat22()
    {
        $id = $_SESSION['member']['id'];
        $idFr = $_SESSION['idFr22'];
        $idChat = $id * $idFr;
        $check = (new Chat)->whereOne('id_user', $idChat);
        if ($check == false) {
            (new Chat)->create([
                'id_user' => $idChat,
            ]);
            $model = (new Chat)->whereOne('id_user', $idChat);
        } else {
            $model = (new Chat)->whereOne('id_user', $idChat);
        }
        $arr = $model['chat'];
        $arr = explode(',', $arr);
        foreach ($arr as $chat) {
            $chat = explode('-', $chat);
            $idC = reset($chat);
            if (end($chat) == '') {
            } else {
        ?>
<div style="display:flex;flex-direction: <?php if ($id == $idC) {
                                                                echo 'row';
                                                            } else {
                                                                echo 'row-reverse';
                                                            } ?> ;width:100%">
    <li style="" class="li"><?php
                                            if (count(explode('.', end($chat))) > 1) {
                                            ?>
        <a href="http://localhost/laravel-app/facebook/upload/<?= end($chat) ?>"><img src="./upload/<?= end($chat) ?>"
                width="200" alt=""></a>
        <?php
                                            } else {
                        ?>
        <p><?= end($chat) ?></p>
        <?php
                                            }
                        ?>
    </li>
</div>
<br>
<?php
            }
        }
    }

    public function loadAllChat2()
    {
        $id = $_SESSION['member']['id'];
        $idFr = $_SESSION['idFr'];
        $idChat = $id * $idFr;
        $check = (new Chat)->whereOne('id_user', $idChat);
        if ($check == false) {
            (new Chat)->create([
                'id_user' => $idChat,
            ]);
            $model = (new Chat)->whereOne('id_user', $idChat);
        } else {
            $model = (new Chat)->whereOne('id_user', $idChat);
        }
        $arr = $model['chat'];
        $arr = explode(',', $arr);
        foreach ($arr as $chat) {
            $chat = explode('-', $chat);
            $idC = reset($chat);
            if (end($chat) == '') {
            } else {
            ?>
<div style="display:flex;flex-direction: <?php if ($id == $idC) {
                                                                echo 'row';
                                                            } else {
                                                                echo 'row-reverse';
                                                            } ?> ;width:100%">
    <li style="" class="li"><?php
                                            if (count(explode('.', end($chat))) > 1) {
                                            ?>
        <a href="http://localhost/laravel-app/facebook/upload/<?= end($chat) ?>"><img src="./upload/<?= end($chat) ?>"
                width="200" alt=""></a>
        <?php
                                            } else {
                        ?>
        <p><?= end($chat) ?></p>
        <?php
                                            }
                        ?>
    </li>
</div>
<br>
<?php
            }
        }
    }


    public function loadAllChat()
    {
        $id = $_SESSION['member']['id'];
        $idFr = $_SESSION['idFr'];
        $idChat = $id * $idFr;
        $check = (new Chat)->whereOne('id_user', $idChat);
        if ($check == false) {
            (new Chat)->create([
                'id_user' => $idChat,
            ]);
            $model = (new Chat)->whereOne('id_user', $idChat);
        } else {
            $model = (new Chat)->whereOne('id_user', $idChat);
        }
        $arr = $model['chat'];
        $arr = explode(',', $arr);
        foreach ($arr as $chat) {
            $chat = explode('-', $chat);
            $idC = reset($chat);
            if (end($chat) == '') {
            } else {
            ?>
<div style="display:flex;flex-direction: <?php if ($id == $idC) {
                                                                echo 'row';
                                                            } else {
                                                                echo 'row-reverse';
                                                            } ?> ;width:100%">
    <li style="" class="li"><?php
                                            if (count(explode('.', end($chat))) > 1) {
                                            ?>
        <a href="http://localhost/laravel-app/facebook/upload/<?= end($chat) ?>"><img src="./upload/<?= end($chat) ?>"
                width="500" alt=""></a>
        <?php
                                            } else {
                        ?>
        <p><?= end($chat) ?></p>
        <?php
                                            }
                        ?>
    </li>
</div>
<br>
<?php
            }
        }
    }
    public function loadDataChat2()
    {
        $id = $_POST['id'];
        $data = nl2br($_POST['data']);
        $id_chat = $_POST['id_chat'];
        $check = (new Chat)->find($id_chat);
        $content_chat = $check['chat'];
        if (isset($_POST['img'])) {
            $chatNew =  $content_chat . "$id-$data," . $id . '-' . $_POST['img'] . ",";
        } else {
            $chatNew =  $content_chat . "$id-$data,";
        }
        (new Chat)->update([
            'chat' => $chatNew,
        ], $id_chat);
    }
    public function loadDataChat()
    {
        $id = $_POST['id'];
        $data = nl2br($_POST['data']);
        $id_chat = $_POST['id_chat'];
        $check = (new Chat)->find($id_chat);
        $content_chat = $check['chat'];
        if (isset($_POST['img'])) {
            $chatNew =  $content_chat . "$id-$data," . $id . '-' . $_POST['img'] . ",";
        } else {
            $chatNew =  $content_chat . "$id-$data,";
        }
        (new Chat)->update([
            'chat' => $chatNew,
        ], $id_chat);
    }

    public function loadChat22()
    {
        unset($_SESSION['idFr22']);
        $id = $_SESSION['member']['id'];
        $idFr = $_POST['idFr'];
        $_SESSION['idFr22'] = $idFr;
        $idChat = $id * $idFr;
        $check = (new Chat)->whereOne('id_user', $idChat);
        if ($check == false) {
            (new Chat)->create([
                'id_user' => $idChat,
            ]);
            $model = (new Chat)->whereOne('id_user', $idChat);
        } else {
            $model = (new Chat)->whereOne('id_user', $idChat);
        }
        $arr = $model['chat'];
        $arr = explode(',', $arr);
        $user = (new User)->find($idFr);
        ?>
<div class="hd row">
    <div class="col-sm-10 row">
        <div class="col-sm-3">
            <img style="width:50px ; height:50px ; border-radius:50% ; border : 1px solid green"
                src="./upload/<?= $user['image'] ?>" alt="">
        </div>


        <div class="dropdown  col-sm-8">
            <h5 class="    dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <?= $user['name'] ?>
            </h5>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="wall-me?id=<?= $user['id'] ?>">Xem trang cá nhân</a>
            </div>
        </div>


    </div>
    <button style="border:none ; background:none ; width:50px " class="btn btn-outline-dark col-sm-2" id="closs_jjd22"
        type="button">
        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times"
            class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
            <path fill="currentColor"
                d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
            </path>
        </svg></button>
    <!-- <p style="float:right;font-size:100px">.</p>  -->
</div>
</div>
<div style=" position:absolute;  
                top: 0;
                right: 0;
                bottom: 0;
                width: 100%;
                height: 90%;  ">
    <div class="end">
        <ul class="chat ul2">
            <?php

                    ?>
        </ul>
    </div>
    <div style="background-color:white;padding: 0px 10px" class="row ">
        <form style="position: relative;" class=" col-sm-2 formSend22">
            <div style="position: absolute; top:-200px ;width:300px; display:none ; border-radius:20px"
                class="showImgSend2">
            </div>
            <input style="display:none" id="imageClass22" type="file" name="image" value="">
            <label style="width: 35px; height: 40px;" class="col-sm-2" for="imageClass22">


                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-circle-up"
                    class="svg-inline--fa fa-chevron-circle-up fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512">
                    <path fill="blue"
                        d="M8 256C8 119 119 8 256 8s248 111 248 248-111 248-248 248S8 393 8 256zm231-113.9L103.5 277.6c-9.4 9.4-9.4 24.6 0 33.9l17 17c9.4 9.4 24.6 9.4 33.9 0L256 226.9l101.6 101.6c9.4 9.4 24.6 9.4 33.9 0l17-17c9.4-9.4 9.4-24.6 0-33.9L273 142.1c-9.4-9.4-24.6-9.4-34 0z">
                    </path>
                </svg>
            </label>
        </form>

        <form style="background-color:white" class="col-sm-10 row" onsubmit="return false;">
            <input class="col-sm-10 data_chat2" style="   border-top-left-radius: 10px;border-bottom-left-radius: 10px ;
    margin-left: 0px;outline:none" placeholder="Chat">
            <button style=" border-top-right-radius: 10px;border-bottom-right-radius: 10px ; border :none ; background:none;
                     margin-left: 0px;
                     " type="button" class="col-sm-2 chat_send2" data-id_chat2="<?= $model['id'] ?>"
                data-id="<?= $id ?>" type="">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane"
                    class="svg-inline--fa fa-paper-plane fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512">
                    <path fill="blue"
                        d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z">
                    </path>
                </svg></button>
        </form>
    </div>
</div>
<?php
    }



    public function loadChat2()
    {
        unset($_SESSION['idFr']);
        $id = $_SESSION['member']['id'];
        $idFr = $_POST['idFr'];
        $_SESSION['idFr'] = $idFr;
        $idChat = $id * $idFr;
        $check = (new Chat)->whereOne('id_user', $idChat);
        if ($check == false) {
            (new Chat)->create([
                'id_user' => $idChat,
            ]);
            $model = (new Chat)->whereOne('id_user', $idChat);
        } else {
            $model = (new Chat)->whereOne('id_user', $idChat);
        }
        $arr = $model['chat'];
        $arr = explode(',', $arr);
        $user = (new User)->find($idFr);
    ?>
<div class="hd row">
    <div class="col-sm-10 row">
        <div class="col-sm-3">

            <img style="width:50px ; height:50px ; border-radius:50% ; border : 1px solid green"
                src="./upload/<?= $user['image'] ?>" alt="">
        </div>


        <div class="dropdown  col-sm-8">
            <h5 class="    dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <?= $user['name'] ?>
            </h5>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="wall-me?id=<?= $user['id'] ?>">Xem trang cá nhân</a>
            </div>
        </div>


    </div>
    <button style="border:none ; background:none ; width:50px " class="btn btn-outline-dark col-sm-2" id="closs_jjd"
        type="button">
        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times"
            class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
            <path fill="currentColor"
                d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
            </path>
        </svg></button>
    <!-- <p style="float:right;font-size:100px">.</p>  -->
</div>
</div>
<div style=" position:absolute;  
                top: 0;
                right: 0;
                bottom: 0;
                width: 100%;
                height: 90%;  ">
    <div class="end">
        <ul class="chat ul">
            <?php

                    ?>
        </ul>
    </div>
    <div style="background-color:white;padding: 0px 10px" class="row ">
        <form style="position: relative;" class=" col-sm-2 formSend">
            <div style="position: absolute; top:-200px ;width:300px; display:none ; border-radius:20px"
                class="showImgSend">
            </div>
            <input style="display:none" id="imageClass" type="file" name="image" value="">
            <label style="width: 35px; height: 40px;" class="col-sm-2" for="imageClass">


                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-circle-up"
                    class="svg-inline--fa fa-chevron-circle-up fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512">
                    <path fill="blue"
                        d="M8 256C8 119 119 8 256 8s248 111 248 248-111 248-248 248S8 393 8 256zm231-113.9L103.5 277.6c-9.4 9.4-9.4 24.6 0 33.9l17 17c9.4 9.4 24.6 9.4 33.9 0L256 226.9l101.6 101.6c9.4 9.4 24.6 9.4 33.9 0l17-17c9.4-9.4 9.4-24.6 0-33.9L273 142.1c-9.4-9.4-24.6-9.4-34 0z">
                    </path>
                </svg>
            </label>
        </form>

        <form style="background-color:white" class="col-sm-10 row" onsubmit="return false;">
            <input class="col-sm-10 data_chat" style="   border-top-left-radius: 10px;border-bottom-left-radius: 10px ;
    margin-left: 0px;outline:none" placeholder="Chat">
            <button style=" border-top-right-radius: 10px;border-bottom-right-radius: 10px ; border :none ; background:none;
                     margin-left: 0px;
                     " type="button" class="col-sm-2 chat_send" data-id_chat="<?= $model['id'] ?>" data-id="<?= $id ?>"
                type="">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="paper-plane"
                    class="svg-inline--fa fa-paper-plane fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512">
                    <path fill="blue"
                        d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z">
                    </path>
                </svg></button>
        </form>
    </div>
</div>
<?php
    }




    public function loadChat()
    {
        unset($_SESSION['idFr']);
        $id = $_SESSION['member']['id'];
        $idFr = $_POST['idFr'];
        $_SESSION['idFr'] = $idFr;
        $idChat = $id * $idFr;
        $check = (new Chat)->whereOne('id_user', $idChat);
        if ($check == false) {
            (new Chat)->create([
                'id_user' => $idChat,
            ]);
            $model = (new Chat)->whereOne('id_user', $idChat);
        } else {
            $model = (new Chat)->whereOne('id_user', $idChat);
        }
        $arr = $model['chat'];
        $arr = explode(',', $arr);
        $user = (new User)->find($idFr);
    ?>
<div class="hd">
    <div style="align-items:center " class="row border my-1">
        <div class="col-sm-3">
            <img style="border-radius:50%" src="./upload/<?= $user['image'] ?>" alt="" width="70" height="70">
        </div>
        <div class="col-sm-9 row">
            <h3><?= $user['name'] ?></h3>

        </div>
        <!-- <p style="float:right;font-size:100px">.</p>  -->
    </div>
</div>
<div style=" position:absolute;  
                top: 0;
                right: 0;
                bottom: 0;
                width: 75%;
                height: 100%;  ">
    <div class="end">
        <ul class="chat ul">
            <?php

                    ?>
        </ul>
    </div>
    <div style="background-color:white" class="row ">
        <form style="position: relative;" class=" col-sm-1 formSend">
            <div style="position: absolute; top:-200px ; display:none" class="showImgSend">
            </div>
            <input style="display:none" id="imageClass" type="file" name="image" value="">
            <label style="width: 49px;" class="col-sm-2" for="imageClass">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="image"
                    class="svg-inline--fa fa-image fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512">
                    <path fill="currentColor"
                        d="M464 448H48c-26.51 0-48-21.49-48-48V112c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48zM112 120c-30.928 0-56 25.072-56 56s25.072 56 56 56 56-25.072 56-56-25.072-56-56-56zM64 384h384V272l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L208 320l-55.515-55.515c-4.686-4.686-12.284-4.686-16.971 0L64 336v48z">
                    </path>
                </svg>
            </label>
        </form>
        <form style="background-color:white" class="col-sm-11 row" onsubmit="return false;">
            <input class="col-sm-10 data_chat" style="border-radius: 20px;
        height: 50px;outline:none" placeholder="Chat">
            <button style="border-radius: 20px;
                     margin-left: -35px;
                     " type="button" class="col-sm-2 chat_send" data-id_chat="<?= $model['id'] ?>" data-id="<?= $id ?>"
                type="">Chat</button>
        </form>
    </div>
</div>
<?php
    }




    public function index()
    {
        unset($_SESSION['idFr']);
        // echo $_SESSION['idFr'];
        $array2 = (new User)->all();
        $checkAllFriend = (new Friends)->find($_SESSION['member']['id']);
        $friend =  explode(',', $checkAllFriend['list_frend']);
        $listFrend = [];
        foreach ($array2 as $value) {
            foreach ($friend as $vax) {
                if ($vax == $value['id']) {
                    $list = [
                        'id' => $value['id'],
                        'name' => $value['name'],
                        'image' => $value['image'],
                        'email' => $value['email'],
                    ];
                    array_push($listFrend, $list);
                }
            }
        }
        $suport_2 = (new User)->find($_SESSION['member']['id'] ?? 0);
        unset($array2['password']);
        $suport_3 = (new Online)->all();
        return view('Views.Chat.index', [], [], $listFrend, $suport_2, $suport_3);
    }
}