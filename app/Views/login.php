<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <!-- https://cdnjs.com/libraries/twitter-bootstrap/5.0.0-beta1 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />

  <!-- Icons: https://getbootstrap.com/docs/5.0/extend/icons/ -->
  <!-- https://cdnjs.com/libraries/font-awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <style>
    body {
      background-image: url('./upload/abc.gif');
      background-repeat: no-repeat;
      background-size:100%
    }
  </style>
  <title>Login</title>
</head>

<body class=" text-center">
  <div class="container  "> 
    <div style="padding:10px; border-radius:10px; max-width:700px;margin:10% auto; ">
      <div style="background:#ccc;padding:10px ; border-radius:10px">
        <h1 class="text-center alert alert-success">LOGIN</h1>
        <form action="checklogin" method="post" class="form-horizontal">
          <div class="form-floating mb-3">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>
          <div class="form-group">
            <p></p>
            <button class="btn btn-success" type="submit">Login</button>
          </div>
          <p></p>
          <p>Bạn chưa có tài khoản ? <a href="logki">Đăng kí</a> </p>
      </div>
      </form>
      <?php 
        if(!empty($errors)){
            foreach($errors as $val){
               ?>
            <p class="error alert alert-danger"><?=$val?></p>
               <?php 
            }
        }
      ?>
    </div>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>

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