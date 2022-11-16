<?php
require 'function_dokter.php';
session_start();

//ambil data di url
$dokradid = $_GET["dokradid"];
$dktr1 = query("SELECT * FROM xray_dokter_radiology WHERE dokradid=$dokradid")[0];
if (isset($_POST["submit"])) {
	if (ubah_rad($_POST) > 0) {
		echo "
<script>
	alert('Data Berhasil diubah');
	document.location.href= 'view_dokter_radiology.php';
</script>
";
	} else {
		echo "
<script>
	alert('Data Gagal diubah');
	document.location.href= 'update_dokter_radiology.php';
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
				<li class="breadcrumb-item"><a href="view_dokter_radiology.php">Tabel Dokter Radiology</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Data Dokter Radiology</li>
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
							<form action="" method="post" enctype="multipart/form-data">
								<input type="hidden" name="pk" value="<?= $dktr1["pk"]; ?>">
								<ul>
									<li>
										<label for="dokradid"><b>Kode Dokter Radiology</b></label><br>
										<input type="text" name="dokradid" id="dokradid" required value="<?= $dktr1["dokradid"]; ?>">
									</li>
									<li>
										<label for="dokrad_name"><b>Nama Depan</b></label><br>
										<input type="text" name="dokrad_name" id="dokrad_name" required value="<?= $dktr1["dokrad_name"]; ?>">
									</li>
									<li>
										<label for="dokrad_lastname"><b>Nama Belakang</b></label><br>
										<input type="text" name="dokrad_lastname" id="dokrad_lastname" value="<?= $dktr1["dokrad_lastname"]; ?>">
									</li>
									<label for="dokrad_sex"><b>Jenis Kelamin</b></label><br>
									<label class="radio-admin">
										<input type="radio" name="dokrad_sex" <?php if ($dktr1["dokrad_sex"] == 'Laki-Laki') {
																					echo 'checked';
																				} ?> value="Laki-Laki" required> Laki - laki
										<span class="checkmark"></span>
									</label><br>
									<label class="radio-admin">
										<input type="radio" name="dokrad_sex" <?php if ($dktr1["dokrad_sex"] == 'Perempuan') {
																					echo 'checked';
																				} ?> value="Perempuan" required> Perempuan
										<span class="checkmark"></span>
									</label><br>
									<label class="radio-admin">
										<input type="radio" name="dokrad_sex" <?php if ($dktr1["dokrad_sex"] == 'Other') {
																					echo 'checked';
																				} ?> value="Other" required> Other
										<span class="checkmark"></span>
									</label>
									<!--
											<input type="radio" name="dokrad_sex"	value="Laki-Laki" required>laki-laki</input>
						<input type="radio" name="dokrad_sex" value="Perempuan" required>perempuan</input><br> -->
									<li><br>
										<label for="dokrad_tlp"><b>Masukan tlp</b></label><br>
										<input type="text" name="dokrad_tlp" id="dokrad_tlp" required value="<?= $dktr1["dokrad_tlp"]; ?>">
									</li>
									<li><br>
										<label for="dokrad_email"><b>Masukan email</b></label><br>
										<input type="text" name="dokrad_email" id="dokrad_email" required value="<?= $dktr1["dokrad_email"]; ?>">
									</li>
									<!-- <li><br>
							<label for="dokrad_img"><b>Masukan Image Profil</b></label><br>
							<img style="width: 200px;" src="../image/<?= $dktr1['dokrad_img']; ?>">
							<input type="file" name="file">
						</li> -->
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
							<p>&copy; Powered by Intiwid IT Solution 2022</a>.</p>
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