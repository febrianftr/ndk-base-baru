<?php

require 'koneksi/koneksi.php';

session_start();

echo "<script>
            function play(){
            var audio = document.getElementById('audio');
            audio.play();
                 }
      </script>";

if (isset($_POST["login"])) {

  $username = $_POST["username"];
  $password = $_POST["password"];

  if (empty($username)) {
    echo "<script>alert('Username belum diisi!'); </script>
         <script>
            function play(){
            var audio1 = document.getElementById('audio1');
            audio1.play();
                 }
        </script>";
  } elseif (empty($password)) {
    echo "<script>alert('Password belum diisi!'); </script>
          <script>
            function play(){
            var audio1 = document.getElementById('audio1');
            audio1.play();
                 }
        </script>";
  } else {
    //---------------------------- query untuk mendapatkan username --------------------------------

    $query = "SELECT * FROM xray_login WHERE username = '$username' ";
    $hasil = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($hasil);

    //---------------------------- cek kesesuaian password -------------------------------
    if (password_verify($password, $data['password'])) {
      $_SESSION['last_login_timestamp'] = time();

      echo "<script>document.location.href='menu.php';</script>
          <script>
            function play(){
            var audio = document.getElementById('audio');
            audio.play();
                 }
          </script>";

      //----------------------------- menyimpan username dan level ke dalam session ----------------------------------------
      $_SESSION['level'] = $data['level'];
      $_SESSION['username'] = $data['username'];
      $_SESSION['fill'] = $data_temp['fill'];
    }
    echo "<script>alert('username atau password salah silahkan ulangi kembali'); </script>
        <script>
            function play(){
            var audio1 = document.getElementById('audio1');
            audio1.play();
                 }
        </script>";
  }
}

?>

<?php
@$username = $_SESSION['username'];
$query = "SELECT * FROM xray_login WHERE username = '$username' ";
$hasil = mysqli_query($conn, $query);
$data = mysqli_fetch_array($hasil);

if (!($_SESSION['username'] = $data['username'])) {
?>
  <?php include "bahasa.php"; ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- ketika pencet tombol back akan kembali kehalaman awal -->
    <script language="javascript" type="text/javascript">
      window.history.forward();
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" type="text/css" href="styleindex.css" />
    <link rel="stylesheet" href="css/loading.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="icon" href="image/ipi-icon3.png" type="image/png">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login</title>
  </head>

  <body>
    <div class="container-fluid">
      <div class="row">

        <div class="main-login">
          <div class="login-all">

            <div class="form_login">
              <form class="login" method="post" action="">
                <div class="form1">
                  <div class="group5">
                    <input name="username" class="input5" type="text" required>
                    <span class="highlight5"></span>
                    <span class="bar5"></span>
                    <label class="label5"><?= $lang['input_uname'] ?></label>
                  </div>
                  <div class="group5">
                    <input name="password" class="input5" type="password" required>
                    <span class="highlight5"></span>
                    <span class="bar5"></span>
                    <label class="label5"><?= $lang['input_pw'] ?></label>
                  </div>

                  <!-- <button class="buttonsearch" type="submit" name="login" onclick="play()"><span><?= $lang['login'] ?></span></button> -->
                  <style>
                    .btn-login2 {
                      font-family: inherit;
                      font-size: 20px;
                      background: #d9003d;
                      color: white;
                      padding: 0.7em 1em;
                      padding-left: 0.9em;
                      display: flex;
                      align-items: center;
                      border: none;
                      border-radius: 16px;
                      overflow: hidden;
                      transition: all 0.2s;
                    }

                    .btn-login2 span {
                      display: block;
                      margin-left: 0.3em;
                      transition: all 0.3s ease-in-out;
                    }

                    .btn-login2 i {
                      display: block;
                      transform-origin: center center;
                      transition: transform 0.3s ease-in-out;
                    }

                    .btn-login2:hover .svg-wrapper {
                      animation: fly-1 0.6s ease-in-out infinite alternate;
                    }

                    .btn-login2:hover i {
                      transform: translateX(1.2em) rotate(0deg) scale(1.6);
                    }

                    .btn-login2:hover span {
                      transform: translateX(5em);
                    }

                    .btn-login2:active {
                      transform: scale(0.95);
                    }

                    @keyframes fly-1 {
                      from {
                        transform: translateY(0.1em);
                      }

                      to {
                        transform: translateY(-0.1em);
                      }
                    }
                  </style>
                  <button class="btn-login2" type="submit" name="login" onclick="play()">
                    <div class="svg-wrapper-1">
                      <div class="svg-wrapper">
                        <i class="fas fa-sign-in-alt"></i>
                      </div>
                    </div>
                    <span><?= $lang['login'] ?></span>
                  </button>

                </div><br>

                <div class="dropdown" style="bottom: 24px; position: absolute; width: 87%;">
                  <button class="dropdown-toggle" type="button" data-toggle="dropdown" style="padding: 6px; border: none; border-radius: 3px;background: #eaeaea; color: #1f69b7; font-weight: bold; font-size: 12px;"><?= $lang['language'] ?>
                    <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="?lang=en"><img style="width: 20px;" src="image/usa.png"> English</a></li>
                    <li><a href="?lang=id"><img style="width: 20px;" src="image/indonesia.png"> Bahasa</a></li>
                  </ul>
                  <a class="float-right" style="color: blue; margin-top: 5px;" href="readmore.php"><?= $lang['read_more'] ?>?</a>
                </div>

              </form>

            </div>

            <div class="view">
              <img src="image/login_back.png" class="img-right" alt="placeholder" style="width: 400px; border-radius: 0 10px 10px 0;">
              <div class="mask flex-center waves-effect waves-light">
                <p style="position:absolute; bottom:0; right:0; padding:5px; color: #fff; font-weight:bold;">Intiwid RISPACS V.3.0</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>



    </div>
    <!-- <div class="footerindex">

      <center><b>Developed by Intiwid Medical System</b></center>

    </div> -->


    <!-- <div class="content">
  


</div> -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>

  </body>

  </html>
<?php } else {
  if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "superadmin") {
    header("location:admin/administrator.php");
  } else if ($_SESSION['level'] == "superadmin") {
    header("location:admin/administrator.php");
  } else if ($_SESSION['level'] == "radiology") {
    header("location:radiology/index.php");
  } else if ($_SESSION['level'] == "radiographer") {
    header("location:radiographer/workload.php");
  }
} ?>