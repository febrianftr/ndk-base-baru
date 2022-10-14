<?php

require 'function_radiology.php';

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
  document.location.href= 'view_template.php';
</script>";
  }
}

if ($_SESSION['level'] == "radiology") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <title>New Template | Radiology</title>
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
										<li class="breadcrumb-item active">New Template Expertise</li>
									</ol>
								</nav>
							</div>
            <div class="container">
              <div class="row">
                <div class="about-inti col-md-12 back-search" style="padding: 10px;">
                  <h1 style="color: #3a9e8a;"><?= $lang['create_template'] ?></h1>
                  <form action="" method="post">
                    <input class="form-control" type="text" name="title" placeholder="Insert tittle.." style="width: 100%">
                    <textarea class="ckeditor" name="fill" style="width: 100%; height: 250px;" id="ckeditor"></textarea>
                    <br>
                    <button class="btn btn-worklist btn-expertise waves-effect waves-light" type="submit" name="submit"><?= $lang['save_template'] ?></button>
                  </form>
                </div>
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
			$(document).ready(function(){
			$("li[data-target='#template']").addClass("active");
			$("ul[id='template'] li[id='newt1']").addClass("active");
      		});
		</script>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>