<?php
require 'function_dokter.php';
session_start();

if (isset($_POST["submit"])) {
	tambah($_POST);
	echo "<script>alert('Data berhasil dimasukkan');
document.location.href='view_dokter.php';
</script>";
}
if ($_SESSION['level'] == "admin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Tambah Data Dokter</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $lang['new_doctor'] ?></li>
				<li style="float: right;">
					<label>Zoom</label>
					<a href="#" id="decfont"><i class="fas fa-minus-circle"></i></a>
					<a href="#" id="incfont"><i class="fas fa-plus-circle"></i></a>
				</li>
			</ol>
		</nav>

		<div id="container1">
			<div id="content1">
				<div class="body">
					<h1 style="color: #ee7423"><?= $lang['add_new_doctor'] ?></h1>
					<div class="container-fluid">
						<div class="row form-dokter">
							<form action="" method="post">

								<div class="col-md-5 col-md-offset-1">
									<label for="named"><b><?= $lang['f_name'] ?> </b></label><br>
									<input type="text" name="named" id="named" placeholder="<?= $lang['input_f_name'] ?>" required>


									<label for="lastnamed"><b><?= $lang['l_name'] ?></b></label><br>
									<input type="text" name="lastnamed" id="lastnamed" placeholder="<?= $lang['input_l_name'] ?>">

									<label for="username"><b>Username</b></label><br>
									<input type="text" name="username" id="username" placeholder="input username...">

									<label for="password"><b>Password</b></label><br>
									<input type="password" name="password" id="password" placeholder="<?= $lang['input_pw'] ?>" required>

									<br><br>
									<button class="button1" type="submit" name="submit"><?= $lang['add_data'] ?></button>


								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="footerindex">
				<div class="">
					<div class="footer-login col-sm-12"><br>
						<center>
							<p>&copy; Powered by Intiwid IT Solution 2019</a>.</p>
						</center>
					</div>
				</div>
			</div>
		</div>
		<?php include('script-footer.php'); ?>

	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>