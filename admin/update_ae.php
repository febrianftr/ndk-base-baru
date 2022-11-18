<?php
require 'function_dokter.php';
session_start();

$pk = $_GET["pk"];
$result =  mysqli_query(
    $conn_pacsio,
    "SELECT * FROM ae WHERE pk = '$pk' "
);

$row = mysqli_fetch_assoc($result);
if (isset($_POST["submit"])) {
    if ($_POST['passwordconfirm'] == "27102108") {
        if (update_ae($_POST) > 0) {
            echo "<script type='text/javascript'>
            setTimeout(function () { 
            swal({
                       title: 'Berhasil Diubah!',
                       text:  '',
                       icon: 'success',
                       timer: 1000,
                       showConfirmButton: true
                   });  
            },10); 
            window.setTimeout(function(){ 
             window.location.replace('view_ae.php');
            } ,1000); 
           </script>";
        } else {
            echo "<script type='text/javascript'>
            setTimeout(function () { 
            swal({
                       title: 'Gagal Diinput!',
                       text:  '',
                       icon: 'error',
                       timer: 1000,
                       showConfirmButton: true
                   });  
            },10); 
            window.setTimeout(function(){ 
             window.location.replace('update_ae.php?pk=" . $pk . "');
            } ,1000); 
           </script>";
        }
    } else {
        echo "<script type='text/javascript'>
        setTimeout(function () { 
            swal({
                title: 'Password Konfirmasi Salah',
                text:  '',
                icon: 'error',
                timer: 1000,
                showConfirmButton: true
            });  
     },10); 
        window.setTimeout(function(){ 
         window.location.replace('update_ae.php?pk=" . $pk . "');
        } ,1000); 
       </script>";
    }
}

if ($_SESSION['level'] == "admin") {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Ubah Data template</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('menu-bar.php'); ?><br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb1 breadcrumb">
                <li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
                <li class="breadcrumb-item"><a href="view_template.php">Tabel template</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Data template</li>
                <li style="float: right;">
                    <label>Zoom</label>
                    <a href="#" id="decfont"><i class="fas fa-minus-circle"></i></a>
                    <a href="#" id="incfont"><i class="fas fa-plus-circle"></i></a>
                </li>
            </ol>
        </nav>

        <div id="container1">
            <div id="content1">
                <div class="body">

                    <div class="container-fluid">

                        <div class="form-template col-md-8 col-md-offset-2">
                            <h1>EDIT AE TITLE</h1>
                            <form action="" method="post">
                                <input type="hidden" name="pk" value="<?= $row["pk"]; ?>">

                                <label for="aetitle"><b>AE TITLE</b></label><br>
                                <input class="form-control" type="text" name="aetitle" id="aetitle" required value="<?= $row["aet"]; ?>">

                                <label for="ip"><b>IP</b></label><br>
                                <input class="form-control" type="text" name="ip" id="ip" required value="<?= $row["hostname"]; ?>">

                                <label for="port"><b>PORT</b></label><br>
                                <input class="form-control" type="text" name="port" id="port" required value="<?= $row["port"]; ?>">
                                <!-- <label for="color"><b>COLOR</b></label><br>
                                <input class="form-control" type="color" name="color" id="color" required value="<?= $row["color"]; ?>"> -->
                                <label for="password"><b>Password Confirm</b></label><br>
                                <input class="form-control" type="password" name="passwordconfirm" required><br />
                                <button class="btn-worklist" type="submit" name="submit">Save AE Title</button>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footerindex">
                <div class="">
                    <div class="footer-login col-sm-12"><br>
                        <center>
                            <p>&copy; Powered by Intiwid IT Solution 2022</a>.</p>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <?php include('script-footer.php'); ?>

    </body>

    </html>
<?php } else {
    header("location:../index.php");
} ?>