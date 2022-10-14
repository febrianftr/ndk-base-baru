<?php
require '../koneksi/koneksi.php';
session_start();

if ($_SESSION['level'] == "radiology") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <?php include('head.php'); ?>
    <title>Query Search | Radiology</title>

  </head>

  <body>
    <?php include('sidebar.php'); ?>
    <div class="container-fluid" id="main">
        <div class="row">
              <div class="col-12" style="padding-left: 0;">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="index.php">Home</a></li>
										<li class="breadcrumb-item active">Query Search</li>
									</ol>
								</nav>
							</div>

          <!-- //////content home/////////////// -->
          <?php include('../query.php'); ?>
          <!-- //////end content home/////////////// -->

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
			$("li[data-target='#service']").addClass("active");
			$("ul[id='service'] li[id='query1']").addClass("active");
      		});
		</script>


  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>