<?php

require '../js/proses/function.php';
require '../default-value.php';
session_start();
$uid = $_GET['uid'];

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

	<body style="background-color: #1f69b7;">
		<?php include('../sidebar-index.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">
				<div id="content1">
					<div class="d-flex justify-content-center align-items-center">
						<div class="col-md-6 box-change-dokter table-box">
							<form method="post" id="send-dicom">
								<div class="radiobtn1">
									<h6>Pilih AET yang akan dikirim</h6>
									<hr>
									<form method="POST" id="send-dicom" action="../send-dicom.php">
										<input type="hidden" name="uid" value="<?= $_GET['uid']; ?>" id="uid">
										<span>UID : <?= $_GET['uid']; ?></span>
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
		<div class="footerindex">
			<div class="">
				<?php include('footer-itw.php'); ?>
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
						swal({
							title: "error" + ", Hubungi IT",
							icon: "error",
							timer: 1500,
						});
					},
				});
			},
		});
	});
</script>