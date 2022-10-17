<?php
require 'koneksi/koneksi.php';
require 'viewer-all.php';
require 'default-value.php';
$uid = $_POST['uid'];
$row = mysqli_fetch_assoc(mysqli_query(
	$conn_pacsio,
	"SELECT patient.pat_name,
	patient.pat_id,
	patient.pat_sex,
	study.pk
	FROM patient	JOIN study
	ON patient.pk = study.patient_fk 
	WHERE study_iuid = '$uid'"
));
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
				<tr>
					<td>Nama</td>
					<td>&nbsp;: </td>
					<td align="left">&nbsp; <?= removeCharacter($row['pat_name']); ?></td>
				</tr>
				<tr>
					<td>MRN</td>
					<td>&nbsp;: </td>
					<td align="left">&nbsp; <?= defaultValue($row['pat_id']); ?></td>
				</tr>
				<tr>
					<td>Sex</td>
					<td>&nbsp;: </td>
					<td align="left">&nbsp; <?= defaultValue($row['pat_sex']); ?></td>
				</tr>
			</thead>
		</table>
	</div>
	<h4>
		<strong>
			<label>SERIES DESC </label>&nbsp;
			<label></label>
		</strong>
	</h4>
	<h4>
		<strong>
			<table class="table-dicom" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
				<thead class="thead1">
					<tr>
						<th>viewer</th>
						<th>series</th>
						<th>#i</th>
						<th>Create Time</th>
					</tr>
					<?php
					$pk_study = $row['pk'];
					$query = mysqli_query(
						$conn_pacsio,
						"SELECT * FROM series WHERE study_fk = '$pk_study'"
					);
					while ($row1 = mysqli_fetch_assoc($query)) {
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
		</strong>
	</h4>
	<br>
	<p>
</div>