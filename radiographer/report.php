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
							<!-- <div class="">
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
							</form> -->




							<style>
								.cont-regist h4 {
									color: #064588;
								}

								.input-regist input,
								.input-regist input[type="radio"]+label,
								.input-regist input[type="checkbox"]+label:before,
								.input-regist input[type="checkbox"]+label,
								.input-regist select option,
								.input-regist select {
									width: 100%;
									padding: 1em;
									line-height: 1.4;
									background-color: #f9f9f9;
									border: 1px solid #e5e5e5;
									border-radius: 3px;
									-webkit-transition: 0.35s ease-in-out;
									-moz-transition: 0.35s ease-in-out;
									-o-transition: 0.35s ease-in-out;
									transition: 0.35s ease-in-out;
									transition: all 0.35s ease-in-out;
								}

								.input-regist input:focus {
									outline: 0;
									border-color: #309ace;
								}

								.input-regist input:focus+.input-icon i {
									color: #377d71;
								}

								.input-regist input:focus+.input-icon:after {
									border-right-color: #377d71;
								}

								.input-regist input[type="radio"],
								.input-regist input[type="checkbox"] {
									display: none;
								}

								.input-regist input[type="radio"]+label,
								.input-regist input[type="checkbox"]+label,
								.input-regist select {
									display: inline-block;
									width: 30%;
									text-align: center;
									float: left;
									border-radius: 0;
								}

								.input-regist-gender input[type="radio"]+label,
								.input-regist-gender input[type="checkbox"]+label {
									display: inline-block;
									width: 33%;
									text-align: center;
									float: left;
									border-radius: 0;
									cursor: pointer;
								}

								.input-regist input[type="radio"]+label:first-of-type,
								.input-regist input[type="checkbox"]+label:first-of-type {
									border-top-left-radius: 3px;
									border-bottom-left-radius: 3px;
								}

								.input-regist input[type="radio"]+label:last-of-type,
								.input-regist input[type="checkbox"]+label:last-of-type {
									border-top-right-radius: 3px;
									border-bottom-right-radius: 3px;
								}

								.input-regist input[type="radio"]+label i,
								.input-regist input[type="checkbox"]+label i {
									padding-right: 0.4em;
								}

								.input-regist input[type="radio"]:checked+label,
								.input-regist input[type="checkbox"]:checked+label,
								.input-regist input:checked+label:before,
								.input-regist select:focus,
								.input-regist select:active {
									background-color: #377d71;
									color: #fff;
									/* border-color: #309ace; */
								}

								.input-regist input:checked+label:after {
									opacity: 1;
								}

								.input-regist select {
									/* height: 3.4em; */
									line-height: 2;
									margin: 0;
								}

								.input-regist select:first-of-type {
									border-top-left-radius: 3px;
									border-bottom-left-radius: 3px;
								}

								.input-regist select:last-of-type {
									border-top-right-radius: 3px;
									border-bottom-right-radius: 3px;
								}

								.input-regist select:focus,
								.input-regist select:active {
									outline: 0;
								}

								.input-regist select option {
									background-color: #ececec;
									color: #747474;
								}

								.input-group-regist {
									margin-bottom: 1em;
									zoom: 1;
								}

								.input-group:before,
								.input-group:after {
									content: "";
									display: table;
								}

								.input-group:after {
									clear: both;
								}

								.input-group-icon {
									position: relative;
								}

								.input-group-icon input {
									padding-left: 4.4em;
								}

								.input-group-icon .input-icon {
									position: absolute;
									top: 15px;
									left: 0;
									width: 3.4em;
									height: 3.4em;
									line-height: 3.4em;
									text-align: center;
									pointer-events: none;
								}

								.input-group-icon .input-icon:after {
									position: absolute;
									top: 0px;
									bottom: 23px;
									left: 3.4em;
									display: block;
									border-right: 1px solid #e5e5e5;
									content: "";
									-webkit-transition: 0.35s ease-in-out;
									-moz-transition: 0.35s ease-in-out;
									-o-transition: 0.35s ease-in-out;
									transition: 0.35s ease-in-out;
									transition: all 0.35s ease-in-out;
								}

								.input-group-icon .input-icon i {
									-webkit-transition: 0.35s ease-in-out;
									-moz-transition: 0.35s ease-in-out;
									-o-transition: 0.35s ease-in-out;
									transition: 0.35s ease-in-out;
									transition: all 0.35s ease-in-out;
								}


								.cont-regist {
									padding: 1em 3em 2em 3em;
									margin: 0em auto;
									background-color: #fff;
									border-radius: 4.2px;
									box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2);
								}

								.regist-live tr td {
									font-size: 15px;
									color: #377d71;
								}

								.right-regist {
									width: 100%;
									background-color: #fff;
									padding: 5px;
									border: 3px solid #fff;
									padding: 10px;
									border-radius: 5px;
								}



								.ks-cboxtags {
									list-style: none;
									/* padding: 20px; */
								}

								.ks-cboxtags li {
									display: inline;
								}

								.ks-cboxtags li span {
									display: inline-block;
									background-color: rgba(255, 255, 255, .9);
									border: 2px solid rgba(139, 139, 139, .3);
									color: #adadad;
									border-radius: 10px;
									white-space: nowrap;
									margin: 3px 0px;
									-webkit-touch-callout: none;
									-webkit-user-select: none;
									-moz-user-select: none;
									-ms-user-select: none;
									user-select: none;
									-webkit-tap-highlight-color: transparent;
									transition: all .2s;
								}

								.ks-cboxtags li span {
									padding: 8px 12px;
									cursor: pointer;
								}

								.ks-cboxtags li span::before {
									display: inline-block;
									font-style: normal;
									font-variant: normal;
									text-rendering: auto;
									-webkit-font-smoothing: antialiased;
									font-family: "Font Awesome 5 Free";
									font-weight: 900;
									font-size: 12px;
									padding: 2px 6px 2px 2px;
									content: "\f068";
									transition: transform .3s ease-in-out;
								}

								.ks-cboxtags li input[type="checkbox"]:checked+span::before {
									content: "\f00c";
									transform: rotate(-360deg);
									transition: transform .3s ease-in-out;
								}

								.ks-cboxtags li input[type="checkbox"]:checked+span {
									border: 2px solid #fff;
									background-color: #1f69b7;
									color: #fff;
									transition: all .2s;
								}

								.ks-cboxtags li input[type="checkbox"] {
									display: absolute;
								}

								.ks-cboxtags li input[type="checkbox"] {
									position: absolute;
									opacity: 0;
								}

								.ks-cboxtags li input[type="checkbox"]:focus+span {
									border: 1px solid #377d71;
								}

								.card-body i,
								.card-body h4 {
									color: #2a412f;
								}
							</style>

							<div class="cont-regist">
								<div>
									<h4>Excel Report</h4>
								</div>
								<div class="row justify-content-center align-items-center" style="padding: 10px; border-radius: 5px; border: solid 2px #eff1f7;">
									<div class="col-md-2" style="padding: 4px;">
										<div class="input-group input-group-regist input-regist input-group-icon">
											<input type="text" name="from-workload" id="from-workload" placeholder="From Date" autocomplete="off" />
											<div class="input-icon"><i class="fas fa-calendar-alt"></i></div>
										</div>
									</div>
									<div class="col-md-2" style="padding: 4px;">
										<div class="input-group input-group-regist input-regist input-group-icon">
											<input type="text" name="to-workload" id="to-workload" placeholder="To Date" autocomplete="off" />
											<div class="input-icon"><i class="fas fa-calendar-alt"></i></div>
										</div>
									</div>

									<div class="col-md-4">
										<input type="checkbox" class="cboxtombol" style="margin-top: 0px;" checked> <?= $lang['check_all'] ?> Modality
										<ul class="ks-cboxtags">
											<?php
											$study = mysqli_query(
												$conn_pacsio,
												"SELECT mods_in_study FROM study GROUP BY mods_in_study LIMIT 15"
											);
											while ($row = mysqli_fetch_assoc($study)) { ?>
												<li><label><input class="common_selector cbox checkbox4 search-input-workload" type="checkbox" id="checkbox" name="modality1[]" value="<?= $row['mods_in_study']; ?>" checked><span><?= $row['mods_in_study']; ?></span></label></li>
											<?php } ?>
										</ul>
									</div>


									<div class="col-md-2">
										Condition :
										<ul class="ks-cboxtags">
											<li><label><input class="common_selector cbox5 checkbox4 search-input-workload" type="checkbox" id="checkbox" name="priority_doctor" value="normal" checked><span>Normal</span></label></li>
											<li><label><input class="common_selector cbox5 checkbox4 search-input-workload" type="checkbox" id="checkbox" name="priority_doctor" value="cito" checked><span>Cito</span></label></li>
										</ul>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="sel1">Select Radiographer:</label>
											<select class="form-control select2" multiple="multiple" name="radiographer[]" style="width: 100%;">
												<option value="all">ALL RADIOGRAPHER</option>
												<?php
												$query_radiografer = mysqli_query($conn, "SELECT * FROM xray_order WHERE radiographer_name IS NOT NULL GROUP BY radiographer_name LIMIT 30");
												while ($radiografer = mysqli_fetch_array($query_radiografer)) { ?>
													<option value="<?php echo $radiografer['radiographer_name']; ?>"><?php echo $radiografer['radiographer_name'] . ' ' . $radiografer['radiographer_lastname']; ?></option>
												<?php
												}
												?>
											</select>
										</div>
									</div>

									<div class="col-md-12" style="background: #f9f9f9; border-radius: 5px;">

										<button style="margin: 10px 0px; float: right; padding: 10px 30px; border-radius: 5px; border: none; font-weight: bold; font-size: 18px;" class="btn-excel" type="submit" name="radiographerworkload" id="radiographerworkload"><i class="fas fa-file-excel"></i> Excel</button>
									</div>
								</div>
							</div>




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