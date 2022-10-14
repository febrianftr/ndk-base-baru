<?php

require 'function_dokter.php';

session_start();

if (isset($_POST['submit'])) 
{
  berita($_POST);
  echo "<script>alert('Data berhasil dimasukkan');
  document.location.href='report-news.php';
  </script>";
}

if ($_SESSION['level'] == "admin") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Report News | Admin</title>
<?php include('head.php'); ?>
</head>

<body>

<?php include('menu-bar.php'); ?><br>
<nav aria-label="breadcrumb">
          <ol class="breadcrumb1 breadcrumb">
            <li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $lang['report_news'] ?></li>
          </ol>
        </nav>

        <div id="container1">
          <div id="content1">
<div class="container-fluid">
  <form action="" method="POST">
  <textarea class="ckeditor" style="width: 100%; height: 320px;" id="ckeditor" name="berita"></textarea>
  <button class="button1" type="submit" name="submit"><?= $lang['add_data'] ?></button>
  </form>
</div>
</div>

<div class="footerindex">
    <div class="">
          <div class="footer-login col-sm-12"><br>
            <center><p>&copy; Powered by Intiwid IT Solution 2019</a>.</p></center>
          </div> 
        </div>
</div>
</div>
<?php include('script-footer.php'); ?>
  </body>
  </html>
 <?php } else {header("location:../index.php");} ?>