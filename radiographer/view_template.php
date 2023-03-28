<?php

require '../koneksi/koneksi.php';

session_start();

$username = $_SESSION['username'];

$result = mysqli_query($conn, "SELECT * FROM xray_template");

if ($_SESSION['level'] == "radiographer") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>View Template | radiographer</title>
    <?php include('head.php'); ?>
  </head>

  <body>

    <?php include('../sidebar-index.php'); ?>
    <div class="container-fluid" id="main">
      <?php include('../template-index.php') ?>
    </div>

    <div class="footerindex">
      <div class="">
        <?php include('footer-itw.php'); ?>
      </div>
    </div>

    <?php include('script-footer.php'); ?>
    <script>
      $(document).ready(function() {
        $("li[id='settings1']").addClass("active");
      });
    </script>
  </body>

  </html>
  <script>
    $('document').ready(function() {
      var table = $('#example1').dataTable({
        "stateSave": true,
        "ajax": {
          "url": "../getTemplate.php",
          "dataSrc": ""
        },
        "columns": [{
            "data": "no"
          },
          {
            "data": "action"
          },
          {
            "data": "title"
          },
          {
            "data": "username"
          }
        ]
      });
    });
  </script>
<?php } else {
  header("location:../index.php");
} ?>