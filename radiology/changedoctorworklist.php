<?php

require 'function_radiology.php';
require '../model/query-base-dokter-radiology.php';

session_start();

$uid = $_GET['uid'];

$query = mysqli_query(
	$conn,
	"SELECT $select_dokter_radiology 
	FROM $table_dokter_radiology"
);

if (isset($_POST["submit"])) {
	if (ubahdokterworklist($_POST)) {
		echo "
			<script>
				alert('Data berhasil dikirimkan');
				document.location.href= 'dicom.php';
			</script>";
	} else {
		echo "
			<script>
				alert('data gagal dikirimkan');
				document.location.href= 'changedoctorworklist.php?dokradid=$dokradid';
			</script>";
	}
}

if ($_SESSION['level'] == "radiology" || $_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Ubah</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('sidebar.php'); ?>
		<div class="container" id="main">
			<div class="row">
				<div id="content1">
					<div class="container-fluid">
						<div class="about-inti col-md-6 col-md-offset-3" style="background-color: #f2f2f2;padding: 10px 85px;">
							<form action="" method="post">
								<?php while ($row = mysqli_fetch_assoc($query)) { ?>
									<input type="hidden" name="uid" value="<?= $uid ?>">
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" id="<?php echo $row['dokradid'] ?>" name="dokradid" value="<?= $row['dokradid'] ?>" required>
										<label class="custom-control-label" for="<?php echo $row['dokradid'] ?>">
											&nbsp;
											<h3><?= ucwords($row['dokrad_fullname']); ?> </h3>
										</label>
									</div>
								<?php } ?>
								<input type="submit" class="btn btn-primary btn-lg" value="Pilih" name="submit">
						</div>
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