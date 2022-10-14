<?php
require '../koneksi/koneksi.php';
session_start();
if ($_SESSION['level'] == "radiographer") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>About | Radiographer</title>
    <?php include('head.php'); ?>
    
  </head>

  <body>
  <?php include('sidebar.php'); ?>
    <div class="container" id="main">
        <div class="row">
            
            <div id="content1">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum perspiciatis ex nemo autem earum saepe? Quaerat vero in quasi quas voluptate. Harum nihil blanditiis culpa, numquam reiciendis deleniti necessitatibus repellendus.</p>
            </div>

        </div>       
    </div>

    <div class="footerindex">
        <div class="">
          <?php include('footer-itw.php'); ?>
        </div>
    </div>
    <?php include('script-footer.php'); ?>
    <script>
      $(document).ready(function() {
        $("a[href='about.php']").addClass("active-menu");
      });
    </script>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>