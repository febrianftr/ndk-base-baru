<?php
$modality = implode(
	'", "',
	$_POST['modality']
);
$modality5 = $_POST['modality'];
$modality4 = "DIKA MAU NYOBA";
$modality2 = '"';
$modality3 = $modality2 . $modality . $modality2;
$count = count($modality5);
$from = $_POST['from'];
$to = $_POST['to'];
$typechart = $_POST['typechart'];

function hex2rgba($color, $opacity = false)
{

	$default = 'rgb( 0, 0, 0 )';

	/**
	 * Return default if no color provided
	 */
	if (empty($color)) {

		return $default;
	}

	/**
	 * Sanitize $color if "#" is provided
	 */
	if ($color[0] == '#') {

		$color = substr($color, 1);
	}

	/**
	 * Check if color has 6 or 3 characters and get values
	 */
	if (strlen($color) == 6) {

		$hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
	} elseif (strlen($color) == 3) {

		$hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
	} else {

		return $default;
	}

	/**
	 * [$rgb description]
	 * @var array
	 */
	$rgb =  array_map('hexdec', $hex);

	/**
	 * Check if opacity is set(rgba or rgb)
	 */
	if ($opacity) {

		if (abs($opacity) > 1)

			$opacity = 1.0;

		$output = 'rgba( ' . implode(",", $rgb) . ',' . $opacity . ' )';
	} else {

		$output = 'rgb( ' . implode(",", $rgb) . ' )';
	}

	/**
	 * Return rgb(a) color string
	 */
	return $output;
}


?>
<?php
require '../koneksi/koneksi.php';
// for ($x = 1; $x <= $count; $x++) {
// 	$y = $x - 1;
// 	$sql6 = mysqli_query($conn_pacs, "select * from ae where aet = '$modality5[$y]'");
// 	$row6 = mysqli_fetch_assoc($sql6);
// 	$grafik = $row6['pat_id_issuer'];
// 	$aet = $modality5[$y];
// 	$sql8 = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer WHERE src_aet = '$aet'");
// 	$row8 = mysqli_fetch_assoc($sql8);
// 	$modalityy = $row8['xray_type_code'];
// 	echo $modality2 . $modalityy . ' ' . $grafik . $modality2 . ',';
// }
// echo "<br />";
// echo $modality3;
session_start();
if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html PUBLIC>
	<html>

	<head>
		<title>Result Chart | Radiographer</title>
		<?php include('head.php'); ?>
		<style type="text/css">
			.table-dicom td {
				font-size: 13px;
			}

			.table-dicom th {
				font-size: 13px;
			}
		</style>
	</head>

	<body>
		<?php include('sidebar.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">

				<div id="content1">
					<div class="container-fluid">
						<div class="col-12" style="padding-left: 0;">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active">Chart</li>
								</ol>
							</nav>
						</div>
						<div class="about-inti">
							<center>
								<h1> <?= $lang['search_chart'] ?></h1>
							</center>
							<form action="result-chart.php" method="post">

								<!-- <div style="padding: 0px;" class="input-checkbox2 search-workload5 col-sm-3 input-date">

								<img src="../image/chart.png">

							</div> -->
								<div>
									<div class="container-fluid search_chart2">
										<div class="row">

											<div class="col-md-8" style="min-height: 140px; padding: 0px; border: 3px solid #cacaca; border-radius: 5px; background-color: whitesmoke;">
												<label class="work-1"><?= $lang['search_mod']; ?> <div style="float: right; margin-right: 10px;"><input type="checkbox" class="cboxtombol" style="margin-top: 0px;" checked> <?= $lang['check_all'] ?></div></label><br>
												<div class="wrap-search wrap-search2" style="height: auto;">
													<!-- <input type="checkbox" class="cbox" checked  name="CR" id="CR" placeholder="CR" value="CR">
									<label for="CR"><b> &nbsp;CR&nbsp;</b></label>
									<input type="checkbox" class="cbox" checked  name="DX" id="DX" placeholder="DX" value="DX" >
									<label for="DX"><b> &nbsp;DX&nbsp;</b></label>
									<input type="checkbox" class="cbox" checked  name="PX" id="PX" placeholder="PX" value="PX" >
									<label for="PX"><b> &nbsp;PX&nbsp;</b></label>
									<input type="checkbox" class="cbox" checked  name="USG" id="USG" placeholder="USG" value="USG" >
									<label for="USG"><b> &nbsp;USG&nbsp;</b></label>
									-->
													<?php $sql = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer GROUP BY src_aet");
													while ($row = mysqli_fetch_assoc($sql)) : ?>

														<tr>
															<td><label class="c1"><input class="common_selector cbox search-input-workload" type="checkbox" id="checkbox" name="modality[]" value="<?= $row['src_aet']; ?>" checked><span class="checkmark1"></span></td>
															<?php
															$src_aet = $row['src_aet'];
															$sql2 = mysqli_query($conn_pacs, "SELECT * FROM ae WHERE aet = '$src_aet'");
															$row2 = mysqli_fetch_assoc($sql2); ?>
															<td><?= $row['xray_type_code'] . ' ' . $row2['pat_id_issuer']; ?></label></td>
														<?php endwhile; ?>



												</div>
												<label class="work-1">Type Chart</label><br>
												<div class="wrap-search">
													<select name="typechart">
														<option value="bar" <?php if ($typechart == 'bar') {
																				echo 'selected';
																			} ?>>BAR</option>
														<option value="line" <?php if ($typechart == 'line') {
																					echo 'selected';
																				} ?>>LINE</option>
														<option value="pie" <?php if ($typechart == 'pie') {
																				echo 'selected';
																			} ?>>PIE</option>
													</select>
												</div>
											</div>

											<div class="col-md-4">
												<div style="padding: 0px; min-height: 140px; border: 3px solid #cacaca; border-radius: 5px; background-color: whitesmoke;">
													<label class="work-1"><?= $lang['search_date'] ?></label><br>
													<div class="wrap-search">
														<label for="from"><b>From</b></label><br>
														<input type="text" name="from" id="from" placeholder="from" required style="width: 100%;"></input><br>
														<label for="to"><b>To</b></label><br>
														<input type="text" name="to" id="to" placeholder="to" required style="width: 100%;"></input><br>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div><br>
						</div>
					</div>
					<div class="col-md-6"><button id="btn-worklist1" class="btn btn-warning btn-lg" name="submit" style="box-shadow: none; font-weight: bold; border-radius: 5px;">Submit</button></div>
					</form>
				</div>
				<div class="container-fluid">
					<center>
						<h2><?= $lang['radiology_data'] ?><br /><?php echo $from ?> - <?php echo $to ?></h2>
					</center>



					<div style="overflow-x:auto;">
						<div class="chart1" style="width: 800px;margin: 0px auto;">

							<canvas id="myChart"></canvas>

						</div>
					</div>

					<br>

					<br />
					<br />
					<!-- UNTUK TAMBAHIN TABLE DATA -->
					<div class="back-search">
						<?php
						for ($x = 1; $x <= $count; $x++) {
							$y = $x - 1;
							$no = 1;
							$data = mysqli_query($conn, "select * from xray_workload_radiographer WHERE src_aet='$modality5[$y]' AND complete_date BETWEEN '$from' AND '$to' ");
							$CR1 = mysqli_num_rows($data); ?>
							<?php if ($CR1 > 0) { ?>
								<table class="table-dicom table-paginate" border="1">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama </th>
											<th>mrn/No. Foto</th>
											<th>MODALITY</th>
											<th>COMPLETE DATE</th>
										</tr>
									</thead>
									<tbody>
										<?php $sql3 = mysqli_query($conn_pacs, "SELECT * FROM ae WHERE aet = '$modality5[$y]'");
										$row3 = mysqli_fetch_assoc($sql3);
										$sql4 = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer WHERE src_aet = '$modality5[$y]'");
										$row4 = mysqli_fetch_assoc($sql4); ?>
										<h1 align="center">DATA <?php echo $row4['xray_type_code'] . ' ' . $row3['pat_id_issuer']; ?></h1>
									<?php
										while ($d = mysqli_fetch_array($data)) { ?>
											<tr>
												<td><?php echo $no++; ?></td>
												<td><?php echo $d['name'] . ' ' . $d['lastname']; ?></td>
												<td><?php echo $d['mrn'] . ' / ' . $d['patientid']; ?></td>
												<td align="center" bgcolor="pink"><?php echo $d['xray_type_code']; ?></td>
												<td><?php echo $d['complete_date']; ?></td>
											</tr>
									<?php }
									} ?>
									</tbody>
								</table>
							<?php } ?>

					</div>
				</div>
				<br><br><br><br><br><br><br>

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
				$("ul[id='service'] li[id='chart2']").addClass("active");
			});
		</script>
		<script type="text/javascript">
			$(document).on('click', '.cboxtombol', function() {
				$('.cbox').prop('checked', this.checked);
			});
		</script>
		<!-- <script type="text/javascript" src="js/Chart.js"></script> -->
		<!-- UNTUK TAMBAHIN CHART -->
		<?php
		if ($typechart == 'bar') {

		?>
			<script>
				var ctx = document.getElementById("myChart").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: [<?php for ($x = 1; $x <= $count; $x++) {
										$y = $x - 1;
										$sql6 = mysqli_query($conn_pacs, "select * from ae where aet = '$modality5[$y]'");
										$row6 = mysqli_fetch_assoc($sql6);
										$grafik = $row6['pat_id_issuer'];
										$aet = $modality5[$y];
										$sql8 = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer WHERE src_aet = '$aet'");
										$row8 = mysqli_fetch_assoc($sql8);
										$modalityy = $row8['xray_type_code'];
										echo $modality2 . $modalityy . ' ' . $grafik . $modality2; ?>, <?php
																									} ?>],
						datasets: [{
							label: '',
							data: [
								<?php
								for ($x = 1; $x <= $count; $x++) {
									$y = $x - 1;
									$jml_CR = mysqli_query($conn, "select * from xray_workload_radiographer where src_aet='$modality5[$y]' AND complete_date BETWEEN '$from' AND '$to' ");
									echo mysqli_num_rows($jml_CR);
								?>, <?php } ?>
							],
							backgroundColor: [
								<?php for ($x = 1; $x <= $count; $x++) {
									$y = $x - 1;
									$sql5 = mysqli_query($conn_pacs, "select * from ae where aet = '$modality5[$y]'");
									$row5 = mysqli_fetch_assoc($sql5);
									$color = $row5['color'];
									$rgbrafli = hex2rgba($color, 0.4);
									$rgb2 = "'";
									$rgb3 = ",";
									$rgb313 = $rgb2 . $rgbrafli . $rgb2 . $rgb3;
									echo $rgb313;
								} ?>
							],
							borderColor: [
								<?php for ($x = 1; $x <= $count; $x++) {
									$y = $x - 1;
									$sql5 = mysqli_query($conn_pacs, "select * from ae where aet = '$modality5[$y]'");
									$row5 = mysqli_fetch_assoc($sql5);
									$color = $row5['color'];
									$rgb = hex2rgba($color, 1);
									$rgb2 = "'";
									$rgb3 = ",";
									$rgb313 = $rgb2 . $rgb . $rgb2 . $rgb3;
									echo $rgb313;
								} ?>
							],
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero: true
								}
							}]
						}
					}
				});
			</script>
		<?php } elseif ($typechart == 'line') { ?>
			<script>
				var ctx = document.getElementById("myChart").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'line',
					data: {
						labels: [<?php for ($x = 1; $x <= $count; $x++) {
										$y = $x - 1;
										$sql6 = mysqli_query($conn_pacs, "select * from ae where aet = '$modality5[$y]'");
										$row6 = mysqli_fetch_assoc($sql6);
										$grafik = $row6['pat_id_issuer'];
										$aet = $modality5[$y];
										$sql8 = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer WHERE src_aet = '$aet'");
										$row8 = mysqli_fetch_assoc($sql8);
										$modalityy = $row8['xray_type_code'];
										echo $modality2 . $modalityy . ' ' . $grafik . $modality2; ?>, <?php
																									} ?>],
						datasets: [{
							label: '',
							data: [
								<?php
								for ($x = 1; $x <= $count; $x++) {
									$y = $x - 1;
									$jml_CR = mysqli_query($conn, "select * from xray_workload_radiographer where src_aet='$modality5[$y]' AND complete_date BETWEEN '$from' AND '$to' ");
									echo mysqli_num_rows($jml_CR);
								?>, <?php } ?>
							],
							backgroundColor: [
								<?php for ($x = 1; $x <= $count; $x++) {
									$y = $x - 1;
									$sql5 = mysqli_query($conn_pacs, "select * from ae where aet = '$modality5[$y]'");
									$row5 = mysqli_fetch_assoc($sql5);
									$color = $row5['color'];
									$rgbrafli = hex2rgba($color, 0.4);
									$rgb2 = "'";
									$rgb3 = ",";
									$rgb313 = $rgb2 . $rgbrafli . $rgb2 . $rgb3;
									echo $rgb313;
								} ?>
							],
							borderColor: [
								<?php for ($x = 1; $x <= $count; $x++) {
									$y = $x - 1;
									$sql5 = mysqli_query($conn_pacs, "select * from ae where aet = '$modality5[$y]'");
									$row5 = mysqli_fetch_assoc($sql5);
									$color = $row5['color'];
									$rgb = hex2rgba($color, 1);
									$rgb2 = "'";
									$rgb3 = ",";

									$rgb313 = $rgb2 . $rgb . $rgb2 . $rgb3;
									echo $rgb313;
								} ?>
							],
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero: true
								}
							}]
						}
					}
				});
			</script>
		<?php } else { ?>
			<script>
				var ctx = document.getElementById("myChart").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'pie',
					data: {
						labels: [<?php for ($x = 1; $x <= $count; $x++) {
										$y = $x - 1;
										$sql6 = mysqli_query($conn_pacs, "select * from ae where aet = '$modality5[$y]'");
										$row6 = mysqli_fetch_assoc($sql6);
										$grafik = $row6['pat_id_issuer'];
										$aet = $modality5[$y];
										$sql8 = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer WHERE src_aet = '$aet'");
										$row8 = mysqli_fetch_assoc($sql8);
										$modalityy = $row8['xray_type_code'];
										echo $modality2 . $modalityy . ' ' . $grafik . $modality2; ?>, <?php
																									} ?>],
						datasets: [{
							label: '',
							data: [
								<?php
								for ($x = 1; $x <= $count; $x++) {
									$y = $x - 1;
									$jml_CR = mysqli_query($conn, "select * from xray_workload_radiographer where src_aet='$modality5[$y]' AND complete_date BETWEEN '$from' AND '$to' ");
									echo mysqli_num_rows($jml_CR);
								?>, <?php } ?>
							],
							backgroundColor: [
								<?php for ($x = 1; $x <= $count; $x++) {
									$y = $x - 1;
									$sql5 = mysqli_query($conn_pacs, "select * from ae where aet = '$modality5[$y]'");
									$row5 = mysqli_fetch_assoc($sql5);
									$color = $row5['color'];
									$rgbrafli = hex2rgba($color, 0.4);
									$rgb2 = "'";
									$rgb3 = ",";

									$rgb313 = $rgb2 . $rgbrafli . $rgb2 . $rgb3;
									echo $rgb313;
								} ?>
							],
							borderColor: [
								<?php for ($x = 1; $x <= $count; $x++) {
									$y = $x - 1;
									$sql5 = mysqli_query($conn_pacs, "select * from ae where aet = '$modality5[$y]'");
									$row5 = mysqli_fetch_assoc($sql5);
									$color = $row5['color'];
									$rgb = hex2rgba($color, 1);
									$rgb2 = "'";
									$rgb3 = ",";

									$rgb313 = $rgb2 . $rgb . $rgb2 . $rgb3;
									echo $rgb313;
								} ?>
							],
							borderWidth: 1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero: true
								}
							}]
						}
					}
				});
			</script>
		<?php } ?>
		<script>
			$('#from').datetimepicker({
				timepicker: false,
				format: 'Y-m-d'
			});
			$('#to').datetimepicker({
				timepicker: false,
				format: 'Y-m-d'
			});
		</script>

	</body>

	</html>
<?php } else {
	header("location:../index.php");
} ?>
<?php
include '../koneksi/koneksi.php';


?>