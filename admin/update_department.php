<?php
require 'function_dokter.php';
session_start();
//ambil data di url
$pk = $_GET["pk"];
$row = mysqli_fetch_assoc(mysqli_query(
	$conn,
	"SELECT * FROM xray_department WHERE pk = '$pk'"
));
if (isset($_POST["submit"])) {
	if (update_department($_POST) > 0) {
		echo "<script>
				alert('Data Berhasil diubah');
				document.location.href= 'view_department.php';
			</script>";
	} else {
		echo "<script>
				alert('Data Gagal diubah');
				document.location.href= 'update_department.php?pk=$pk';
			</script>";
	}
}
if ($_SESSION['level'] == "admin") {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Ubah Data Department</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="administrator.php">Administrator</a></li>
				<li class="breadcrumb-item"><a href="view_department.php">Tabel Department</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Data Department</li>
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
					<h1>Ubah Data Department</h1>
					<div class="container-fluid">
						<div class="row form-dokter">
							<form action="" method="post">
								<ul>
									<input type="hidden" name="pk" value="<?= $pk; ?>">
									<li>
										<label for="dep_id"><b>Department ID</b></label><br>
										<input type="text" name="dep_id" id="dep_id" required value="<?= $row["dep_id"]; ?>">
									</li>
									<li>
										<label for="name_dep"><b>Nama Department</b></label><br>
										<input type="text" name="name_dep" id="name_dep" required value="<?= $row["name_dep"]; ?>">
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