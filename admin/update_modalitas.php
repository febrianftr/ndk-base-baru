<?php
require 'function_dokter.php';
session_start();

//ambil data di url
$idmod = $_GET["idmod"];
$row = query("SELECT * FROM xray_modalitas WHERE idmod=$idmod")[0];
if (isset($_POST["submit"])) {
	if (ubah_mod($_POST) > 0) {
		echo "
<script>
	alert('Data Berhasil diubah');
	document.location.href= 'view_modalitas.php';
</script>
";
	} else {
		echo "
<script>
	alert('Data Gagal diubah');
	document.location.href= 'view_modalitas.php';
</script>";
	}
}
if ($_SESSION['level'] == "admin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Ubah Data Modalitas</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="administrator.php">Administrator</a></li>
				<li class="breadcrumb-item"><a href="view_modalitas.php">Tabel Modalitas</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Data Modalitas</li>
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
					<h1>Ubah Data Departmen</h1>
					<div class="container-fluid">
						<div class="row form-dokter">
							<form action="" method="post" enctype="multipart/form-data">
								<input type="hidden" name="idmod" value="<?= $row["idmod"]; ?>">
								<ul>
									<li>
										<label><b>Pilih Kode Modalitas</b></label><br>
										<input type="text" name="xray_type_code" readonly="" value="<?= $row["xray_type_code"]; ?>">
										<p>Jika ingin edit kode modalitas. mohon hapus data, lalu buat data baru..</p>
									</li>

									<li>
										<label for="typename"><b>Nama Tipe</b></label><br>
										<input type="text" name="typename" id="typename" value="<?= $row["typename"]; ?>">
									</li>
									<li>
										<label for="imgmod"><b>Image Modality</b></label><br>
										<img style="width: 200px;" src="../gambar/<?= $row["imgmod"]; ?>">
										<input type="file" name="file">
										<input type="hidden" name="fileupdate" value="<?= $row["imgmod"]; ?>">
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