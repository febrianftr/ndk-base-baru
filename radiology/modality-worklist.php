<?php
require '../koneksi/koneksi.php';
session_start();

if ($_SESSION['level'] == "radiology") {
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include('head.php'); ?>
    <title>Modality Worklist | Radiology</title>
    <script type="text/javascript" src="js/Chart.js"></script>
    <style type="text/css">
    body{
    font-family: roboto;
    }
    table{
    margin: 0px auto;
    }

    canvas {
  border: 2px solid rgb(151, 149, 149);
}

    </style>

  </head>
 <body>

<?php include('menu-bar.php'); ?><br>  
    <!-- ---------------------------------chart--------------------- -->
    

    <!-- //////content home/////////////// -->
  <?php include('../modality-worklist.php'); ?>
    <!-- //////end content home/////////////// -->
        <?php include('script-footer.php'); ?>

       
  </body>
</html>
<?php } else { header("location:../index.php");} ?>