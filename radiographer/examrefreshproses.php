<?php

require '../koneksi/koneksi.php';

if (isset($_POST['submit'])) {
	$uid = $_POST['uid'];

	echo $uid;

	// --------------- RIS

	$query3 = "SELECT * FROM xray_exam WHERE uid = '$uid'";
	$data_exam = mysqli_query($conn, $query3);
	$row3 = mysqli_fetch_assoc($data_exam);

	$acc = addslashes($row3['acc']);
	$patientid = addslashes($row3['patientid']);
	$mrn = addslashes($row3['mrn']);
	$name = addslashes($row3['name']);
	$lastname = addslashes($row3['lastname']);
	$address = addslashes($row3['address']);
	$sex = $row3['sex'];
	$birth_date = $row3['birth_date'];
	$weight = $row3['weight'];
	$name_dep = addslashes($row3['name_dep']);
	$xray_type_code = $row3['xray_type_code'];
	$typename = $row3['typename'];
	$type = $row3['type'];
	$prosedur = $row3['prosedur'];
	$dokterid = $row3['dokterid'];
	$named = addslashes($row3['named']);
	$lastnamed = addslashes($row3['lastnamed']);
	$email = $row3['email'];
	$radiographer_id = $row3['radiographer_id'];
	$radiographer_name = addslashes($row3['radiographer_name']);
	$radiographer_lastname = addslashes($row3['radiographer_lastname']);
	$dokradid = $row3['dokradid'];
	$dokrad_name = addslashes($row3['dokrad_name']);
	$dokrad_lastname = addslashes($row3['dokrad_lastname']);
	$create_time = $row3['create_time'];
	$schedule_date = $row3['schedule_date'];
	$schedule_time = $row3['schedule_time'];
	$contrast = $row3['contrast'];
	$priority = $row3['priority'];
	$pat_state = addslashes($row3['pat_state']);
	$contrast_allergies = $row3['contrast_allergies'];
	$spc_needs = addslashes($row3['spc_needs']);
	$payment = $row3['payment'];
	$arrive_date = $row3['arrive_date'];
	$arrive_time = $row3['arrive_time'];
	////SELECT DEPID////

	///////////////////
	//////dari PACS/////
	$query6 = "SELECT
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
		study.num_instances as num_instances_study,
		study.ext_retr_aet,
		study.retrieve_aets,
		study.fileset_iuid,
		study.fileset_id,
		study.availability,
		study.study_status,
		study.checked_time,
		study.updated_time as updated_time_study,
		study.created_time as created_time_study,
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
		series.num_instances as num_instances_series,
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
		series.created_time as created_time_series,
		series.updated_time as updated_time_series,
		series.series_attrs,
		series.content_time
		FROM
		patient
		INNER JOIN study ON study.patient_fk = patient.pk
		INNER JOIN series ON series.study_fk = study.pk WHERE study_iuid = '$uid'";
	$data_exam6 = mysqli_query($conn_pacs, $query6);
	$row6 = mysqli_fetch_assoc($data_exam6);

	$study_datetime = $row6['study_datetime'];
	$updated_time_study = $row6['updated_time_study'];
	$num_instances_study = $row6['num_instances_study'];
	$num_series = $row6['num_series'];
	$src_aet = $row6['src_aet'];
	$perf_physician = addslashes($row6['perf_physician']);
	$perf_physician = str_replace('^', ' ', $perf_physician);
	$pk = $row6['pk'];

	$queryseries = mysqli_query($conn_pacs, "SELECT study.pk,
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
		study.num_instances as num_instances_study,
		study.ext_retr_aet,
		study.retrieve_aets,
		study.fileset_iuid,
		study.fileset_id,
		study.availability,
		study.study_status,
		study.checked_time,
		study.updated_time as updated_time_study,
		study.created_time as created_time_study,
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
		series.num_instances as num_instances_series,
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
		series.created_time as created_time_series,
		series.updated_time as updated_time_series,
		series.series_attrs,
		series.content_time FROM series INNER JOIN study ON series.study_fk = study.pk WHERE study_fk = '$pk'");
	while ($rowseries = mysqli_fetch_assoc($queryseries)) {
		$study_iuid = $rowseries['study_iuid'];
		$series_iuid = $rowseries['series_iuid'];
		$series_no = $rowseries['series_no'];
		$modality = $rowseries['modality'];
		$body_part = $rowseries['body_part'];
		$series_desc = $rowseries['series_desc'];
		$institution = $rowseries['institution'];
		$station_name = $rowseries['station_name'];
		$department = $rowseries['department'];
		$perf_physician = $rowseries['perf_physician'];
		$perf_phys_fn_sx = $rowseries['perf_phys_fn_sx'];
		$pps_start = $rowseries['pps_start'];
		$pps_iuid = $rowseries['pps_iuid'];
		$num_instances_series = $rowseries['num_instances_series'];
		$retrieve_aets = $rowseries['retrieve_aets'];
		$created_time_series = $rowseries['created_time_series'];
		$updated_time_series = $rowseries['updated_time_series'];
		$content_time = $rowseries['content_time'];

		$queryseries2 = "INSERT INTO xray_series
		(uid, series_iuid, series_no, modality, body_part, series_desc, institution, station_name, department, perf_physician, perf_phys_fn_sx, pps_start, pps_iuid, num_instances,retrieve_aets, created_time, updated_time, content_time)
		VALUES
	     ('$study_iuid', '$series_iuid', '$series_no', '$modality', '$body_part', '$series_desc', '$institution', '$station_name', '$department', '$perf_physician', '$perf_phys_fn_sx', '$pps_start', '$pps_iuid', '$num_instances_series', '$retrieve_aets', '$created_time_series', '$updated_time_series', '$content_time')";
		mysqli_query($conn, $queryseries2);
	}

	////////////////////

	$query4 = "INSERT INTO xray_exam2
		(uid, acc, patientid, mrn, name, lastname, sex, birth_date, weight, depid, name_dep, xray_type_code, typename, type, prosedur,dokterid, named, lastnamed,email,radiographer_id,radiographer_name, radiographer_lastname, dokradid, dokrad_name, dokrad_lastname, create_time, schedule_date, schedule_time, contrast, priority, pat_state, contrast_allergies, spc_needs, payment, arrive_date, arrive_time,complete_date,complete_time,study_datetime, updated_time, num_instances, num_series, series_desc, src_aet)
	    VALUES
	    ('$uid', '$acc', '$patientid', '$mrn', '$name', '$lastname', '$sex', '$birth_date', '$weight', '$depid', '$name_dep', '$xray_type_code', '$typename', '$type', '$prosedur','$dokterid', '$named', '$lastnamed','$email','','$radiographer_name','','$dokradid','$dokrad_name','$dokrad_lastname','$create_time', '$schedule_date', '$schedule_time', '$contrast', '$priority', '$pat_state', '$contrast_allergies', '$spc_needs', '$payment', '$arrive_date', '$arrive_time', NOW(), NOW(), '$study_datetime', '$updated_time_study', '$num_instances_study', '$num_series', NULL, '$src_aet')";
	mysqli_query($conn, $query4);
	// if (!$cek) {
	// 	echo 'gagal';
	// }
	// // var_dump($query4);
	// die();

	$query5 = "INSERT INTO xray_workload_radiographer
    	(uid, acc, patientid, mrn, name, lastname, sex, birth_date, weight, depid, name_dep, xray_type_code, typename, type, prosedur,dokterid, named, lastnamed,email,radiographer_id,radiographer_name,radiographer_lastname, dokradid, dokrad_name, dokrad_lastname, create_time, schedule_date, schedule_time, contrast, priority, pat_state, contrast_allergies, spc_needs, payment, arrive_date, arrive_time,complete_date,complete_time,status, study_datetime, updated_time, num_instances, num_series, series_desc, src_aet, patienttype, kv, mas, filmsize8, filmsize10, filmreject8, filmreject10, rephoto, operator)
        VALUES
        ('$uid', '$acc', '$patientid', '$mrn', '$name', '$lastname', '$sex', '$birth_date', '$weight', '$depid', '$name_dep', '$xray_type_code', '$typename', '$type', '$prosedur','$dokterid', '$named', '$lastnamed','$email','','$radiographer_name','','$dokradid','$dokrad_name','$dokrad_lastname', '$create_time', '$schedule_date', '$schedule_time', '$contrast', '$priority', '$pat_state', '$contrast_allergies', '$spc_needs', '$payment', '$arrive_date', '$arrive_time', NOW(), NOW(),'ready to approve', '$study_datetime', '$updated_time_study', '$num_instances_study', '$num_series', NULL, '$src_aet', 'NORMAL', '$kv', '$mas', '$filmsize8', '$filmsize10', '$filmreject8', '$filmreject10', '$rephoto', '$operator')";
	mysqli_query($conn, $query5);

	mysqli_query($conn, "DELETE FROM xray_exam WHERE uid = '$uid'");
}
$query9 = "UPDATE study SET img = '1' WHERE study_iuid = '$uid' ";
mysqli_query($conn_pacs, $query9);

if (mysqli_query($conn, $query4)) {
	echo "New record created successfully";
} else {
	echo "Error: " . $query4 . "<br>" . mysqli_error($conn);
}

if ($dokradid) {

	$queryselectdr = "SELECT * FROM xray_dokter_radiology WHERE dokradid = '$dokradid' ";

	$resultselectdr = mysqli_query($conn, $queryselectdr);

	$rowselectdr = mysqli_fetch_assoc($resultselectdr);

	$nama = $rowselectdr['dokrad_name'] . ' ' . $rowselectdr['dokrad_lastname'];

	$idtele = $rowselectdr['idtele'];

	$token = "5414794545:AAGl8kEfUPyF-32OG3niUvWpRcJ5SSyrZ8c"; // token bot

	$data = [
		'text' => "Halo " . $nama . ", Pasien atas nama " . $name . " dengan MRN/No. Foto" . $mrn . "/" . $patientid . " telah selesai exam pada tanggal " . $updated_time_study . ", pasien sudah dapat dilakukan pembacaan expertise, Terimakasih",
		'chat_id' => $idtele  //contoh bot, group id -442697126
	];

	file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));

	// echo "<script>window.close('OTP SUDAH TERKIRIM');</script>";
}
header("location:examrefresh.php");
