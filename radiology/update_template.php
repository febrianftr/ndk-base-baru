<?php
require 'function_radiology.php';
session_start();
//ambil data di url
$template_id = $_GET["template_id"];
$result =  mysqli_query($conn, "SELECT * FROM xray_template WHERE template_id = '$template_id' ");
$row = mysqli_fetch_assoc($result);
if (isset($_POST["submit"])) {
	if (update_template($_POST) > 0) {
		echo "<script type='text/javascript'>
            setTimeout(function () { 
            swal({
                    title: 'Berhasil Diinput!',
                    text:  '',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: true
                });  
            },10); 
            window.setTimeout(function(){ 
            window.location.replace('view_template.php');
            } ,1000); 
        </script>";
	} else {
		echo "<script type='text/javascript'>
            setTimeout(function () { 
            swal({
                    title: 'Gagal Diinput!',
                    text:  '',
                    icon: 'error',
                    timer: 1000,
                    showConfirmButton: true
                });  
            },10);
        </script>";
	}
}
if ($_SESSION['level'] == "radiology") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Ubah Data template</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('sidebar.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">
				<div id="content1">
					<div class="col-md-12">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
								<li class="breadcrumb-item"><a href="view_template.php">Tabel template</a></li>
								<li class="breadcrumb-item active" aria-current="page">Edit Data template</li>
							</ol>
						</nav>
					</div>

					<div class="container-fluid">

						<div class="about-inti table-box">
							<h1><?= $lang['create_template']; ?></h1>
							<div class="container-fluid">
								<div class="form-template">
									<form action="" method="post">
										<input type="hidden" name="template_id" value="<?= $row["template_id"]; ?>">
										<ul>
											<li>
												<input class="form-control" type="text" name="title" id="title" required value="<?= $row["title"]; ?>" style="width: 100%">
											</li>
											<li>
												<textarea class="ckeditor" id="ckeditor" name="fill" id="fill"> <?= $row["fill"]; ?> </textarea>
											</li>
											<br>
											<li>
												<button class="btn btn-worklist" type="submit" name="submit"><?= $lang['save_template'] ?></button>
											</li>
										</ul>
									</form>
								</div>
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

	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>