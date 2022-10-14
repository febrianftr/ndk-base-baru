<?php
	require '../koneksi/koneksi.php';
	session_start();
	@$uid = $_POST['uid'];
	$query = "SELECT *
			FROM xray_exam
			WHERE uid = '$uid' ORDER BY schedule_time";
	$data_dicom = mysqli_query($conn,$query);
	// Insert TEXTAREA POSTINGAN DOKTER
	$query_tampil = "SELECT MAX(template_id) as user_id3 FROM xray_template";
	$result_tampil = mysqli_query($conn, $query_tampil);
	$row_tampil = mysqli_fetch_assoc($result_tampil);
	if (isset($_POST['saveas'])) {
	$pk = $row_tampil['user_id3'] + 1;
	$title = $_POST['title'];
	$fill = $_POST['fill'];
	$typemod = $_POST['typemod'];
	$level = $_POST['level'];
	$username = $_SESSION['username'];
	$query_insert = "INSERT INTO xray_template (template_id, title, fill, typemod, level, username) VALUES ('$pk', '$title', '$fill', '$typemod','$level', '$username')";
	$result = mysqli_query($conn, $query_insert);
	}
	// penutup insert TEXTAREA POSTINGAN DOKTER
	if ($_SESSION['level'] == "radiology") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="css/css-navbar.css">
		
		<?php include('head.php'); ?>
		<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
		<title>Home | radiology</title>
	</head>
	<body>
		<?php include('menu-bar.php'); ?>
		<div class="div-mid2">
			<div class="kotak">
				<div class="info-patient">
					<!-- POP UP INPUT TEMPLATE -->
					<form action="" method="post">
						<textarea class="ckeditor" id="ckeditor" name="fill"></textarea>
						<input type="text" name="title" placeholder="Tittle">
						<?php
						$query_tm = "SELECT * FROM xray_modalitas";
						$result_tm = mysqli_query($conn, $query_tm);
						?>
						<select name="typemod">
							<?php while($row_tm = mysqli_fetch_assoc($result_tm)) : ?>
							<option value="<?php echo $row_tm['typemod']; ?>"><?php echo $row_tm['typemod']; ?></option>
							<?php endwhile; ?>
						</select>
						<select name="level">
							<option value="mytemplate">My Template</option>
							<option value="public">Public</option>
						</select><br>
						<input type="submit" name="saveas" value="save pop up">
					</form>
					<!-- TUTUP POP UP INPUT TEMPLATE -->
				</div>
				
			</div>
			<br/>
		</div>
	</div>
	<!-- <div id="overlay2"></div>
		<div class="wrapper2">
			<div class="container2">
				<div class="pop-up2">
					<div class="pop-body2">
						<a href="#" class="btn-close2">X</a>
						<h3>Report Review</h4>
						
						<embed width="100%" height="500" src="pdf/testpdf3.php" type="application/pdf"></embed>
						
					</div>
				</div>
			</div>
	</div> -->
	<!-- <div id="modal-window">
		<span class="modal-close">&#10006;</span>
		<div class="align-content">
			<div class="content">
				<h3><b>Review Report PDF</b></h3>
				<embed width="100%" height="500" src="pdf/testpdf3.php" type="application/pdf"></embed>
			</div>
		</div>
	</div> -->
	<!-- ========== END MODALS ========== -->
	<?php include('script-footer.php'); ?>
	
	<script>
		$(document).ready(function(){
		$(".data-order").hide();
		$(".button-work-order").click(function(){
		$(".data-order").toggle();
		$(".data-patient").hide();
		});
		});
		$(document).ready(function(){
		$(".data-patient").hide();
		$(".button-work-patient").click(function(){
		$(".data-patient").toggle();
		$(".data-order").hide();
		});
		});
	</script>
</body>
</html>
<?php } else { header("location:../index.php");} ?>