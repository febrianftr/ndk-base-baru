<?php

require 'function_radiographer.php';
require '../default-value.php';
require '../model/query-base-update-expdate.php';
require '../model/query-base-study.php';
require '../model/query-base-order.php';
require '../model/query-base-patient.php';
require '../model/query-base-workload.php';
session_start();
$uid = $_GET['uid'];

$row_update_expdate = mysqli_fetch_assoc(mysqli_query(
	$conn,
	"SELECT $select_expdate,
	pat_name,
	prosedur,
	mods_in_study
	FROM $table_expdate 
	RIGHT JOIN $table_study
	ON study.study_iuid = xray_workload.uid
	JOIN $table_patient
	ON patient.pk = study.patient_fk
	LEFT JOIN $table_order
    ON xray_order.uid = study.study_iuid
	WHERE study_iuid = '$uid'
	"
));
// $is_taken = $row_update_expdate['is_taken'];
if (isset($_POST["update_expdate"])) {
	if (update_expdate($_POST)) {
		echo "<script type='text/javascript'>
			setTimeout(function () { 
			swal({
					title: 'Berhasil Update Expired Date!',
					text:  '',
					icon: 'success',
					timer: 1000,
					showConfirmButton: true
				});  
			},10); 
			window.setTimeout(function(){ 
			document.location.href= 'workload.php';
			} ,1000); 
		</script>";
	} else {
		echo "<script type='text/javascript'>
			setTimeout(function () { 
			swal({
					title: 'Gagal Update Expired Date!',
					text:  '',
					icon: 'error',
					timer: 1000,
					showConfirmButton: true
				});  
			},10); 
			window.setTimeout(function(){ 
			history.back();
			} ,1000); 
		</script>";
	}
}

if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Update Exp Date</title>
		<script type="text/javascript" src="../js/sweetalert.min.js" />
		</script>
		<?php include('head.php'); ?>
	</head>

	<body style="background-color: #1f69b7;">
		<?php include('../sidebar-index.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">
				<div id="content1">
					<form action="" method="post">
						<div class="d-flex justify-content-center align-items-center">
							<div class="col-md-6 box-change-dokter table-box">
								<form method="post" id="take-envelope">
									<div class="radiobtn1">
										<div class='alert alert-info' role='alert'>Pasien <?= removeCharacter(defaultValue($row_update_expdate['pat_name'])); ?>, modalitas <?= defaultValue($row_update_expdate['mods_in_study']); ?>, Pemeriksaan <?= defaultValue($row_update_expdate['prosedur']); ?></div>
										<input type="hidden" id="study_iuid" name="study_iuid" value="<?= $uid; ?>">
										<label for="qr_expdate">Expired Date</label><br>
										<input type="text" class="form-control" name="expdate" id="expdate" value="<?= date('d-m-Y', strtotime($row_update_expdate['qr_expdate'])); ?>" readonly>
										<br>
										<br>
										<label for="add_date">Pilih Jangka Waktu Aktif</label><br>
										<div style="background-color: black; padding: 12px; border-radius: 4px; border: 1px solid #ced4da;">
											<label class="radio-admin">
												<input type="radio" name="add_date" id="add_date" value="30"> 30 Hari
												<span class="checkmark"></span>
											</label>
											<label class="radio-admin">
												<input type="radio" name="add_date" id="add_date" value="60"> 60 Hari
												<span class="checkmark"></span>
											</label>
											<label class="radio-admin">
												<input type="radio" name="add_date" id="add_date" value="90"> 90 Hari
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
									<!-- <button type="submit" name="update_expdate">Tombol</button> -->
									<button class="btn-worklist3 btn-lg" type="submit" name="update_expdate" style="margin: 10px 0; float:right;">
										<span class="spinner-grow spinner-grow-sm loading" role="status" aria-hidden="true"></span>
										<p class="loading" style="display:inline;">Loading...</p>
										<!-- <i class="fas fa-envelope"></i> -->
										<p class="ubah" style="display:inline;">Update</p>
									</button>
								</form>
							</div>
						</div>
					</form>
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
	<script src="../js/proses/take-envelope.js?v=<?= $random; ?>"></script>
	<script>
		$('#created_at').datetimepicker({
			format: 'd-m-Y H:i',
			step: 1
		});
	</script>

	</html>
<?php } else {
	header("location:../index.php");
} ?>