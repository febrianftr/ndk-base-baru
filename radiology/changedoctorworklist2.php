<?php

require 'function_radiology.php';

session_start();

$uid = $_GET['uid'];

$query1 = mysqli_query($conn, "SELECT * FROM xray_exam2 WHERE uid = '$uid' ");

$row1 = mysqli_fetch_assoc($query1);

$dokradid1 = $row1['dokradid'];

$query = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE NOT dokradid = '$dokradid1' AND NOT dokradid = '5' ");

if (isset($_POST["submit"])) {
	if (ubahdokterworklist($_POST)) {
		echo "
<script>
	alert('Data berhasil dikirimkan');
	document.location.href= 'dicom.php';
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


if ($_SESSION['level'] == "radiology") {
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

		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">About</li>
			</ol>
		</nav>

		<div id="container1">
			<div id="content1">
				<div class="container-fluid">
					<div class="about-inti col-md-6 col-md-offset-3" style="background-color: #f2f2f2;padding: 10px 85px;">

						<form action="" method="post">
							<?php while ($row = mysqli_fetch_assoc($query)) { ?>
								<input type="hidden" name="uid" value="<?= $uid ?>">
								<div class="custom-control custom-radio">
									<input type="radio" class="custom-control-input" id="<?php echo $row['dokradid'] ?>" name="dokradid" value="<?= $row['dokradid'] ?>" required>
									<label class="custom-control-label" for="<?php echo $row['dokradid'] ?>">&nbsp;<h3><?php echo $row['dokrad_name'] . '' . $row['dokrad_lastname'] ?> </h3></label>
								</div>
							<?php } ?>

							<input type="submit" class="btn btn-primary btn-lg" value="Pilih" name="submit">
					</div>
					</form>

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