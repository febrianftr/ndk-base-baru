<?php

require '../koneksi/koneksi.php';


// -------------------------- SELECT WAITING KIRIM KE PACS ----------------------------------

$pacs = mysqli_query($conn_pacs, "SELECT
study.patient_fk,
series.study_fk,
patient.merge_fk,
patient.pat_id,
patient.pat_id_issuer,
patient.pat_name,
patient.pat_fn_sx,
patient.pat_gn_sx,
patient.pat_i_name,
patient.pat_p_name,
patient.pat_birthdate,
patient.pat_sex,
patient.pat_custom1,
patient.pat_custom2,
patient.pat_custom3,
patient.created_time,
patient.pat_attrs,
study.pk,
study.accno_issuer_fk,
study.study_iuid,
study.study_id,
study.study_datetime,
study.accession_no,
study.ref_physician,
study.ref_phys_fn_sx,
study.ref_phys_gn_sx,
study.ref_phys_i_name,
study.ref_phys_p_name,
study.study_desc,
study.study_custom1,
study.study_custom2,
study.study_custom3,
study.study_status_id,
study.mods_in_study,
study.cuids_in_study,
study.num_series,
study.num_instances,
study.ext_retr_aet,
study.retrieve_aets,
study.fileset_iuid,
study.fileset_id,
study.availability,
study.study_status,
study.checked_time,
study.updated_time,
study.created_time,
study.study_attrs,
study.chargeId,
study.totalCharge,
study.billId,
study.invoiceNo,
study.batchNo,
study.img,
study.fill,
study.del,
series.mpps_fk,
series.inst_code_fk,
series.series_iuid,
series.series_no,
series.modality,
series.body_part,
series.laterality,
series.series_desc,
series.institution,
series.station_name,
series.department,
series.perf_physician,
series.perf_phys_fn_sx,
series.perf_phys_gn_sx,
series.perf_phys_i_name,
series.perf_phys_p_name,
series.pps_start,
series.pps_iuid,
series.series_custom1,
series.series_custom2,
series.series_custom3,
series.src_aet,
series.ext_retr_aet,
series.retrieve_aets,
series.fileset_iuid,
series.fileset_id,
series.availability,
series.series_status,
series.created_time,
series.series_attrs,
series.content_time
FROM
patient
INNER JOIN study ON study.patient_fk = patient.pk
INNER JOIN series ON series.study_fk = study.pk WHERE study.img IS NULL OR study.img = ' ' GROUP BY study_iuid ORDER BY study.study_datetime ASC ");
?>
<meta http-equiv="refresh" content="1" />
<table>
	<tr>
		<th>
			<center>UID</center>
		</th>
		<th>
			<center>MRN/Patient ID</center>
		</th>
		<th>
			<center>Nama</center>
		</th>
		<th>
			<center>Jenis Kelamin</center>
		</th>
		<th>
			<center>Nama Type</center>
		</th>
		<th>
			<center>Prosedur</center>
		</th>
		<th>
			<center>Nama Dokter </center>
		</th>
		<th>
			<center>Waktu Order</center>
		</th>
		<th>
			<center>action</center>
		</th>
	</tr>
	<?php $result = mysqli_query($conn, "SELECT * FROM xray_exam GROUP BY pk"); ?>
	<?php while ($row = mysqli_fetch_array($result)) {
		$uid = $row['uid'];
	?>
		<form action="examrefreshproses.php" method="POST">
			<tr>
				<input name="uid" type="hidden" id="uid" value="<?= $uid; ?>">
				<td><?php echo $uid; ?></td>
				<td align=center><?= $row['mrn']; ?></td>
				<td align=center><?= $row['name']; ?> <?= $row['lastname']; ?></td>
				<td align=center><?= $row['sex']; ?></td>
				<td align=center><?= $row['type']; ?></td>
				<td align=center><?= $row['prosedur']; ?></td>
				<td align=center><?= $row['named']; ?> <?= $row['lastnamed']; ?></td>
				<td align=center><?= $row['create_time']; ?></td>
				<?php
				$result2 = mysqli_query($conn_pacs, "SELECT * FROM study WHERE study_iuid = '$uid' ");
				$row2 = mysqli_fetch_assoc($result2);
				$study_iuid = $row2['study_iuid'];
				?><?php if (!$study_iuid) { ?>

			<?php } else { ?>
				<td><input type="submit" name="submit" value="proses exam" id="modal"></td>
			<?php } ?>
			</tr>
		</form>
	<?php } ?>
	<?php while ($row1 = mysqli_fetch_array($pacs)) {
		$study_iuid1 = $row1['study_iuid'];
		$ref_physician = $row1['ref_physician'];
		$ref_physician1 = str_replace('^', ' ', $ref_physician);
		$pat_name = $row1['pat_name'];
		$pat_name1 = str_replace('^', ' ', $pat_name);
		$del = $row1['del'];

		$data_dicom6 = mysqli_query($conn, "SELECT * FROM xray_exam WHERE uid = '$study_iuid1' ");
		$row5 = mysqli_fetch_assoc($data_dicom6);
		$uid3 = $row5['uid'];

		$data_dicom5 = mysqli_query($conn, "SELECT * FROM xray_exam2 WHERE uid = '$study_iuid1' ");
		$row4 = mysqli_fetch_assoc($data_dicom5);
		$uid2 = $row4['uid'];

		$data_dicom4 = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer WHERE uid = '$study_iuid1' ");
		$row3 = mysqli_fetch_assoc($data_dicom4);
		$uid1 = $row3['uid'];
		if (!$del) {
			if (!$uid3) {
				if (!$uid1 and !$uid2) {
	?>
					<form action="examrefreshprosespacs.php" method="POST">
						<tr>
							<input name="study_iuid" type="hidden" id="study_iuid" value="<?= $study_iuid1; ?>">
							<td><?php echo $study_iuid1; ?></td>
							<td align=center><?= $row1['pat_id']; ?></td>
							<td align=center><?= $pat_name1; ?></td>
							<td align=center><?= $row1['pat_sex']; ?></td>
							<td align=center><?= $row1['mods_in_study']; ?></td>
							<td align=center><?= $row1['study_desc']; ?></td>
							<td align=center><?= $ref_physician; ?></td>
							<td align=center><?= $row1['study_datetime']; ?></td>
							<td><input type="submit" name="submitpacs" value="proses exam pacs" id="modal"></td>
						</tr>
					</form>
				<?php } ?>
			<?php } ?>
		<?php } ?>
	<?php } ?>
</table>
<?php require 'script-footer.php' ?>
<script>
	$(document).ready(function() {
		$("#modal").trigger("click");
	});
</script>