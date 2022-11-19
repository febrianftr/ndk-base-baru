<?php

require '../koneksi/koneksi.php';

session_start();

$username = $_SESSION['username'];

$result = mysqli_query($conn, "SELECT * FROM xray_template ");

if ($_SESSION['level'] == "radiographer") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>View Template | radiographer</title>
    <?php include('head.php'); ?>
  </head>

  <body>

    <?php include('sidebar.php'); ?>
    <div class="container-fluid" id="main">
      <div class="row">

        <div id="content1">
          <div class="col-12" style="padding-left: 0;">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">
                  View Template
                </li>
              </ol>
            </nav>
          </div>
          <div class="container-fluid">
            <div class="about-inti back-search" style="padding: 10px;">
              <table class="table table-dicom" id="example1" style="margin-top: 0px;" border="1" cellpadding="8" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th><?= $lang['action'] ?></th>
                    <th><?= $lang['name_template'] ?></th>
                    <th><?= $lang['name'] ?></th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
        <?php require '../modal.php'; ?>
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
          "url": "getTemplate.php",
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