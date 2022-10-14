<?php
require 'function_dokter.php';
session_start();

//ambil data di url
$idharga = $_GET["idharga"];
$row = query("SELECT * FROM xray_price WHERE idharga=$idharga")[0];
if( isset($_POST["submit"]) ) {
	if ( ubah_price($_POST) > 0 ){
		echo "
<script>
	alert('Data Berhasil diubah');
	document.location.href= 'view_price.php';
</script>
";
}else {
echo "
<script>
	alert('Data Gagal diubah');
	document.location.href= 'view_price.php';
</script>";
}
}
if ($_SESSION['level'] == "admin") {
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Ubah Data Prosedur</title>
		<?php include('head.php'); ?>
	</head>
	<body>
		<?php include('menu-bar.php'); ?><br>
		
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item"><a href="administrator.php">Administrator</a></li>
				<li class="breadcrumb-item"><a href="view_price.php">Tabel Harga</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Data Harga</li>
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
		<h1>Ubah Data Harga</h1>
		<div class="container-fluid">
			<div class="row form-dokter">
				<form action="" method="post">
					<input type="hidden" name="idharga" value="<?= $row["idharga"]; ?>">
					<ul>
						<li>
							<!-- <label for="code_xray"><b>Kode X-Ray</b></label><br> -->
							<!-- <input type="text" name="code_xray" id="code_xray" required value="<?= $row["code_xray"]; ?>"> -->
						</li>
						<label for="type"><b><?= $lang['pro_type'] ?></b></label><br>
						<?php 
							$type = $row['type'];
							$result = mysqli_query($conn, "SELECT * FROM xray_modalitas ORDER BY xray_type_code ASC ");
						?>
						<select id="idmod" name="idmod">
							<option>---Select Modality---</option>
							<?php 
							while($row1 = mysqli_fetch_assoc($result)){  
								$xray_type_code = $row1['xray_type_code'];
								$selected = "";
								if ($type === $xray_type_code ){
								$selected = "selected";
							}
							?>
								<option value="<?= $row1['idmod']; ?>" <?php echo $selected; ?> ><?= $row1['xray_type_code']; ?></option>
							<?php } ?>
						</select>
						<li>
							<label for="prosedur"><b>Study Desc</b></label><br>
							<input type="text" name="main_prosedur" id="main_prosedur" required value="<?= $row["main_prosedur"]; ?>">
						</li>
						<li>
							<!-- <label for="prosedur"><b>Series Desc</b></label><br> -->
							<!-- <input type="text" name="prosedur" id="prosedur" required value="<?= $row["prosedur"]; ?>"> -->
						</li>
						<li>
							<label for="price"><b>harga</b></label><br>
							<input type="text" name="price" id="price" required value="<?= $row["price"]; ?>">
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