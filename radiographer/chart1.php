<?php
require '../koneksi/koneksi.php';
session_start();

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
$color = '#ffa226';
$rgb = hex2rgba($color, 0.4);
$rgba = hex2rgba($color, 1);





if ($_SESSION['level'] == "radiographer") {
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title>Searching by Chart | Radiographer</title>
		<?php include('head.php'); ?>
	</head>

	<body>
		<?php include('sidebar.php'); ?>
		<div class="container-fluid" id="main">
			<div class="row">
				<div class="col-12" style="padding-left: 0;">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item active">Report Chart</li>
						</ol>
					</nav>
				</div>

				<div id="content1">
					<div class="container-fluid">
						<div class="about-inti">
							<!-- <center>
								<h1 style="color: #68b399;"> <?= $lang['search_chart'] ?></h1>
							</center> -->
							<form action="result-chart.php" method="post">

								<!-- <div style="padding: 0px;" class="input-checkbox2 search-workload5 col-sm-3 input-date">

								<img src="../image/chart.png">

							</div> -->
								<div>
									<div class="container-fluid search_chart2">
										<div class="row">

											<div class="col-md-8" style="min-height: 140px; padding: 0px; border: 3px solid #cacaca; border-radius: 5px; background: whitesmoke;">
												<label class="work-1"><?= $lang['search_mod'] ?> <div style="float: right; margin-right: 10px;"><input type="checkbox" class="cboxtombol" style="margin-top: 0px;" checked> <?= $lang['check_all'] ?></div></label><br>
												<div class="wrap-search wrap-search2" style="height: auto;">
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
														<option value="bar">BAR</option>
														<option value="line">LINE</option>
														<option value="pie">PIE</option>
													</select>
												</div>
											</div>


											<div class="col-md-4">
												<div style="padding: 0px; min-height: 140px; border: 3px solid #cacaca; border-radius: 5px; background: whitesmoke;">
													<label class="work-1"><?= $lang['search_date'] ?></label><br>
													<div class="wrap-search">
														<label for="from"><b>From</b></label><br>
														<input type="text" name="from" id="from" placeholder="from" required style="width: 100%;" autocomplete="off"></input><br>
														<label for="to"><b>To</b></label><br>
														<input type="text" name="to" id="to" placeholder="to" required style="width: 100%;" autocomplete="off"></input><br>
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
				</div><br><br>

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