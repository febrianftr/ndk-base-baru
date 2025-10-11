<?php
require '../koneksi/koneksi.php';
session_start();

// --------------------------------

if ($_SESSION['level'] == "radiology") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html>

    <head>
        <title>Workload Patient Detail | Radiology</title>
        <?php include('head.php'); ?>
    </head>

    <body>
        <?php include('../sidebar-index.php'); ?>
        <div class="container-fluid" id="content2">
            <div class="row">
                <?php include('../workload-patient-detail-index.php'); ?>
            </div>
        </div>
        <br><br>

        <?php include('script-footer.php'); ?>
    </body>

    </html>
    <script>
        $(document).ready(function() {
            $("li[data-target='#service']").addClass("active");
            $("ul[id='service'] li[id='expertise']").addClass("active");
            $("li[data-target='#service'] a i").css('color', '#bdbdbd');
        });
    </script>
<?php } else {
    header("location:../index.php");
} ?>