<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <!-- https://cdnjs.com/libraries/twitter-bootstrap/5.0.0-beta1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

  <!-- Icons: https://getbootstrap.com/docs/5.0/extend/icons/ -->
  <!-- https://cdnjs.com/libraries/font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
    $(document).ready(function() {
      $("#show_tym").draggable();
    })
  </script>
  <title>Facebook</title>
  <style>
    .banner {
      width: 100%;
      height: 210px;
    }

    body {
      background-color: #fff;
    }

    .avatar {
      position: absolute;
      left: 50%;
      top: -100px;
      z-index: 2;
      transform: translateX(-50%);
      width: 200px;
      height: 200px
    }

    .avatar-2 {
      width: 200px;
      height: 200px
    }

    .avatar img {
      border:4px solid #1472ff ;
      border-radius: 50%;
    }

    .label {
      position: absolute;
      position: absolute;
      left: 50%;
      top: 80px;
      opacity: 0;
      z-index: 2;
      transform: translateX(-50%);
    }

    .avatar:hover .label {
      opacity: 1;
      transition: all .9s;
    }
  </style>
    <style>
     * {
       margin: 0;
       padding: 0;
       box-sizing: border-box;
     }

     body {
       background: #ccc;
     }

     .post {
       top: 10%;
       right: 2%;
       position: fixed;
       overflow: auto;
       background-color: #fff;
       max-width: 350px;
       height: 500px;
       display: none;
     }

     #show_tym {
       position: fixed;
       z-index: 2;
       width: 50px;
       height: 50px;
       top: 9%;
       right: 1%;
       border: none;
       background: transparent;
       outline: none;
       transition: all .7s;
     }

     ::-webkit-scrollbar {
       display: none;
     }

     #show_tym:hover {
       width: 70px;
       height: 70px;
     }

     .body {
       width: 800px;
       margin: 0 auto;
       display: flex;
       flex-direction: column;
       justify-content: space-between;
       background-color: #fff;
     }

     @media (max-width: 768px) {
       .row {
         margin-top: 100px;
       }

       #show_tym {
         z-index: 99;
         right: 7%
       }
     }
     .tym{ 
       display: none;
       z-index: 1000;
       overflow: hidden;
       transition:all .4s;
      position:absolute;height:50px;background:white;top:-50px;left:-5px;padding:5px ; border-radius:20px
     }
     .form_hover:hover .tym{ 
       display: block;
       transition:all .4s;
     }
   </style>
  <title>User</title>
</head>

<body class="">
  <div style="background:#fff;width:100%; position:fixed ; z-index:3" class=" header  mb-3 border-bottom">
    <div class="container bg-light">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
            <use xlink:href="#bootstrap" />
          </svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="http://localhost/laravel-app/facebook/" class="nav-link px-2 link-secondary">Home</a></li>
          <li><a href="chat-box" class="nav-link px-2 link-dark">Chát</a></li>
          <li><a href="show-image" class="nav-link px-2 link-dark">Ảnh</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">Tin tức</a></li>
        </ul>
        <!-- <button style="width:45px ;height:45px; border-radius:50%;background:#ccc" class="btn position-relative click_thongbao" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" class="svg-inline--fa fa-bell fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <path fill="currentColor" d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"></path>
          </svg>
          <div class="show_thongbao">
          </div>
        </button> -->
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <!-- <input type="search" class="form-control" placeholder="Search..." aria-label="Search"> -->
        </form>
        <div class="dropdown text-end">
          <?php if (!empty($_SESSION['member']['name'])) { ?>
            <a href="#" class="d-block link-dark 
             text-decoration-none dropdown-toggle  " id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="./upload/<?= $_SESSION['member']['image'] ?>" alt="mdo" width="32" height="32" class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
              <li><a class="dropdown-item" href="wall-me">Quản lí tài khoản</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="user-me">Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="  alert-success dropdown-item" href="logout">Sign out</a></li>
            </ul>
          <?php } else { ?>
            <a class="  alert-success btn" href="login">Login</a>
          <?php }; ?>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="banner">
    <img src="data:image/jpeg;base64,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" width="100%" height="100%" alt="">
  </div>
  <div style="position: relative">
    <div class="avatar">
      <div id="showImg" class="avatar-2">
        <img src="./upload/<?= $array['image'] ?>" width="100%" height="100%" alt="">
      </div>
      <h1 class="text-center"><?= $array['name'] ?>
      <br></h1>
      
      <form class="form_avatar" enctype="multipart/form-data">
        <input style="display:none" type="file" id="file_avatar" name="image" value="">
        <label class="label" style="width:40px" for="file_avatar">
          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
          </svg></label>
      </form>
    </div>
  </div>
  <div style="margin-top:180px" class="container">
 
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
         data-bs-target="#home" type="button" role="tab" aria-controls="home"
          aria-selected="true">Giới thiệu</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
         data-bs-target="#profile" type="button" role="tab" aria-controls="profile" 
         aria-selected="false">Ảnh</button>
      </li>
      <!-- <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
         data-bs-target="#post" type="button" role="tab" aria-controls="contact" 
         aria-selected="false">Bài viết</button>
      </li> -->
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" 
        data-bs-target="#contact" type="button" role="tab" aria-controls="contact" 
        aria-selected="false">Bạn bè</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" 
        data-bs-target="#view" type="button" role="tab" aria-controls="contact"
         aria-selected="false">Xem thêm</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


        <div class="row">
          <div class="col-sm-6 py-1">
            <div class="text-center py-1">
              <?php 
              $list = explode(",",$support['list_frend']);
              $flag = true ;
              foreach($list as $value) { 
                if($value == $array['id']){ 
                  $flag = false ;
                 }
              }
              if($array['id'] == $_SESSION['member']['id']){ }else{
              if($flag == true){ ?>
              
            
                <?php
                  $flagList = true;
                  $arrList = explode(',', $array['delay_friend']);
                  foreach ($arrList as $val){ 
                    if($val == $_SESSION['member']['id']){
                      $flagList = false;
                    } 
                  } 
                  if($flagList == true){ ?>
                    <button type="button" data-id="<?= $array['id'] ?>" class="click-fiend btn btn-outline-info">Kết bạn</button>
                  <?php }else{ ?>
                    <div class="bg-light py-1">
                    <span class="text-primary">Đã gửi lời mời kết bạn</span><button 
                    type="button" data-id="<?= $array['id'] ?>"
                    class="click-unfiend btn btn-outline-danger">Hủy</button>
                  </div>
                 <?php }
                 ?>
             <?php  }else{  ?>
              <button type="button" class="btn btn-outline-success">Bạn bè</button>
            <?php  }}
              ?>
            </div>
            <h3 class="alert alert-light text-center">Tiểu sử
            </h3> 
            <div class="text-center">
              <p class="detail"><?= $errors['detail'] ?? '' ?>      <?php  if($array['id'] == $_SESSION['member']['id']){?> <button class="click_detail" type="" style="width:40px;border:none;background:none"> 
              <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="edit" class="svg-inline--fa fa-edit fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path>
              </svg>
            </button>    <?php  }   ?></p>
              <form class="form_detail" style="display: none">
                <textarea class="textarea form-control" rows="" cols=""><?= $errors['detail']??'' ?> </textarea>
              </form>
            </div>
            <div>
                    <ol class="list-group list-group-numbered">
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold">Năm sinh</div>
                          <p class="data"><?= $errors['date']??'Chưa thiết lập' ?></p>
                          <form style="display:none" class="form-show-content">
                            <input class="form-control date" type="date" name=""   value="<?= $errors['date']??'' ?>">
                          </form>
                        </div>
                        <?php  if($array['id'] == $_SESSION['member']['id']){?> 
                          <span class=" click-hidden  badge bg-primary rounded-pill">edit</span>
                        <?php  }   ?>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold">Quên quán</div>
                          <!-- Form -->
                          <p class="data2"><?= $errors['address']??'Chưa thiết lập' ?></p>
                          <form style="display:none" class="form-show-content2">
                            <input class="form-control address" type="text"  name="" value="<?=$errors['address']??''  ?>">
                          </form>
                          </div>
                               <?php  if($array['id'] == $_SESSION['member']['id']){?> 
                          <span class=" click-hidden2 badge bg-primary rounded-pill">edit</span>
                              <?php  }   ?>
                        <!--  -->
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold">Nghề nghiệp</div>
                          <p class="data3"><?= $errors['cv']??'Chưa thiết lập' ?></p>
                          <form style="display:none" class="form-show-content3">
                            <input class="form-control cv" type="text" name="text" value="<?=$errors['cv']??''  ?>">
                          </form>
                        </div>
                             <?php  if($array['id'] == $_SESSION['member']['id']){?> 
                        <span class=" click-hidden3 badge bg-primary rounded-pill">edit</span>
                            <?php  }   ?>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                          <div class="fw-bold">Giới tính</div>
                          <p class="data4"><?php if(isset($errors['sex'])){
                            if($errors['sex'] == '1'){
                              echo 'Nam';
                            }else{
                              echo 'Nữ';
                            }
                          }else{
                            echo  'Chưa thiết lập';
                          } ?></p>
                          <form style="display:none" class="form-show-content4">
                            <select class="sex form-control" >
                              <option >Chọn giới tính</option>
                              <option  <?php if(($errors['sex'] ?? 1) == 1){echo 'selected';} ?> value="1">Nam</option>
                              <option  <?php if(($errors['sex'] ?? 1) == 0){echo 'selected';} ?> value="0">Nu</option>
                            </select>
                          </form>
                        </div>
                             <?php  if($array['id'] == $_SESSION['member']['id']){?> 
                        <span class=" click-hidden4 badge bg-primary rounded-pill">edit</span>
                            <?php  }   ?>
                      </li>
                    </ol>
            </div>
            <div class="row my-2 border">
              <h5 class="text-center alert-light alert">List ảnh</h5>
                      <?php
                        $arrImg = explode(",", $errors['imageOld'] ?? '');
                        foreach ($arrImg as $img) {
                        ?>
                         <div class="col-sm-3">
                          <img width="100%" src="./upload/<?= $img ?>" alt="">
                          </div> 
                        <?php
                        }
                        ?>  
            </div>
          </div>
          <div class="col-sm-6">
          <div id="showhh" class="container my-3">
         </div>
          </div>
        </div>


      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


        <?php
        $arrImg = explode(",", $errors['imageOld']);
        foreach ($arrImg as $img) {
        ?>
          <img src="./upload/<?= $img ?>" alt="">
        <?php
        }
        ?>


      </div>
      <!-- <div class="tab-pane fade" id="post" role="tabpanel" aria-labelledby="profile-tab">Bài viết</div> -->
      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">Bạn bè</div>
      <div class="tab-pane fade" id="view" role="tabpanel" aria-labelledby="contact-tab">Xem thêm</div>
    </div>



  </div>
  <!-- Optional JavaScript; choose one of the two! -->

        <input type="hidden" name="" class="id-truyen" value="<?= $array['id'] ?>">

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script> -->
    
  <script>
    $(document).ready(function() {

      $('.click-unfiend').on('click',function(){
        var id = $(this).data('id'); 
        $.ajax({
           url:('load_kp_unfriends'),
           method: 'POST',
           data:{id:id},
           success: function(data){
            //  alert(data)
             location.reload();
           }
         })
      })
      $('.click-fiend').on('click', function(){
        var id = $(this).data('id');
        $.ajax({
           url:('load_kp_friends'),
           method: 'POST',
           data:{id:id},
           success: function(data){
            //  alert(data)
             location.reload();
           }
         })
      })
      $('.form-show-content').on('change',function(){ 
        var date = $('.date').val();  
         $.ajax({
           url:('load_content_contact'),
           method: 'POST',
           data:{date:date},
           success: function(){
             location.reload();
           }
         })
      })
      $('.form-show-content2').on('change',function(){ 
        var address = $('.address').val();  
         $.ajax({
           url:('load_content_contact'),
           method: 'POST',
           data:{address:address},
           success: function(){
             location.reload();
           }
         })
      })
      $('.form-show-content3').on('change',function(){ 
        var cv = $('.cv').val();  
         $.ajax({
           url:('load_content_contact'),
           method: 'POST',
           data:{cv:cv},
           success: function(){
             location.reload();
           }
         })
      })
      $('.form-show-content4').on('change',function(){ 
        var sex = $('.sex').val();  
        $.ajax({
          url:('load_content_contact'),
          method: 'POST',
          data:{sex:sex},
          success: function(){ 
             location.reload();
           }
         })
      })
      $('.click-hidden').on('click', function(){
        $(this).hide(120);
        $('.data').hide(122);
        $('.form-show-content').show(120);
      })
      $('.click-hidden2').on('click', function(){
        $(this).hide(120);
        $('.data2').hide(122);
        $('.form-show-content2').show(120);
      })
      $('.click-hidden3').on('click', function(){
        $(this).hide(120);
        $('.data3').hide(122);
        $('.form-show-content3').show(120);
      })
      $('.click-hidden4').on('click', function(){
        $(this).hide(120);
        $('.data4').hide(122);
        $('.form-show-content4').show(120);
      })
      $('.form_detail').on('change',function(){ 
        var value = $('textarea').val(); 
         $.ajax({
           url:('load_detail_contact'),
           method: 'POST',
           data:{value:value},
           success: function(){
             location.reload();
           }
         })
      })
      $('.click_detail').on('click', function() { 
        $('.detail').hide(100);
        $('.form_detail').show(200);
      })
      $('.form_avatar').on('change', function() {
        $.ajax({
          url: ('loadAvatar'),
          method: 'POST',
          data: new FormData(this),
          contentType: false,
          processData: false,
          success: function(data) {
            location.reload();
          }
        })
      })
    })
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
  <script>
    function del(id) {
      var data = JSON.parse(localStorage.getItem('post'));
      for (let index = 0; index < data.length; index++) {
        if (id == data[index].id) {
          newData = data.splice(index, 1);
        }
      }
      localStorage.setItem('post', JSON.stringify(data));
    }
    view()

    function view() {
      var data = JSON.parse(localStorage.getItem('post'));
      document.getElementById('showPost').style.padding = '10px';
      for (let index = 0; index < data.length; index++) {
        $('#showPost').append('<div class="col-sm-2"> <img width="100%" src="./upload/' + data[index].avatar + '"></div><div class="col-sm-10"><h5>' + data[index].name + '</h5> <p> ' + data[index].content + '</p></div> <img width="100%" src="./upload/' + data[index].image + '"> <p></p><hr>');
      }
    }

    function add_post(id) {
      var content = document.getElementById('save_content_' + id).value;
      var name = document.getElementById('save_name_' + id).value;
      var image = document.getElementById('save_image_' + id).value;
      var avatar = document.getElementById('save_avatar_' + id).value;
      var arr = {
        'name': name,
        'id': id,
        'content': content,
        'avatar': avatar,
        'image': image,
      }
      if (localStorage.getItem('post') == null) {
        localStorage.setItem('post', '[]');
      }
      var value_old = JSON.parse(localStorage.getItem('post'));

      var check = $.grep(value_old, function(value_of_old) {
        return value_of_old.id == id;
      })
      if (check.length) {
        alert('Mục lưu trữ đã tồn tại bài viết này rồi');
      } else {
        alert('Bạn đã lưu thành công');
        $('#showPost').append('<div class="col-sm-2"> <img width="100%" src="./upload/' + arr.avatar + '"></div><div class="col-sm-10"><h5>' + arr.name + '</h5> <p> ' + arr.content + '</p></div> <img width="100%" src="./upload/' + arr.image + '">  <p></p><hr>');
        value_old.push(arr);
        localStorage.setItem('post', JSON.stringify(value_old));
      }

    }
  </script>
  <script>
    $(document).ready(function() {
      $(document).on('click','.like_btn' , function(e) {
           var id = $(this).data('id');   
           var data = $(this).data('like_status');
           $.ajax({
              url: ('update_like_status'),
              method: 'POST',
              data: {
                data: data, 
                id:id,
              }, 
              success: function(data){ 
                console.log(data);
                  // window.location.reload(); 
                // $('.showform_'+id).html(data);
                 like();
              }
            }) 
         })
         $(document).on('click','.haha_btn' , function(e) {
           var id = $(this).data('id');   
           var data = $(this).data('like_status');
           $.ajax({
              url: ('update_like_status'),
              method: 'POST',
              data: {
                data: data, 
                id:id,
              }, 
              success: function(data){ 
                console.log(data);
                  // window.location.reload(); 
                // $('.showform_'+id).html(data);
                 like();
              }
            }) 
         })
         $(document).on('click','.love_btn' , function(e) {
           var id = $(this).data('id');   
           var data = $(this).data('like_status');
           $.ajax({
              url: ('update_like_status'),
              method: 'POST',
              data: {
                data: data, 
                id:id,
              }, 
              success: function(data){ 
                console.log(data);
                  // window.location.reload(); 
                // $('.showform_'+id).html(data);
                 like();
              }
            }) 
         })
         $(document).on('click','.sad_btn' , function(e) {
           var id = $(this).data('id');   
           var data = $(this).data('like_status');
           $.ajax({
              url: ('update_like_status'),
              method: 'POST',
              data: {
                data: data, 
                id:id,
              }, 
              success: function(data){ 
                console.log(data);
                  // window.location.reload(); 
                // $('.showform_'+id).html(data);
                 like();
              }
            }) 
         })
         $(document).on('click','.angry_btn' , function(e) {
           var id = $(this).data('id');   
           var data = $(this).data('like_status');
           $.ajax({
              url: ('update_like_status'),
              method: 'POST',
              data: {
                data: data, 
                id:id,
              }, 
              success: function(data){  
                // console.log(data);
                  // window.location.reload(); 
                // $('.showform_'+id).html(data);
                 like();
              }
            }) 
         })
        $(document).on('click','.share_post',function(e){
          var id = $(this).data('id'); 
          
        })
        $(document).on('click','.click_share',function(e){
             var id = $(this).data('id');   
            var data = $('.text_share_'+id).val(); 
            $.ajax({
              url: ('share_post'),
              method: 'POST',
              data: {
                data: data, 
                id:id,
              }, 
              success: function(data){ 
                // console.log(data);
                  window.location.reload(); 
                // $('.showform_'+id).html(data);
              }
            })
          })
      $(document).on('click','.form-check ',function(){
           var id = $(this).data('id');  
           var data = $(this).data('status');   
           $.ajax({
              url: ('load_status'),
              method: 'POST',
              data: {
                data: data, 
                id:id,
              }, 
              success: function(data){ 
                // console.log(data);
                  // window.location.reload(); 
                // $('.showform_'+id).html(data);
              }
            })
         }) 
        $(document).on('click' , '.edit_post' , function(){
          var id = $(this).data('id');
          $('.text_content').hide(50);
          $('.edit_form_'+id).show(50); 
          $('#exampleModal_'+id).hide(50);
          $('.modal-backdrop').hide(50);
          $(document).on('change','.form_edit',function(e) {
           var data = $('.input_edit_'+id).val(); 
            
           $.ajax({
             url: ('load_edit'),
             method: 'POST',
             data: {
               data: data, 
               id:id,
             }, 
             success: function(data){ 
                window.location.reload(); 
              // $('.showform_'+id).html(data);
             }
          })
         })
        })
      $(document).on('click', '.showformclick', function(e) {
        var id = $(this).data('id_post');
        $('.showform_' + id).toggle(1000);
        $.ajax({
          url: ('cmt_load_rep'),
          method: 'POST',
          data: {
            id: id,
          },
          success: function(data) {
            $('.showform_' + id).html(data);
          }
        })
      })

      thongbao()

      function thongbao() {
        $.ajax({
          url: ('thongbao'),
          method: 'POST',
          success: function(data) {
            $('.thongbao').html(data);
            thongbao()
          }
        })
      }
      show_thongbao()

      function show_thongbao() {
        $.ajax({
          url: ('show_thongbao'),
          method: 'POST',
          success: function(data) {
            $('.show_thongbao').html(data);
            show_thongbao()
          }
        })
      }
      $('.click_thongbao').on('click', function() {
        $.ajax({
          url: ('loadThongBao'),
          method: 'POST',
          success: function() {}
        })
      })


      $('#show_tym').click(function() {
        $('.post').toggle(1000)
      })
      $(document).on('change', '.form', function() {
        $.ajax({
          url: ('loadImg'),
          method: 'POST',
          data: new FormData(this),
          contentType: false,
          processData: false,
          success: function(data) {
            $('.showImg').html(data);
          }
        })
      })
      $(document).on('click', '.cmt-rep-click', function() {
        var img = $('.imhHidden').val();
        var id_post = $(this).data('id');
        var id_user = $('.id_user').val();
        var comentLoad = $('.comentLoad_' + id_post).val();
        $.ajax({
          url: ('loadCmt'),
          method: 'POST',
          data: {
            img: img,
            id_post: id_post,
            id_user: id_user,
            comentLoad: comentLoad
          },
          success: function(data) {
            showFOrm(id_post)
          }
        })
      })

      function showFOrm(id) {
        $.ajax({
          url: ('cmt_load_rep'),
          method: 'POST',
          data: {
            id: id,
          },
          success: function(data) {
            $('.showform_' + id).html(data);
          }
        })
      }
      $(document).on('click', '.cmt-click', function() {
        var img = $('.imhHidden').val();
        var id_post = $(this).data('id');
        var id_user = $('.id_user').val();
        var comentLoad = $('.comentLoad_' + id_post).val();
        $.ajax({
          url: ('loadCmt'),
          method: 'POST',
          data: {
            img: img,
            id_post: id_post,
            id_user: id_user,
            comentLoad: comentLoad
          },
          success: function(data) {
            cmt(id_post)
          }
        })
      })
      $(document).on('click', '.coment', function() {
        var id = $(this).data('id');
        $('.showComent_' + id).toggle(1000);
        $.ajax({
          url: 'show-cmt',
          method: 'POST',
          data: {
            id: id
          },
          success: function(data) {
            $('.showComent_' + id).html(data);
            cmt(id)
          }
        })
      })

      function cmt(id) {
        $.ajax({
          url: 'show-cmt',
          method: 'POST',
          data: {
            id: id
          },
          success: function(data) {
            $('.showComent_' + id).html(data);
          }
        })
      }

      function like() {
        var id = $('.id-truyen').val();
        $.ajax({
          url: 'show_wall',
          method: 'POST',
          data:{id:id},
          success: function(data) {
            $('#showhh').html(data);
          }
        })
      }
      like();
      $(document).on('click', '.clickBtn', function() {
        var id = $(this).data('id');
        var valHidden = $(this).data('hidden');
        if (valHidden == 1) {
          var i = 0;
          $.ajax({
            url: 'check-ajax',
            method: 'POST',
            data: {
              i: i,
              id: id
            },
            success: function() {
              like();
            }
          })
        } else {
          var i = 1;
          $.ajax({
            url: 'check-ajax',
            method: 'POST',
            data: {
              i: i,
              id: id
            },
            success: function(data) {
              like();
            }
          })
        }
      })

    })
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./dist/kursor.css">
  <script src="./dist/kursor.js"></script>
  <!-- or from a CDN -->
  <script src="//unpkg.com/kursor"></script>
  <script src="./cursor-dot/index.js"></script>
  <script>
    var kursorx = new kursor({
      type: 3
    })
  </script>
  <script>
    const cursor = cursorDot({
      // options here
      // diameter in pixels
      diameter: 100,

      // border width
      borderWidth: 50,

      // border color
      borderColor: '#fff',

      // easing
      easing: 6,

      // background
      background: 'transparent',

      index: '99',
    })
    cursor.over(". element-1", {
      background: "#ccc"
    });
    cursor.over(".img", {
      scale: 10,
    })
    cursor.over(". element-2", {
      borderColor: "rgba (255,255,255, .38)"
    });

    cursor.over(".element-3", {
      scale: 10,
      background: "red"
    });
  </script>
  <script>
    (function(i, s, o, g, r, a, m) {
      i['GoogleAnalyticsObject'] = r;
      i[r] = i[r] || function() {
        (i[r].q = i[r].q || []).push(arguments)
      }, i[r].l = 1 * new Date();
      a = s.createElement(o),
        m = s.getElementsByTagName(o)[0];
      a.async = 1;
      a.src = g;
      m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
    ga('create', 'UA-46156385-1', 'cssscript.com');
    ga('send', 'pageview');
  </script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->

  <!-- https://cdnjs.com/libraries/popper.js/2.5.4 -->
  <!-- <script
       src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"
     ></script>
     <script
       src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.min.js"
     ></script> -->

  <!-- More: https://getbootstrap.com/docs/5.0/getting-started/introduction/ -->
</body>

</html>