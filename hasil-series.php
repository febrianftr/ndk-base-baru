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
	study.pk,
	study.study_desc
	FROM patient JOIN study
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
		<h5 class="text-center font-weight-bold">Pemeriksaan Detail</h5>
		<br>
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
					<td>Jenis Kelamin</td>
					<td>&nbsp;: </td>
					<td align="left">&nbsp; <?= defaultValue($row['pat_sex']); ?></td>
				</tr>
				<tr>
					<td>Pemeriksaan Utama</td>
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
						<th>Series</th>
						<th>Body Part</th>
						<th>Src Aet</th>
						<th>Modality</th>
						<th>#i</th>
						<th>Create Time</th>
					</tr>
					<?php
					$pk_study = $row['pk'];
					$query = mysqli_query(
						$conn_pacsio,
						"SELECT series_desc, body_part, src_aet, modality, num_instances, created_time FROM series WHERE study_fk = '$pk_study'"
					);
					while ($row1 = mysqli_fetch_assoc($query)) {
					?>
						<tr>
							<td align="left"><?= defaultValue($row1['series_desc']) ?></td>
							<td align="left"><?= defaultValue($row1['body_part']); ?></td>
							<td align="left"><?= defaultValue($row1['src_aet']); ?></td>
							<td align="left"><?= defaultValue($row1['modality']); ?></td>
							<td align="left"><?= defaultValue($row1['num_instances']); ?></td>
							<td align="left"><?= defaultValueDateTime($row1['created_time']); ?></td>
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