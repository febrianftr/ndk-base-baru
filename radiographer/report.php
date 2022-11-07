<?php
require '../koneksi/koneksi.php';
session_start();
if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<?php include('head.php'); ?>
		<title>Report Excel</title>
	</head>


	<body>
		<?php include('sidebar.php'); ?>
		<div class="container-fluid" id="main">
			<?php require '../report-index.php'; ?>
		</div>
		<div class="footerindex">
			<div class="">
				<?php include('footer-itw.php'); ?>
			</div>
		</div>
		<?php include('script-footer.php'); ?>
		<script src="../js/proses/report-excel.js"></script>
		<script>
			$(document).ready(function() {
				$("li[data-target='#service']").addClass("active");
				$("ul[id='service'] li[id='report1']").addClass("active");

				$(".select2").select2({
					placeholder: 'Select Radiographer'
				});

				$('.cboxtombol').click(function() {
					$('.cbox').prop('checked', this.checked);
				});
				// --------------------
				$('#from_workload').datetimepicker({
					format: 'd-m-Y H:i'
				});
				$('#to_workload').datetimepicker({
					format: 'd-m-Y H:i'
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>