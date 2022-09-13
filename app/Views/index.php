 <!DOCTYPE html>
 <html lang="en">

 <head>
     <!-- Required meta tags -->
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />
     <link rel="icon" type="image/png"
         href="https://cdn.iconscout.com/icon/free/png-256/facebook-logo-2019-1597680-1350125.png" />
     <!-- Bootstrap CSS -->
     <!-- https://cdnjs.com/libraries/twitter-bootstrap/5.0.0-beta1 -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
         integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

     <!-- Icons: https://getbootstrap.com/docs/5.0/extend/icons/ -->
     <!-- https://cdnjs.com/libraries/font-awesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     <link rel="stylesheet" href="./css/lightslider.css" />
     <link rel="stylesheet" href="./css/prettify.css" />
     <link rel="stylesheet" href="./css/lightgallery.min.css" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
         integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
     </script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
         integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
     </script>
     <link rel="stylesheet" media="(prefers-color-scheme:light)"
         href="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.0.0-beta.50/dist/themes/light.css">
     <link rel="stylesheet" media="(prefers-color-scheme:dark)"
         href="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.0.0-beta.50/dist/themes/dark.css"
         onload="document.documentElement.classList.add('sl-theme-dark');">
     <script type="module" src="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.0.0-beta.50/dist/shoelace.js">
     </script>
     <style>
     body {
         background: #1b1d20;
     }

     img {
         max-width: 100%;
         display: block;
     }

     h1 {
         margin-top: 150px;
         text-align: center;
         color: #fff;
     }

     .slide {
         max-width: 380px;
         margin: 20px auto;
         display: grid;
         box-shadow: 0 4px 20px 2px rgba(0, 0, 0, 0.4);
     }

     .slide-items {
         position: relative;
         grid-area: 1/1;
         border-radius: 5px;
         overflow: hidden;
     }

     .slide-nav {
         grid-area: 1/1;
         z-index: 1;
         display: grid;
         grid-template-columns: 1fr 1fr;
         grid-template-rows: auto 1fr;
     }

     .slide-nav button {
         -webkit-appearance: none;
         -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
         opacity: 0;
     }

     .slide-items>* {
         position: absolute;
         top: 0px;
         opacity: 0;
         pointer-events: none;
     }

     .slide-items>.active {
         position: relative;
         opacity: 1;
         pointer-events: initial;
     }

     .slide-thumb {
         display: flex;
         grid-column: 1 / 3;
     }

     .slide-thumb>span {
         flex: 1;
         display: block;
         height: 3px;
         background: rgba(0, 0, 0, 0.4);
         margin: 5px;
         border-radius: 3px;
         overflow: hidden;
     }

     .slide-thumb>span.active::after {
         content: '';
         display: block;
         height: inherit;
         background: rgba(255, 255, 255, 0.9);
         border-radius: 3px;
         transform: translateX(-100%);
         animation: thumb 5s forwards linear;
     }

     @keyframes thumb {
         to {
             transform: initial;
         }
     }
     </style>
     <style>
     #css-script-menu {
         position: absolute;
         height: 90px;
         width: 100%;
         top: 0;
         left: 0;
         border-top: 5px solid #16a1e7;
         background: #fff;
         -moz-box-shadow: 0 2px 3px 0 rgba(0, 0, 0, .16);
         -webkit-box-shadow: 0 2px 3px 0 rgba(0, 0, 0, .16);
         box-shadow: 0 2px 3px 0 rgba(0, 0, 0, .16);
         z-index: 999999;
         padding: 10px 0;
         -webkit-box-sizing: content-box;
         -moz-box-sizing: content-box;
         box-sizing: content-box
     }

     .css-script-center {
         max-width: 960px;
         margin: 0 auto
     }

     .css-script-center ul {
         width: 212px;
         float: left;
         line-height: 45px;
         margin: 0;
         padding: 0;
         list-style: none
     }

     .css-script-center a {
         text-decoration: none
     }

     .css-script-ads {
         max-width: 728px;
         height: 90px;
         float: right
     }

     .css-script-clear {
         clear: both;
         height: 0
     }

     #carbonads {
         font-family: -apple-system, BlinkMacSystemFont, segoe ui, Roboto, Oxygen-Sans, Ubuntu, Cantarell, helvetica neue, Helvetica, Arial, sans-serif
     }

     #carbonads {
         display: block;
         overflow: hidden;
         max-width: 728px;
         position: relative;
         font-size: 22px;
         box-sizing: content-box
     }

     #carbonads>span {
         display: block
     }

     #carbonads a {
         color: #111;
         text-decoration: none
     }

     #carbonads a:hover {
         color: #000
     }

     .carbon-wrap {
         display: flex;
         align-items: center
     }

     .carbon-img {
         display: block;
         margin: 0;
         line-height: 1
     }

     .carbon-img img {
         display: block;
         height: 90px;
         width: auto
     }

     .carbon-text {
         display: block;
         padding: 0 1em;
         line-height: 1.35;
         text-align: left
     }

     .carbon-poweredby {
         display: block;
         position: absolute;
         bottom: 0;
         right: 0;
         padding: 6px 10px;
         text-align: center;
         text-transform: uppercase;
         letter-spacing: .5px;
         font-weight: 600;
         font-size: 8px;
         border-top-left-radius: 4px;
         line-height: 1;
         color: #ccc !important
     }

     @media only screen and (min-width:320px) and (max-width:759px) {
         .carbon-text {
             font-size: 14px
         }
     }
     </style>

     <script>
     $(document).ready(function() {
         $("#show_tym").draggable();
     })
     </script>
     <title>Facebook </title>
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

     .tym {
         display: none;
         z-index: 1000;
         transition: all .4s;
         position: absolute;
         height: 50px;
         background: white;
         top: -50px;
         left: -5px;
         padding: 5px;
         border-radius: 20px
     }

     .tym button:hover .tym,
     .tym button:hover img {
         transition: all .5s;
         transform: scale(1.9);
     }

     .form_hover:hover .tym {
         display: block;
         transition: all .4s;
     }

     .end {
         background: #fff;
         margin: 0 auto;
         width: 100%;
         height: 100%;
         overflow-x: hidden;
         overflow-y: auto;
         transform: rotate(180deg);
         direction: rtl;
         text-align: left;
         padding: 10px
     }

     .ul {
         width: 100%;
         overflow: hidden;
         transform: rotate(180deg);
         padding: 10px;
     }

     .ul2 {
         width: 100%;
         overflow: hidden;
         transform: rotate(180deg);
         padding: 10px;
     }

     .li {
         /* display: inline-block; */
         max-width: 50%;
         word-wrap: break-word;
         gap: 20px;
         list-style: none;
         border-radius: 10px;
         box-shadow: 2px 2px 12px black;
         padding: 5px 10px;
     }

     .li p {
         height: auto;
         /* padding:10px */
     }

     .hd {
         background-color: #cccc;
         /* display: none; */
         /* position: fixed; */
         /* left: 24%; */
         /* width: 75%; */
         width: 350px;
         position: absolute;
         padding: 5px 10px;
         top: 0;
         right: 0;
         box-shadow: 2px 2px 20px #a3a3a3;
         width: 110%;
         left: 0;
         z-index: 100;
         background: white;
     }

     .abc_msg {
         z-index: 1000000;
     }

     @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');
     </style>
 </head>

 <body class="  ">
     <div style="background:#fff;width:100%; position:fixed ; z-index:3" class=" header  mb-3 border-bottom">
         <div class="container bg-light">
             <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                 <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                     <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                         <use xlink:href="#bootstrap" />
                     </svg>
                 </a>

                 <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                     <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
                     <li><a href="chat-box" class="nav-link px-2 link-dark">Chát</a></li>
                     <li><a href="show-image" class="nav-link px-2 link-dark">Ảnh</a></li>
                     <li><a href="#" class="nav-link px-2 link-dark">Tin tức</a></li>
                     <!-- <li>
                         <div class="input-group mb-3">
                             <input type="text" class="form-control" placeholder="Tìm kiếm "
                                 aria-label="Recipient's username" aria-describedby="basic-addon2">
                             <div class="input-group-append">
                                 <button button class="btn btn-outline-secondary" type="button">Tìm kiếm</button>
                             </div>
                         </div>
                     </li> -->
                 </ul>

                 <div class="dropdown">
                     <button style="width:45px ;height:45px; border-radius:50%;background:#ccc;margin:10px"
                         id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
                         class="btn click_msg position-relative " type="button">
                         <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="comments"
                             class="svg-inline--fa fa-comments fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 576 512">
                             <path fill="currentColor"
                                 d="M532 386.2c27.5-27.1 44-61.1 44-98.2 0-80-76.5-146.1-176.2-157.9C368.3 72.5 294.3 32 208 32 93.1 32 0 103.6 0 192c0 37 16.5 71 44 98.2-15.3 30.7-37.3 54.5-37.7 54.9-6.3 6.7-8.1 16.5-4.4 25 3.6 8.5 12 14 21.2 14 53.5 0 96.7-20.2 125.2-38.8 9.2 2.1 18.7 3.7 28.4 4.9C208.1 407.6 281.8 448 368 448c20.8 0 40.8-2.4 59.8-6.8C456.3 459.7 499.4 480 553 480c9.2 0 17.5-5.5 21.2-14 3.6-8.5 1.9-18.3-4.4-25-.4-.3-22.5-24.1-37.8-54.8zm-392.8-92.3L122.1 305c-14.1 9.1-28.5 16.3-43.1 21.4 2.7-4.7 5.4-9.7 8-14.8l15.5-31.1L77.7 256C64.2 242.6 48 220.7 48 192c0-60.7 73.3-112 160-112s160 51.3 160 112-73.3 112-160 112c-16.5 0-33-1.9-49-5.6l-19.8-4.5zM498.3 352l-24.7 24.4 15.5 31.1c2.6 5.1 5.3 10.1 8 14.8-14.6-5.1-29-12.3-43.1-21.4l-17.1-11.1-19.9 4.6c-16 3.7-32.5 5.6-49 5.6-54 0-102.2-20.1-131.3-49.7C338 339.5 416 272.9 416 192c0-3.4-.4-6.7-.7-10C479.7 196.5 528 238.8 528 288c0 28.7-16.2 50.6-29.7 64z">
                             </path>
                         </svg>
                     </button>
                     <ul style="width:300px" class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                         <!-- <li><a class="dropdown-item" href="#">Action</a></li>  -->

                         <?php
                            foreach ($support_4 as $value) {
                                foreach ($support as $sup) {

                                    if ($value == $sup['id']) { ?>

                         <button style="outline:none ; border:none ; background : none ;width:100%" class="click_msgh"
                             type="button" data-id="<?= $sup['id'] ?>">
                             <div style="align-items: center " class="col-sm-12 row m-1 border">
                                 <div class="col-sm-3 ">
                                     <img style="border-radius:50%" src="./upload/<?= $sup['image'] ?>" width="50"
                                         height="50" alt="">
                                 </div>
                                 <div class="col-sm-8 row">
                                     <h5><?= $sup['name'] ?></h5>
                                     <p>
                                         <?php
                                                        foreach ($support_3 as $vax) {
                                                            $now = date('Y-m-d H:i:s');
                                                            if ($vax['id_user'] == $sup['id']) {
                                                                if ($vax['time_onl'] > $now) {
                                                                    echo 'Đang online ';
                                                                } else {
                                                                    echo 'Online ' . timeAgo($vax['time_onl']) . ' trước';
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                        ?>
                                     </p>
                                 </div>
                             </div>

                         </button>

                         <?php  }
                                }
                            }
                            ?>


                     </ul>
                 </div>


                 <button style="width:45px ;height:45px; border-radius:50%;background:#ccc;margin:10px"
                     class="btn position-relative click_friend" type="button" data-bs-toggle="offcanvas"
                     data-bs-target="#offcanvasFirend" aria-controls="offcanvasFirend">
                     <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-friends"
                         class="svg-inline--fa fa-user-friends fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 640 512">
                         <path fill="currentColor"
                             d="M192 256c61.9 0 112-50.1 112-112S253.9 32 192 32 80 82.1 80 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C51.6 288 0 339.6 0 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zM480 256c53 0 96-43 96-96s-43-96-96-96-96 43-96 96 43 96 96 96zm48 32h-3.8c-13.9 4.8-28.6 8-44.2 8s-30.3-3.2-44.2-8H432c-20.4 0-39.2 5.9-55.7 15.4 24.4 26.3 39.7 61.2 39.7 99.8v38.4c0 2.2-.5 4.3-.6 6.4H592c26.5 0 48-21.5 48-48 0-61.9-50.1-112-112-112z">
                         </path>
                     </svg>
                     <div class="show_friend">
                     </div>
                 </button>
                 <button style="width:45px ;height:45px; border-radius:50%;background:#ccc"
                     class="btn position-relative click_thongbao" type="button" data-bs-toggle="offcanvas"
                     data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                     <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell"
                         class="svg-inline--fa fa-bell fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 448 512">
                         <path fill="currentColor"
                             d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z">
                         </path>
                     </svg>
                     <div class="show_thongbao">
                     </div>
                 </button>
                 <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">

                     <!-- <input type="search" class="form-control" placeholder="Search..." aria-label="Search"> -->
                 </form>
                 <div class="dropdown text-end">
                     <?php if (!empty($_SESSION['member']['name'])) { ?>
                     <a href="#" class="d-block link-dark 
             text-decoration-none dropdown-toggle  " id="dropdownUser1" data-bs-toggle="dropdown"
                         aria-expanded="false">
                         <img src="./upload/<?= $support_2['image'] ?>" alt="mdo" width="32" height="32"
                             class="rounded-circle">
                     </a>
                     <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                         <li><a class="dropdown-item" href="wall-me">
                                 <sl-icon name="toggle-on"></sl-icon> Quản lí tài khoản
                             </a></li>
                         <li><a class="dropdown-item" href="#">
                                 <sl-icon name="wrench"></sl-icon> Settings
                             </a></li>
                         <li class="text-center">
                             <!--  -->
                             <div class="qr-overview">
                                 <sl-qr-code value="facebook" label="Scan this code to visit Shoelace on the web!">
                                 </sl-qr-code>
                                 <br>

                                 <sl-input maxlength="255" placeholder="Nhập url" value="Nhập url" clearable></sl-input>
                             </div>

                             <script>
                             const container = document.querySelector('.qr-overview');
                             const qrCode = container.querySelector('sl-qr-code');
                             const input = container.querySelector('sl-input');
                             input.value = qrCode.value;
                             input.addEventListener('sl-input', () => qrCode.value = input.value);
                             </script>
                             <style>
                             .qr-overview {
                                 max-width: 256px;
                             }

                             .qr-overview sl-input {
                                 margin-top: 1rem;
                             }
                             </style>
                             <!--  -->
                         </li>
                         <li><a class="dropdown-item" href="user-me">
                                 <sl-icon name="pip"></sl-icon> Profile
                             </a></li>
                         <li>
                             <hr class="dropdown-divider">
                         </li>
                         <li><a class="  alert-success dropdown-item" href="logout">
                                 <sl-icon name="toggle-off"></sl-icon> Sign out
                             </a></li>
                     </ul>
                     <?php } else { ?>
                     <a class="  alert-success btn" href="login">Login</a>
                     <?php }; ?>
                 </div>
             </div>
         </div>
     </div>
     <br>
     <br>
     <br>
     <!-- header -->
     <div class="row">
         <div class="col-sm-3">
         </div>
         <div style="position:fixed;left:0;top:0;bottom:0" class=" bg-light col-sm-3">
             <br>
             <br>
             <br>
             <style>
             a {
                 text-decoration: none;
             }
             </style>
             <!-- ////////////////// -->
             <a href="gruop" class="row">
                 <div class="row" style=" padding:10px">
                     <div class="col-sm-2 align-items-center" style="width:60px">
                         <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="users"
                             class="svg-inline--fa fa-users fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 640 512">
                             <path fill="currentColor"
                                 d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z">
                             </path>
                         </svg>
                     </div>
                     <div class=" col-sm-10 ">
                         <h3> Nhóm</h3>
                         <p style="color:teal"><?php echo count($gruop);  ?> nhóm mới </p>
                     </div>
                     <div class=" col-sm-12 ">
                         <div style="  overflow:auto ;  padding-left:20px" class="row col-sm-12 ">
                             <?php
                                foreach ($gruop as $val) {
                                    $ghhas = explode(",", $val['member']);
                                ?>
                             <a href="show-gruop?id=<?= $val['id'] ?>"
                                 class="row my-2 bg-light rounded shadow-lg p-2 rounded text-dark">
                                 <div class="col-sm-2">
                                     <img width="50" height="50" src="<?php if (empty($val['banner'])) {
                                                                                echo 'https://cdn.cms-twdigitalassets.com/content/dam/blog-twitter/official/en_us/products/2017/rethinking-our-default-profile-photo/Avatar-Blog2-Round1.png.img.fullhd.medium.png';
                                                                            } else {
                                                                                echo './upload/' . $val['banner'];
                                                                            } ?>" alt="">
                                 </div>
                                 <p class="  col-sm-10"><?= $val['name']  ?> <br> <small style="color: #ccc">
                                         <?= count($ghhas) - 1 ?> Thành viên</small> </p>
                             </a>
                             <?php } ?>
                         </div>
                     </div>
                 </div>
             </a>
             <!-- //////////////////////////////////////////////////////////////// -->



             <!-- // ---------------------------------------------------------------- -->
         </div>
         <div class="col-sm-6 ">





             <div class="row m-1">

                 <div class="col-sm-12">
                     <div style="overflow:auto ; height:240px ; display:flex " class=" ">
                         <div style="height:95% ;  width:150px; border-radius:20px ; overflow:hidden "
                             class="card col-sm-3 text-white bg-out-line-primary mb-3 m-1">
                             <button style="height:100% ; width:100% ; font-weight:bold" type="button"
                                 class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal11">
                                 Tạo bài viết +
                             </button>
                         </div>
                         <div style="height:95% ;  width:150px; border-radius:20px ; overflow:hidden "
                             class="card col-sm-3 text-white bg-out-line-primary mb-3 m-1">
                             <label for="abc"
                                 style="height:100% ; width:100% ; font-weight:bold ; text-align:center ; justify-content:center ; padding:60% 0 "
                                 type="button" class="btn btn-outline-primary">
                                 Tạo tin +
                             </label>
                             <form class="up-story" enctype="multipart/form-data" method="post">
                                 <input style="display:none" type="file" id="abc" name="fileStory" value="">
                             </form>
                         </div>
                         <?php foreach ($storys as $story) {
                                if ($story['user_id'] == $_SESSION['member']['id']) {

                            ?>
                         <div style="position: relative; width:150px; border-radius:20px ; overflow:hidden"
                             data-toggle="modal" data-target="#exampleModalLong22_<?= $story['user_id'] ?>"
                             style="display:block ; height:100%" class="card col-sm-3 text-white bg-primary mb-3 m-1"
                             style="max-width: 18rem;">
                             <div style="position: absolute; top:0 ; left:0;  " class="card-header"> <img
                                     style="border:2px solid #09ffe8;width:40px ; height:40px ; border-radius:50%"
                                     src="<?php echo './upload/' . $_SESSION['member']['image']; ?>" alt=""> </div>
                             <img height="230px" width="100%" src="<?php echo './upload/' . $story['image'] ?>" alt="">
                         </div>

                         <div class="modal fade" id="exampleModalLong22_<?= $story['user_id'] ?>" tabindex="-1"
                             role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                             <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLabel">Tin của bạn </h5>
                                         <button type="button" class="btn-close" data-bs-dismiss="modal"
                                             aria-label="Close"></button>
                                     </div>
                                     <div id="carouselExampleIndicators<?php echo  $story['user_id'] ?>"
                                         class="carousel slide" data-bs-ride="carousel">
                                         <div class="carousel-inner">
                                             <?php
                                                        $flag = 0;
                                                        foreach ($storys as $st) {
                                                            if ($st['user_id'] == $story['user_id']) {
                                                                $flag++;   ?>
                                             <div class="carousel-item <?php if ($flag == 1) {
                                                                                            echo 'active';
                                                                                        }  ?>">
                                                 <img width="400px" height="400px"
                                                     src="<?php echo './upload/' . $st['image'] ?>" alt="">
                                                 <small style="width:100%" class="btn btn-primary">Bạn đã tải lên :
                                                     <?php echo timeAgo($st['created_at']) ?></small>
                                             </div>
                                             <?php }
                                                        } ?>
                                         </div>
                                         <button class="carousel-control-prev" type="button"
                                             data-bs-target="#carouselExampleIndicators<?php echo  $story['user_id'] ?>"
                                             data-bs-slide="prev">
                                             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                             <span class="visually-hidden">Previous</span>
                                         </button>
                                         <button class="carousel-control-next" type="button"
                                             data-bs-target="#carouselExampleIndicators<?php echo  $story['user_id'] ?>"
                                             data-bs-slide="next">
                                             <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                             <span class="visually-hidden">Next</span>
                                         </button>
                                     </div>


                                 </div>
                             </div>
                         </div>



                         <?php break;
                                }
                            } ?>
                         <?php
                            $arr = [];
                            foreach ($storys as $story) {
                                if ($story['user_id'] != $_SESSION['member']['id']) {
                                    if (in_array($story['user_id'], $arr)) {
                                    } else {
                                        array_push($arr, $story['user_id']);

                            ?>

                         <div style="position: relative; width:150px; border-radius:20px ; overflow:hidden"
                             data-toggle="modal" data-target="#exampleModalLong22_<?= $story['user_id'] ?>"
                             style="display:block ; height:100%" class="card col-sm-3 text-white bg-primary mb-3 m-1"
                             style="max-width: 18rem;">
                             <div style="position: absolute; top:0 ; left:0; " class="card-header"> <img
                                     style="border:2px solid #09ffe8;width:40px ; height:40px ; border-radius:50%"
                                     src="<?php echo './upload/' . (new User)->find($story['user_id'])['image']; ?>"
                                     alt=""> </div>
                             <img height="220px" width="100%" src="<?php echo './upload/' . $story['image'] ?>" alt="">
                         </div>

                         <div class="modal fade" id="exampleModalLong22_<?= $story['user_id'] ?>" tabindex="-1"
                             role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                             <div class="modal-dialog" role="document">
                                 <div class="modal-content">

                                     <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLabel">Tin của
                                             <?php echo (new User)->find($story['user_id'])['name']; ?></h5>
                                         <button type="button" class="btn-close" data-bs-dismiss="modal"
                                             aria-label="Close"></button>
                                     </div>
                                     <div id="carouselExampleIndicators<?php echo  $story['user_id'] ?>"
                                         class="carousel slide" data-bs-ride="carousel">
                                         <div class="carousel-inner">
                                             <?php
                                                            $flag = 0;
                                                            foreach ($storys as $st) {
                                                                if ($st['user_id'] == $story['user_id']) {
                                                                    $flag++;   ?>
                                             <div class="carousel-item <?php if ($flag == 1) {
                                                                                                echo 'active';
                                                                                            }  ?>">
                                                 <img width="400px" height="400px"
                                                     src="<?php echo './upload/' . $st['image'] ?>" alt="">
                                                 <a href="<?php echo 'user-me?id=' . $story['user_id'] ?>"
                                                     style="width:100%"
                                                     class="btn btn-primary"><?= (new User)->find($story['user_id'])['name'] ?>
                                                     đã tải lên : <?php echo timeAgo($st['created_at']) ?></a>
                                             </div>
                                             <?php }
                                                            } ?>


                                         </div>
                                         <?php if ($flag <= 1) {
                                                        } else {  ?>
                                         <button class="carousel-control-prev" type="button"
                                             data-bs-target="#carouselExampleIndicators<?php echo  $story['user_id'] ?>"
                                             data-bs-slide="prev">
                                             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                             <span class="visually-hidden">Previous</span>
                                         </button>
                                         <button class="carousel-control-next" type="button"
                                             data-bs-target="#carouselExampleIndicators<?php echo  $story['user_id'] ?>"
                                             data-bs-slide="next">
                                             <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                             <span class="visually-hidden">Next</span>
                                         </button>
                                         <?php } ?>
                                     </div>





                                 </div>
                             </div>
                         </div>


                         <?php    }
                                }
                            } ?>
                     </div>
                 </div>
             </div>





             <!-- Modal -->



             <!-- Modal -->
             <div class="modal fade" id="exampleModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                 <div class="modal-dialog" role="document">
                     <div class="modal-content">

                         <!--   -->
                         <div style="padding: 10px;
    margin-bottom: 30px;
    border-bottom: 1px solid;
    border-radius: 20px;
    background:white
    ">
                             <form class="input-group " action="createPost" method="post" enctype="multipart/form-data">

                                 <textarea class="form-control textarea" name="content" rows="" cols=""></textarea>
                                 <input id="ig" style="display:none" class="form-control" multiple type="file"
                                     name="image[]" value="">
                                 <button class="btn btn-primary element-3" type="">Dang bai</button>
                             </form>
                             <label style="width:30px;height:30px" for="ig">
                                 <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="images"
                                     class="svg-inline--fa fa-images fa-w-18" role="img"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                     <path fill="currentColor" d="M480 416v16c0 26.51-21.49 48-48 48H48c-26.51
        0-48-21.49-48-48V176c0-26.51 21.49-48 48-48h16v208c0 44.112 35.888 80 80 
        80h336zm96-80V80c0-26.51-21.49-48-48-48H144c-26.51 0-48 21.49-48 48v256c0 
        26.51 21.49 48 48 48h384c26.51 0 48-21.49 48-48zM256 128c0 26.51-21.49 48-48
          48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-96 144l55.515-55.515c4.686-4.686
          12.284-4.686 16.971 0L272 256l135.515-135.515c4.686-4.686 12.284-4.686 16.971 0L512 
          208v112H160v-48z"></path>
                                 </svg></label>
                             <!--  -->

                         </div>
                     </div>
                 </div>
             </div>

             <div style="background:none" class="container dd card border mb-3">
                 <br>

                 <!--  -->
                 <div id="stories" class="storiesWrapper"></div>
                 <!-- <div class="avatar-group">
  <sl-avatar image="https://images.unsplash.com/photo-1490150028299-bf57d78394e0?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=256&h=256&q=80&crop=right"></sl-avatar> 
</div> -->

                 <style>
                 .avatar-group sl-avatar:not(:first-of-type) {
                     margin-left: -1rem;
                 }

                 .avatar-group sl-avatar::part(base) {
                     border: solid 2px rgb(var(--sl-color-neutral-0));
                 }
                 </style>


                 <div id="showhh" class="container">
                 </div>

             </div>
             <div class="text-center">
                 <img width="500" src="https://s1.uphinh.org/2021/07/21/loading.gif" alt="">
             </div>
         </div>

         <div style="position:fixed;right:0 ; background:#fff;top:0;bottom:0" class="col-sm-3">
             <br>
             <br>
             <br>
             <style>
             </style>
             <style>
             .abc_msg {
                 box-shadow: 3px 3px 20px #ccc;
                 padding: 10px;
                 display: none;
                 position: fixed;
                 width: 370px;
                 height: 500px;
                 bottom: 0;
                 right: 10%;
                 background-color: white;
                 border-radius: 10px;
                 overflow: auto;
             }

             .abc_msg2 {
                 box-shadow: 3px 3px 20px #ccc;
                 padding: 10px;
                 display: none;
                 position: fixed;
                 width: 370px;
                 height: 500px;
                 bottom: 0;
                 right: 33%;
                 background-color: white;
                 border-radius: 10px;
                 overflow: auto;
             }

             .pplas {
                 position: absolute;
                 bottom: 0;
                 left: 0;
                 right: 0;
             }

             .pplas input {
                 width: 80%
             }

             .pplas button {
                 width: 18%;
             }

             .animateSuccessLong {
                 width: 100%;
                 height: 100%;
                 background-color: #fff;
             }
             </style>
             <div class="abc_msg">
             </div>
             <div class="abc_msg2">
             </div>
             <!--  -->
             <sl-tab-group placement="end">
                 <sl-tab slot="nav" panel="general">
                     <sl-icon name="align-bottom"></sl-icon>General
                 </sl-tab>
                 <sl-tab slot="nav" panel="custom">
                     <sl-icon name="cloud-download-fill"></sl-icon>Custom
                 </sl-tab>
                 <sl-tab slot="nav" panel="advanced">
                     <sl-icon name="chat-square-dots-fill"></sl-icon>Advanced
                 </sl-tab>
                 <sl-tab slot="nav" panel="disabled">
                     <sl-icon name="check-circle-fill"></sl-icon>Bài viết đã lưu
                 </sl-tab>
                 <sl-tab-panel name="general">
                     <!-- <h1>Heelo word</h1> -->
                 </sl-tab-panel>
                 <sl-tab-panel name="custom">This is the custom tab panel.</sl-tab-panel>
                 <sl-tab-panel name="advanced">This is the advanced tab panel.</sl-tab-panel>
                 <sl-tab-panel name="disabled">
                     <div style="height:180px;overflow:auto ; padding:3px;border:1px solid black;border-radius:10px"
                         class="row" id="showPost">
                     </div>
                 </sl-tab-panel>
             </sl-tab-group>
             <!--  -->
             <iframe width="100%" height="315" src="https://www.youtube.com/embed/GyUOPtgmAik"
                 title="YouTube video player" frameborder="0"
                 allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                 allowfullscreen></iframe>
             <div style="height:200px ;overflow:auto" class="row m-2 ">
                 <?php
                    foreach ($support_4 as $value) {
                        foreach ($support as $sup) {

                            if ($value == $sup['id']) { ?>

                 <div style="align-items: center " class="col-sm-12 row m-1 border">
                     <div class="col-sm-2 ">
                         <img style="border-radius:50%" src="./upload/<?= $sup['image'] ?>" width="50" height="50"
                             alt="">
                     </div>
                     <div class="col-sm-10 row">
                         <h5><?= $sup['name'] ?></h5>
                         <p>
                             <?php

                                            foreach ($support_3 as $vax) {
                                                $now = date('Y-m-d H:i:s');
                                                if ($vax['id_user'] == $sup['id']) {
                                                    if ($vax['time_onl'] > $now) {
                                                        echo 'Đang online ';
                                                    } else {
                                                        echo 'Online ' . timeAgo($vax['time_onl']) . ' trước';
                                                        break;
                                                    }
                                                }
                                            }
                                            ?>
                         </p>
                     </div>
                 </div>

                 <?php  }
                        }
                    }
                    ?>
             </div>
         </div>
         <br>
     </div>

     <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
         <div class="offcanvas-header">
             <h5 id="offcanvasRightLabel">Thông báo của bạn</h5>
             <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
         </div>
         <div class="offcanvas-body">
             <div class="thongbao">
             </div>
         </div>
     </div>
     <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFirend" aria-labelledby="offcanvasRightLabel">
         <div class="offcanvas-header">
             <h5 id="offcanvasRightLabel">Lời mời kết bạn</h5>
             <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
         </div>
         <div class="offcanvas-body">
             <div class="listFriend">
             </div>
         </div>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"
         integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous">
     </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js">
     </script>
     <script>
     $(document).ready(function() {
         $('.up-story').on('change', function() {
             $.ajax({
                 url: ('loadImageStory'),
                 method: 'POST',
                 data: new FormData(this),
                 contentType: false,
                 processData: false,
                 success: function(data) {
                     window.location.reload();
                 }
             })
         })
     })
     </script>

     <script src="./js/lightgallery-all.min.js"></script>
     <script src="./js/prettify.js"></script>
     <script src="./js/lightslider.js"></script>
     <script>
     $(document).ready(function() {
         var flag = 0;
         var idFr1 = 0;

         $(document).on('click', '#closs_jjd', function() {
             $('.abc_msg').hide(100);
             flag = 0;
             if (flag == 0) {
                 idFr1 = 0
             }
         })
         $(document).on('click', '#closs_jjd22', function() {
             $('.abc_msg2').hide(100);
             if (flag == 0) {
                 flag == 0;
             } else {
                 flag = 1;
             }
             if (flag == 0) {
                 idFr1 = 0
             }
         })
         $(document).on('input', '.search-ajax', function() {
             var data = $(this).val();
             $.ajax({
                 url: ('showUserChat'),
                 method: 'POST',
                 data: {
                     data: data
                 },
                 success: function(data) {
                     $('#showUserChat').html(data);
                 }
             })
         })
         //  setInterval(showUserChat(), 100);
         showUserChat()

         function showUserChat() {
             $.ajax({
                 url: ('showUserChat'),
                 method: 'POST',
                 success: function(data) {
                     $('#showUserChat').html(data);
                 }
             })
         }
         $(document).on('change', '.formSend22', function() {

             $('.showImgSend2').show(100)
             $.ajax({
                 url: ('loadImageSend2'),
                 method: 'POST',
                 data: new FormData(this),
                 contentType: false,
                 processData: false,
                 success: function(data) {
                     $('.showImgSend2').html(data);
                 }
             })
         })
         $(document).on('change', '.formSend', function() {

             $('.showImgSend').show(100)
             $.ajax({
                 url: ('loadImageSend'),
                 method: 'POST',
                 data: new FormData(this),
                 contentType: false,
                 processData: false,
                 success: function(data) {
                     $('.showImgSend').html(data);
                 }
             })
         })

         $(document).on('click', '.chat_send', function() {
             $('.showImgSend').hide(100);
             var id = $(this).data('id');
             var id_chat = $(this).data('id_chat');
             var data = $('.data_chat').val();
             var img = $('.imageHidden').val();
             $.ajax({
                 url: ('loadDataChat'),
                 method: "post",
                 data: {
                     id: id,
                     data: data,
                     id_chat: id_chat,
                     img: img
                 },
                 success: function(data) {
                     $('.imageHidden').val('');
                     $('.data_chat').val('');
                     fetch_data()
                 }
             })
         })
         $(document).on('click', '.chat_send2', function() {
             $('.showImgSend2').hide(100);
             var id = $(this).data('id');
             var id_chat = $(this).data('id_chat2');
             var data = $('.data_chat2').val();
             var img = $('.imageHidden2').val();
             $.ajax({
                 url: ('loadDataChat2'),
                 method: "post",
                 data: {
                     id: id,
                     data: data,
                     id_chat: id_chat,
                     img: img
                 },
                 success: function(data) {
                     $('.imageHidden2').val('');
                     $('.data_chat2').val('');
                     fetch_data2()
                 }
             })
         })
         //  setInterval(fetch_data(),1000); 
         function fetch_data() {
             $.ajax({
                 url: ('loadAllChat2'),
                 method: "post",
                 success: function(data) {
                     $('.ul').html(data)
                     setTimeout(fetch_data(), 5000);
                 }
             })
         }

         function fetch_data2() {
             $.ajax({
                 url: ('loadAllChat22'),
                 method: "post",
                 success: function(data) {
                     $('.ul2').html(data)
                     setTimeout(fetch_data2(), 5000);
                 }
             })
         }
         //  fetch_data2();
         //  fetch_data();

         $(document).on('click', '.click_msgh', function() {
             flag++;

             var idFr = $(this).data('id');
             if (idFr != idFr1) {
                 idFr1 = $(this).data('id');
                 console.log(flag);

                 if (flag == 0) {
                     flag = 1;
                 }
                 if (flag >= 3) {
                     flag = 2;
                 }
                 if (flag == 1) {
                     $('.abc_msg').toggle(100);
                     $.ajax({
                         url: ('loadChat2'),
                         method: "post",
                         data: {
                             idFr: idFr
                         },
                         success: function(data) {
                             $('.abc_msg').html(data);
                             fetch_data()
                         }
                     })
                 } else if (flag >= 2) {
                     $('.abc_msg2').hide(100);
                     $('.abc_msg2').toggle(100);
                     $.ajax({
                         url: ('loadChat22'),
                         method: "post",
                         data: {
                             idFr: idFr
                         },
                         success: function(data) {
                             $('.abc_msg2').html(data);
                             fetch_data2();
                         }
                     })
                 }
             }
         })
     })
     </script>
     <script>
     let count = 0;
     // Always escape HTML for text arguments!
     function escapeHtml(html) {
         const div = document.createElement('div');
         div.textContent = html;
         return div.innerHTML;
     }

     // Custom function to emit toast notifications
     function notify(message, type = 'primary', icon = 'info-circle', duration = 3000) {
         const alert = Object.assign(document.createElement('sl-alert'), {
             type: type,
             closable: true,
             duration: duration,
             innerHTML: `
        <sl-icon name="${icon}" slot="icon"></sl-icon>
        ${escapeHtml(message)}
      `
         });

         document.body.append(alert);
         return alert.toast();
     }

     window.onload = () => {
         notify(`Hi ! `);
     };
     </script>


     <script>
     // $(document).ready(function() {
     //   $('.imageGallery').lightSlider({
     //       gallery:true,
     //       item:1,
     //       loop:true,
     //       thumbItem:7,
     //       slideMargin:10,
     //       enableDrag: false,
     //       currentPagerPosition:'left',
     //       onSliderLoad: function(el) {
     //           el.lightGallery({
     //               selector: '#imageGallery .lslide'
     //           });
     //       }   
     //   });  
     // });
     </script>
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
             $('#showPost').append('<div class="col-sm-2"> <img width="100%" src="./upload/' + data[index].avatar +
                 '"></div><div class="col-sm-10"><h5>' + data[index].name + '</h5> <p> ' + data[index].content +
                 '</p></div> <img width="100%" src="./upload/' + data[index].image + '"> <p></p><hr>');
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
             $('#showPost').append('<div class="col-sm-2"> <img width="100%" src="./upload/' + arr.avatar +
                 '"></div><div class="col-sm-10"><h5>' + arr.name + '</h5> <p> ' + arr.content +
                 '</p></div> <img width="100%" src="./upload/' + arr.image + '">  <p></p><hr>');
             value_old.push(arr);
             localStorage.setItem('post', JSON.stringify(value_old));
         }
     }
     </script>
     <script>
     $(document).ready(function() {
         let page = 1;
         $(window).scroll(function() {
             if ($(window).scrollTop() + $(window).height() >= $(document).height() - 30) {
                 setTimeout(function() {

                     page++;
                     $.ajax({
                         url: ('show-like'),
                         method: 'POST',
                         data: {
                             page: page
                         },
                         success: function(data1) {
                             $('#showhh').html(data1);
                         }
                     })
                 }, 100);
             }
         })
         //  setInterval(like() , 1000);
         $(document).on('click', '.click_msg', function(e) {
             $('.abc_msg').toggle(100);
         });
         $(document).on('click', '.click-unfiend', function() {
             var id = $(this).data('id');
             $.ajax({
                 url: ('load_kp_unfriends'),
                 method: 'POST',
                 data: {
                     id: id
                 },
                 success: function(data) {}
             })
         });
         $(document).on('click', '.click-fiend', function() {
             var id = $(this).data('id');
             $.ajax({
                 url: ('load_kp_friends'),
                 method: 'POST',
                 data: {
                     id: id
                 },
                 success: function(data) {
                     //  alert(data)
                     //  location.reload();
                 }
             })
         })
         $(document).on('click', '.like_btn', function(e) {
             var id = $(this).data('id');
             var data = $(this).data('like_status');
             $.ajax({
                 url: ('update_like_status'),
                 method: 'POST',
                 data: {
                     data: data,
                     id: id,
                 },
                 success: function(data) {
                     console.log(data);
                     // window.location.reload(); 
                     // $('.showform_'+id).html(data);
                     like();
                 }
             })
         })
         $(document).on('click', '.haha_btn', function(e) {
             var id = $(this).data('id');
             var data = $(this).data('like_status');
             $.ajax({
                 url: ('update_like_status'),
                 method: 'POST',
                 data: {
                     data: data,
                     id: id,
                 },
                 success: function(data) {
                     console.log(data);
                     // window.location.reload(); 
                     // $('.showform_'+id).html(data);
                     like();
                 }
             })
         })
         $(document).on('click', '.love_btn', function(e) {
             var id = $(this).data('id');
             var data = $(this).data('like_status');
             $.ajax({
                 url: ('update_like_status'),
                 method: 'POST',
                 data: {
                     data: data,
                     id: id,
                 },
                 success: function(data) {
                     console.log(data);
                     // window.location.reload(); 
                     // $('.showform_'+id).html(data);
                     like();
                 }
             })
         })
         $(document).on('click', '.sad_btn', function(e) {
             var id = $(this).data('id');
             var data = $(this).data('like_status');
             $.ajax({
                 url: ('update_like_status'),
                 method: 'POST',
                 data: {
                     data: data,
                     id: id,
                 },
                 success: function(data) {
                     console.log(data);
                     // window.location.reload(); 
                     // $('.showform_'+id).html(data);
                     like();
                 }
             })
         })
         $(document).on('click', '.angry_btn', function(e) {
             var id = $(this).data('id');
             var data = $(this).data('like_status');
             $.ajax({
                 url: ('update_like_status'),
                 method: 'POST',
                 data: {
                     data: data,
                     id: id,
                 },
                 success: function(data) {
                     // console.log(data);
                     // window.location.reload(); 
                     // $('.showform_'+id).html(data);
                     like();
                 }
             })
         })
         $(document).on('click', '.share_post', function(e) {
             var id = $(this).data('id');

         })
         $(document).on('click', '.click_share', function(e) {
             var id = $(this).data('id');
             var data = $('.text_share_' + id).val();
             $.ajax({
                 url: ('share_post'),
                 method: 'POST',
                 data: {
                     data: data,
                     id: id,
                 },
                 success: function(data) {
                     // console.log(data);
                     window.location.reload();
                     // $('.showform_'+id).html(data);
                 }
             })
         })
         $(document).on('click', '.form-check ', function() {
             var id = $(this).data('id');
             var data = $(this).data('status');
             $.ajax({
                 url: ('load_status'),
                 method: 'POST',
                 data: {
                     data: data,
                     id: id,
                 },
                 success: function(data) {
                     // console.log(data);
                     // window.location.reload(); 
                     // $('.showform_'+id).html(data);
                 }
             })
         })
         $(document).on('click', '.edit_post', function() {
             var id = $(this).data('id');
             $('.text_content').hide(50);
             $('.edit_form_' + id).show(50);
             $('#exampleModal_' + id).hide(50);
             $('.modal-backdrop').hide(50);
             $(document).on('change', '.form_edit', function(e) {
                 var data = $('.input_edit_' + id).val();

                 $.ajax({
                     url: ('load_edit'),
                     method: 'POST',
                     data: {
                         data: data,
                         id: id,
                     },
                     success: function(data) {
                         window.location.reload();
                         // $('.showform_'+id).html(data);
                     }
                 })
             })
         })
         $(document).on('click', '.click-khongchapnhan', function() {
             var id = $(this).data('id');
             $.ajax({
                 url: (' click_khongchapnhan'),
                 method: 'POST',
                 data: {
                     id: id,
                 },
                 success: function(data) {

                     // $('.showform_'+id).html(data);
                 }
             })
         })
         $(document).on('click', '.click-chapnhan', function() {
             var id = $(this).data('id');
             $.ajax({
                 url: ('click_chapnhan'),
                 method: 'POST',
                 data: {
                     id: id,
                 },
                 success: function(data) {

                     // $('.showform_'+id).html(data);
                 }
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
         setInterval(listFriend, 3000);

         function listFriend() {
             $.ajax({
                 url: ('listFriend'),
                 method: 'POST',
                 //  timeout:11000,
                 success: function(data) {
                     $('.listFriend').html(data);
                 }
             })
         }
         setInterval(thongbao, 3000);

         function thongbao() {
             $.ajax({
                 url: ('thongbao'),
                 method: 'POST',
                 success: function(data) {
                     $('.thongbao').html(data);
                 }
             })
         }
         show_friend()
         setInterval(show_friend(), 3000);

         function show_friend() {
             $.ajax({
                 url: ('show_friend'),
                 method: 'POST',
                 success: function(data) {
                     $('.show_friend').html(data);
                     //  show_friend()
                 }
             })
         }
         show_thongbao()
         setInterval(show_thongbao(), 3000);

         function show_thongbao() {
             $.ajax({
                 url: ('show_thongbao'),
                 method: 'POST',
                 success: function(data) {
                     $('.show_thongbao').html(data);
                     //  show_thongbao()
                 }
             })
         }
         $('.click_thongbao').on('click', function() {
             $.ajax({
                 url: ('loadThongBao'),
                 method: 'POST',
                 success: function() {
                     show_thongbao()
                 }
             })
         })


         $('.click_friend').on('click', function() {
             $.ajax({
                 url: ('loadFriend'),
                 method: 'POST',
                 success: function() {
                     // listFriend()
                 }
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

         $(window).scroll(function() {
             if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                 like();
             }
         });

         function like() {
             $.ajax({
                 url: 'show-like',
                 method: 'POST',
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
                 //  $.ajax({
                 //    url: 'check-ajax',
                 //    method: 'POST',
                 //    data: {
                 //      i: i,
                 //      id: id
                 //    },
                 //    success: function() {
                 //      like();
                 //    }
                 //  })
             } else {
                 var i = 1;
                 //  $.ajax({
                 //    url: 'check-ajax',
                 //    method: 'POST',
                 //    data: {
                 //      i: i,
                 //      id: id
                 //    },
                 //    success: function(data) {
                 //      like();
                 //    }
                 //  })
             }
         })

     })
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