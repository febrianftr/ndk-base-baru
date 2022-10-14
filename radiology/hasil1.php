<?php
require '../koneksi/koneksi.php';
require '../viewer-all.php';
$uid = $_POST['uid'];
$query = "SELECT * FROM xray_series INNER JOIN xray_workload_radiographer ON xray_workload_radiographer.uid = xray_series.uid WHERE xray_series.uid = '$uid'";
$value = mysqli_query($conn, $query);
$row2 = mysqli_fetch_assoc($value);


$query1 = "SELECT * FROM xray_series WHERE uid = '$uid'";
$value1 = mysqli_query($conn, $query1);
?>
<style>
	.fill {
		padding: 50px;
	}
</style>

<div class="fill">
	<div class="table-responsive-sm">
			<table class="" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
				<thead class="thead1">
						<tr><td>Name</td><td>&nbsp;: </td><td align="left">&nbsp; <?= $row2['name']; ?></td></tr>
						<tr><td>MRN</td><td>&nbsp;: </td><td align="left">&nbsp; <?= $row2['mrn']; ?></td></tr>
						<tr><td>Sex</td><td>&nbsp;: </td><td align="left">&nbsp; <?= $row2['sex']; ?></td></tr>
						<tr><td>Department</td><td>&nbsp;: </td><td align="left">&nbsp; <?= $row2['name_dep']; ?></td></tr>
						<tr><td>Referral Physician</td><td>&nbsp;: </td><td align="left">&nbsp; <?= $row2['named'] . ' ' . $row2['lastnamed']; ?></td></tr>
				</thead>
			</table>
			</div>
	<h4><strong><label>SERIES DESC </label>&nbsp;<label></label></strong></h4>
	<h4><strong>
			<table class="table-dicom" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
				<thead class="thead1">
					<tr>
						<th>viewer</th>
						<th>series</th>
						<th>#i</th>
						<th>Create Time</th>
					</tr>
					<?php
					while ($row1 = mysqli_fetch_assoc($value1)) {

					?>
						<tr>
							<td align="left">
								<?= MOBILEFIRST . $row1['series_iuid'] . MOBILELAST; ?>
							</td>
							<td align="left"><?= $row1['series_desc']; ?></td>
							<td align="left"><?= $row1['num_instances']; ?></td>
							<td align="left"><?= $row1['created_time']; ?></td>
						</tr>
					<?php
					}

					?>
				</thead>
			</table>
		</strong></h4>
	<br>
	<p>
</div>