<?php
require '../koneksi/koneksi.php';
session_start();
if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<?php include('head.php'); ?>
		<!-- Load file CSS Bootstrap dan Select2 melalui CDN -->
		<link href="css/select2.min.css" rel="stylesheet" />
		<title>Report Excel | Radiographer</title>
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
										<li class="breadcrumb-item active">Report Excel</li>
									</ol>
								</nav>
							</div>
							<div class="">
								<div class="row report-th">
									<div class="col-md-4">
										<center><strong>
												<h5 style="margin: 3px 0px; color: #4f977e;">Query to Excel</h5>
											</strong></center>
									</div>
									<div class="col-md-5">
										<center><strong>
												<h5 style="margin: 3px 0px; color: #4f977e;"><?= $lang['select_date'] ?></h5>
											</strong></center>
									</div>
									<div class="col-md-2">
										<center><strong>
												<h5 style="margin: 3px 0px; color: #4f977e;">Extras</h5>
											</strong></center>
									</div>
									<div class="col-md-1">
										<center><strong>
												<h5 style="margin: 3px 0px; color: #4f977e;"><?= $lang['action'] ?></h5>
											</strong></center>
									</div>
								</div>
							</div>
							<form action="prosesexport-query.php" method="POST">
								<div class="">
									<div class="row report-bg">
										<div class="col-md-4">
											<h5 style="margin-top: 16px; ">1.) Dr Radiology Workload (Approved) </h5>
										</div>

										<div style="height: 97px; padding-top: 20px;" class="col-md-2 report-input">
											<div class="row">
												<div class="col" style="padding: 0 2px 0 2px;">
													<span class="date-icon2">
														<input type="text" name="from-radiology-workload" id="from-radiology-workload" class="form-control" placeholder="From Date" autocomplete="off" />
													</span>
												</div>
												<div class="col" style="padding: 0 2px 0 2px;">
													<span class="date-icon2">
														<input type="text" name="to-radiology-workload" id="to-radiology-workload" class="form-control" placeholder="To Date" autocomplete="off" /><br>
													</span>
												</div>
											</div>
										</div>

										<div class="col-md-3" style="color: #000; padding-top: 2px;">
											<label><input type="checkbox" class="cboxtombol1" style="margin-top: 0px;" checked> <?= $lang['check_all'] ?></label><br>
											<?php $sql = mysqli_query($conn, "SELECT * FROM xray_modalitas");
											while ($row = mysqli_fetch_assoc($sql)) : ?>
												<tr>
													<td><label class="c2"><input class="common_selector cbox1 search-input-workload" type="checkbox" id="checkbox" name="modality[]" value="<?= $row['xray_type_code']; ?>" checked><span class="checkmark2"></span></td>
													<td><?= $row['xray_type_code']; ?></label></td>
												<?php endwhile; ?>
												</tr>
										</div>

										<div style="height: 97px; padding-top: 20px;" class="col-md-2 wrap-search report-input">
											<select name="dokradid">
												<?php
												$result = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology");
												?>
												<?php while ($row = mysqli_fetch_assoc($result)) { ?>
													<option value="<?= $row['dokradid']; ?>"><?= $row['dokrad_name'] . ' ' . $row['dokrad_lastname']; ?></option>
												<?php } ?>
											</select>
										</div> <br>
										<div class="col-md-1">
											<center>
												<button style="margin: 10px 0px;" class="btn-excel" type="submit" name="radiologyworkload" id="radiologyworkload"><i class="fas fa-file-excel"></i> Excel</button>
											</center>
										</div>
									</div>
								</div>
								<div class="">
									<div class="row report-bg">
										<div class="col-md-4">
											<h5 style="margin-top: 25px;"> 2.) Radiographer Workload</h5>
										</div>
										<div style="height: 123px; padding-top: 20px;" class="col-md-2 report-input">
											<div class="row">
												<div class="col" style="padding: 0 2px 0 2px;">
													<span class="date-icon2">
														<input type="text" name="from-radiographer-workload" id="from-radiographer-workload" class="form-control" placeholder="From Date" autocomplete="off" />
													</span>
												</div>
												<div class="col" style="padding: 0 2px 0 2px;">
													<span class="date-icon2">
														<input type="text" name="to-radiographer-workload" id="to-radiographer-workload" class="form-control" placeholder="To Date" autocomplete="off" /><br>
													</span>
												</div>
											</div>
										</div>
										<div class="col-md-3" style="border-right: 3px solid #cacaca; color: #000; padding-top: 2px; height: 123px;">
											<label><input type="checkbox" class="cboxtombol" style="margin-top: 0px;" checked> <?= $lang['check_all'] ?></label><br>
											<?php $sql = mysqli_query($conn, "SELECT * FROM xray_modalitas");
											while ($row = mysqli_fetch_assoc($sql)) : ?>
												<tr>
													<td><label class="c2"><input class="common_selector cbox search-input-workload" type="checkbox" id="checkbox" name="modality1[]" value="<?= $row['xray_type_code']; ?>" checked><span class="checkmark2"></span></td>
													<td><?= $row['xray_type_code']; ?></label></td>
												<?php endwhile; ?>
										</div>
										<div style="height: 123px; padding-top: 0px; border-right: 3px solid #cacaca;" class="col-md-2 wrap-search">
											<div class="" style="color: #000; padding-top: 2px; height: auto;">
												<label>Condition :</label><br>
												<?php $sql2 = mysqli_query($conn, "SELECT * FROM xray_patient_type");
												while ($row2 = mysqli_fetch_assoc($sql2)) : ?>
													<td><label class="c2"><input class="common_selector search-input-workload" type="checkbox" id="checkbox" name="patienttype[]" value="<?= $row2['typeofpatient']; ?>" checked><span class="checkmark2"></span></td>
													<td><?= $row2['typeofpatient']; ?></td>
												<?php endwhile; ?>
											</div>
											<div class="form-group">
												<label for="sel1">Select Radiographer:</label>
												<select class="form-control select2" multiple="multiple" name="radiographer[]" style="width: 100%;">
													<option value="all">ALL RADIOGRAPHER</option>
													<?php
													$sql21 = "select * from xray_workload_radiographer group by radiographer_name";
													$hasil21 = mysqli_query($conn, $sql21);
													while ($data21 = mysqli_fetch_array($hasil21)) {
													?>
														<option value="<?php echo $data21['radiographer_name']; ?>"><?php echo $data21['radiographer_name'] . ' ' . $data21['radiographer_lastname']; ?></option>
													<?php
													}
													?>
												</select>
											</div>
										</div> <br>
										<div class="col-md-1" style="padding-top: 10px;">
											<center>
												<button style="margin: 10px 0px;" class="btn-excel" type="submit" name="radiographerworkload" id="radiographerworkload"><i class="fas fa-file-excel"></i> Excel</button>
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
			$(document).ready(function() {
				$("li[data-target='#service']").addClass("active");
				$("ul[id='service'] li[id='report1']").addClass("active");
			});
		</script>

		<script src="../js/select2.min.js"></script>
		<script>
			$(document).ready(function() {
				$(".select2").select2({});
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
					format: 'd-m-Y H:i'
				});
				// --------------------
				$('#from-refferal-workload').datetimepicker({
					timepicker: false,
					format: 'd-m-Y'
				});
				$('#to-refferal-workload').datetimepicker({
					format: 'd-m-Y',
				});
				// --------------------
				$('#from-radiographer-workload').datetimepicker({
					format: 'd-m-Y H:i'
				});
				$('#to-radiographer-workload').datetimepicker({
					format: 'd-m-Y H:i'
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>