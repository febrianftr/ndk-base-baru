<?php

require 'function_radiographer.php';

session_start();

$uid = $_GET['uid'];

$query1 = mysqli_query($conn, "SELECT * FROM xray_exam2 WHERE uid = '$uid' ");

$row1 = mysqli_fetch_assoc($query1);

$dokradid1 = $row1['dokradid'];

$query4 = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE NOT dokradid = '$dokradid1' AND NOT dokradid = '5' ");
$count = mysqli_num_rows($query4);

if (isset($_POST["submit"])) {
	if (ubahdokterworklist($_POST)) {
		echo "
<script>
	alert('Data berhasil dikirimkan');
	document.location.href= 'workload.php';
</script>
";
	} else {
		echo "
<script>
	alert('data gagal dikirimkan');
	document.location.href= 'changedoctorworklist.php?dokradid=$dokradid';
</script>";
	}
}
// if (isset($_POST['submit'])) {
// 	echo $_POST['dokradid'];
// 	echo $_POST['uid'];
// }


if ($_SESSION['level'] == "radiographer") {
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
		<div class="container-fluid" id="main">
			<div class="row">

				<div id="content1">
					<div class="container">
						<div class="about-inti col-md-7" style="background-color: #f2f2f2;padding: 10px 85px;">

							<form action="" method="post">

								<?php while ($row = mysqli_fetch_assoc($query4)) { ?>
									<input type="hidden" name="uid" value="<?= $uid ?>">
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" id="<?php echo $row['dokradid'] ?>" name="dokradid" value="<?= $row['dokradid'] ?>" required>
										<label class="custom-control-label" for="<?php echo $row['dokradid'] ?>">&nbsp;<h4 style="margin: -20px 0 25px 0; cursor:pointer;"><?php echo $row['dokrad_name'] . '' . $row['dokrad_lastname'] ?> </h4></label>
									</div>
								<?php } ?>

								<input type="submit" class="btn btn-primary btn-lg" value="Pilih" name="submit">

							</form>
						</div>
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