<?php 

$study_iuid = $get_approve_pacs['study_iuid'];
	$fill = $get_approve_pacs['fill'];
	$query3 = "SELECT * 
		   	   FROM study 
		       INNER JOIN patient 
		       ON study.patient_fk = patient.pk 
		       WHERE study_iuid = '$study_iuid' ";
	$data_exam = mysqli_query($conn_pacs,$query3);
	$row3 = mysqli_fetch_assoc($data_exam);

	$pat_id = $row3['pat_id'];
	$pat_name = $row3['pat_name'];
	$pat_sex = $row3['pat_sex'];
	$pat_birthdate = $row3['pat_birthdate'];
	$accession_no = $row3['accession_no'];
	$mods_in_study = $row3['mods_in_study'];
	$ref_physician = $row3['ref_physician'];
	$study_desc = $row3['study_desc'];

    $query5 = "UPDATE xray_workload SET 
				patientid = '$pat_id', 
				name = '$pat_name', 
				sex ='$pat_sex', 
				birth_date = '$pat_birthdate',
				acc = '$accession_no',
				xray_type_code = '$mods_in_study',
				dokrad_name = '$ref_physician',
				spc_needs = '$study_desc',
				fill = '$fill'
				WHERE uid = '$study_iuid'
				";
	mysqli_query($conn, $query5);

 ?>