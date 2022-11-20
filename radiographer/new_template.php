<?php

session_start();

if ($_SESSION['level'] == "radiographer") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>Create Template</title>
    <?php include('head.php'); ?>
  </head>

  <body>

    <?php include('sidebar.php'); ?>
    <div class="container-fluid" id="main">
      <?php include('../template-create.php'); ?>
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
<?php } else {
  header("location:../index.php");
} ?>