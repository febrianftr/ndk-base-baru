<?php
require 'function_dokter.php';
session_start();

if (isset($_POST["submit"])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordulang = $_POST['passwordulang'];
	$result = mysqli_query($conn, "SELECT * FROM xray_login INNER JOIN xray_superadmin ON xray_login.username = '$username' = xray_superadmin.username = '$username' ");
	$row = mysqli_fetch_assoc($result);
	$cek = mysqli_num_rows($result);
	if ($cek > 0) {
		echo "<script>alert('username sudah ada');</script>";
	} else {
		if ($password == $passwordulang) {
			superadmin_tambah($_POST);
			echo "<script>alert('Data berhasil dimasukkan');
document.location.href='view_superadmin.php';
</script>";
		} else {
			echo "<script>alert('password tidak sama');</script>";
		}
	}
}
if ($_SESSION['level'] == "admin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Tambah Data SuperAdmin</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="administrator.php">Administrator</a></li>
				<li class="breadcrumb-item active" aria-current="page">SuperAdmin New</li>
				<li style="float: right;">
					<label>Zoom</label>
					<a href="#" id="decfont"><i class="fas fa-minus-circle"></i></a>
					<a href="#" id="incfont"><i class="fas fa-plus-circle"></i></a>
				</li>
			</ol>
		</nav>

		<div class="body">
			<h1 style="color: #ee7423">Tambah Data SuperAdmin</h1>
			<div class="container-fluid">
				<div class="row form-dokter">
					<form action="" method="post">

						<div class="col-md-5 col-md-offset-1">
							<label for="sa_name"><b>Nama Depan </b></label><br>
							<input type="text" name="sa_name" id="sa_name" placeholder="Masukan nama depan.." required>


							<label for="sa_lastname"><b>Nama Belakang</b></label><br>
							<input type="text" name="sa_lastname" id="sa_lastname" placeholder="Masukan nama akhir..">
							<br>
							<label for="username"><b>Masukan username</b></label><br>
							<input type="text" name="username" id="username" placeholder="Masukan username.." required>
						</div>
						<div class="col-md-5">
							<label for="contract_password"><b>Masukan password contract</b></label><br>
							<input type="password" name="contract_password" id="contract_password" placeholder="Masukan password contract.." required>

							<label for="password"><b>Masukan password</b></label><br>
							<input type="password" name="password" id="password" placeholder="Masukan password.." required>


							<label for="passwordulang"><b>Masukan password ulang</b></label><br>
							<input type="password" name="passwordulang" id="passwordulang" placeholder="Ulangi password.." required>


							<button class="button1" type="submit" name="submit">Tambah Data</button>
						</div>

					</form>
				</div>
			</div>
		</div>
		<?php include('script-footer.php'); ?>
		<div class="footerindex">
			<div class="">
				<div class="footer-login col-sm-12"><br>
					<center>
						<p>&copy; Powered by Intiwid IT Solution 2019</a>.</p>
					</center>
				</div>
			</div>
		</div>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>