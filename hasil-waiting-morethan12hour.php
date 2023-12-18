<?php
require 'koneksi/koneksi.php';
require 'viewer-all.php';
require 'default-value.php';
require 'model/query-base-patient.php';
require 'model/query-base-study.php';
require 'model/query-base-workload.php';
require 'model/query-base-order.php';
require 'bahasa.php';

$waiting12hour = mysqli_query(
	$conn_pacsio,
	"SELECT 
	$select_patient, 
	$select_study, 
	$select_workload,
	$select_order
	FROM $table_patient
	JOIN $table_study 
	ON patient.pk = study.patient_fk 
	JOIN $table_workload
	ON study.study_iuid = xray_workload.uid 
	LEFT JOIN $table_order
	ON xray_order.uid = xray_workload.uid 
	WHERE status = 'waiting'
	AND study.study_datetime < DATE_SUB(NOW(), INTERVAL 12 HOUR)
	AND priority = 'normal'
	AND mods_in_study IN('CT','CT\\\\SR')
	AND contrast = 0
	AND study.updated_time >= '2023-11-26'
	"
);
?>
<style>
	.fill {
		padding: 50px;
	}
</style>
<div class="fill">
	<div class="table-responsive-sm">
		<h5 class="text-center font-weight-bold">The patient has not been read for more than 12 hour</h5>
	</div>
	<br>
	<h4>
		<strong>
			<table class="table-dicom" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
				<thead class="thead1">
					<tr>
						<th>Action</th>
						<th>Status</th>
						<th><?= $lang['patient_name'] ?></th>
						<th>MRN</th>
						<th><?= $lang['study_date'] ?></th>
						<th>No Foto</th>
						<th><?= $lang['study'] ?></th>
						<th>Contrast</th>
					</tr>
					<?php
					while ($row1 = mysqli_fetch_assoc($waiting12hour)) {
						// kondisi ketika dokter belum ada menggunakan icon berbeda
						if ($row1["pk_dokter_radiology"] == null && $row1["dokradid"] == null) {
							$icon_change_doctor = CHANGEDOCTORICONNO;
						} else {
							$icon_change_doctor = CHANGEDOCTORICONYES;
						}

						// kondisi jika prioriry normal dan CITO
						if ($row1["priority"] == 'Normal' || $row1["priority"] == 'NORMAL' || $row1["priority"] == 'normal') {
							$priority_style = PRIORITYNORMAL;
						} else if ($row1["priority"] == 'Cito' || $row1["priority"] == 'CITO' || $row1["priority"] == 'cito') {
							$priority_style = PRIORITYCITO;
						} else {
							$priority_style = '';
						}
					?>
						<tr>
							<td align="left"><a style="text-decoration: none;" href="changedoctorworklist.php?uid=<?= $row1["study_iuid"]; ?>&dokradid=<?= $row1["dokradid"]; ?>&status=<?= $row1["status"]; ?>"><span class="btn rgba-stylish-slight darken-1 btn-inti2"><?= $icon_change_doctor; ?></span></a></td>
							<td align=" left"><?= styleStatus($row1['status'], $row1['study_iuid']); ?></td>
							<td align="left"><?= defaultValue(removeCharacter($row1['pat_name'])) . '&nbsp;' . $priority_style ?></td>
							<td align="left"><?= defaultValue($row1['pat_id']) ?></td>
							<td align="left"><?= defaultValueDateTime($row1['study_datetime']); ?></td>
							<td align="left"><?= defaultValue($row1['patientid']); ?></td>
							<td align="left"><?= defaultValue($row1['study_desc']); ?></td>
							<td align="left"><?= contrast($row1['contrast']); ?></td>
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

<?php

mysqli_close($conn);
