<?php
require '../koneksi/koneksi.php';
session_start();

if ($_SESSION['level'] == "radiographer") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <?php include('head.php'); ?>
    <title>Query | radiology</title>

  </head>

  <body>

    <?php include('menu-bar.php'); ?><br>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb1 breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Query</li>
      </ol>
    </nav>

    <!-- ---------------------------------chart--------------------- -->


    <!-- //////content home/////////////// -->
    <?php include('../query.php'); ?>
    <!-- //////end content home/////////////// -->
    <?php include('script-footer.php'); ?>
    <script>
    $(document).ready(function(){
        $("a[href='query-search.php']").addClass("active-menu");
      });
  </script>


  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>