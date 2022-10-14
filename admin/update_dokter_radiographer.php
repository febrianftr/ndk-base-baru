<?php
require 'function_dokter.php';
session_start();

//ambil data di url
$radiographer_id = $_GET["radiographer_id"];
$dktr = query("SELECT * FROM xray_radiographer WHERE radiographer_id=$radiographer_id")[0];
if (isset($_POST["submit"])) {
	if (ubah_grapher($_POST) > 0) {
		echo "
<script>
	alert('Data Berhasil diubah');
	document.location.href= 'view_dokter_radiographer.php';
</script>
";
	} else {
		echo "
<script>
	alert('Data Gagal diubah');
	document.location.href= 'update_dokter_radiographer.php';
</script>";
	}
}
if ($_SESSION['level'] == "admin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Ubah Data Dokter</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="administrator.php">Administrator</a></li>
				<li class="breadcrumb-item"><a href="view_dokter_radiographer.php">Tabel Dokter Radiographer</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Data Dokter Radiographer</li>
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
					<h1>Ubah Data Dokter</h1>
					<div class="container-fluid">
						<div class="row form-dokter">
							<form action="" method="post">
								<input type="hidden" name="radiographer_id" value="<?= $dktr["radiographer_id"]; ?>">
								<ul>
									<li>
										<label for="radiographer_name"><b>Nama Depan</b></label><br>
										<input type="text" name="radiographer_name" id="radiographer_name" required value="<?= $dktr["radiographer_name"]; ?>">
									</li>
									<li>
										<label for="radiographer_lastname"><b>Nama Belakang</b></label><br>
										<input type="text" name="radiographer_lastname" id="radiographer_lastname" value="<?= $dktr["radiographer_lastname"]; ?>">
									</li>
									<label for="radiographer_sex"><b>Jenis Kelamin</b></label><br>
									<label class="radio-admin">
										<input type="radio" name="radiographer_sex" <?php if ($dktr["radiographer_sex"] == 'Laki-Laki') {
																						echo 'checked';
																					} ?> value="Laki-Laki" required> Laki - laki
										<span class="checkmark"></span>
									</label><br>
									<label class="radio-admin">
										<input type="radio" name="radiographer_sex" <?php if ($dktr["radiographer_sex"] == 'Perempuan') {
																						echo 'checked';
																					} ?> value="Perempuan" required> Perempuan
										<span class="checkmark"></span>
									</label><br>
									<label class="radio-admin">
										<input type="radio" name="radiographer_sex" <?php if ($dktr["radiographer_sex"] == 'Other') {
																						echo 'checked';
																					} ?> value="Other" required> Other
										<span class="checkmark"></span>
									</label>
									<!-- 	<input type="radio" name="radiographer_sex"	value="Laki-Laki" required>laki-laki</input>
						<input type="radio" name="radiographer_sex" value="Perempuan" required>perempuan</input> --><br>
									<li><br>
										<label for="radiographer_tlp"><b>Masukan telepon</b></label><br>
										<input type="text" name="radiographer_tlp" id="radiographer_tlp" required value="<?= $dktr["radiographer_tlp"]; ?>">
									</li>
									<li><br>
										<label for="radiographer_email"><b>Masukan email</b></label><br>
										<input type="text" name="radiographer_email" id="radiographer_email" required value="<?= $dktr["radiographer_email"]; ?>">
									</li>
									<li>
										<button class="button1" type="submit" name="submit">Ubah Data</button>
									</li>
								</ul>

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