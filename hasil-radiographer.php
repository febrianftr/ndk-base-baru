<?php
require 'koneksi/koneksi.php';
require 'viewer-all.php';
require 'default-value.php';
require 'model/query-base-patient.php';
require 'model/query-base-study.php';
require 'model/query-base-workload-radiographers.php';
require 'bahasa.php';

$uid = $_POST['uid'];
$row = mysqli_fetch_assoc(mysqli_query(
	$conn_pacsio,
	"SELECT $select_patient,
	$select_study
	FROM $table_patient
	JOIN $table_study
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
		<h5 class="text-center font-weight-bold"><?= $lang['study'] ?> Detail</h5>
		<br>
		<table class="" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
			<thead class="thead1">
				<tr>
					<td><?= $lang['patient_name'] ?></td>
					<td>&nbsp;: </td>
					<td align="left">&nbsp; <?= removeCharacter($row['pat_name']); ?></td>
				</tr>
				<tr>
					<td>MRN</td>
					<td>&nbsp;: </td>
					<td align="left">&nbsp; <?= defaultValue($row['pat_id']); ?></td>
				</tr>
				<tr>
					<td><?= $lang['sex'] ?></td>
					<td>&nbsp;: </td>
					<td align="left">&nbsp; <?= defaultValue($row['pat_sex']); ?></td>
				</tr>
				<tr>
					<td><?= $lang['study'] ?></td>
					<td>&nbsp;: </td>
					<td align="left" class="font-weight-bold">&nbsp; <?= defaultValue($row['study_desc']); ?></td>
				</tr>
			</thead>
		</table>
	</div>
	<br>
	<h4>
		<strong>
			<table class="table-dicom" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
				<thead class="thead1">
					<tr>
						<th>Radiographer ID</th>
						<th>Radiographer Name</th>
						<th>Created Date</th>
						<th>Updated Date</th>
					</tr>
					<?php
					$study_iuid = $row['study_iuid'];
					$query = mysqli_query(
						$conn_pacsio,
						"SELECT
						$select_workload_radiographers
						FROM $table_workload_radiographers
						WHERE uid = '$study_iuid'"
					);
					$count = mysqli_num_rows($query);
					if ($count > 0) {
						while ($row1 = mysqli_fetch_assoc($query)) { ?>
							<tr>
								<td align="left"><?= defaultValue($row1['radiographers_id']) ?></td>
								<td align="left"><?= defaultValue($row1['radiographers_name']) ?></td>
								<td align="left"><?= defaultValueDateTime($row1['created_at']); ?></td>
								<td align="left"><?= defaultValueDateTime($row1['updated_at']); ?></td>
							</tr>
						<?php }
					} else { ?>
						<tr>
							<td colspan="5">Data tidak ditemukan</td>
						</tr>
					<?php } ?>
				</thead>
			</table>
		</strong>
	</h4>
	<br>
	<p>
</div>

<?php

mysqli_close($conn);
