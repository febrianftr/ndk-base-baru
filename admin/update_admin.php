<?php
require 'function_dokter.php';
session_start();
//ambil data di url
$admin_id = $_GET["admin_id"];
$dktr = query("SELECT * FROM xray_admin WHERE admin_id=$admin_id")[0];
if( isset($_POST["submit"]) ) {
	if ( ubah_admin($_POST) > 0 ){
		echo "
<script>
	alert('Data Berhasil diubah');
	document.location.href= 'view_admin.php';
</script>
";
}else {
echo "
<script>
	alert('Data Gagal diubah');
	document.location.href= 'view_admin.php';
</script>";
}
}
if ($_SESSION['level'] == "admin") {
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Ubah Data admin</title>
		<?php include('head.php'); ?>
	</head>
	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="administrator.php">Administrator</a></li>
				<li class="breadcrumb-item"><a href="view_admin.php">Tabel admin</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Data admin</li>
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
		<h1>Ubah Data admin</h1>
		<div class="container-fluid">
			<div class="row form-dokter">
				<form action="" method="post">
					<input type="hidden" name="admin_id" value="<?= $dktr["admin_id"]; ?>">
					<ul>
						<li>
							<label for="ad_name"><b>Nama Depan</b></label><br>
							<input type="text" name="ad_name" id="ad_name" required value="<?= $dktr["ad_name"]; ?>">
						</li>
						<li>
							<label for="ad_lastname"><b>Nama Belakang</b></label><br>
							<input type="text" name="ad_lastname" id="ad_lastname" value="<?= $dktr["ad_lastname"]; ?>">
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