<?php
require '../koneksi/koneksi.php';
session_start();

$ip = $_SERVER['SERVER_NAME'];
$from = date('Y-m-d H:i', strtotime($_POST['from-workload']));
$to = date('Y-m-d H:i', strtotime($_POST['to-workload']));
$mods_in_study = $_POST['mods_in_study'];
$priority_doctor = $_POST['priority_doctor'];
$radiographer_name = $_POST['radiographer_name'];
$export_excel = "http://$_SERVER[SERVER_NAME]:8000/api/export-excel?from_updated_time=$from&to_updated_time=$to&xray_type_code=$mods_in_study&patienttype=$priority_doctor&radiographer_name=$radiographer_name";
// http: //127.0.0.1:8000/api/export-excel?from_updated_time=2019-01-09%2000:00&to_updated_time=2022-09-09%2018:10&xray_type_code=CR,PX,CT,DX&patienttype=normal&radiographer_name=KS,%20RA
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
							<form action="" method="POST">
								<div>
									<div class="row report-bg">
										<div style="height: 123px; padding-top: 20px;" class="col-md-2 report-input">
											<div class="row">
												<div class="col" style="padding: 0 2px 0 2px;">
													<span class="date-icon2">
														<input type="text" name="from-workload" id="from-workload" class="form-control" placeholder="From Date" autocomplete="off" />
													</span>
												</div>
												<div class="col" style="padding: 0 2px 0 2px;">
													<span class="date-icon2">
														<input type="text" name="to-workload" id="to-workload" class="form-control" placeholder="To Date" autocomplete="off" /><br>
													</span>
												</div>
											</div>
										</div>
										<div class="col-md-3" style="border-right: 3px solid #cacaca; color: #000; padding-top: 2px; height: 123px;">
											<label><input type="checkbox" class="cboxtombol" style="margin-top: 0px;" checked> <?= $lang['check_all'] ?></label><br>
											<?php
											$study = mysqli_query(
												$conn_pacsio,
												"SELECT mods_in_study FROM study GROUP BY mods_in_study LIMIT 15"
											);
											while ($row = mysqli_fetch_assoc($study)) { ?>
												<tr>
													<td><label class="c2"><input class="common_selector cbox search-input-workload" type="checkbox" id="checkbox" name="modality1[]" value="<?= $row['mods_in_study']; ?>" checked><span class="checkmark2"></span></td>
													<td><?= $row['mods_in_study']; ?></label></td>
												<?php } ?>
										</div>
										<div style="height: 123px; padding-top: 0px; border-right: 3px solid #cacaca;" class="col-md-2 wrap-search">
											<div class="" style="color: #000; padding-top: 2px; height: auto;">
												<label>Prioritas pasien (hasil) :</label><br>
												<td><label class="c2"><input class="common_selector search-input-workload" type="checkbox" id="checkbox" name="priority_doctor" value="normal" checked><span class="checkmark2"></span></td>
												<td>Normal</td>
												<td><label class="c2"><input class="common_selector search-input-workload" type="checkbox" id="checkbox" name="priority_doctor" value="cito" checked><span class="checkmark2"></span></td>
												<td>Cito</td>
											</div>
											<div class="form-group">
												<label for="sel1">Pilih Radiografer:</label>
												<select class="form-control select2" multiple="multiple" name="radiographer[]" style="width:100%;">
													<option value="all">Semua</option>
													<?php
													$query_radiografer = mysqli_query($conn, "SELECT * FROM xray_order WHERE radiographer_name IS NOT NULL GROUP BY radiographer_name LIMIT 30");
													while ($radiografer = mysqli_fetch_array($query_radiografer)) { ?>
														<option value="<?php echo $radiografer['radiographer_name']; ?>"><?php echo $radiografer['radiographer_name'] . ' ' . $radiografer['radiographer_lastname']; ?></option>
													<?php } ?>
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
				$(".select2").select2({
					placeholder: 'Pilih Radiografer'
				});
			});
		</script>
		<script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
		<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.min.css">
		<script>
			$(document).ready(function() {
				$('.cboxtombol').click(function() {
					$('.cbox').prop('checked', this.checked);
				});
				// --------------------
				$('#from-workload').datetimepicker({
					format: 'd-m-Y H:i'
				});
				$('#to-workload').datetimepicker({
					format: 'd-m-Y H:i'
				});
			});
		</script>
	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>