<?php
require '../koneksi/koneksi.php';
session_start();
if ($_SESSION['level'] == "radiology") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<?php include('head.php'); ?>
		<title>Report Excel | Radiology</title>
	</head>

	<body>
	<?php include('sidebar.php'); ?>
    <div class="container-fluid" id="main">
        <div class="row">

			<div id="content1">
				<div class="body">

					<div class="container-fluid">
							<div class="col-12" style="padding-left: 0;">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="index.php">Home</a></li>
										<li class="breadcrumb-item active">Download Report Excel</li>
									</ol>
								</nav>
							</div>

					<div class="container-fluid">
							<div class="row report-th">
								<div class="col-md-4">
									<center><strong>
											<h5 style="margin: 3px 0px; color: #4f977e;">Query to Excel</h5>
										</strong></center>
								</div>
								<div class="col-md-5">
									<center><strong>
											<h5 style="margin: 3px 0px;  color: #4f977e;"><?= $lang['select_date'] ?></h5>
										</strong></center>
								</div>
								<div class="col-md-3">
									<center><strong>
											<h5 style="margin: 3px 0px;  color: #4f977e;"><?= $lang['action'] ?></h5>
										</strong></center>
								</div>
							</div>
						

						<form action="prosesexport-query.php" method="POST">
								<div class="row report-bg">
									<div class="col-md-4">
										<h5 style="margin-top: 16px; ">1.) Dr Radiology Workload (Approved) </h5>
									</div>

									<div style="height: 75px; padding-top: 20px;" class="col-md-2 wrap-search report-input">
										<span class="date-icon2">
											<input type="text" name="from-radiology-workload" id="from-radiology-workload" class="form-control" placeholder="From Date" autocomplete="off" />
										</span>
										<span class="date-icon2">
											<input type="text" name="to-radiology-workload" id="to-radiology-workload" class="form-control" placeholder="To Date" autocomplete="off" /><br>
										</span>
									</div>
									<div class="col-md-3" style="border-right: 3px solid #cacaca; color: #000; padding-top: 2px; height: 75px;">
										<label><input type="checkbox" class="cboxtombol" style="margin-top: 0px;" checked> <?= $lang['check_all'] ?></label><br>
										
										<?php $sql = mysqli_query($conn, "SELECT * FROM xray_modalitas");
										while ($row = mysqli_fetch_assoc($sql)) : ?>
											<tr>
													<td><label class="c2"><input class="common_selector cbox search-input-workload" type="checkbox" id="checkbox" name="modality[]" value="<?= $row['xray_type_code']; ?>" checked><span class="checkmark2"></span></td>
												<td><?= $row['xray_type_code']; ?></label></td>
											<?php endwhile; ?>
											</tr>
									</div><br>
									<div class="col-md-3">
										<center>
											<button style="margin: 10px 0px;" class="btn-excel" type="submit" name="radiologyworkload" id="radiologyworkload"><i class="fas fa-file-excel"></i> Export to Excel</button>
										</center>

									</div>
								</div>
							



						</form>
					</div>
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
		<script>	
			$(document).ready(function(){
			$("li[data-target='#service']").addClass("active");
			$("ul[id='service'] li[id='report1']").addClass("active");
      		});
		</script>
		<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.min.css">
		<script>
			$(document).ready(function() {
				$('.cboxtombol').click(function() {
					$('.cbox').prop('checked', this.checked);
				});
				$('.cboxtombol1').click(function() {
					$('.cbox1').prop('checked', this.checked);
				});
				// --------------------
				$('#from-radiology-workload').datetimepicker({
					format: 'd-m-Y H:i'
				});
				$('#to-radiology-workload').datetimepicker({
					format: 'd-m-Y H:i',
				});
				// --------------------
				$('#from-refferal-workload').datetimepicker({
					timepicker: false,
					format: 'Y-m-d'
				});
				$('#to-refferal-workload').datetimepicker({
					timepicker: false,
					format: 'Y-m-d',
				});
				// --------------------
				$('#from-radiographer-workload').datetimepicker({
					timepicker: false,
					format: 'Y-m-d'
				});
				$('#to-radiographer-workload').datetimepicker({
					timepicker: false,
					format: 'Y-m-d',
				});
			});
		</script>


	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>