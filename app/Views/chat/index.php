<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <!-- https://cdnjs.com/libraries/twitter-bootstrap/5.0.0-beta1 -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />

    <!-- Icons: https://getbootstrap.com/docs/5.0/extend/icons/ -->
    <!-- https://cdnjs.com/libraries/font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
    </style>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $(document).ready(function() {
        $("#show_tym").draggable();
    })
    </script>
    <title>Facebook</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {}

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
    }

    .ul {
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
    }

    .li p {
        height: auto;
        padding: 10px
    }

    .hd {
        position: fixed;
        left: 24%;
        width: 75%;
        z-index: 100;
        background: #fff;
    }
    </style>
</head>

<body class="  ">
    <div style="background:#fff;width:100%; position:fixed ; z-index:3" class="p-3 header  mb-3 border-bottom">
        <div class="container bg-light">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="http://localhost/laravel-app/facebook/" class="nav-link px-2 link-secondary">Home</a>
                    </li>
                    <li><a href="chat-box" class="nav-link px-2 link-dark">Chát</a></li>
                    <li><a href="show-image" class="nav-link px-2 link-dark">Ảnh</a></li>
                    <li><a href="#" class="nav-link px-2 link-dark">Tin tức</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <!-- <input type="search" class="form-control" placeholder="Search..." aria-label="Search"> -->
                </form>
                <div class="dropdown text-end">
                    <?php if (!empty($_SESSION['member']['name'])) { ?>
                    <a href="#" class="d-block link-dark 
             text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="./upload/<?= $support_2['image'] ?>" alt="mdo" width="32" height="32"
                            class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="user-me">Quản lí tài khoản</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
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
    <br>
    <br>
    <!-- header -->
    <div>
        <div style=" height:100%" class="row">
            <div style=" 
            height:100%;
            overflow:auto;
	           " class="p-3 bg-light row  col-sm-3">
                <div class="col-sm-12  ">
                    <div class="col-sm-10 row">
                        <h1 class="col-sm-10">Chat</h1>
                        <p class="col-sm-1">Tuy chon</p>
                    </div>
                    <div class="col-sm-2">
                    </div>
                    <div style="position: relative" class="col-sm-12">
                        <input style="width:100% ;padding:10px;border-radius:20px;outline:none" type="text"
                            class="search-ajax" name="" value="" placeholder="Search">
                        <br>
                        <hr>
                    </div>
                </div>
                <div class="col-sm-12" id="showUserChat">
                </div>
            </div>
            <div class=" show col-sm-9">
                <img width="100%" height="100%" src="./upload/1.gif" alt="">
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
    $(document).ready(function() {
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
        setInterval(showUserChat(), 3000);

        function showUserChat() {
            $.ajax({
                url: ('showUserChat'),
                method: 'POST',
                success: function(data) {
                    $('#showUserChat').html(data);
                }
            })
        }
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
                }
            })
        })

        function fetch_data() {
            $.ajax({
                url: ('loadAllChat'),
                method: "post",
                success: function(data) {
                    $('.ul').html(data)
                    fetch_data();
                }
            })
        }
        fetch_data();

        $(document).on('click', '.click', function() {
            var idFr = $(this).data('id');
            $.ajax({
                url: ('loadChat'),
                method: "post",
                data: {
                    idFr: idFr
                },
                success: function(data) {
                    $('.show').html(data)
                }
            })
        })
    })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js">
    </script>
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