<?php
session_start();
require_once "../app/Models/User.php";
require_once "../app/Models/Post.php";
require_once "../app/Models/thongbao.php";
require_once "../app/Models/Online.php";
require_once "../app/Models/Friends.php";
require_once "../app/Models/Contact.php";
require_once "../app/Models/Gruop.php";
require_once "../app/Models/Story.php";
require_once "../app/core/core.php";
class Controller
{
    public function loadImageStory(){
        if (!empty($_FILES['fileStory']['name'])) {
            $image = $_FILES["fileStory"];
            $imgName = uniqid() . $image['name'];
            move_uploaded_file($image['tmp_name'], "./upload/" . $imgName);
            (new Story)->create([
                'image' => $imgName,
                'user_id' => $_SESSION['member']['id']
            ]);
        }
    }
    public function loadBaner()
    {
        if (!empty($_FILES['bngr']['name'])) {
            $image = $_FILES["bngr"];
            $imgName = uniqid() . $image['name'];
            move_uploaded_file($image['tmp_name'], "./upload/" . $imgName);
            (new Gruop)->update([
                'banner' => $imgName,
            ], $_POST['id']);
        }
    }

    public function store_gr()
    {
        $errors = errors([
            'name.required' => $_POST['name'],
        ]);
        if (!empty($errors)) {
            $_SESSION['msg'] = 'Không để trống name';
            return view('Views.createGruop', [], $errors);
        };
        $id =  time() . rand(0, 100);
        (new Gruop)->create([
            'id' => $id,
            'name' => $_POST['name'],
            'status' => $_POST['status'],
            'admin' => $_SESSION['member']['id'],
            'member' => $_SESSION['member']['id'] . '-admin' . ',',
        ]);

        echo '121212';
        // $model = (new Gruop)->find($id);
        return redirect('show-gruop?id=' . $id);
    }
    public function show_gruop($id)
    {
        $model = (new Gruop)->all();
        $arr = [];
        foreach ($model as $val) {
            $list = explode(',', $val['member']);
            foreach ($list as $avx) {
                $ogt = explode('-', $avx);
                // echo reset($ogt);
                if (reset($ogt) == $_SESSION['member']['id']) {
                    array_push($arr, $val);
                }
            }
        }
        return view2('Views.show-gruop', ['gruop' => $arr,  'model' => (new Gruop)->find($id)]);
    }
    public function create_gruop()
    {
        return view('Views.createGruop');
    }
    public function page()
    {
        return view('Views.page');
    }
    public function gruop()
    {
        // $model = (new Gruop)->where('id' ,$id);
        $model = (new Gruop)->all();

        $arr = [];
        foreach ($model as $val) {
            $list = explode(',', $val['member']);
            foreach ($list as $avx) {
                $ogt = explode('-', $avx);
                // echo reset($ogt);
                if (reset($ogt) == $_SESSION['member']['id']) {
                    $gruop = (array_push($arr, $val));
                }
            }
        }
        return view2('Views.group', ['model' => $model ,'gruop' => $arr]);
    }

    public function update_like_status()
    {
        $id = $_POST['id'];
        $data = $_POST['data'];
        $check = (new Post)->find($id);
        $count_like = $check['count_like'];
        $arrCountLike = explode(',', $count_like);
        $count_likeDetail = $check['detail_like'];
        $arrCountLikeDetail = explode(',', $count_likeDetail);
        $flagDetail = true;
        foreach ($arrCountLikeDetail as $val) {
            $getData = explode('-', $val);
            if ($data == end($getData)) {
                $flagDetail = false;
            }
        }
        $flag = true;
        foreach ($arrCountLike as $val) {
            if ($_SESSION['member']['id'] == $val) {
                $flag = false;
            }
        }
        if ($flag == true) {
            $count_like_New = $check['count_like'] . "," . $_SESSION['member']['id'];
            $detailLikeNew = $check['detail_like'] .  "," . $_SESSION['member']['id'] . "-" . $data;
            (new Post)->update([
                'count_like' => $count_like_New,
                'detail_like' => $detailLikeNew,
            ], $id);
            date_default_timezone_set('asia/ho_chi_minh');
            $check = (new Post)->find($_POST['id']);
            $now = date('Y-m-d H:i:s');
            if ($_SESSION['member']['id'] != $check['user_id']) {
                if ($check['coment_id'] == 0) {
                    $content_thongbao = $_SESSION['member']['name'] . " đã thích bài viết của bạn ";
                } else {
                    $content_thongbao = $_SESSION['member']['name'] . " đã thích bình luận của bạn ";
                }
                unset($checkUser['password']);
                (new thongbao)->create([
                    'user_id' => ($check['user_id']),
                    'user_rep' => ($_SESSION['member']['id']),
                    'content_thongbao' => $content_thongbao,
                    'id_post' => $_POST['id'],
                    'status' => 0,
                    'image' => ($_SESSION['member']['image']),
                    'created_at' => $now,
                ]);
            }
        } else {
            $flahCheckDeloy = true;
            foreach ($arrCountLikeDetail as $key => $val) {
                $getData = explode('-', $val);
                if ($_SESSION['member']['id'] == reset($getData)) {
                    if ($data == end($getData)) {
                        $flahCheckDeloy = false;
                    }
                }
            }
            if ($flahCheckDeloy == true) {
                foreach ($arrCountLikeDetail as $key => $val) {
                    $getData = explode('-', $val);
                    if ($_SESSION['member']['id'] == reset($getData)) {
                        unset($arrCountLikeDetail[$key]);
                    }
                }
                $arrCountLikeDetailNew = implode(', ', $arrCountLikeDetail);
                $arrCountLikeDetailNewNew = $arrCountLikeDetailNew . "," . $_SESSION['member']['id'] . "-" . $data;
                (new Post)->update([
                    'detail_like' =>  $arrCountLikeDetailNewNew,
                ], $id);
                date_default_timezone_set('asia/ho_chi_minh');
                $check = (new Post)->find($_POST['id']);
                $now = date('Y-m-d H:i:s');
                if ($_SESSION['member']['id'] != $check['user_id']) {
                    if ($check['coment_id'] == 0) {
                        $content_thongbao = $_SESSION['member']['name'] . " đã thích bài viết của bạn ";
                    } else {
                        $content_thongbao = $_SESSION['member']['name'] . " đã thích bình luận của bạn ";
                    }
                    unset($checkUser['password']);
                    (new thongbao)->create([
                        'user_id' => ($check['user_id']),
                        'user_rep' => ($_SESSION['member']['id']),
                        'content_thongbao' => $content_thongbao,
                        'id_post' => $_POST['id'],
                        'status' => 0,
                        'image' => ($_SESSION['member']['image']),
                        'created_at' => $now,
                    ]);
                }
            } else {

                foreach ($arrCountLike as $key => $val) {
                    if ($_SESSION['member']['id'] == $val) {
                        unset($arrCountLike[$key]);
                    }
                }
                foreach ($arrCountLikeDetail as $key => $val) {
                    $getData = explode('-', $val);
                    if ($_SESSION['member']['id'] == reset($getData)) {
                        unset($arrCountLikeDetail[$key]);
                    }
                }
                $arrCountLikeDetailNew = implode(',', $arrCountLikeDetail);
                $count_like_New = implode(', ', $arrCountLike);
                (new Post)->update([
                    'count_like' => $count_like_New,
                    'detail_like' => $arrCountLikeDetailNew,
                ], $id);
            }
        }
    }



    public function share_post()
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $id = $_POST['id'];
        $data = $_POST['data'];
        (new Post)->create([
            'content' => $data,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => $_SESSION['member']['id'],
            'share' => $id,
        ]);
    }
    public function load_status()
    {
        (new Post)->update(['status' => $_POST['data']], $_POST['id']);
    }


    public function load_edit()
    {
        $id = $_POST['id'];
        $data = $_POST['data'];
        (new Post)->update([
            'content' => $data,
        ], $id);
    }
    public function cmt_load_rep()
    {
        $errors = (new Post)->all();
        $support = (new User)->all();
?>

<form method="post" onsubmit="return false;" enctype="multipart/form-data" class="form input-group ">
    <div class="showImg">
    </div>
    <input type="hidden" name="idHidden" class="idHidden" value="<?= $_POST['id'] ?>">
    <input type="hidden" class="id_user" value="<?= $_SESSION['member']['id'] ?>">
    <input name="coment" type="text" class="comentLoad_<?= $_POST['id'] ?> form-control "
        placeholder="Binh luận của bạn">
    <input style="display:none" class="form-control" class="file" type="file" id="ig_<?= $_POST['id'] ?>" name="image"
        value="">
    <button class="btn btn-outline-secondary cmt-rep-click  " type="button" data-id="<?= $_POST['id'] ?>"
        id="button-addon2">Gửi</button>
</form>
<label style="width:30px;height:30px" for="ig_<?= $_POST['id'] ?>">
    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="images"
        class="svg-inline--fa fa-images fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
        <path fill="currentColor" d="M480 416v16c0 26.51-21.49 48-48 48H48c-26.51
                            0-48-21.49-48-48V176c0-26.51 21.49-48 48-48h16v208c0 44.112 35.888 80 80 
                            80h336zm96-80V80c0-26.51-21.49-48-48-48H144c-26.51 0-48 21.49-48 48v256c0 
                            26.51 21.49 48 48 48h384c26.51 0 48-21.49 48-48zM256 128c0 26.51-21.49 48-48
                                48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-96 144l55.515-55.515c4.686-4.686
                                12.284-4.686 16.971 0L272 256l135.515-135.515c4.686-4.686 12.284-4.686 16.971 0L512 
                                208v112H160v-48z"></path>
    </svg>
</label> <?php
                    foreach ($errors as $vax) {
                        if ($_POST['id'] == $vax['coment_id']) { ?>
<div style="margin: 0px 0px 15px 20px;
    background: #ccc;" class="card bg- ">
    <div class="card-header"><?php
                                                foreach ($support as $valS) {
                                                    if ($vax['user_id'] == $valS['id']) {
                                                ?>
        <img style="border-radius:50%" src="./upload/<?= $valS['image'] ?>" width="50" height="50" alt="">
        <?php
                                                        echo $valS['name'] . ' đã trả lời bình luận';
                                                    };
                                                };
                        ?>
        <br>
        <small><?= timeAgo($vax['created_at']) ?></small>
    </div>
    <div class=" border card-body">
        <p style="overflow-wrap: break-word;" class="card-text"><?= $vax['content'] ?></p>
        <?php if ($vax['image']) { ?>
        <img class="element-3" src="./upload/<?= $vax['image'] ?>" width="200" height="200" alt="">
        <?php }; ?>
    </div>
</div>
<?php }
                    } ?>
<?php


    }

    public function listFriend()
    {
        // $check = (new thongbao)->where('user_id', $_SESSION['member']['id']); 
        $friend = (new Friends)->find($_SESSION['member']['id']);
        $listFreind = explode(',', $friend['list_frend']);
        $check = (new User)->find($_SESSION['member']['id']);
        $arrList = explode(",", $check['delay_friend']);
        $all = (new User)->all();
        unset($all['password']);
        unset($check['password']);
    ?>

<?php
        if (!empty($check)) {
            foreach ($all as $support) {
                foreach ($arrList as $val) {
                    if ($val == $support['id']) {
        ?>
<div style="align-items:center;	 
                                            padding: 10px;
                                            border: 1px solid;
                                            border-radius: 10px;
                                            margin-bottom: 10px;
                                            align-items: center;" class="row">
    <div class="col-sm-2">
        <img style="border-radius:50%" src="./upload/<?= $support['image'] ?>" width="50" height="50" alt="">
    </div>
    <div class="col-sm-7 row">
        <h3><?= $support['name'] ?></h3>
        <p>Đã gửi lời mời kết bạn</p>
    </div>
    <div class="col-sm-3 text-center">
        <button data-id="<?= $support['id'] ?>" class="click-chapnhan btn btn-primary" type="">Chấp nhận</button>
        <button data-id="<?= $support['id'] ?>" class="click-khongchapnhan btn btn-danger" type="">Hủy</button>
    </div>
</div>
<?php
                    }
                }
            }
        } ?>
<div>
    <div class="row">
        <hr>
        <h4 class="text-center ">Gợi ý</h4>
        <hr>
        <?php
                foreach ($all as $val) {
                    unset($val['password']);
                    $flagFreind = true;
                    foreach ($listFreind as $valFr) {
                        if ($val['id'] == $_SESSION['member']['id'] || $val['id'] == $valFr) {
                            $flagFreind = false;
                        }
                    }
                    if ($flagFreind == true) {
                ?>
        <div class="col-sm-12 row m-3">
            <div class="col-sm-3">
                <img class="rounded" src="./upload/<?= $val['image'] ?>" width="70" height="70" alt="">
            </div>
            <div class="col-sm-5">
                <h4><?= $val['name'] ?></h4>
            </div>
            <div class="col-sm-4">
                <?php
                                $delay_firend = explode(",", $val['delay_friend']);
                                $co = true;
                                foreach ($delay_firend as $valDelay) {
                                    if ($_SESSION['member']['id'] == $valDelay) {
                                        $co = false;
                                    }
                                }
                                if ($co == false) { ?>
                <button type="button" data-id="<?= $val['id'] ?>"
                    class="click-unfiend btn btn-outline-danger">Hủy</button>
                <?php } else { ?>
                <button type="" data-id="<?= $val['id'] ?>" class="click-fiend btn btn-primary">Ket ban</button>
                <?php } ?>
            </div>
        </div>
        <?php }
                } ?>
    </div>
</div>
<?php
    }
    public function thongbao()
    {
        $check = (new thongbao)->where('user_id', $_SESSION['member']['id']);
    ?>
<?php
        if (!empty($check)) {
            foreach ($check as $support) {
        ?> <a style="text-decoration: none" href="show-post?id=<?php

                                                                        $newPost = (new Post)->find($support['id_post']);
                                                                        if ($newPost['coment_id'] == 0) {
                                                                            echo $newPost['id'];
                                                                        } else {
                                                                            echo $newPost['coment_id'];
                                                                        }

                                                                        ?>"> <?php
                        if ($support['user_rep'] == $_SESSION['member']['id']) {
                        } else { ?>
    <div style="align-items:center;	
                                padding: 10px;
                                border: 1px solid;
                                border-radius: 10px;
                                margin-bottom: 10px;
                                align-items: center;" class="row">
        <div class="col-sm-2">
            <img style="border-radius:50%" src="./upload/<?= $support['image'] ?>" width="50" height="50" alt="">
        </div>
        <div class="col-sm-10 row">
            <p style="color:black"><?= $support['content_thongbao'] ?></p>
            <span style="color:blue"><?= $support['coment'] ?? '' ?></span>
            <small><?= timeAgo($support['created_at']) ?></small>
        </div>
    </div>
    <?php
                        }
                    ?>
</a> <?php
                    }
                } ?>
<?php
    }
    public function click_khongchapnhan()
    {
        $you = (new User)->find($_POST['id']);
        $arrYou = explode(',', $you['delay_friend']);
        foreach ($arrYou as $key => $val) {
            if ($_SESSION['member']['id'] == $val) {
                unset($arrYou[$key]);
            }
        }
        $arrYouNew = implode(',', $arrYou);
        (new User)->update([
            'delay_friend' => $arrYouNew,
        ], $_POST['id']);

        $me = (new User)->find($_SESSION['member']['id']);
        $arrMe = explode(',', $me['delay_friend']);
        foreach ($arrMe as $key => $val) {
            if ($_POST['id'] == $val) {
                unset($arrMe[$key]);
            }
        }
        $arrMeNew = implode(',', $arrMe);
        (new User)->update([
            'delay_friend' => $arrMeNew,
        ], $_SESSION['member']['id']);
    }
    public function click_chapnhan()
    {
        $friendMe = (new Friends)->find($_SESSION['member']['id']);
        $listMe = $friendMe['list_frend'] . $_POST['id'] . ',';
        $friendMe = (new Friends)->find($_POST['id']);
        $listYou = $friendMe['list_frend'] . $_SESSION['member']['id'] . ',';
        (new Friends)->update([
            'list_frend' => $listMe,
        ], $_SESSION['member']['id']);
        (new Friends)->update([
            'list_frend' => $listYou,
        ], $_POST['id']);

        $you = (new User)->find($_POST['id']);
        $arrYou = explode(',', $you['delay_friend']);
        foreach ($arrYou as $key => $val) {
            if ($_SESSION['member']['id'] == $val) {
                unset($arrYou[$key]);
            }
        }
        $arrYouNew = implode(',', $arrYou);
        (new User)->update([
            'delay_friend' => $arrYouNew,
        ], $_POST['id']);

        $me = (new User)->find($_SESSION['member']['id']);
        $arrMe = explode(',', $me['delay_friend']);
        foreach ($arrMe as $key => $val) {
            if ($_POST['id'] == $val) {
                unset($arrMe[$key]);
            }
        }
        $arrMeNew = implode(',', $arrMe);
        (new User)->update([
            'delay_friend' => $arrMeNew,
        ], $_SESSION['member']['id']);
    }

    public function show_friend()
    {
        $suport_2 = (new User)->find($_SESSION['member']['id']);
        $array2 = (new User)->all();
        $arrList = explode(',', $suport_2['delay_friend']);
        $countFr = 0;
        foreach ($arrList as $val) {
            if (!empty($val)) {
                $countFr = $countFr + 1;
            }
        }
        // $countFr = count($arrList);
        unset($array2['password']);
    ?>
<?php if ($countFr > 0) { ?>
<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    <?php echo $countFr ?>+
    <span class="visually-hidden">unread messages</span>
</span>
<?php } ?>
<?php
    }
    public function show_thongbao()
    {
        $check = (new thongbao)->where('user_id', $_SESSION['member']['id']);
        $count = 0;
        foreach ($check as $value) {
            if ($value['status'] == 0) {
                $count = $count + 1;
            }
        }
    ?>

<?php if ($count > 0) { ?>
<input type="hidden" id="thongbaoHidden" name="" value="<?php echo $count ?>">
<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    <?php echo $count ?>+
    <span class="visually-hidden">unread messages</span>
</span>
<?php } ?>
<?php


    }

    public function loadThongBao()
    {
        $id = $_SESSION['member']['id'];
        $check = (new thongbao)->where('user_id', $id);
        foreach ($check as $val) {
            (new thongbao())->update([
                'status' => 1,
            ], $val['id']);
        }
    }
    public function del_post_wall_me($id)
    {
        $check = (new Post)->find($id);
        if ($check['user_id'] == $_SESSION['member']['id']) {
            (new Post)->destroy($id);
            return  redirect('http://localhost/laravel-app/facebook/wall-me');
        } else {
            return  redirect('http://localhost/laravel-app/facebook/login');
        }
    }
    public function del_post($id)
    {
        $check = (new Post)->find($id);
        if ($check['user_id'] == $_SESSION['member']['id']) {
            (new Post)->destroy($id);
            return  redirect('http://localhost/laravel-app/facebook/');
        } else {
            return  redirect('http://localhost/laravel-app/facebook/');
        }
    }
    public function loadAvatar()
    {
        if (!empty($_FILES['image']['name'])) {
            $imageName = uniqid() . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], './upload/' . $imageName);

            if ((new Contact)->find($_SESSION['member']['id'])) {
                $check = (new Contact)->find($_SESSION['member']['id']);
                $img = $check['imageOld'];
                $imgNew  = $img . $imageName . ",";
                (new Contact)->update([
                    'imageOld' => $imgNew,
                ], $_SESSION['member']['id']);
            } else {
                $imgNew  =  $imageName . ",";
                (new Contact)->create([
                    'id' => $_SESSION['member']['id'],
                    'imageOld' => $imgNew,
                    'detail' => '',
                ]);
            }
            (new User)->update([
                'image' => $imageName,
            ], $_SESSION['member']['id']);
            $_SESSION['member']['img'] = $imageName;
        }
    }
    public function load_content_contact()
    {
        if ((new Contact)->find($_SESSION['member']['id'])) {
            if (isset($_POST['date'])) {
                (new Contact)->update([
                    'date' => $_POST['date'],
                ], $_SESSION['member']['id']);
            } elseif (isset($_POST['address'])) {
                (new Contact)->update([
                    'address' => $_POST['address'],
                ], $_SESSION['member']['id']);
            } elseif (isset($_POST['cv'])) {
                (new Contact)->update([
                    'cv' => $_POST['cv'],
                ], $_SESSION['member']['id']);
            } elseif (isset($_POST['sex'])) {
                (new Contact)->update([
                    'sex' => $_POST['sex'],
                ], $_SESSION['member']['id']);
            };
            // (new Contact)->update([
            //     'imageOld' => $imgNew,
            // ], $_SESSION['member']['id']);
        } else {

            if (isset($_POST['date'])) {
                (new Contact)->create([
                    'id' => $_SESSION['member']['id'],
                    'date' => $_POST['date'],
                ]);
            } elseif (isset($_POST['address'])) {
                (new Contact)->create([
                    'id' => $_SESSION['member']['id'],
                    'address' => $_POST['address'],
                ]);
            } elseif (isset($_POST['sv'])) {
                (new Contact)->create([
                    'id' => $_SESSION['member']['id'],
                    'cv' => $_POST['cv'],
                ]);
            } elseif (isset($_POST['sex'])) {
                (new Contact)->create([
                    'id' => $_SESSION['member']['id'],
                    'sex' => $_POST['sex'],
                ]);
            };
            // (new Contact)->create([
            //     'id' => $_SESSION['member']['id'],
            //     'imageOld' => $imgNew,
            //     'detail' => '',
            // ]); 
        };
        // if(isset($_POST['date'])){ 

        // }elseif(isset($_POST['address'])){

        // }elseif(isset($_POST['sv'])){

        // }elseif(isset($_POST['sex'])){

        // };
    }
    public function load_detail_contact()
    {
        if ((new Contact)->find($_SESSION['member']['id'])) {
            (new Contact)->update([
                'detail' => $_POST['value'],
            ], $_SESSION['member']['id']);
        } else {
            (new Contact)->create([
                'id' => $_SESSION['member']['id'],
                'detail' => $_POST['value'],
            ]);
        }
    }

    public function show_wall()
    {
        $id = $_POST['id'];
        $array = (new Post)->where('coment_id', 0);
        $errors = (new Post)->all();
        $support = (new User)->all();
        $gruop = (new Gruop)->all();
        $sup = (new User)->find($id);
    ?>
<?php foreach ($array as $value) {
            if ($value['user_id'] == $id) {
        ?>
<div style="    
            /* padding: 0px 10px; */
            border-radius: 20px;
            background: #dddd; 
            overflow: hidden;
            margin-bottom: 20px;">
    <div style="border:none; background: #fff;" id="<?php echo $value['id'] ?>" class="card   ">
        <div style=" justify-content: center; align-items: center;text-slign:center" class=" row   card-header p-3">
            <?php
                            foreach ($support as $val) {
                                if ($value['user_id'] == $val['id']) {
                            ?>
            <div class="col-sm-1">
                <a href="user-me?id=<?= $val['id'] ?>"> <img class="rounded-circle img" style="border-radius:50%"
                        src="./upload/<?= $val['image'] ?> " width="50" height="50" alt=""></a>
            </div>
            <div class="row col-sm-10">
                <h2 style="display:inline" class="title"><?= $val['name'] ?>

                    <?php
                                                        if(isset($value['gruop']) && $value['user_id'] == $val['id']){
                                                            foreach($gruop as $gr){  
                                                                if($value['gruop'] == $gr['id']){ 
                                                            echo '>' ; ?> <a
                        href="show-gruop?id=<?= $gr['id'] ?>"><strong style="color:#005c88"> <?= $gr['name'] ?></strong>
                    </a> <?php ; }}}
                                                    ?></h2>
                <small><?= timeAgo($value['created_at'])  ?></small>
            </div>
            <input type="hidden" id="save_name_<?= $value['id'] ?>" name="" value="<?= $val['name'] ?>">
            <input type="hidden" id="save_avatar_<?= $value['id'] ?>" name="" value="<?= $val['image'] ?>">
            <?php
                                };
                            };
                            ?>
            <div class="col-sm-1">
                <button style="border:none ; background:transparent;outline:none" class="btn_click"
                    id="<?php echo $value['id']; ?>" data-id="<?php echo $value['id']; ?>" data-bs-toggle="modal"
                    data-bs-target="#exampleModal_<?php echo $value['id']; ?>">
                    <div style="width:10px">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-v"
                            class="svg-inline--fa fa-ellipsis-v fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 192 512">
                            <path fill="currentColor"
                                d="M96 184c39.8 0 72 32.2 72 72s-32.2 72-72 72-72-32.2-72-72 32.2-72 72-72zM24 80c0 39.8 32.2 72 72 72s72-32.2 72-72S135.8 8 96 8 24 40.2 24 80zm0 352c0 39.8 32.2 72 72 72s72-32.2 72-72-32.2-72-72-72-72 32.2-72 72z">
                            </path>
                        </svg>
                    </div>
                </button>
            </div>
            <!-- / Modal -->
            <div class="modal fade" id="exampleModal_<?php echo $value['id']; ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="save_content_<?= $value['id'] ?>" name=""
                                value="<?php echo $value['content'] ?>">
                            <input type="hidden" id="save_image_<?= $value['id'] ?>" name=""
                                value="<?php echo $value['image'] ?>">
                            <a style="display:block" onclick="add_post(<?php echo $value['id']; ?>)"
                                class="btn alert-success" href="#<?php echo $value['id'] ?>">Lưu bài viết</a>
                            <a style="display:block" class="btn alert-success" href="">Báo cáo quản trị viên</a>
                            <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom_<?= $value['id'] ?>"
                                aria-controls="offcanvasBottom" style="width:100%;border:none;outline:none"
                                data-id="<?= $value['id'] ?>" class=" share_post text-center alert-success" type="">
                                <p>Chia sẻ</p>
                            </button>


                            <!-- Share -->
                            <div class="offcanvas offcanvas-bottom" tabindex="-1"
                                id="offcanvasBottom_<?= $value['id'] ?>" aria-labelledby="offcanvasBottomLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Chia sẻ</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body small">
                                    Nội dung:
                                    <form class="form-control">
                                        <input class="form-control textarea text_share_<?= $value['id'] ?>" type="text"
                                            name="" value="">
                                        <button data-id="<?= $value['id'] ?>" type="button"
                                            class="click_share  btn btn-primary" type="">Chia sẻ</button>
                                    </form>
                                </div>
                            </div>
                            <?php
                                            if ($value['user_id'] == $_SESSION['member']['id']) { ?>

                            <button style="width:100%;border:none;outline:none" data-id="<?= $value['id'] ?>"
                                class=" edit_post text-center alert-success" type="">
                                <p>Sửa bài viết</p>
                            </button>
                            <a style="display:block" onclick="del(<?= $value['id'] ?>)" class="btn alert-danger"
                                href="del-post-wall-me?uyweugtewggduyu76uyewrguergew2367twetetfdgvbdf=<?= $value['id'] ?>">Xóa
                                bài viết</a>
                            <form class="form_status text-center p-3">
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="0" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input type="hidden" class="status_hidden" name="" value="<?= $value['id'] ?>">
                                    <input class="form-check-input" value="0" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1"
                                        <?php if ($value['status'] == 0) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?>>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Mọi người
                                    </label>
                                </button>
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="1" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input class="form-check-input" value="1" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2"
                                        <?php if ($value['status'] == 1) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?>>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Bạn bè
                                    </label>
                                </button>
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="2" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input class="form-check-input" value="2" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault3"
                                        <?php if ($value['status'] == 2) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?>>
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Chỉ mình tôi
                                    </label>
                                </button>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Modal -->
        </div>
    </div>
    <div style="background-color: #fff" class="  card-body">
        <p style="overflow-wrap: break-word;" class="card-text text_content"><?= $value['content'] ?></p>

        <!-- // -->

        <?php
                        if ($value['share'] != 0) {
                            $share = (new Post)->find($value['share']);
                            $userShare = (new User)->find($share['user_id']);
                        ?>
        <div class="col-sm-1">
            <a href="user-me?id=<?= $userShare['id'] ?>"> <img class="rounded-circle img" style="border-radius:50%"
                    src="./upload/<?= $userShare['image'] ?> " width="50" height="50" alt=""></a>
        </div>
        <div class="row col-sm-10">
            <h2 style="display:inline" class="title"><?= $userShare['name'] ?></h2>
            <small><?= timeAgo($share['created_at'] ?? '') ?></small>
        </div>
        <div>
            <p style="overflow-wrap: break-word;" class="card-text text_content"><?= $share['content'] ?></p>
            <?php if ($share['user_id'] == $_SESSION['member']['id']) { ?>
            <form class="form_edit edit_form_<?= $share['id'] ?>" style="display:none">
                <input type="hidden" class="id_edit_hidden" name="" value="<?= $share['id'] ?>">
                <input type="text" class="form-control input_edit_<?= $share['id'] ?>" name=""
                    value="<?= $value['content'] ?>">
                <br>
            </form>
            <?php } ?>
            <?php if ($share['image']) {
                                    $arrValue = explode(',', $share['image']);
                                    if (count($arrValue) == 1) {
                                ?>
            <img src="./upload/<?= $share['image'] ?>" width="100%" alt="">
            <?php   } else { ?>
            <div style="height:400px; overflow:auto">
                <?php foreach ($arrValue as  $valx) {     ?>
                <img width="100%" height="400" src="./upload/<?= $valx ?>" />

                <?php    } ?>
            </div>
        </div>
        <?php }
                                }; ?><?php
                                    }

                                        ?>


        <!--  -->
        <?php if ($value['user_id'] == $_SESSION['member']['id']) { ?>
        <form class="form_edit edit_form_<?= $value['id'] ?>" style="display:none">
            <input type="hidden" class="id_edit_hidden" name="" value="<?= $value['id'] ?>">
            <input type="text" class="form-control input_edit_<?= $value['id'] ?>" name=""
                value="<?= $value['content'] ?>">
            <br>
        </form>
        <?php } ?>
        <?php if ($value['image']) {
                                $arrValue = explode(',', $value['image']);
                                if (count($arrValue) == 1) {
                            ?>
        <img src="./upload/<?= $value['image'] ?>" width="100%" alt="">
        <?php   } else { ?>
        <div style="height:400px; overflow:auto">
            <?php foreach ($arrValue as  $valx) {     ?>
            <img width="100%" height="400" src="./upload/<?= $valx ?>" />

            <?php    } ?>
        </div>
        <?php }
                            }; ?>
        <div class="row">
            <form style="position:relative" class="form col-sm-11 form_hover">
                <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                    class="clickBtn hoverTym" data-hidden="<?= $value['like_status'] ?>" data-id="<?= $value['id'] ?>">
                    <?php
                                        $detailLike = explode(',', $value['detail_like']);
                                        $checkDetail = 0;
                                        foreach ($detailLike as $val) {
                                            $detailLike_List = explode('-', $val);
                                            if ($_SESSION['member']['id'] == reset($detailLike_List)) {
                                                $checkDetail = end($detailLike_List);
                                            }
                                        }
                                        if ($checkDetail == 0) { ?>
                    <div style="width:30px;height:30px">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart"
                            class="svg-inline--fa fa-heart fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path fill="<?php
                                                                echo 'currentColor'; ?>"
                                d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z">
                            </path>
                        </svg>
                    </div>
                    <?php } elseif ($checkDetail == 1) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class="  like_btn " data-like_status="1" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifLike.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 2) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" haha_btn  " data-like_status="2" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHaha.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 3) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" love_btn  " data-like_status="3" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifThuongthuong.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 4) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" sad_btn  " data-like_status="4" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHuhu.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 5) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" angry_btn  " data-like_status="5" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifGian.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php    }
                                        ?>


                </button>
                <div class="btn-group dropend">
                    <button type="button" class="btn   dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <small><?php $count = explode(",", $value['count_like']);
                                                    unset($count[0]);
                                                    echo count($count) ?></small>
                    </button>

                    <ul style="z-index:10000 ; width:300px" class="dropdown-menu">

                        <?php
                                            $detail_like_count = explode(',', $value['detail_like']);
                                            foreach ($detail_like_count as $val) {
                                                if ($val == 0) {
                                                    continue;
                                                }
                                                $detail_like_c = explode('-', $val);
                                            ?>
                        <li><a class="dropdown-item"
                                href="http://localhost/laravel-app/facebook/user-me?id=<?= reset($detail_like_c) ?>">
                                <?php $u = (new User)->find(reset($detail_like_c)); ?> <img
                                    src="./upload/<?= $u['image'] ?>" width="30" height="30" alt="">
                                <?php unset($u['password']);
                                                                                                                                                                                                                                                                                                echo $u['name'];
                                                                                                                                                                                                                                                                                                if (end($detail_like_c) == 1) {
                                                                                                                                                                                                                                                                                                    echo ' đã     LIKE <sl-icon name="hand-thumbs-up-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                } elseif (end($detail_like_c) == 2) {
                                                                                                                                                                                                                                                                                                    echo ' đã     HAHA <sl-icon name="emoji-laughing"></sl-icon>';
                                                                                                                                                                                                                                                                                                } elseif (end($detail_like_c) == 3) {
                                                                                                                                                                                                                                                                                                    echo ' đã     YÊU THÍCH <sl-icon name="heart-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                } elseif (end($detail_like_c) == 4) {
                                                                                                                                                                                                                                                                                                    echo ' đã     KHÓC <sl-icon name="emoji-frown-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                } elseif (end($detail_like_c) == 5) {
                                                                                                                                                                                                                                                                                                    echo ' đã     PHẪN NỘ  <sl-icon name="emoji-angry-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                                                                                ?></a>
                        </li>
                        <?php }
                                            ?>
                    </ul>
                </div>
                <div class="tym">
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class="  like_btn " data-like_status="1" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifLike.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" haha_btn  " data-like_status="2" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHaha.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" love_btn  " data-like_status="3" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifThuongthuong.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" sad_btn  " data-like_status="4" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHuhu.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" angry_btn  " data-like_status="5" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifGian.gif" width="50px" height="50px" alt="SEO">
                    </button>
                </div>
            </form>
            <!-- <div class="col-sm-1" style="width:50px;float:right">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="share-alt-square" class="svg-inline--fa fa-share-alt-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M448 80v352c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48zM304 296c-14.562 0-27.823 5.561-37.783 14.671l-67.958-40.775a56.339 56.339 0 0 0 0-27.793l67.958-40.775C276.177 210.439 289.438 216 304 216c30.928 0 56-25.072 56-56s-25.072-56-56-56-56 25.072-56 56c0 4.797.605 9.453 1.74 13.897l-67.958 40.775C171.823 205.561 158.562 200 144 200c-30.928 0-56 25.072-56 56s25.072 56 56 56c14.562 0 27.823-5.561 37.783-14.671l67.958 40.775a56.088 56.088 0 0 0-1.74 13.897c0 30.928 25.072 56 56 56s56-25.072 56-56C360 321.072 334.928 296 304 296z"></path>
                            </svg>
                        </div> -->
        </div>
    </div>
    <button style="border:none ; background:transparent;outline:none;    margin-left: 20px;" class="coment"
        data-id="<?= $value['id'] ?>">Xem binh luan</button>
    <br>
    <div style="display:none;" id="showcmt" class="showComent_<?= $value['id'] ?> border px-3">

    </div>
    <p></p>
</div>
</div>
<?php }
        }; ?>
<?php
    }
    public function load_kp_unfriends()
    {
        $check = (new User)->find($_POST['id']);
        unset($check['password']);
        $list_fr = explode(',', $check['delay_friend']);
        foreach ($list_fr as $key =>  $val) {
            if ($val == $_SESSION['member']['id']) {
                unset($list_fr[$key]);
            }
        }
        $listNew  = implode(',', $list_fr);
        (new User)->update(
            [
                'delay_friend' =>  $listNew,
            ],
            $_POST['id']
        );
    }
    public function load_kp_friends()
    {
        $check = (new User)->find($_POST['id']);
        unset($check['password']);
        $list_frNew = $check['delay_friend'] . $_SESSION['member']['id'] . ",";
        // echo $_POST['id'];
        (new User)->update(
            [
                'delay_friend' => ($list_frNew),
            ],
            $_POST['id']
        );
    }
    public function wall_me()
    {
        if (isset($_GET['id'])) {
            $model = (new User)->find($_GET['id']);
            $contact = (new Contact)->find($_GET['id']);
        } else {
            $model = (new User)->find($_SESSION['member']['id']);
            $contact = (new Contact)->find($_SESSION['member']['id']);
        }
        $friends = (new Friends)->find($_SESSION['member']['id']);
        return view('Views.user.wall-me', $model, $contact, $friends);
    }
    public function user_me()
    {
        if (isset($_GET['id'])) {
            $model = (new User)->find($_GET['id']);
        } else {
            $model = (new User)->find($_SESSION['member']['id']);
        }
        return view('Views.user.user-index', $model);
    }
    public function showcmt()
    {
        $id = $_SESSION['member']['id'] ?? 0;
        $array = (new Post)->where('coment_id', 0);
        $errors = (new Post)->all();
        $support = (new User)->all();
        unset($support['password']);
        $sup = (new User)->find($id);
    ?>
<form action="create-coment" method="post" onsubmit="return false;" enctype="multipart/form-data"
    class="form input-group ">
    <div class="showImg">
    </div>
    <input type="hidden" name="idHidden" class="idHidden" value="<?= $_POST['id'] ?>">
    <input type="hidden" class="id_user" value="<?= $_SESSION['member']['id'] ?>">
    <input name="coment" type="text" class="comentLoad_<?= $_POST['id'] ?> form-control "
        placeholder="Binh luận của bạn">
    <input style="display:none" class="form-control" class="file" type="file" id="ig_<?= $_POST['id'] ?>" name="image"
        value="">
    <button class="btn btn-outline-secondary cmt-click  " type="button" data-id="<?= $_POST['id'] ?>"
        id="button-addon2">Gửi</button>
</form>
<label style="width:30px;height:30px" for="ig_<?= $_POST['id'] ?>">
    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="images"
        class="svg-inline--fa fa-images fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
        <path fill="currentColor" d="M480 416v16c0 26.51-21.49 48-48 48H48c-26.51
          0-48-21.49-48-48V176c0-26.51 21.49-48 48-48h16v208c0 44.112 35.888 80 80 
          80h336zm96-80V80c0-26.51-21.49-48-48-48H144c-26.51 0-48 21.49-48 48v256c0 
          26.51 21.49 48 48 48h384c26.51 0 48-21.49 48-48zM256 128c0 26.51-21.49 48-48
            48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-96 144l55.515-55.515c4.686-4.686
            12.284-4.686 16.971 0L272 256l135.515-135.515c4.686-4.686 12.284-4.686 16.971 0L512 
            208v112H160v-48z"></path>
    </svg></label>
<?php
        foreach ($errors as $vax) {
            if ($_POST['id'] == $vax['coment_id']) { ?>
<div style="    padding: 5px;
    border-radius: 15px;" class="card bg-  mb-1">
    <div class="card-header">

        <?php
                        foreach ($support as $valS) {
                            if ($vax['user_id'] == $valS['id']) {
                        ?>
        <img style="border-radius:50%" src="./upload/<?= $valS['image'] ?>" width="50" height="50" alt="">
        <?php
                                echo $valS['name'] . ' đã bình luận';
                            };
                        };
                        ?>
        <br>
        <small><?= timeAgo($vax['created_at']) ?></small>
    </div>
    <div class=" border card-body">
        <p style="overflow-wrap: break-word;" class="card-text"><?= $vax['content'] ?></p>
        <?php if ($vax['image']) { ?>
        <img class="element-3" src="./upload/<?= $vax['image'] ?>" width="200" height="200" alt="">
        <?php }; ?>
    </div>
    <form style="position:relative" class="form col-sm-11 form_hover">
        <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
            class="clickBtn hoverTym" data-hidden="<?= $vax['like_status'] ?>" data-id="<?= $vax['id'] ?>">
            <?php
                            $detailLike = explode(',', $vax['detail_like']);
                            $checkDetail = 0;
                            foreach ($detailLike as $val) {
                                $detailLike_List = explode('-', $val);
                                if ($_SESSION['member']['id'] == reset($detailLike_List)) {
                                    $checkDetail = end($detailLike_List);
                                }
                            }
                            if ($checkDetail == 0) { ?>
            <div style="width:30px;height:30px">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart"
                    class="svg-inline--fa fa-heart fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512">
                    <path fill="<?php
                                                    echo 'currentColor'; ?>"
                        d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z">
                    </path>
                </svg>
            </div>
            <?php } elseif ($checkDetail == 1) { ?>
            <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                class="  like_btn " data-like_status="1" data-hidden="<?= $vax['like_status'] ?>"
                data-id="<?= $vax['id'] ?>">
                <img src="./upload/gifLike.gif" width="50px" height="50px" alt="SEO">
            </button>
            <?php } elseif ($checkDetail == 2) { ?>
            <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                class=" haha_btn  " data-like_status="2" data-hidden="<?= $vax['like_status'] ?>"
                data-id="<?= $vax['id'] ?>">
                <img src="./upload/gifHaha.gif" width="50px" height="50px" alt="SEO">
            </button>
            <?php } elseif ($checkDetail == 3) { ?>
            <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                class=" love_btn  " data-like_status="3" data-hidden="<?= $vax['like_status'] ?>"
                data-id="<?= $vax['id'] ?>">
                <img src="./upload/gifThuongthuong.gif" width="50px" height="50px" alt="SEO">
            </button>
            <?php } elseif ($checkDetail == 4) { ?>
            <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                class=" sad_btn  " data-like_status="4" data-hidden="<?= $vax['like_status'] ?>"
                data-id="<?= $vax['id'] ?>">
                <img src="./upload/gifHuhu.gif" width="50px" height="50px" alt="SEO">
            </button>
            <?php } elseif ($checkDetail == 5) { ?>
            <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                class=" angry_btn  " data-like_status="5" data-hidden="<?= $vax['like_status'] ?>"
                data-id="<?= $vax['id'] ?>">
                <img src="./upload/gifGian.gif" width="50px" height="50px" alt="SEO">
            </button>
            <?php    }
                            ?>


        </button>
        <div class="btn-group dropend">
            <button type="button" class="btn   dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <small><?php $count = explode(",", $vax['count_like']);
                                        unset($count[0]);
                                        echo count($count) ?></small>
            </button>

            <ul style="z-index:10000 ; width:300px" class="dropdown-menu">

                <?php
                                $detail_like_count = explode(',', $vax['detail_like']);
                                foreach ($detail_like_count as $val) {
                                    if ($val == 0) {
                                        continue;
                                    }
                                    $detail_like_c = explode('-', $val);
                                ?>
                <li><a class="dropdown-item"
                        href="http://localhost/laravel-app/facebook/user-me?id=<?= reset($detail_like_c) ?>">
                        <?php $u = (new User)->find(reset($detail_like_c)); ?> <img src="./upload/<?= $u['image'] ?>"
                            width="30" height="30" alt="">
                        <?php unset($u['password']);
                                                                                                                                                                                                                                                                                    echo $u['name'];
                                                                                                                                                                                                                                                                                    if (end($detail_like_c) == 1) {
                                                                                                                                                                                                                                                                                        echo ' đã     LIKE <sl-icon name="hand-thumbs-up-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                    } elseif (end($detail_like_c) == 2) {
                                                                                                                                                                                                                                                                                        echo ' đã     HAHA <sl-icon name="emoji-laughing"></sl-icon>';
                                                                                                                                                                                                                                                                                    } elseif (end($detail_like_c) == 3) {
                                                                                                                                                                                                                                                                                        echo ' đã     YÊU THÍCH <sl-icon name="heart-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                    } elseif (end($detail_like_c) == 4) {
                                                                                                                                                                                                                                                                                        echo ' đã     KHÓC <sl-icon name="emoji-frown-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                    } elseif (end($detail_like_c) == 5) {
                                                                                                                                                                                                                                                                                        echo ' đã     PHẪN NỘ  <sl-icon name="emoji-angry-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                    }

                                                                                                                                                                                                                                                                                    ?></a>
                </li>
                <?php }
                                ?>
            </ul>
        </div>
        <div class="tym">
            <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                class="  like_btn " data-like_status="1" data-hidden="<?= $vax['like_status'] ?>"
                data-id="<?= $vax['id'] ?>">
                <img src="./upload/gifLike.gif" width="50px" height="50px" alt="SEO">
            </button>
            <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                class=" haha_btn  " data-like_status="2" data-hidden="<?= $vax['like_status'] ?>"
                data-id="<?= $vax['id'] ?>">
                <img src="./upload/gifHaha.gif" width="50px" height="50px" alt="SEO">
            </button>
            <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                class=" love_btn  " data-like_status="3" data-hidden="<?= $vax['like_status'] ?>"
                data-id="<?= $vax['id'] ?>">
                <img src="./upload/gifThuongthuong.gif" width="50px" height="50px" alt="SEO">
            </button>
            <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                class=" sad_btn  " data-like_status="4" data-hidden="<?= $vax['like_status'] ?>"
                data-id="<?= $vax['id'] ?>">
                <img src="./upload/gifHuhu.gif" width="50px" height="50px" alt="SEO">
            </button>
            <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                class=" angry_btn  " data-like_status="5" data-hidden="<?= $vax['like_status'] ?>"
                data-id="<?= $vax['id'] ?>">
                <img src="./upload/gifGian.gif" width="50px" height="50px" alt="SEO">
            </button>
        </div>
    </form>
    <div style="display:none" class="showform_<?= $vax['id'] ?>">

    </div>
</div>
<?php }
        }
        ?>
<?php

    }
    public function loadCmt()
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $content = $_POST['comentLoad'];
        $image = $_POST['img'];
        $id_post = $_POST['id_post'];
        $checkPost = (new Post)->find($id_post);
        $id_user = $_POST['id_user'];
        $check = (new User)->find($id_user);
        unset($check['password']);
        if ($check['id'] != $checkPost['user_id']) {
            $content_thongbao = $check['name'] . ' đã bình luận bài viết của bạn';
            (new thongbao)->create([
                'user_id' => ($checkPost['user_id']),
                'user_rep' => ($_SESSION['member']['id']),
                'content_thongbao' => $content_thongbao,
                'coment' => $content,
                'id_post' => $id_post,
                'status' => 0,
                'image' => ($_SESSION['member']['image']),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        if (!isset($image)) {
            (new Post)->create(
                [
                    'content' => $content,
                    'user_id' => $id_user,
                    'created_at' => date('Y-m-d H:i:s'),
                    'coment_id' => $id_post,
                ],
            );
        } else {
            (new Post)->create(
                [
                    'content' => $content,
                    'image' => $image,
                    'user_id' => $id_user,
                    'created_at' => date('Y-m-d H:i:s'),
                    'coment_id' => $id_post,
                ]
            );
        }
    }
    public function loadImg()
    {
        if (!empty($_FILES['image']['name'])) {
            $image = $_FILES["image"];
            $imgName = uniqid() . $image['name'];
            move_uploaded_file($image['tmp_name'], "./upload/" . $imgName); ?>
<input type="hidden" class="imhHidden" name="" value="<?= $imgName ?>">
<?php  }
        ?>
<img src="./upload/<?= $imgName ?>" width="100" alt="">
<?php
    }
    public function show_like_post()
    {
        // echo '<pre>'; 
        // var_dump( (new Post) -> whereAndWhere([
        //     'coment_id' => 0,  
        // ],['status' => '< 3']));die;
        $id = $_SESSION['member']['id'] ?? 0;
        // $array = (new Post)->where('coment_id', 0); 
        $array = (new Post)->whereAndWhere([
            'id' => $_POST['id'],
            'coment_id' => 0,
        ], ['status' => '< 2']);
        $gruop = (new Gruop)->all(); 
        $errors = (new Post)->all();
        $support = (new User)->all();
        $sup = (new User)->find($id);
        $friend  = (new Friends)->all();
    ?>
<?php foreach ($array as $value) {
            if ($value['status'] == 1) {
                foreach ($friend as $vaxFr) {
                    if ($vaxFr['id'] == $value['user_id']) {
                        $listFr = explode(',', $vaxFr['list_frend']);
                        if ($id == $vaxFr['id'] || in_array($id, $listFr)) {
        ?>
<div style="    
                    /* padding: 0px 10px; */
                    border-radius: 20px;
                    background: #dddd; 
                    overflow: hidden;
                    margin-bottom: 20px;">
    <div style="border:none; background: #fff;" id="<?php echo $value['id'] ?>" class="card   ">
        <div style=" justify-content: center; align-items: center;text-slign:center" class=" row   card-header p-3">
            <?php
                                        foreach ($support as $val) {
                                            if ($value['user_id'] == $val['id']) {
                                        ?>
            <div class="col-sm-1">
                <a href="user-me?id=<?= $val['id'] ?>"> <img class="rounded-circle img" style="border-radius:50%"
                        src="./upload/<?= $val['image'] ?> " width="50" height="50" alt=""></a>
            </div>
            <div class="row col-sm-10">
                <h2 style="display:inline" class="title"><?= $val['name'] ?>
                    <?php
                                                        if(isset($value['gruop']) && $value['user_id'] == $val['id']){
                                                         
                                                        foreach($gruop as $gr){ 
                                                            if($value['gruop'] === $gr['id']){
                                                            echo '>' ; ?> <a
                        href="show-gruop?id=<?= $gr['id'] ?>"><strong style="color:#005c88"> <?= $gr['name'] ?></strong>
                    </a> <?php ;}}}
                                                    ?>
                </h2>
                <small><?= timeAgo($value['created_at']) ?></small>
            </div>
            <input type="hidden" id="save_name_<?= $value['id'] ?>" name="" value="<?= $val['name'] ?>">
            <input type="hidden" id="save_avatar_<?= $value['id'] ?>" name="" value="<?= $val['image'] ?>">
            <?php
                                            };
                                        };
                                        ?>
            <div class="col-sm-1">
                <button style="border:none ; background:transparent;outline:none" class="btn_click"
                    id="<?php echo $value['id']; ?>" data-id="<?php echo $value['id']; ?>" data-bs-toggle="modal"
                    data-bs-target="#exampleModal_<?php echo $value['id']; ?>">
                    <div style="width:10px">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-v"
                            class="svg-inline--fa fa-ellipsis-v fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 192 512">
                            <path fill="currentColor"
                                d="M96 184c39.8 0 72 32.2 72 72s-32.2 72-72 72-72-32.2-72-72 32.2-72 72-72zM24 80c0 39.8 32.2 72 72 72s72-32.2 72-72S135.8 8 96 8 24 40.2 24 80zm0 352c0 39.8 32.2 72 72 72s72-32.2 72-72-32.2-72-72-72-72 32.2-72 72z">
                            </path>
                        </svg>
                    </div>
                </button>
            </div>
            <!-- / Modal -->
            <div class="modal fade" id="exampleModal_<?php echo $value['id']; ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="save_content_<?= $value['id'] ?>" name=""
                                value="<?php echo $value['content'] ?>">
                            <input type="hidden" id="save_image_<?= $value['id'] ?>" name=""
                                value="<?php echo $value['image'] ?>">
                            <a style="display:block" onclick="add_post(<?php echo $value['id']; ?>)"
                                class="btn alert-success" href="#<?php echo $value['id'] ?>">Lưu bài viết</a>
                            <a style="display:block" class="btn alert-success" href="">Báo cáo quản trị viên</a>
                            <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom_<?= $value['id'] ?>"
                                aria-controls="offcanvasBottom" style="width:100%;border:none;outline:none"
                                data-id="<?= $value['id'] ?>" class=" share_post text-center alert-success" type="">
                                <p>Chia sẻ</p>
                            </button>


                            <!-- Share -->
                            <div class="offcanvas offcanvas-bottom" tabindex="-1"
                                id="offcanvasBottom_<?= $value['id'] ?>" aria-labelledby="offcanvasBottomLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Chia sẻ</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body small">
                                    Nội dung:
                                    <form class="form-control">
                                        <input class="form-control textarea text_share_<?= $value['id'] ?>" type="text"
                                            name="" value="">
                                        <button data-id="<?= $value['id'] ?>" type="button"
                                            class="click_share  btn btn-primary" type="">Chia sẻ</button>
                                    </form>
                                </div>
                            </div>
                            <?php
                                                        if ($value['user_id'] == $_SESSION['member']['id']) { ?>

                            <button style="width:100%;border:none;outline:none" data-id="<?= $value['id'] ?>"
                                class=" edit_post text-center alert-success" type="">
                                <p>Sửa bài viết</p>
                            </button>
                            <a style="display:block" onclick="del(<?= $value['id'] ?>)" class="btn alert-danger"
                                href="del-post?uyweugtewggduyu76uyewrguergew2367twetetfdgvbdf=<?= $value['id'] ?>">Xóa
                                bài viết</a>
                            <form class="form_status text-center p-3">
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="0" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input type="hidden" class="status_hidden" name="" value="<?= $value['id'] ?>">
                                    <input class="form-check-input" value="0" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1"
                                        <?php if ($value['status'] == 0) {
                                                                                                                                                                                echo 'checked';
                                                                                                                                                                            } ?>>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Mọi người
                                    </label>
                                </button>
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="1" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input class="form-check-input" value="1" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2"
                                        <?php if ($value['status'] == 1) {
                                                                                                                                                                                echo 'checked';
                                                                                                                                                                            } ?>>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Bạn bè
                                    </label>
                                </button>
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="2" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input class="form-check-input" value="2" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault3"
                                        <?php if ($value['status'] == 2) {
                                                                                                                                                                                echo 'checked';
                                                                                                                                                                            } ?>>
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Chỉ mình tôi
                                    </label>
                                </button>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Modal -->
        </div>
    </div>
    <div style="background-color: #fff" class="  card-body">
        <p style="overflow-wrap: break-word;" class="card-text text_content"><?= $value['content'] ?></p>
        <!-- //////////////////// -->
        <?php
                                    if ($value['share'] != 0) {
                                        $share = (new Post)->find($value['share']);
                                        $userShare = (new User)->find($share['user_id']);
                                    ?>
        <div class="col-sm-1">
            <a href="user-me?id=<?= $userShare['id'] ?>"> <img class="rounded-circle img" style="border-radius:50%"
                    src="./upload/<?= $userShare['image'] ?> " width="50" height="50" alt=""></a>
        </div>
        <div class="row col-sm-10">
            <h2 style="display:inline" class="title"><?= $userShare['name'] ?></h2>
            <small><?= timeAgo($share['created_at'] ?? '') ?></small>
        </div>
        <div>
            <p style="overflow-wrap: break-word;" class="card-text text_content"><?= $share['content'] ?></p>
            <?php if ($share['user_id'] == $_SESSION['member']['id']) { ?>
            <form class="form_edit edit_form_<?= $share['id'] ?>" style="display:none">
                <input type="hidden" class="id_edit_hidden" name="" value="<?= $share['id'] ?>">
                <input type="text" class="form-control input_edit_<?= $share['id'] ?>" name=""
                    value="<?= $value['content'] ?>">
                <br>
            </form>
            <?php } ?>
            <?php if ($share['image']) {
                                                $arrValue = explode(',', $share['image']);
                                                if (count($arrValue) == 1) {
                                            ?>
            <img src="./upload/<?= $share['image'] ?>" width="100%" alt="">
            <?php   } else { ?>
            <div style="height:400px; overflow:auto">
                <?php foreach ($arrValue as  $valx) {     ?>
                <img width="100%" height="400" src="./upload/<?= $valx ?>" />

                <?php    } ?>
            </div>
        </div>
        <?php }
                                            }; ?><?php
                                                }

                                                    ?>

        <!-- //////////////////////////// -->

        <?php if ($value['user_id'] == $_SESSION['member']['id']) { ?>
        <form class="form_edit edit_form_<?= $value['id'] ?>" style="display:none">
            <input type="hidden" class="id_edit_hidden" name="" value="<?= $value['id'] ?>">
            <input type="text" class="form-control input_edit_<?= $value['id'] ?>" name=""
                value="<?= $value['content'] ?>">
            <br>
        </form>
        <?php } ?>
        <?php if ($value['image']) {
                                            $arrValue = explode(',', $value['image']);
                                            if (count($arrValue) == 1) {
                                        ?>
        <sl-image-comparer>
            <img width="100%" slot="before" src="./upload/<?= $value['image'] ?>">
            <img width="100%" slot="after" src="./upload/<?= $value['image'] ?>">
        </sl-image-comparer>
        <?php   } else { ?>
        <div style="height:400px; overflow:auto">
            <?php foreach ($arrValue as  $valx) {     ?>
            <img width="100%" height="400" src="./upload/<?= $valx ?>" />

            <?php    } ?>
        </div>
        <?php }
                                        }; ?>
        <div class="row">
            <form style="position:relative" class="form col-sm-11 form_hover">
                <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                    class="clickBtn hoverTym" data-hidden="<?= $value['like_status'] ?>" data-id="<?= $value['id'] ?>">
                    <?php
                                                    $detailLike = explode(',', $value['detail_like']);
                                                    $checkDetail = 0;
                                                    foreach ($detailLike as $val) {
                                                        $detailLike_List = explode('-', $val);
                                                        if ($_SESSION['member']['id'] == reset($detailLike_List)) {
                                                            $checkDetail = end($detailLike_List);
                                                        }
                                                    }
                                                    if ($checkDetail == 0) { ?>
                    <div style="width:30px;height:30px">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart"
                            class="svg-inline--fa fa-heart fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path fill="<?php
                                                                            echo 'currentColor'; ?>"
                                d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z">
                            </path>
                        </svg>
                    </div>
                    <?php } elseif ($checkDetail == 1) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class="  like_btn " data-like_status="1" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifLike.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 2) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" haha_btn  " data-like_status="2" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHaha.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 3) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" love_btn  " data-like_status="3" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifThuongthuong.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 4) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" sad_btn  " data-like_status="4" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHuhu.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 5) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" angry_btn  " data-like_status="5" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifGian.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php    }
                                                    ?>


                </button>
                <div class="btn-group dropend">
                    <button type="button" class="btn   dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <small><?php $count = explode(",", $value['count_like']);
                                                                unset($count[0]);
                                                                echo count($count) ?></small>
                    </button>

                    <ul style="z-index:10000 ; width:300px" class="dropdown-menu">

                        <?php
                                                        $detail_like_count = explode(',', $value['detail_like']);
                                                        foreach ($detail_like_count as $val) {
                                                            if ($val == 0) {
                                                                continue;
                                                            }
                                                            $detail_like_c = explode('-', $val);
                                                        ?>
                        <li><a class="dropdown-item"
                                href="http://localhost/laravel-app/facebook/user-me?id=<?= reset($detail_like_c) ?>">
                                <?php $u = (new User)->find(reset($detail_like_c)); ?> <img
                                    src="./upload/<?= $u['image'] ?>" width="30" height="30" alt="">
                                <?php unset($u['password']);
                                                                                                                                                                                                                                                                                                            echo $u['name'];
                                                                                                                                                                                                                                                                                                            if (end($detail_like_c) == 1) {
                                                                                                                                                                                                                                                                                                                echo ' đã     LIKE <sl-icon name="hand-thumbs-up-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                            } elseif (end($detail_like_c) == 2) {
                                                                                                                                                                                                                                                                                                                echo ' đã     HAHA <sl-icon name="emoji-laughing"></sl-icon>';
                                                                                                                                                                                                                                                                                                            } elseif (end($detail_like_c) == 3) {
                                                                                                                                                                                                                                                                                                                echo ' đã     YÊU THÍCH <sl-icon name="heart-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                            } elseif (end($detail_like_c) == 4) {
                                                                                                                                                                                                                                                                                                                echo ' đã     KHÓC <sl-icon name="emoji-frown-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                            } elseif (end($detail_like_c) == 5) {
                                                                                                                                                                                                                                                                                                                echo ' đã     PHẪN NỘ  <sl-icon name="emoji-angry-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                            }

                                                                                                                                                                                                                                                                                                            ?></a>
                        </li>
                        <?php }
                                                        ?>
                    </ul>
                </div>
                <div class="tym">
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class="  like_btn " data-like_status="1" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifLike.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" haha_btn  " data-like_status="2" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHaha.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" love_btn  " data-like_status="3" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifThuongthuong.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" sad_btn  " data-like_status="4" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHuhu.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" angry_btn  " data-like_status="5" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifGian.gif" width="50px" height="50px" alt="SEO">
                    </button>
                </div>
            </form>
            <!-- <div class="col-sm-1" style="width:50px;float:right">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="share-alt-square" class="svg-inline--fa fa-share-alt-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M448 80v352c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48zM304 296c-14.562 0-27.823 5.561-37.783 14.671l-67.958-40.775a56.339 56.339 0 0 0 0-27.793l67.958-40.775C276.177 210.439 289.438 216 304 216c30.928 0 56-25.072 56-56s-25.072-56-56-56-56 25.072-56 56c0 4.797.605 9.453 1.74 13.897l-67.958 40.775C171.823 205.561 158.562 200 144 200c-30.928 0-56 25.072-56 56s25.072 56 56 56c14.562 0 27.823-5.561 37.783-14.671l67.958 40.775a56.088 56.088 0 0 0-1.74 13.897c0 30.928 25.072 56 56 56s56-25.072 56-56C360 321.072 334.928 296 304 296z"></path>
                            </svg>
                        </div> -->
        </div>
    </div>
    <button style="border:none ; background:transparent;outline:none;    margin-left: 20px;" class="coment"
        data-id="<?= $value['id'] ?>">Xem binh luan</button>
    <br>
    <div style="display:none;" id="showcmt" class="showComent_<?= $value['id'] ?> border px-3">

    </div>
    <p></p>
</div>
</div>
<?php
                        }
                    }
                }
            } else {

                ?>
<div style="    
    /* padding: 0px 10px; */
    border-radius: 20px;
    background: #dddd; 
    overflow: hidden;
    margin-bottom: 20px;">
    <div style="border:none; background: #fff;" id="<?php echo $value['id'] ?>" class="card   ">
        <div style=" justify-content: center; align-items: center;text-slign:center" class=" row   card-header p-3">
            <?php
                            foreach ($support as $val) {
                                if ($value['user_id'] == $val['id']) {
                            ?>
            <div class="col-sm-1">
                <a href="user-me?id=<?= $val['id'] ?>"> <img class="rounded-circle img" style="border-radius:50%"
                        src="./upload/<?= $val['image'] ?> " width="50" height="50" alt=""></a>
            </div>
            <div class="row col-sm-10">
                <h2 style="display:inline" class="title"><?= $val['name'] ?>
                    <?php
                                                        if(isset($value['gruop']) && $value['user_id'] == $val['id']){
                                                         
                                                        foreach($gruop as $gr){ 
                                                            if($value['gruop'] === $gr['id']){
                                                            echo '>' ; ?> <a
                        href="show-gruop?id=<?= $gr['id'] ?>"><strong style="color:#005c88"> <?= $gr['name'] ?></strong>
                    </a> <?php ;}}}
                                                    ?></h2>
                <small><?= timeAgo($value['created_at']) ?></small>
            </div>
            <input type="hidden" id="save_name_<?= $value['id'] ?>" name="" value="<?= $val['name'] ?>">
            <input type="hidden" id="save_avatar_<?= $value['id'] ?>" name="" value="<?= $val['image'] ?>">
            <?php
                                };
                            };
                            ?>
            <div class="col-sm-1">
                <button style="border:none ; background:transparent;outline:none" class="btn_click"
                    id="<?php echo $value['id']; ?>" data-id="<?php echo $value['id']; ?>" data-bs-toggle="modal"
                    data-bs-target="#exampleModal_<?php echo $value['id']; ?>">
                    <div style="width:10px">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-v"
                            class="svg-inline--fa fa-ellipsis-v fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 192 512">
                            <path fill="currentColor"
                                d="M96 184c39.8 0 72 32.2 72 72s-32.2 72-72 72-72-32.2-72-72 32.2-72 72-72zM24 80c0 39.8 32.2 72 72 72s72-32.2 72-72S135.8 8 96 8 24 40.2 24 80zm0 352c0 39.8 32.2 72 72 72s72-32.2 72-72-32.2-72-72-72-72 32.2-72 72z">
                            </path>
                        </svg>
                    </div>
                </button>
            </div>
            <!-- / Modal -->
            <div class="modal fade" id="exampleModal_<?php echo $value['id']; ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="save_content_<?= $value['id'] ?>" name=""
                                value="<?php echo $value['content'] ?>">
                            <input type="hidden" id="save_image_<?= $value['id'] ?>" name=""
                                value="<?php echo $value['image'] ?>">
                            <a style="display:block" onclick="add_post(<?php echo $value['id']; ?>)"
                                class="btn alert-success" href="#<?php echo $value['id'] ?>">Lưu bài viết</a>
                            <a style="display:block" class="btn alert-success" href="">Báo cáo quản trị viên</a>
                            <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom_<?= $value['id'] ?>"
                                aria-controls="offcanvasBottom" style="width:100%;border:none;outline:none"
                                data-id="<?= $value['id'] ?>" class=" share_post text-center alert-success" type="">
                                <p>Chia sẻ</p>
                            </button>


                            <!-- Share -->
                            <div class="offcanvas offcanvas-bottom" tabindex="-1"
                                id="offcanvasBottom_<?= $value['id'] ?>" aria-labelledby="offcanvasBottomLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Chia sẻ</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body small">
                                    Nội dung:
                                    <form class="form-control">
                                        <input class="form-control textarea text_share_<?= $value['id'] ?>" type="text"
                                            name="" value="">
                                        <button data-id="<?= $value['id'] ?>" type="button"
                                            class="click_share  btn btn-primary" type="">Chia sẻ</button>
                                    </form>
                                </div>
                            </div>
                            <!-- Share -->

                            <?php
                                            if ($value['user_id'] == $_SESSION['member']['id']) { ?>

                            <button style="width:100%;border:none;outline:none" data-id="<?= $value['id'] ?>"
                                class=" edit_post text-center alert-success" type="">
                                <p>Sửa bài viết</p>
                            </button>
                            <a style="display:block" onclick="del(<?= $value['id'] ?>)" class="btn alert-danger"
                                href="del-post?uyweugtewggduyu76uyewrguergew2367twetetfdgvbdf=<?= $value['id'] ?>">Xóa
                                bài viết</a>
                            <form class="form_status text-center p-3">
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="0" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input type="hidden" class="status_hidden" name="" value="<?= $value['id'] ?>">
                                    <input class="form-check-input" value="0" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1"
                                        <?php if ($value['status'] == 0) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?>>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Mọi người
                                    </label>
                                </button>
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="1" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input class="form-check-input" value="1" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2"
                                        <?php if ($value['status'] == 1) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?>>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Bạn bè
                                    </label>
                                </button>
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="2" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input class="form-check-input" value="2" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault3"
                                        <?php if ($value['status'] == 2) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?>>
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Chỉ mình tôi
                                    </label>
                                </button>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Modal -->
        </div>
    </div>
    <div style="background-color: #fff" class="  card-body">
        <p style="overflow-wrap: break-word;" class="card-text text_content"><?= $value['content'] ?></p>
        <!-- New -->
        <?php
                        if ($value['share'] != 0) {
                            $share = (new Post)->find($value['share']);
                            $userShare = (new User)->find($share['user_id']);
                        ?>
        <div class="col-sm-1">
            <a href="user-me?id=<?= $userShare['id'] ?>"> <img class="rounded-circle img" style="border-radius:50%"
                    src="./upload/<?= $userShare['image'] ?> " width="50" height="50" alt=""></a>
        </div>
        <div class="row col-sm-10">
            <h2 style="display:inline" class="title"><?= $userShare['name'] ?></h2>
            <small><?= timeAgo($share['created_at'] ?? '') ?></small>
        </div>
        <div>
            <p style="overflow-wrap: break-word;" class="card-text text_content"><?= $share['content'] ?></p>
            <?php if ($share['user_id'] == $_SESSION['member']['id']) { ?>
            <form class="form_edit edit_form_<?= $share['id'] ?>" style="display:none">
                <input type="hidden" class="id_edit_hidden" name="" value="<?= $share['id'] ?>">
                <input type="text" class="form-control input_edit_<?= $share['id'] ?>" name=""
                    value="<?= $value['content'] ?>">
                <br>
            </form>
            <?php } ?>
            <?php if ($share['image']) {
                                    $arrValue = explode(',', $share['image']);
                                    if (count($arrValue) == 1) {
                                ?>
            <img src="./upload/<?= $share['image'] ?>" width="100%" alt="">
            <?php   } else { ?>
            <div style="height:400px; overflow:auto">
                <?php foreach ($arrValue as  $valx) {     ?>
                <img width="100%" height="400" src="./upload/<?= $valx ?>" />

                <?php    } ?>
            </div>
        </div>
        <?php }
                                }; ?><?php
                                    }

                                        ?>
        <!-- New -->
        <?php if ($value['user_id'] == $_SESSION['member']['id']) { ?>
        <form class="form_edit edit_form_<?= $value['id'] ?>" style="display:none">
            <input type="hidden" class="id_edit_hidden" name="" value="<?= $value['id'] ?>">
            <input type="text" class="form-control input_edit_<?= $value['id'] ?>" name=""
                value="<?= $value['content'] ?>">
            <br>
        </form>
        <?php } ?>
        <?php if ($value['image']) {
                                $arrValue = explode(',', $value['image']);
                                if (count($arrValue) == 1) {
                            ?>
        <sl-image-comparer>
            <img width="100%" slot="before" src="./upload/<?= $value['image'] ?>">
            <img width="100%" slot="after" src="./upload/<?= $value['image'] ?>">
        </sl-image-comparer>

        <?php   } else { ?>
        <div style="height:400px; overflow:auto">
            <?php foreach ($arrValue as  $valx) {     ?>

            <img width="100%" height="400" src="./upload/<?= $valx ?>" />

            <?php    } ?>
        </div>
        <?php }
                            }; ?>
        <div class="row">
            <form style="position:relative" class="form col-sm-11 form_hover">
                <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                    class="clickBtn hoverTym" data-hidden="<?= $value['like_status'] ?>" data-id="<?= $value['id'] ?>">
                    <?php
                                        $detailLike = explode(',', $value['detail_like']);
                                        $checkDetail = 0;
                                        foreach ($detailLike as $val) {
                                            $detailLike_List = explode('-', $val);
                                            if ($_SESSION['member']['id'] == reset($detailLike_List)) {
                                                $checkDetail = end($detailLike_List);
                                            }
                                        }
                                        if ($checkDetail == 0) { ?>
                    <div style="width:30px;height:30px">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart"
                            class="svg-inline--fa fa-heart fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path fill="<?php
                                                                echo 'currentColor'; ?>"
                                d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z">
                            </path>
                        </svg>
                    </div>
                    <?php } elseif ($checkDetail == 1) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class="  like_btn " data-like_status="1" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifLike.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 2) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" haha_btn  " data-like_status="2" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHaha.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 3) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" love_btn  " data-like_status="3" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifThuongthuong.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 4) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" sad_btn  " data-like_status="4" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHuhu.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 5) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" angry_btn  " data-like_status="5" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifGian.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php    }
                                        ?>


                </button>

                <div class="btn-group dropend">
                    <button type="button" class="btn   dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <small><?php $count = explode(",", $value['count_like']);
                                                    unset($count[0]);
                                                    echo count($count) ?></small>
                    </button>

                    <ul style="z-index:10000 ; width:300px" class="dropdown-menu">

                        <?php
                                            $detail_like_count = explode(',', $value['detail_like']);
                                            foreach ($detail_like_count as $val) {
                                                if ($val == 0) {
                                                    continue;
                                                }
                                                $detail_like_c = explode('-', $val);
                                            ?>
                        <li><a class="dropdown-item"
                                href="http://localhost/laravel-app/facebook/user-me?id=<?= reset($detail_like_c) ?>">
                                <?php $u = (new User)->find(reset($detail_like_c)); ?> <img
                                    src="./upload/<?= $u['image'] ?>" width="30" height="30" alt="">
                                <?php unset($u['password']);
                                                                                                                                                                                                                                                                                                echo $u['name'];
                                                                                                                                                                                                                                                                                                if (end($detail_like_c) == 1) {
                                                                                                                                                                                                                                                                                                    echo ' đã     LIKE <sl-icon name="hand-thumbs-up-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                } elseif (end($detail_like_c) == 2) {
                                                                                                                                                                                                                                                                                                    echo ' đã     HAHA <sl-icon name="emoji-laughing"></sl-icon>';
                                                                                                                                                                                                                                                                                                } elseif (end($detail_like_c) == 3) {
                                                                                                                                                                                                                                                                                                    echo ' đã     YÊU THÍCH <sl-icon name="heart-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                } elseif (end($detail_like_c) == 4) {
                                                                                                                                                                                                                                                                                                    echo ' đã     KHÓC <sl-icon name="emoji-frown-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                } elseif (end($detail_like_c) == 5) {
                                                                                                                                                                                                                                                                                                    echo ' đã     PHẪN NỘ  <sl-icon name="emoji-angry-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                                                                                ?></a>
                        </li>
                        <?php }
                                            ?>
                    </ul>
                </div>
                <div class="tym">
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class="  like_btn " data-like_status="1" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifLike.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" haha_btn  " data-like_status="2" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHaha.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" love_btn  " data-like_status="3" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifThuongthuong.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" sad_btn  " data-like_status="4" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHuhu.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" angry_btn  " data-like_status="5" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifGian.gif" width="50px" height="50px" alt="SEO">
                    </button>
                </div>
            </form>
            <!-- <div class="col-sm-1" style="width:50px;float:right">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="share-alt-square" class="svg-inline--fa fa-share-alt-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M448 80v352c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48zM304 296c-14.562 0-27.823 5.561-37.783 14.671l-67.958-40.775a56.339 56.339 0 0 0 0-27.793l67.958-40.775C276.177 210.439 289.438 216 304 216c30.928 0 56-25.072 56-56s-25.072-56-56-56-56 25.072-56 56c0 4.797.605 9.453 1.74 13.897l-67.958 40.775C171.823 205.561 158.562 200 144 200c-30.928 0-56 25.072-56 56s25.072 56 56 56c14.562 0 27.823-5.561 37.783-14.671l67.958 40.775a56.088 56.088 0 0 0-1.74 13.897c0 30.928 25.072 56 56 56s56-25.072 56-56C360 321.072 334.928 296 304 296z"></path>
                            </svg>
                        </div> -->
        </div>
    </div>
    <button style="border:none ; background:transparent;outline:none;    margin-left: 20px;" class="coment"
        data-id="<?= $value['id'] ?>">Xem binh luan</button>
    <br>
    <div style="display:none;" id="showcmt" class="showComent_<?= $value['id'] ?> border px-3">

    </div>
    <p></p>
</div>
</div>
<?php }
        }; ?>
<?php
    }
    public function show_like($idGre)
    {
        // echo $_COOKIE['hhdasdhashd'] ; 
        // echo '<pre>';
        // var_dump( (new Post) -> whereAndWhere([
        //     'coment_id' => 0, 
        // ],['status' => '< 3']));die;
        $id = $_SESSION['member']['id'] ?? 0;
        // $array = (new Post)->where('coment_id', 0);

        $errors = (new Post)->all();
        if (!isset($_SESSION['data'])) {
            $_SESSION['data'] = 0;
        }
        if (isset($_POST['data'])) {
            $_SESSION['data'] = $_POST['data'];
        }
        if (isset($_POST['page'])) { 
            if (isset($_COOKIE['hhdasdhashd'])) {
                $array = (new Post)->whereAndWhere([
                    'coment_id' => 0,
                    'gruop' => $_COOKIE['hhdasdhashd']
                ], ['status' => '< 2'], (4 * $_POST['page']));
            } else {
                $array = (new Post)->whereAndWhere([
                    'coment_id' => 0,
                ], ['status' => '< 2'], (4 * $_POST['page']));
            }
        } else {
            if (isset($_COOKIE['hhdasdhashd'])) {
                $array = (new Post)->whereAndWhere([
                    'gruop' => $_COOKIE['hhdasdhashd'],
                    'coment_id' => 0,
                ], ['status' => '< 2'], 4);
            } else {
                $array = (new Post)->whereAndWhere([
                    'coment_id' => 0,
                ], ['status' => '< 2'], 4);
            }
        }
        $gruop = (new Gruop)->all();
        $okla = [];
        foreach ($array as $oghthth){
            if(isset($oghthth['gruop'])){
                foreach ($gruop as $val) { 
                    $list = explode(',', $val['member']);
                    foreach ($list as $avx) {
                      $ogt = explode('-', $avx);
                      // echo reset($ogt);
                      $ghhas = explode(",", $val['member']);
                      if (reset($ogt) == $_SESSION['member']['id']) {
                            array_push($okla , $oghthth);
                      }}}
            }else{
                  array_push($okla , $oghthth);
            }
        }

        $support = (new User)->all();
        $sup = (new User)->find($id);
        $friend  = (new Friends)->all();
    ?>
<?php foreach ($array as $value) {
            $flag = false ; 
              if(isset($value['gruop']) && $value['gruop'] != 0 ){
                foreach ($gruop as $val) { 
                    if($val['id'] == $value['gruop']){   
                        $list = explode(',', $val['member']);
                        foreach ($list as $avx) {
                          $ogt = explode('-', $avx);
                          // echo reset($ogt);
                          $ghhas = explode(",", $val['member']);
                          if (reset($ogt) == $_SESSION['member']['id']) {
                            //   echo reset($ogt) .  '== ' .$_SESSION['member']['id'];
                            // echo 'Gruop of me ';
                               $flag = true; 
                          }}
                    }
                    }
            }else{
                $flag = true; 
            }
            if(!$flag) {
                 
            }else{
               
         

            if ($value['status'] == 1) {
                foreach ($friend as $vaxFr) {
                    if ($vaxFr['id'] == $value['user_id']) {
                        $listFr = explode(',', $vaxFr['list_frend']);
                        if ($id == $vaxFr['id'] || in_array($id, $listFr)) {
        ?>
<div style="    
                    /* padding: 0px 10px; */
                    border-radius: 20px;
                    background: #dddd; 
                    overflow: hidden;
                    margin-bottom: 20px;">
    <div style="border:none; background: #fff;" id="<?php echo $value['id'] ?>" class="card   ">
        <div style=" justify-content: center; align-items: center;text-slign:center" class=" row   card-header p-3">
            <?php
                                        foreach ($support as $val) {
                                            if ($value['user_id'] == $val['id']) {
                                        ?>
            <div class="col-sm-1">
                <a href="user-me?id=<?= $val['id'] ?>"> <img class="rounded-circle img" style="border-radius:50%"
                        src="./upload/<?= $val['image'] ?> " width="50" height="50" alt=""></a>
            </div>
            <div class="row col-sm-10">
                <h2 style="display:inline" class="title"><?= $val['name'] ?> <?php
                                                        if(isset($value['gruop']) && $value['user_id'] == $val['id']){
                                                         
                                                        foreach($gruop as $gr){ 
                                                            if($value['gruop'] === $gr['id']){
                                                            echo '>' ; ?> <a
                        href="show-gruop?id=<?= $gr['id'] ?>"><strong style="color:#005c88"> <?= $gr['name'] ?></strong>
                    </a> <?php ;}}}
                                                    ?></h2>
                <small><?= timeAgo($value['created_at']) ?></small>
            </div>
            <input type="hidden" id="save_name_<?= $value['id'] ?>" name="" value="<?= $val['name'] ?>">
            <input type="hidden" id="save_avatar_<?= $value['id'] ?>" name="" value="<?= $val['image'] ?>">
            <?php
                                            };
                                        };
                                        ?>
            <div class="col-sm-1">
                <button style="border:none ; background:transparent;outline:none" class="btn_click"
                    id="<?php echo $value['id']; ?>" data-id="<?php echo $value['id']; ?>" data-bs-toggle="modal"
                    data-bs-target="#exampleModal_<?php echo $value['id']; ?>">
                    <div style="width:10px">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-v"
                            class="svg-inline--fa fa-ellipsis-v fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 192 512">
                            <path fill="currentColor"
                                d="M96 184c39.8 0 72 32.2 72 72s-32.2 72-72 72-72-32.2-72-72 32.2-72 72-72zM24 80c0 39.8 32.2 72 72 72s72-32.2 72-72S135.8 8 96 8 24 40.2 24 80zm0 352c0 39.8 32.2 72 72 72s72-32.2 72-72-32.2-72-72-72-72 32.2-72 72z">
                            </path>
                        </svg>
                    </div>
                </button>
            </div>
            <!-- / Modal -->
            <div class="modal fade" id="exampleModal_<?php echo $value['id']; ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="save_content_<?= $value['id'] ?>" name=""
                                value="<?php echo $value['content'] ?>">
                            <input type="hidden" id="save_image_<?= $value['id'] ?>" name=""
                                value="<?php echo $value['image'] ?>">
                            <a style="display:block" onclick="add_post(<?php echo $value['id']; ?>)"
                                class="btn alert-success" href="#<?php echo $value['id'] ?>">Lưu bài viết</a>
                            <a style="display:block" class="btn alert-success" href="">Báo cáo quản trị viên</a>
                            <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom_<?= $value['id'] ?>"
                                aria-controls="offcanvasBottom" style="width:100%;border:none;outline:none"
                                data-id="<?= $value['id'] ?>" class=" share_post text-center alert-success" type="">
                                <p>Chia sẻ</p>
                            </button>


                            <!-- Share -->
                            <div class="offcanvas offcanvas-bottom" tabindex="-1"
                                id="offcanvasBottom_<?= $value['id'] ?>" aria-labelledby="offcanvasBottomLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Chia sẻ</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body small">
                                    Nội dung:
                                    <form class="form-control">
                                        <input class="form-control textarea text_share_<?= $value['id'] ?>" type="text"
                                            name="" value="">
                                        <button data-id="<?= $value['id'] ?>" type="button"
                                            class="click_share  btn btn-primary" type="">Chia sẻ</button>
                                    </form>
                                </div>
                            </div>
                            <?php
                                                        if ($value['user_id'] == $_SESSION['member']['id']) { ?>

                            <button style="width:100%;border:none;outline:none" data-id="<?= $value['id'] ?>"
                                class=" edit_post text-center alert-success" type="">
                                <p>Sửa bài viết</p>
                            </button>
                            <a style="display:block" onclick="del(<?= $value['id'] ?>)" class="btn alert-danger"
                                href="del-post?uyweugtewggduyu76uyewrguergew2367twetetfdgvbdf=<?= $value['id'] ?>">Xóa
                                bài viết</a>
                            <form class="form_status text-center p-3">
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="0" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input type="hidden" class="status_hidden" name="" value="<?= $value['id'] ?>">
                                    <input class="form-check-input" value="0" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1"
                                        <?php if ($value['status'] == 0) {
                                                                                                                                                                                echo 'checked';
                                                                                                                                                                            } ?>>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Mọi người
                                    </label>
                                </button>
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="1" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input class="form-check-input" value="1" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2"
                                        <?php if ($value['status'] == 1) {
                                                                                                                                                                                echo 'checked';
                                                                                                                                                                            } ?>>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Bạn bè
                                    </label>
                                </button>
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="2" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input class="form-check-input" value="2" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault3"
                                        <?php if ($value['status'] == 2) {
                                                                                                                                                                                echo 'checked';
                                                                                                                                                                            } ?>>
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Chỉ mình tôi
                                    </label>
                                </button>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Modal -->
        </div>
    </div>
    <div style="background-color: #fff" class="  card-body">
        <p style="overflow-wrap: break-word;" class="card-text text_content"><?= $value['content'] ?></p>
        <!-- //////////////////// -->
        <?php
                                    if ($value['share'] != 0) {
                                        $share = (new Post)->find($value['share']);
                                        $userShare = (new User)->find($share['user_id']);
                                    ?>
        <div class="col-sm-1">
            <a href="user-me?id=<?= $userShare['id'] ?>"> <img class="rounded-circle img" style="border-radius:50%"
                    src="./upload/<?= $userShare['image'] ?> " width="50" height="50" alt=""></a>
        </div>
        <div class="row col-sm-10">
            <h2 style="display:inline" class="title"><?= $userShare['name'] ?></h2>
            <small><?= timeAgo($share['created_at'] ?? '') ?></small>
        </div>
        <div>
            <p style="overflow-wrap: break-word;" class="card-text text_content"><?= $share['content'] ?></p>
            <?php if ($share['user_id'] == $_SESSION['member']['id']) { ?>
            <form class="form_edit edit_form_<?= $share['id'] ?>" style="display:none">
                <input type="hidden" class="id_edit_hidden" name="" value="<?= $share['id'] ?>">
                <input type="text" class="form-control input_edit_<?= $share['id'] ?>" name=""
                    value="<?= $value['content'] ?>">
                <br>
            </form>
            <?php } ?>
            <?php if ($share['image']) {
                                                $arrValue = explode(',', $share['image']);
                                                if (count($arrValue) == 1) {
                                            ?>
            <img src="./upload/<?= $share['image'] ?>" width="100%" alt="">
            <?php   } else { ?>
            <div style="height:400px; overflow:auto">
                <?php foreach ($arrValue as  $valx) {     ?>
                <img width="100%" height="400" src="./upload/<?= $valx ?>" />

                <?php    } ?>
            </div>
        </div>
        <?php }
                                            }; ?><?php
                                                }

                                                    ?>

        <!-- //////////////////////////// -->

        <?php if ($value['user_id'] == $_SESSION['member']['id']) { ?>
        <form class="form_edit edit_form_<?= $value['id'] ?>" style="display:none">
            <input type="hidden" class="id_edit_hidden" name="" value="<?= $value['id'] ?>">
            <input type="text" class="form-control input_edit_<?= $value['id'] ?>" name=""
                value="<?= $value['content'] ?>">
            <br>
        </form>
        <?php } ?>
        <?php if ($value['image']) {
                                            $arrValue = explode(',', $value['image']);
                                            if (count($arrValue) == 1) {
                                        ?>
        <sl-image-comparer>
            <img width="100%" slot="before" src="./upload/<?= $value['image'] ?>">
            <img width="100%" slot="after" src="./upload/<?= $value['image'] ?>">
        </sl-image-comparer>
        <?php   } else { ?>
        <div style="height:400px; overflow:auto">
            <?php foreach ($arrValue as  $valx) {     ?>
            <img width="100%" height="400" src="./upload/<?= $valx ?>" />

            <?php    } ?>
        </div>
        <?php }
                                        }; ?>
        <div class="row">
            <form style="position:relative" class="form col-sm-11 form_hover">
                <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                    class="clickBtn hoverTym" data-hidden="<?= $value['like_status'] ?>" data-id="<?= $value['id'] ?>">
                    <?php
                                                    $detailLike = explode(',', $value['detail_like']);
                                                    $checkDetail = 0;
                                                    foreach ($detailLike as $val) {
                                                        $detailLike_List = explode('-', $val);
                                                        if ($_SESSION['member']['id'] == reset($detailLike_List)) {
                                                            $checkDetail = end($detailLike_List);
                                                        }
                                                    }
                                                    if ($checkDetail == 0) { ?>
                    <div style="width:30px;height:30px">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart"
                            class="svg-inline--fa fa-heart fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path fill="<?php
                                                                            echo 'currentColor'; ?>"
                                d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z">
                            </path>
                        </svg>
                    </div>
                    <?php } elseif ($checkDetail == 1) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class="  like_btn " data-like_status="1" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifLike.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 2) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" haha_btn  " data-like_status="2" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHaha.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 3) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" love_btn  " data-like_status="3" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifThuongthuong.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 4) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" sad_btn  " data-like_status="4" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHuhu.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 5) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" angry_btn  " data-like_status="5" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifGian.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php    }
                                                    ?>
                </button>
                <div class="btn-group dropend">
                    <button type="button" class="btn   dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <small><?php $count = explode(",", $value['count_like']);
                                                                unset($count[0]);
                                                                echo count($count) ?></small>
                    </button>

                    <ul style="z-index:10000 ; width:300px" class="dropdown-menu">

                        <?php
                                                        $detail_like_count = explode(',', $value['detail_like']);
                                                        foreach ($detail_like_count as $val) {
                                                            if ($val == 0) {
                                                                continue;
                                                            }
                                                            $detail_like_c = explode('-', $val);
                                                        ?>
                        <li><a class="dropdown-item"
                                href="http://localhost/laravel-app/facebook/user-me?id=<?= reset($detail_like_c) ?>">
                                <?php $u = (new User)->find(reset($detail_like_c)); ?> <img
                                    src="./upload/<?= $u['image'] ?>" width="30" height="30" alt="">
                                <?php unset($u['password']);
                                                                                                                                                                                                                                                                                                            echo $u['name'];
                                                                                                                                                                                                                                                                                                            if (end($detail_like_c) == 1) {
                                                                                                                                                                                                                                                                                                                echo ' đã     LIKE <sl-icon name="hand-thumbs-up-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                            } elseif (end($detail_like_c) == 2) {
                                                                                                                                                                                                                                                                                                                echo ' đã     HAHA <sl-icon name="emoji-laughing"></sl-icon>';
                                                                                                                                                                                                                                                                                                            } elseif (end($detail_like_c) == 3) {
                                                                                                                                                                                                                                                                                                                echo ' đã     YÊU THÍCH <sl-icon name="heart-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                            } elseif (end($detail_like_c) == 4) {
                                                                                                                                                                                                                                                                                                                echo ' đã     KHÓC <sl-icon name="emoji-frown-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                            } elseif (end($detail_like_c) == 5) {
                                                                                                                                                                                                                                                                                                                echo ' đã     PHẪN NỘ  <sl-icon name="emoji-angry-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                            }

                                                                                                                                                                                                                                                                                                            ?></a>
                        </li>
                        <?php }
                                                        ?>
                    </ul>
                </div>
                <div class="tym">
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class="  like_btn " data-like_status="1" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifLike.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" haha_btn  " data-like_status="2" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHaha.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" love_btn  " data-like_status="3" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifThuongthuong.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" sad_btn  " data-like_status="4" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHuhu.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" angry_btn  " data-like_status="5" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifGian.gif" width="50px" height="50px" alt="SEO">
                    </button>
                </div>
            </form>
            <!-- <div class="col-sm-1" style="width:50px;float:right">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="share-alt-square" class="svg-inline--fa fa-share-alt-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M448 80v352c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48zM304 296c-14.562 0-27.823 5.561-37.783 14.671l-67.958-40.775a56.339 56.339 0 0 0 0-27.793l67.958-40.775C276.177 210.439 289.438 216 304 216c30.928 0 56-25.072 56-56s-25.072-56-56-56-56 25.072-56 56c0 4.797.605 9.453 1.74 13.897l-67.958 40.775C171.823 205.561 158.562 200 144 200c-30.928 0-56 25.072-56 56s25.072 56 56 56c14.562 0 27.823-5.561 37.783-14.671l67.958 40.775a56.088 56.088 0 0 0-1.74 13.897c0 30.928 25.072 56 56 56s56-25.072 56-56C360 321.072 334.928 296 304 296z"></path>
                            </svg>
                        </div> -->
        </div>
    </div>
    <button style="border:none ; background:transparent;outline:none;    margin-left: 20px;" class="coment"
        data-id="<?= $value['id'] ?>">Xem binh luan</button>
    <br>
    <div style="display:none;" id="showcmt" class="showComent_<?= $value['id'] ?> border px-3">

    </div>
    <p></p>
</div>
</div>
<?php
                        }
                    }
                }
            } else {

                ?>
<div style="    
    /* padding: 0px 10px; */
    border-radius: 20px;
    background: #dddd; 
    overflow: hidden;
    margin-bottom: 20px;">
    <div style="border:none; background: #fff;" id="<?php echo $value['id'] ?>" class="card   ">
        <div style=" justify-content: center; align-items: center;text-slign:center" class=" row   card-header p-3">
            <?php
                            foreach ($support as $val) {
                                if ($value['user_id'] == $val['id']) {
                            ?>
            <div class="col-sm-1">
                <a href="user-me?id=<?= $val['id'] ?>"> <img class="rounded-circle img" style="border-radius:50%"
                        src="./upload/<?= $val['image'] ?> " width="50" height="50" alt=""></a>
            </div>
            <div class="row col-sm-10">

                <h2 style="display:inline" class="title"><?= $val['name'] ?>
                    <?php
                                                        if(isset($value['gruop']) && $value['user_id'] == $val['id']){
                                                         
                                                        foreach($gruop as $gr){ 
                                                            if($value['gruop'] === $gr['id']){
                                                            echo '>' ; ?> <a
                        href="show-gruop?id=<?= $gr['id'] ?>"><strong style="color:#005c88"> <?= $gr['name'] ?></strong>
                    </a> <?php ;}}}
                                                    ?>
                </h2>
                <small><?= timeAgo($value['created_at']) ?></small>
            </div>
            <input type="hidden" id="save_name_<?= $value['id'] ?>" name="" value="<?= $val['name'] ?>">
            <input type="hidden" id="save_avatar_<?= $value['id'] ?>" name="" value="<?= $val['image'] ?>">
            <?php
                                };
                            };
                            ?>
            <div class="col-sm-1">
                <button style="border:none ; background:transparent;outline:none" class="btn_click"
                    id="<?php echo $value['id']; ?>" data-id="<?php echo $value['id']; ?>" data-bs-toggle="modal"
                    data-bs-target="#exampleModal_<?php echo $value['id']; ?>">
                    <div style="width:10px">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-v"
                            class="svg-inline--fa fa-ellipsis-v fa-w-6" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 192 512">
                            <path fill="currentColor"
                                d="M96 184c39.8 0 72 32.2 72 72s-32.2 72-72 72-72-32.2-72-72 32.2-72 72-72zM24 80c0 39.8 32.2 72 72 72s72-32.2 72-72S135.8 8 96 8 24 40.2 24 80zm0 352c0 39.8 32.2 72 72 72s72-32.2 72-72-32.2-72-72-72-72 32.2-72 72z">
                            </path>
                        </svg>
                    </div>
                </button>
            </div>
            <!-- / Modal -->
            <div class="modal fade" id="exampleModal_<?php echo $value['id']; ?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="save_content_<?= $value['id'] ?>" name=""
                                value="<?php echo $value['content'] ?>">
                            <input type="hidden" id="save_image_<?= $value['id'] ?>" name=""
                                value="<?php echo $value['image'] ?>">
                            <a style="display:block" onclick="add_post(<?php echo $value['id']; ?>)"
                                class="btn alert-success" href="#<?php echo $value['id'] ?>">Lưu bài viết</a>
                            <a style="display:block" class="btn alert-success" href="">Báo cáo quản trị viên</a>
                            <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom_<?= $value['id'] ?>"
                                aria-controls="offcanvasBottom" style="width:100%;border:none;outline:none"
                                data-id="<?= $value['id'] ?>" class=" share_post text-center alert-success" type="">
                                <p>Chia sẻ</p>
                            </button>


                            <!-- Share -->
                            <div class="offcanvas offcanvas-bottom" tabindex="-1"
                                id="offcanvasBottom_<?= $value['id'] ?>" aria-labelledby="offcanvasBottomLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Chia sẻ</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body small">
                                    Nội dung:
                                    <form class="form-control">
                                        <input class="form-control textarea text_share_<?= $value['id'] ?>" type="text"
                                            name="" value="">
                                        <button data-id="<?= $value['id'] ?>" type="button"
                                            class="click_share  btn btn-primary" type="">Chia sẻ</button>
                                    </form>
                                </div>
                            </div>
                            <!-- Share -->

                            <?php
                                            if ($value['user_id'] == $_SESSION['member']['id']) { ?>

                            <button style="width:100%;border:none;outline:none" data-id="<?= $value['id'] ?>"
                                class=" edit_post text-center alert-success" type="">
                                <p>Sửa bài viết</p>
                            </button>
                            <a style="display:block" onclick="del(<?= $value['id'] ?>)" class="btn alert-danger"
                                href="del-post?uyweugtewggduyu76uyewrguergew2367twetetfdgvbdf=<?= $value['id'] ?>">Xóa
                                bài viết</a>
                            <form class="form_status text-center p-3">
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="0" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input type="hidden" class="status_hidden" name="" value="<?= $value['id'] ?>">
                                    <input class="form-check-input" value="0" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault1"
                                        <?php if ($value['status'] == 0) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?>>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Mọi người
                                    </label>
                                </button>
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="1" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input class="form-check-input" value="1" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault2"
                                        <?php if ($value['status'] == 1) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?>>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Bạn bè
                                    </label>
                                </button>
                                <button style="border:none;background:none;width:100%;outline:none" type="button"
                                    data-status="2" data-id="<?= $value['id'] ?>" class="form-check form-switch">
                                    <input class="form-check-input" value="2" type="radio" name="flexRadioDefault"
                                        id="flexRadioDefault3"
                                        <?php if ($value['status'] == 2) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?>>
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Chỉ mình tôi
                                    </label>
                                </button>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Modal -->
        </div>
    </div>
    <div style="background-color: #fff" class="  card-body">
        <p style="overflow-wrap: break-word;" class="card-text text_content"><?= $value['content'] ?></p>
        <!-- New -->
        <?php
                        if ($value['share'] != 0) {
                            $share = (new Post)->find($value['share']);
                            $userShare = (new User)->find($share['user_id']);
                        ?>
        <div class="col-sm-1">
            <a href="user-me?id=<?= $userShare['id'] ?>"> <img class="rounded-circle img" style="border-radius:50%"
                    src="./upload/<?= $userShare['image'] ?> " width="50" height="50" alt=""></a>
        </div>
        <div class="row col-sm-10">
            <h2 style="display:inline" class="title"><?= $userShare['name'] ?></h2>
            <small><?= timeAgo($share['created_at'] ?? '') ?></small>
        </div>
        <div>
            <p style="overflow-wrap: break-word;" class="card-text text_content"><?= $share['content'] ?></p>
            <?php if ($share['user_id'] == $_SESSION['member']['id']) { ?>
            <form class="form_edit edit_form_<?= $share['id'] ?>" style="display:none">
                <input type="hidden" class="id_edit_hidden" name="" value="<?= $share['id'] ?>">
                <input type="text" class="form-control input_edit_<?= $share['id'] ?>" name=""
                    value="<?= $value['content'] ?>">
                <br>
            </form>
            <?php } ?>
            <?php if ($share['image']) {
                                    $arrValue = explode(',', $share['image']);
                                    if (count($arrValue) == 1) {
                                ?>
            <img src="./upload/<?= $share['image'] ?>" width="100%" alt="">
            <?php   } else { ?>
            <div style="height:400px; overflow:auto">
                <?php foreach ($arrValue as  $valx) {     ?>
                <img width="100%" height="400" src="./upload/<?= $valx ?>" />

                <?php    } ?>
            </div>
        </div>
        <?php }
                                }; ?><?php
                                    }

                                        ?>
        <!-- New -->
        <?php if ($value['user_id'] == $_SESSION['member']['id']) { ?>
        <form class="form_edit edit_form_<?= $value['id'] ?>" style="display:none">
            <input type="hidden" class="id_edit_hidden" name="" value="<?= $value['id'] ?>">
            <input type="text" class="form-control input_edit_<?= $value['id'] ?>" name=""
                value="<?= $value['content'] ?>">
            <br>
        </form>
        <?php } ?>
        <?php if ($value['image']) {
                                $arrValue = explode(',', $value['image']);
                                if (count($arrValue) == 1) {
                            ?>
        <sl-image-comparer>
            <img width="100%" slot="before" src="./upload/<?= $value['image'] ?>">
            <img width="100%" slot="after" src="./upload/<?= $value['image'] ?>">
        </sl-image-comparer>

        <?php   } else { ?>
        <div style="height:400px; overflow:auto">
            <?php foreach ($arrValue as  $valx) {     ?>

            <img width="100%" height="400" src="./upload/<?= $valx ?>" />

            <?php    } ?>
        </div>
        <?php }
                            }; ?>
        <div class="row">
            <form style="position:relative" class="form col-sm-11 form_hover">
                <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                    class="clickBtn hoverTym" data-hidden="<?= $value['like_status'] ?>" data-id="<?= $value['id'] ?>">
                    <?php
                                        $detailLike = explode(',', $value['detail_like']);
                                        $checkDetail = 0;
                                        foreach ($detailLike as $val) {
                                            $detailLike_List = explode('-', $val);
                                            if ($_SESSION['member']['id'] == reset($detailLike_List)) {
                                                $checkDetail = end($detailLike_List);
                                            }
                                        }
                                        if ($checkDetail == 0) { ?>
                    <div style="width:30px;height:30px">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="heart"
                            class="svg-inline--fa fa-heart fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path fill="<?php
                                                                echo 'currentColor'; ?>"
                                d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z">
                            </path>
                        </svg>
                    </div>
                    <?php } elseif ($checkDetail == 1) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class="  like_btn " data-like_status="1" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifLike.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 2) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" haha_btn  " data-like_status="2" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHaha.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 3) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" love_btn  " data-like_status="3" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifThuongthuong.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 4) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" sad_btn  " data-like_status="4" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHuhu.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php } elseif ($checkDetail == 5) { ?>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" angry_btn  " data-like_status="5" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifGian.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <?php    }
                                        ?>


                </button>

                <div class="btn-group dropend">
                    <button type="button" class="btn   dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <small><?php $count = explode(",", $value['count_like']);
                                                    unset($count[0]);
                                                    echo count($count) ?></small>
                    </button>

                    <ul style="z-index:10000 ; width:300px" class="dropdown-menu">

                        <?php
                                            $detail_like_count = explode(',', $value['detail_like']);
                                            foreach ($detail_like_count as $val) {
                                                if ($val == 0) {
                                                    continue;
                                                }
                                                $detail_like_c = explode('-', $val);
                                            ?>
                        <li><a class="dropdown-item"
                                href="http://localhost/laravel-app/facebook/user-me?id=<?= reset($detail_like_c) ?>">
                                <?php $u = (new User)->find(reset($detail_like_c)); ?> <img
                                    src="./upload/<?= $u['image'] ?>" width="30" height="30" alt="">
                                <?php unset($u['password']);
                                                                                                                                                                                                                                                                                                echo $u['name'];
                                                                                                                                                                                                                                                                                                if (end($detail_like_c) == 1) {
                                                                                                                                                                                                                                                                                                    echo ' đã     LIKE <sl-icon name="hand-thumbs-up-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                } elseif (end($detail_like_c) == 2) {
                                                                                                                                                                                                                                                                                                    echo ' đã     HAHA <sl-icon name="emoji-laughing"></sl-icon>';
                                                                                                                                                                                                                                                                                                } elseif (end($detail_like_c) == 3) {
                                                                                                                                                                                                                                                                                                    echo ' đã     YÊU THÍCH <sl-icon name="heart-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                } elseif (end($detail_like_c) == 4) {
                                                                                                                                                                                                                                                                                                    echo ' đã     KHÓC <sl-icon name="emoji-frown-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                } elseif (end($detail_like_c) == 5) {
                                                                                                                                                                                                                                                                                                    echo ' đã     PHẪN NỘ  <sl-icon name="emoji-angry-fill"></sl-icon>';
                                                                                                                                                                                                                                                                                                }

                                                                                                                                                                                                                                                                                                ?></a>
                        </li>
                        <?php }
                                            ?>
                    </ul>
                </div>
                <div class="tym">
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class="  like_btn " data-like_status="1" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifLike.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" haha_btn  " data-like_status="2" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHaha.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" love_btn  " data-like_status="3" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifThuongthuong.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" sad_btn  " data-like_status="4" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifHuhu.gif" width="50px" height="50px" alt="SEO">
                    </button>
                    <button style="border:none;background-color:transparent;  outline:none;" type="button" for="like"
                        class=" angry_btn  " data-like_status="5" data-hidden="<?= $value['like_status'] ?>"
                        data-id="<?= $value['id'] ?>">
                        <img src="./upload/gifGian.gif" width="50px" height="50px" alt="SEO">
                    </button>
                </div>
            </form>
            <!-- <div class="col-sm-1" style="width:50px;float:right">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="share-alt-square" class="svg-inline--fa fa-share-alt-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor" d="M448 80v352c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V80c0-26.51 21.49-48 48-48h352c26.51 0 48 21.49 48 48zM304 296c-14.562 0-27.823 5.561-37.783 14.671l-67.958-40.775a56.339 56.339 0 0 0 0-27.793l67.958-40.775C276.177 210.439 289.438 216 304 216c30.928 0 56-25.072 56-56s-25.072-56-56-56-56 25.072-56 56c0 4.797.605 9.453 1.74 13.897l-67.958 40.775C171.823 205.561 158.562 200 144 200c-30.928 0-56 25.072-56 56s25.072 56 56 56c14.562 0 27.823-5.561 37.783-14.671l67.958 40.775a56.088 56.088 0 0 0-1.74 13.897c0 30.928 25.072 56 56 56s56-25.072 56-56C360 321.072 334.928 296 304 296z"></path>
                            </svg>
                        </div> -->
        </div>
    </div>
    <button style="border:none ; background:transparent;outline:none;    margin-left: 20px;" class="coment"
        data-id="<?= $value['id'] ?>">Xem binh luan</button>
    <br>
    <div style="display:none;" id="showcmt" class="showComent_<?= $value['id'] ?> border px-3">

    </div>
    <p></p>
</div>
</div>
<?php }}
        }; ?>
<?php
    }
    public function check_ajax()
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $check = (new Post)->find($_POST['id']);
        $count_like = $check['count_like'];
        $count_like_arr = $check['count_like'];
        $arr = explode(',', $count_like_arr);
        $now = date('Y-m-d H:i:s');
        if ($_SESSION['member']['id'] != $check['user_id']) {
            if ($check['coment_id'] == 0) {
                $content_thongbao = $_SESSION['member']['name'] . " đã thích bài viết của bạn ";
            } else {
                $content_thongbao = $_SESSION['member']['name'] . " đã thích bình luận của bạn ";
            }
            unset($checkUser['password']);
            (new thongbao)->create([
                'user_id' => ($check['user_id']),
                'user_rep' => ($_SESSION['member']['id']),
                'content_thongbao' => $content_thongbao,
                'id_post' => $_POST['id'],
                'status' => 0,
                'image' => ($_SESSION['member']['image']),
                'created_at' => $now,
            ]);
        }
        if (in_array($_SESSION['member']['id'], $arr)) {
            $id = $_SESSION['member']['id'];
            unset($arr[$id]);
        } else {
            array_push($arr, $_SESSION['member']['id']);
        }
        $count = implode(',', $arr);
        (new Post)->update(
            [
                'like_status' => $_POST['i'],
                'count_like' => $count,
            ],
            $_POST['id']
        );
    }
    public function show_iamge()
    {
        return view("Views.images.index");
    }
    public function coment()
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $content = $_POST['coment'];
        $image = $_FILES['image'];
        if (empty($image['name'])) {
            (new Post)->create(
                [
                    'content' => $content,
                    'user_id' => $_SESSION['member']['id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'coment_id' => $_POST['idHidden'],
                ],
            );
        } else {
            $imgName = uniqid() . $image['name'];
            move_uploaded_file($image['tmp_name'], "./upload/" . $imgName);
            (new Post)->create(
                [
                    'content' => $content,
                    'image' => $imgName,
                    'user_id' => $_SESSION['member']['id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'coment_id' => $_POST['idHidden'],
                ]
            );
        }
        return  redirect('http://localhost/laravel-app/facebook/');
    }
    public function create()
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $content = nl2br($_POST['content']);
        $image = $_FILES['image'];
        // echo '<pre>';
        // foreach ($image['name'] as $key => $value) { 
        // }  
        if (empty($content)) {
            return  redirect('http://localhost/laravel-app/facebook/');
        }
        if (empty($image['name'])) {
            (new Post)->create(
                [
                    'gruop' => $_POST['id_gruop'] ?? null,
                    'content' => $content,
                    'user_id' => $_SESSION['member']['id'],
                    'created_at' => date('Y-m-d H:i:s'),
                ],
            );
        } else {
            $imgNamePus = '';
            foreach ($image['name'] as $key => $value) {
                $newValue = explode('.', $value);
                $imgName = uniqid() . "." . end($newValue);
                move_uploaded_file($image['tmp_name'][$key], "./upload/" . $imgName);
                $imgNamePus .= $imgName . ",";
                // echo $value;
                // echo $image['tmp_name'][$key];
            }
            $imgNamePus = rtrim($imgNamePus, ",");
            // $imgName = uniqid() . $image['name'];
            (new Post)->create(
                [
                    'gruop' => $_POST['id_gruop'] ?? null,
                    'content' => $content,
                    'image' => $imgNamePus,
                    'user_id' => $_SESSION['member']['id'],
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
        }
        return  redirect('http://localhost/laravel-app/facebook/');
    }
    public function show_post($id)
    {
        $friends = (new Friends)->find($_SESSION['member']['id']);
        $list_freind  = explode(',', $friends['list_frend']);
        $array = (new Post)->where('coment_id', 0);
        $arrayComent = (new Post)->all();
        $array2 = (new User)->all();
        $online = (new Online)->all();
        $suport_2 = (new User)->find($_SESSION['member']['id'] ?? 0);
        unset($suport_2['password']);
        $suport_3 = (new thongbao)->where('user_id', $_SESSION['member']['id'] ?? 0);
        $count = 0;
        foreach ($suport_3 as $value) {
            if ($value['status'] == 0) {
                $count = $count + 1;
            }
        }
        // $checkFr = (new User)->find($_SESSION['member']['id']);
        // unset($checkFr);
        $arrList = explode(',', $suport_2['delay_friend']);
        $countFr = 0;
        foreach ($arrList as $val) {
            if (!empty($val)) {
                $countFr = $countFr + 1;
            }
        }
        // $countFr = count($arrList);
        // $suport_4 = (new Friends)->find($_SESSION['member']['id']);
        // $lisrtFriend = explode(',', $suport_4['list_frend']);
        // foreach ($lisrtFriend as $val){

        // };
        unset($array2['password']);
        return view('Views.post.showPost', $array, $id, $array2,  $suport_2, $online, $list_freind);
    }
    public function index()
    {
        
        $model = (new Gruop)->all();
        $arr = [];
        foreach ($model as $val) {
            $list = explode(',', $val['member']);
            foreach ($list as $avx) {
                $ogt = explode('-', $avx);
                // echo reset($ogt);
                if (reset($ogt) == $_SESSION['member']['id']) {
                    array_push($arr, $val);
                }
            }
        }
        $friends = (new Friends)->find($_SESSION['member']['id']);
        $list_freind  = explode(',', $friends['list_frend']);
        $array = (new Post)->where('coment_id', 0);
        $arrayComent = (new Post)->all();
        $array2 = (new User)->all();
        $online = (new Online)->all();
        $suport_2 = (new User)->find($_SESSION['member']['id'] ?? 0);
        unset($suport_2['password']);
        $suport_3 = (new thongbao)->where('user_id', $_SESSION['member']['id'] ?? 0);
        $count = 0;
        foreach ($suport_3 as $value) {
            if ($value['status'] == 0) {
                $count = $count + 1;
            }
        }
        // $checkFr = (new User)->find($_SESSION['member']['id']);
        // unset($checkFr);
        $arrList = explode(',', $suport_2['delay_friend']);
        $countFr = 0;
        foreach ($arrList as $val) {
            if (!empty($val)) {
                $countFr = $countFr + 1;
            }
        }
        // $countFr = count($arrList);
        // $suport_4 = (new Friends)->find($_SESSION['member']['id']);
        // $lisrtFriend = explode(',', $suport_4['list_frend']);
        // foreach ($lisrtFriend as $val){

        // };
        unset($array2['password']);
        $date = date('Y-m-d H:i:s');
        $newdate = strtotime ( '+24 day' , strtotime ( $date ) ) ; 
        $storys = (new Story)->all();
        // $storys = (new Story)->whereAndWhere(0 , ['created_at <' =>  date('y-m-d h:i:s' , strtotime ( '-1 day' , strtotime ( $date ) ))] );
        $storysNew = [];
        foreach ($storys as $val){
            if(date('y-m-d h:i:s' ,   strtotime($val['created_at']  )) > date('y-m-d h:i:s' , strtotime ( '-1 day' , strtotime ( $date ) )) ){
               array_push($storysNew , $val);
            }
        } 
        return view('Views.index', $array, $arrayComent, $array2,  $suport_2, $online, $list_freind, 
        ['gruop' => $arr , 'storys' => $storysNew]);
    }
    public function login()
    {

        return view('Views.login');
    }
    public function logki()
    {
        return view('Views.logki');
    }
    public function checkLogki()
    {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $passwordReset = $_POST['passwordReset'];
        $errors = errors([
            'email.required' => $email,
            'name.required' => $name,
            'password.required' => $password,
            'passwordReset.required' => $passwordReset,
        ]);
        if (!empty($errors)) {
            return view('Views.logki', [], $errors);
        } else {
            if ($password != $passwordReset) {
                $error =  ["Mật khẩu không trùng khớp "];
                return view('Views.logki', [], $error);
            } elseif ((new User)->whereOne('email', $email)) {
                $error =  ["Email đã tồn tại "];
                return view('Views.logki', [], $error);
            } else {
                $mhPass = password_hash($password, PASSWORD_DEFAULT);
                (new User)->create([
                    'name' => $name,
                    'email' => $email,
                    'password' => $mhPass,
                ]);
                return view('Views.login');
            }
        }
    }
    public function logout()
    {
        unset($_SESSION['member']);
        return redirect('http://localhost/laravel-app/facebook/');
    }
    public function checklogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $checkEmail = (new User)->whereOne('email', $email);
        if ($checkEmail && password_verify($password, $checkEmail['password'])) {
            if ((new Friends)->find($checkEmail['id'])) {
            } else {
                (new Friends)->create([
                    'id' => $checkEmail['id'],
                ]);
            }
            unset($checkEmail['password']);
            $_SESSION['member'] = $checkEmail;
            return redirect('http://localhost/laravel-app/facebook/');
        } else {
            $errors = ["Sai tai khoan mat khau !"];
            return view('Views.login', [], $errors);
        }
    }
}