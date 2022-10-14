<?php
require 'function_radiographer.php';
session_start();
//ambil data di url
$template_id = $_GET["template_id"];
// $jml = mysqli_num_rows($result2);
if (isset($_POST["submit"])) {
	if (ubah_temp_new($_POST) > 0) {
		echo "
<script>
	alert('Data Berhasil diubah');
	document.location.href= 'view_template.php';
</script>
";
	} else {
		echo "
<script>
	alert('Data Gagal diubah');
	document.location.href= 'view_template.php';
</script>";
	}
}
$result = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology");
if ($_SESSION['level'] == "radiographer") {
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

				<div class="col-12" style="padding-left: 0;">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
							<li class="breadcrumb-item"><a href="view_template.php">Tabel template</a></li>
							<li class="breadcrumb-item active" aria-current="page">Edit Data template</li>
						</ol>
					</nav>
				</div>

				<div class="container-fluid">

					<div class="form-template col-12 col-md-offset-2">
						<h1><?= $lang['create_template'] ?></h1>
						<?php
						$result2 =  mysqli_query($conn, "SELECT * FROM xray_template WHERE template_id = '$template_id' ");
						$row2 = mysqli_fetch_assoc($result2);
						
						?>
						<form action="" method="post">
							<input type="hidden" name="template_id" value="<?= $row2["template_id"]; ?>">

							<label for="title"><b><?= $lang['title'] ?></b></label><br>
							<input class="form-control" type="text" name="title" id="title" required value="<?= $row2["title"]; ?>">

							<label for="fill"><b>Fill</b></label><br>
							<textarea class="ckeditor" id="ckeditor" name="fill" id="fill"> <?= $row2["fill"]; ?> </textarea>

							<label for="dokter"><b><?= $lang['radiology_physician'] ?></b></label><br>
							<select name="username">
								<?php while ($row = mysqli_fetch_assoc($result)) { ?>
									<option value="<?= $row['username']; ?>"><?= $row['dokrad_name'] . ' ' . $row['dokrad_lastname']; ?></option>
								<?php } ?>
							</select>

							<button class="btn-worklist" type="submit" name="submit"><?= $lang['save_template'] ?></button>


						</form>
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