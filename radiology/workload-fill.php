<?php
require '../koneksi/koneksi.php';
session_start();

// --------------------------------

if ($_SESSION['level'] == "radiology") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html>

  <head>
    <title>Workload | Radiology</title>
    <?php include('head.php'); ?>
    <style>
      @media only screen and (max-width: 800px) {
        .menu-size2 {
          visibility: hidden;
        }
      }

      @media only screen and (max-width: 768px) {
        .footerindex {
          position: fixed;
        }
      }
    </style>
  </head>

  <body>
    <?php include('../sidebar-index.php'); ?>
    <div class="container-fluid" id="content2">
      <div class="row">
        <?php include('../workload-fill-index.php'); ?>
      </div>
    </div>
    <br><br>

    <?php include('script-footer.php'); ?>
    <script>
      $(document).ready(function() {
        $("li[data-target='#service']").addClass("active");
        $("ul[id='service'] li[id='expertise-history']").addClass("active");
      });
    </script>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>