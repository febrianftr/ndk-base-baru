<?php
require 'function_dokter.php';
session_start();
//ambil data di url
$depid = $_GET["depid"];
$row = query("SELECT * FROM xray_department WHERE depid=$depid")[0];
if( isset($_POST["submit"]) ) {
	if ( ubah_dep($_POST) > 0 ){
		echo "
<script>
	alert('Data Berhasil diubah');
	document.location.href= 'view_departmen.php';
</script>
";
}else {
echo "
<script>
	alert('Data Gagal diubah');
	document.location.href= 'view_departmen.php';
</script>";
}
}
if ($_SESSION['level'] == "admin") {
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Ubah Data Departmen</title>
		<?php include('head.php'); ?>
	</head>
	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="administrator.php">Administrator</a></li>
				<li class="breadcrumb-item"><a href="view_departmen.php">Tabel Departmen</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Data Departmen</li>
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
				<form action="" method="post">
					<input type="hidden" name="depid" value="<?= $row["depid"]; ?>">
					<ul>
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
            <center><p>&copy; Powered by Intiwid IT Solution 2019</a>.</p></center>
          </div> 
        </div>
</div>
</div>
	<?php include('script-footer.php'); ?>

</body>
</html>
<?php } else {header("location:../index.php");} ?>