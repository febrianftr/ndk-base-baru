<?php

require '../koneksi/koneksi.php';

session_start();

$username = $_SESSION['username'];

$result = mysqli_query($conn, "SELECT * FROM xray_template WHERE username = '$username' ");

if ($_SESSION['level'] == "radiology") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>View Template | Radiology</title>
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
                <li class="breadcrumb-item active">View Template</li>
              </ol>
            </nav>
          </div>
          <div class="container-fluid">
            <div class="about-inti back-search" style="padding: 10px;">
              <h1 style="color: #3a9e8a;">View Template</h1>
              <table class="table table-dicom" id="example1" style="margin-top: 0px;" border="1" cellpadding="4" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th><?= $lang['action'] ?></th>
                    <th><?= $lang['name_template'] ?></th>
                  </tr>
                </thead>
              </table>
              <br>

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
        $('.tombol-hapus').on('click', function(e) {
          e.preventDefault();
          const href = $(this).attr('href');
          swal({
              title: "Hapus",
              text: "Yakin ingin menghapus?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((result) => {
              if (result) {
                document.location.href = href;
              }
            })
        });
      });
    </script>
    <script>
      $(document).ready(function() {
        $("li[data-target='#template']").addClass("active");
        $("ul[id='template'] li[id='viewt1']").addClass("active");
      });


      $('document').ready(function() {
        $('#example1').dataTable({
          "paging": false,
          "ordering": false,
          "info": false,
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
            }
          ]
        });
      });
    </script>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>