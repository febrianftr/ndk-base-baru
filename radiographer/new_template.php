<?php

require 'function_radiographer.php';

session_start();

if (isset($_POST["submit"])) {
  if (new_temp($_POST) > 0) {
    echo "
<script>
  alert('Template Berhasil ditambahkan');
  document.location.href= 'view_template.php';
</script>
";
  } else {
    echo "
<script>
  alert('Template Gagal ditambahkan');
  document.location.href= 'new_template.php';
</script>";
  }
}

$result = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology");

if ($_SESSION['level'] == "radiographer") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>Create Template | radiographer</title>
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
                  New Template
                </li>
              </ol>
            </nav>
          </div>
          <div class="container">

            <div class="about-inti back-search" style="padding: 10px;">

              <h1><?= $lang['create_template'] ?></h1>

              <form action="" method="post">
                <input class="form-control" type="text" name="title" placeholder="<?= $lang['insert_tittle'] ?>.." style="width: 100%; margin-bottom: 7px;">
                <textarea class="ckeditor" name="fill" style="width: 100%; height: 250px;" id="ckeditor"></textarea>
                <select name="username">
                  <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?= $row['username']; ?>"><?= $row['dokrad_name'] . ' ' . $row['dokrad_lastname']; ?></option>
                  <?php } ?>
                </select>
                <br>
                <button class="btn-worklist" type="submit" name="submit"><?= $lang['save_template'] ?></button>
                <a href="view_template.php" class="btn btn-worklist3 waves-effect waves-light" style="box-shadow: none; font-size: 11px;">View Template</a>
              </form>
            </div>
          </div>
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
        $("li[id='settings1']").addClass("active");
      });
    </script>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>