<?php
require '../koneksi/koneksi.php';
session_start();

if ($_SESSION['level'] == "refferal") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <?php include('head.php'); ?>
    <title>Home | radiology</title>

  </head>

  <body>
    <?php include('../sidebar-index.php'); ?>
    <div class="container-fluid" id="content2">
      <div class="row">

        <!-- //////content home/////////////// -->
        <?php include('../home-index.php'); ?>
        <!-- //////end content home/////////////// -->

      </div>
    </div>


    <?php include('script-footer.php'); ?>
    <script>
      $(document).ready(function() {
        $("li[data-target='#home1']").addClass("active");
      });
    </script>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>