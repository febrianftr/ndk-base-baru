<?php
require '../koneksi/koneksi.php';
require '../default-value.php';
require '../model/query-base-study.php';
require '../model/query-base-patient.php';

session_start();
$uid = $_GET['uid'];

$row = mysqli_fetch_assoc(mysqli_query(
	$conn_pacsio,
	"SELECT 
	study.pk AS pk_study,
	pat_id,
	pat_name,
	pat_sex,
	study_desc,
	mods_in_study,
	accession_no
	FROM $table_patient
	JOIN $table_study
	ON patient.pk = study.patient_fk
	WHERE study_iuid = '$uid'"
));

$pat_name = defaultValue($row['pat_name']);
$pat_id = defaultValue($row['pat_id']);
$pat_sex = styleSex($row['pat_sex']);
$mods_in_study = defaultValue($row['mods_in_study']);
$study_desc = defaultValue($row['study_desc']);
$acc = defaultValue($row['accession_no']);
$pk_study = defaultValue($row['pk_study']);

if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Send Dicom</title>
		<script type="text/javascript" src="../js/sweetalert.min.js" />
		</script>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('../sidebar-index.php'); ?>
		<div class="container-fluid" id="content2">
			<div class="row">
				<div id="content1">
					<div class="d-flex justify-content-center align-items-center">
						<div class="col-md-6 box-change-dokter table-box">
							<form method="post" id="send-dicom">
								<div class="radiobtn1">

									<form method="POST" id="send-dicom">
										<input type="hidden" name="uid" value="<?= $uid ?>" id="uid">
										<input type="hidden" name="acc" value="<?= $acc ?>" id="acc">
										<input type="hidden" name="pat_id" value="<?= $pat_id ?>" id="pat_id">
										<input type="hidden" name="pk_study" value="<?= $pk_study ?>" id="pk_study">
										<input type="hidden" name="validation" value="true" id="validation">
										<div class="container">
											<div class="row">
												<div class="col-md-7">
													<table>
														<tr>
															<td>UID </td>
															<td>&nbsp;&nbsp;: <?= $uid ?></td>
														</tr>
														<tr>
															<td>Nama Pasien </td>
															<td>&nbsp;&nbsp;: <?= removeCharacter($pat_name) ?></td>
														</tr>
														<tr>
															<td>MRN </td>
															<td>&nbsp;&nbsp;: <?= $pat_id ?></td>
														</tr>
													</table>
												</div>
												<div class="col-md-5">
													<table>
														<tr>
															<td>Jenis Kelamin </td>
															<td>&nbsp;&nbsp;: <?= $pat_sex ?></td>
														</tr>
														<tr>
															<td>Pemeriksaan </td>
															<td>&nbsp;&nbsp;: <?= $study_desc ?></td>
														</tr>
														<tr>
															<td>Modality </td>
															<td>&nbsp;&nbsp;: <?= $mods_in_study ?></td>
														</tr>
													</table>
												</div>
											</div>
										</div>

										<hr>
										<h6>Pilih AET Station yang akan dikirim</h6>


										<hr>
										<?php
										$sql = mysqli_query(
											$conn_pacsio,
											"SELECT aet, station_name FROM ae"
										);
										while ($row = mysqli_fetch_assoc($sql)) { ?>
											<label class="c1"><input class="common_selector cbox search-input-workload" type="radio" name="aet" value="<?= $row['aet']; ?>" checked><span class="checkmark1"></span>
												<?= $row['aet']; ?> (<?= $row['station_name']; ?>)
											</label>
										<?php } ?>
										<hr>
										<a class="btn btn-info btn-lg" href="workload.php" style="border-radius: 5px; box-shadow:none">Back</a>
										<button class="btn btn-info btn-lg" type="submit" id="submit" name="submit" style="border-radius: 5px; box-shadow:none">
											<span class="spinner-grow spinner-grow-sm loading" role="status" aria-hidden="true"></span>
											<p class="loading" style="display:inline;">Loading...</p>
											<p class="ubah" style="display:inline;">Send</p>
										</button>
									</form>
									<hr>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div id="content1">
					<div class="d-flex justify-content-center align-items-center">
						<div class="col-md-6 box-change-dokter table-box">
							<h6>Input</h6>
							<p id="input"></p>
							<h6>Output</h6>
							<p id="output"></p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php include('script-footer.php'); ?>
	</body>
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
<script>
	$(document).ready(function() {
		$(".loading").hide();

		$("#send-dicom").validate({
			rules: {
				aet: "required"
			},
			errorPlacement: function(error, element) {
				if (element.is(":radio")) {
					error.appendTo(element.parents("label"));
				} else {
					error.insertAfter(element);
				}
			},
			highlight: function(element) {
				$(element).closest("label").addClass("has-error");
				$(element).addClass("invalid");
			},
			unhighlight: function(element) {
				$(element).closest("label").removeClass("has-error");
				$(element).removeClass("invalid");
			},
			errorClass: "invalid-text",
			ignoreTitle: true,
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: "../proses-send-dicom.php",
					data: $(form).serialize(),
					beforeSend: function() {
						$(".loading").show();
						$(".ubah").hide();
					},
					complete: function() {
						$(".loading").hide();
						$(".ubah").show();
					},
					success: function(response) {
						// KETIKA TIDAK ADA PERUBAHAN ACC NUMBER
						let res = JSON.parse(response);
						$('#input').html(res.input);
						$('#output').html(res.output);
						swal({
							title: 'check status',
							icon: "success",
							timer: 1000,
						});
						// setTimeout(function() {
						// 	window.location.href = "workload.php";
						// }, 1000);
					},
					error: function(xhr, textStatus, error) {
						// KETIKA ADA PERUBAHAN ACC NUMBER DENGAN KONDISI :
						let res = JSON.parse(xhr.responseText);
						// KETIKA BUKAN KODE 500, MENAMPILKAN POP UP KONFIRMASI
						if (res.status != 500) {
							swal({
								title: res.status,
								text: res.output,
								icon: "warning",
								buttons: true,
								dangerMode: true,
							}).then((result) => {
								// KETIKA POP UP KONFIRMASI DIKLIK OK
								if (result) {
									$.ajax({
										type: "POST",
										url: "../proses-send-dicom.php",
										// menambahkan validation false, karena untuk proses api ohif
										data: $(form).serialize() + "&validation=false",
										beforeSend: function() {
											$(".loading").show();
											$(".ubah").hide();
										},
										complete: function() {
											$(".loading").hide();
											$(".ubah").show();
										},
										success: function(response) {
											// KIRIM KE AET
											let res = JSON.parse(response);
											$('#input').html(res.input);
											$('#output').html(res.output);
											swal({
												title: 'check status',
												icon: "success",
												timer: 1000,
											});
											// setTimeout(function() {
											// 	window.location.href = "workload.php";
											// }, 1000);
										},
										error: function(xhr, textStatus, error) {
											let res = JSON.parse(xhr.responseText);
											swal({
												title: res.status,
												text: res.output,
												icon: "error",
												timer: 1500,
											});
										},
									});
								}
							}).catch(() => {

							});
						} else {
							// KETIKA CODE RESPONSE 500, TIDAK ADA VIEWER MOBILE / VIEWER MOBILE REJECTED
							swal({
								title: res.status,
								text: res.output,
								icon: "error",
								timer: 1500,
							});
						}
					},
				});
			},
		});
	});
</script>