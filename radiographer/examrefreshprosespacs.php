<?php

require '../koneksi/koneksi.php';

if (isset($_POST['submitpacs'])) {

	@$study_iuid = $_POST['study_iuid'];

	// -----------------------pacs


	session_start();

	$query1 = "SELECT
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
    INNER JOIN series ON series.study_fk = study.pk WHERE study_iuid = '$study_iuid'";
	$pacs = mysqli_query($conn_pacs, $query1);
	$row1 = mysqli_fetch_assoc($pacs);

	$accession_no = addslashes($row1['accession_no']);
	$pat_id = addslashes($row1['pat_id']);
	$pat_name = $row1['pat_name'];
	$pat_name1 = str_replace('^', ' ', $pat_name);
	$pat_name1 = addslashes($pat_name1);
	$pat_sex = $row1['pat_sex'];
	$pat_birthdate = $row1['pat_birthdate'];
	$mods_in_study = $row1['mods_in_study'];
	$study_desc = $row1['study_desc'];
	$ref_physician = $row1['ref_physician'];
	$ref_physician1 = str_replace('^', ' ', $ref_physician);
	$ref_physician1 = addslashes($ref_physician1);
	$username = $_SESSION['username'];
	$radiographer = mysqli_query($conn, "SELECT * FROM xray_radiographer WHERE username = '$username' ");
	$row2 = mysqli_fetch_assoc($radiographer);
	$radiographer_id = $row2['radiographer_id'];
	$radiographer_name = addslashes($row2['radiographer_name']);
	$radiographer_lastname = addslashes($row2['radiographer_lastname']);
	$study_datetime = $row1['study_datetime'];
	$updated_time_study = $row1['updated_time_study'];
	$num_instances_study = $row1['num_instances_study'];
	$num_series = $row1['num_series'];
	$src_aet = $row1['src_aet'];
	$pk = $row1['pk'];
	$perf_physician = $row1['perf_physician'];
	$perf_physician = str_replace('^', ' ', $perf_physician);
	$perf_physician = addslashes($perf_physician);

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

	$query7 = "INSERT INTO xray_exam2
		(uid, acc, patientid, mrn, name, lastname, sex, birth_date, xray_type_code, prosedur, named, radiographer_id, radiographer_name, radiographer_lastname, create_time, schedule_date, schedule_time, arrive_date, arrive_time,complete_date,complete_time,study_datetime, updated_time, num_instances, num_series, series_desc, src_aet)
        VALUES
            ('$study_iuid', '$accession_no', '$pat_id','$pat_id', '$pat_name1','','$pat_sex', '$pat_birthdate', '$mods_in_study', '$study_desc', '$ref_physician1','','$radiographer_name2','','$study_datetime', '$study_datetime', '$study_datetime', '0000-00-00', '00:00:00', NOW(), NOW(), '$study_datetime', '$updated_time_study', '$num_instances_study', '$num_series', '$series_desc', '$src_aet')";
	mysqli_query($conn, $query7);

	$query8 = "INSERT INTO xray_workload_radiographer
    	(uid, acc, mrn, patientid, name, lastname, sex, birth_date, xray_type_code, prosedur, named, radiographer_id, radiographer_name, radiographer_lastname, create_time, schedule_date, schedule_time, arrive_date, arrive_time,complete_date,complete_time,status, study_datetime, updated_time, num_instances, num_series, series_desc, src_aet, patienttype, kv, mas, filmsize8, filmsize10, filmreject8, filmreject10, rephoto, operator)
        VALUES
            ('$study_iuid', '$accession_no', '$pat_id','$pat_id', '$pat_name1', '', '$pat_sex', '$pat_birthdate', '$mods_in_study', '$study_desc', '$ref_physician1','', '$radiographer_name2', '', '$study_datetime', '$study_datetime', '$study_datetime', '0000-00-00', '00:00:00', NOW(), NOW(),'ready to approve', '$study_datetime', '$updated_time_study', '$num_instances_study', '$num_series', '$series_desc', '$src_aet', 'NORMAL', '$kv', '$mas', '$filmsize8', '$filmsize10', '$filmreject8', '$filmreject10', '$rephoto', '$operator')";
	mysqli_query($conn, $query8);
	
	$query9 = "UPDATE study SET img = '1' WHERE study_iuid = '$study_iuid' ";
	mysqli_query($conn_pacs, $query9);
	
	echo ("erorr " . mysqli_error($conn));
}

header("location:examrefresh.php");
