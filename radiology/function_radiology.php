<?php

require '../koneksi/koneksi.php';
//untuk menampilkan
function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

// edit

function ubah_exam($ubah_exam)
{
	global $conn;
	$uid = $ubah_exam['uid'];
	$fill = addslashes($ubah_exam['fill']);

	$query = "UPDATE xray_exam2 SET 
				fill = '$fill'
				WHERE uid = '$uid'
	";
	mysqli_query($conn, $query);


	return mysqli_affected_rows($conn);
}

function ubahdokter($uid)
{
	global $conn;

	$query = "UPDATE xray_workload_radiographer SET 
				dokradid = NULL,
				dokrad_name = NULL,
				dokrad_lastname = NULL,
				approve_date = NULL,
				approve_time = NULL,
				status = 'ready to approve',
				fill = NULL
				WHERE uid = '$uid'
	";
	mysqli_query($conn, $query);

	$query1 = "DELETE FROM xray_workload WHERE uid = '$uid'";
	mysqli_query($conn, $query1);

	$query3 = "SELECT * FROM xray_workload_radiographer WHERE uid = '$uid'";
	$data_exam = mysqli_query($conn, $query3);
	$row3 = mysqli_fetch_assoc($data_exam);

	$acc = $row3['acc'];
	$patientid = $row3['patientid'];
	$mrn = $row3['mrn'];
	$name = $row3['name'];
	$lastname = $row3['lastname'];
	$address = $row3['address'];
	$sex = $row3['sex'];
	$birth_date = $row3['birth_date'];
	$weight = $row3['weight'];
	$name_dep = $row3['name_dep'];
	$xray_type_code = $row3['xray_type_code'];
	$typename = $row3['typename'];
	$type = $row3['type'];
	$prosedur = $row3['prosedur'];
	$dokterid = $row3['dokterid'];
	$named = $row3['named'];
	$lastnamed = $row3['lastnamed'];
	$email = $row3['email'];
	$radiographer_id = $row3['radiographer_id'];
	$radiographer_name = $row3['radiographer_name'];
	$radiographer_lastname = $row3['radiographer_lastname'];
	$dokradid = $row3['dokradid'];
	$dokrad_name = $row3['dokrad_name'];
	$dokrad_lastname = $row3['dokrad_lastname'];
	$create_time = $row3['create_time'];
	$schedule_date = $row3['schedule_date'];
	$schedule_time = $row3['schedule_time'];
	$contrast = $row3['contrast'];
	$priority = $row3['priority'];
	$pat_state = $row3['pat_state'];
	$contrast_allergies = $row3['contrast_allergies'];
	$spc_needs = $row3['spc_needs'];
	$payment = $row3['payment'];
	$arrive_date = $row3['arrive_date'];
	$arrive_time = $row3['arrive_time'];
	$complete_date = $row3['complete_date'];
	$complete_time = $row3['complete_time'];
	////SELECT DEPID////
	$query313 = "SELECT * FROM xray_department WHERE name_dep = '$name_dep'";
	$data_exam313 = mysqli_query($conn, $query313);
	$row313 = mysqli_fetch_assoc($data_exam313);
	$depid = $row313['depid'];
	$fill = $row3['fill'];
	$study_datetime = $row3['study_datetime'];
	$updated_time = $row3['updated_time'];
	$num_instances = $row3['num_instances'];
	$num_series = $row3['num_series'];
	$src_aet = $row3['src_aet'];
	$series_desc = $row3['series_desc'];
	$status = $row3['status'];

	mysqli_query($conn, "INSERT INTO xray_exam2
    	(uid, acc, patientid, mrn, name, lastname, address, sex, birth_date, weight, name_dep, xray_type_code, typename, type, prosedur,dokterid, named, lastnamed,email,radiographer_id,radiographer_name, radiographer_lastname,dokradid,dokrad_name,dokrad_lastname,create_time, schedule_date, schedule_time, contrast, priority, pat_state, contrast_allergies, spc_needs, payment, arrive_date, arrive_time,complete_date,complete_time,fill,study_datetime,updated_time, num_instances, num_series, series_desc, src_aet) VALUES
        ('$uid', '$acc', '$patientid', '$mrn', '$name', '$lastname', '$address', '$sex', '$birth_date', '$weight', '$name_dep', '$xray_type_code', '$typename', '$type', '$prosedur','$dokterid', '$named', '$lastnamed','$email','$radiographer_id','$radiographer_name','$radiographer_lastname','$dokradid','$dokrad_name','$dokrad_lastname','$create_time', '$schedule_date', '$schedule_time', '$contrast', '$priority', '$pat_state', '$contrast_allergies', '$spc_needs','$payment','$arrive_date', '$arrive_time','$complete_date','$complete_time','$fill','$study_datetime','$updated_time', '$num_instances', '$num_series', '$series_desc', '$src_aet') ");

	return mysqli_affected_rows($conn);
}

function ubahdokterworklist($post)
{
	global $conn;

	$uid = $post['uid'];
	$dokradid = $post['dokradid'];

	$query4 = "SELECT * FROM xray_dokter_radiology WHERE dokradid = '$dokradid'";
	$data_exam1 = mysqli_query($conn, $query4);
	$row4 = mysqli_fetch_assoc($data_exam1);

	$dokradid1 = $row4['dokradid'];
	$dokradname1 = $row4['dokrad_name'];
	$dokradlastname1 = $row4['dokrad_lastname'];

	$query = "UPDATE xray_exam2 SET 
				dokradid = '$dokradid1',
				dokrad_name = '$dokradname1',
				dokrad_lastname = '$dokradlastname1'
				WHERE uid = '$uid'
	";
	mysqli_query($conn, $query);

	$query1 = "UPDATE xray_workload_radiographer SET 
	dokradid = '$dokradid1',
	dokrad_name = '$dokradname1',
	dokrad_lastname = '$dokradlastname1'
	WHERE uid = '$uid'
	";
	mysqli_query($conn, $query1);

	return mysqli_affected_rows($conn);
}

function bgst($post_exam_fill)
{
	global $conn;
	$uid = $post_exam_fill['uid'];
	$fill = $post_exam_fill['fill'];
	$q2 = mysqli_query($conn, 'SELECT MAX(pdf_id) as pdf from xray_testpdf');
	$row2 = mysqli_fetch_assoc($q2);
	$ai2 = $row2['pdf'] + 1;
	$query = "INSERT INTO xray_testpdf
				VALUES 
				('$ai2','$fill')
				";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function input_temp($post_exam_temp)
{
	global $conn;
	$title = $post_exam_temp['title'];
	$fill = $post_exam_temp['fill'];
	$username = $_SESSION['username'];
	if (empty($title)) {
		echo "<script>alert('Title belum diisi!');</script>";
	} else {
		$q2 = mysqli_query($conn, 'SELECT MAX(template_id) as pdf from xray_template');
		$row2 = mysqli_fetch_assoc($q2);
		$ai2 = $row2['pdf'] + 1;
		$query = "INSERT INTO xray_template
				VALUES 
				('$ai2','$title','$fill','$username')
				";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}
}

function input_approve($get_approve)
{
	global $conn;
	$uid = $get_approve['uid'];
	$fill = addslashes($get_approve['fill']);
	$username = $get_approve['username'];
	$patienttype = $get_approve['patienttype'];

	$result = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE username = '$username' ");
	$row = mysqli_fetch_assoc($result);

	$dokradid = $row['dokradid'];
	$dokrad_name = $row['dokrad_name'];
	$dokrad_lastname = $row['dokrad_lastname'];

	$query3 = "SELECT * FROM xray_exam2 WHERE uid = '$uid'";
	$data_exam = mysqli_query($conn, $query3);
	$row3 = mysqli_fetch_assoc($data_exam);
	$acc = $row3['acc'];
	$patientid = $row3['patientid'];
	$mrn = $row3['mrn'];
	$name = $row3['name'];
	$name1 = str_replace('^', ' ', $name);
	$name1 = addslashes($name1);
	$lastname = addslashes($row3['lastname']);
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
	$complete_date = $row3['complete_date'];
	$complete_time = $row3['complete_time'];
	$study_datetime = $row3['study_datetime'];
	$updated_time = $row3['updated_time'];
	$num_instances = $row3['num_instances'];
	$num_series = $row3['num_series'];
	$series_desc = $row3['series_desc'];
	$src_aet = $row3['src_aet'];

	$query4 = "INSERT INTO xray_workload
		(uid, acc, patientid, mrn, name, lastname, sex, birth_date, weight, name_dep, xray_type_code, typename, type, prosedur,dokterid, named, lastnamed,email,radiographer_id,radiographer_name, radiographer_lastname,dokradid,dokrad_name,dokrad_lastname,create_time, schedule_date, schedule_time, contrast, priority, pat_state, contrast_allergies, spc_needs, payment, arrive_date, arrive_time,complete_date,complete_time,approve_date,approve_time,fill,study_datetime,updated_time,num_instances,num_series, series_desc, src_aet, patienttype)
        VALUES
        ('$uid', '$acc', '$patientid', '$mrn', '$name1', '$lastname', '$sex', '$birth_date', '$weight', '$name_dep', '$xray_type_code', '$typename', '$type', '$prosedur','$dokterid', '$named', '$lastnamed','$email','$radiographer_id','$radiographer_name','$radiographer_lastname','$dokradid','$dokrad_name','$dokrad_lastname','$create_time', '$schedule_date', '$schedule_time', '$contrast', '$priority', '$pat_state', '$contrast_allergies', '$spc_needs','$payment','$arrive_date', '$arrive_time','$complete_date','$complete_time',NOW(),NOW(),'$fill','$study_datetime','$updated_time','$num_instances', '$num_series', '$series_desc', '$src_aet', '$patienttype')";
	mysqli_query($conn, $query4);


	$query5 = "UPDATE xray_workload_radiographer SET
    			dokradid = '$dokradid', 
				dokrad_name = '$dokrad_name',
				dokrad_lastname = '$dokrad_lastname',
				approve_date = NOW(), 
				approve_time = NOW(), 
				fill ='$fill', 
				status = 'APPROVED',
				patienttype = '$patienttype'
				WHERE uid = '$uid'
				";
	mysqli_query($conn, $query5);

	mysqli_query($conn, "DELETE FROM xray_exam2 WHERE uid = '$uid'");

	return mysqli_affected_rows($conn);
}

// -------------------------------------------------------

function input_approve_pacs($get_approve_pacs)
{
	global $conn_pacs, $conn;
	$study_iuid = $get_approve_pacs['study_iuid'];
	$username = $get_approve_pacs['username'];
	$fill = $get_approve_pacs['fill'];
	$query = "SELECT * FROM xray_dokter_radiology WHERE username = '$username' ";
	$data_user = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($data_user);
	$dokradid =	$row['dokradid'];
	$dokrad_name =	$row['dokrad_name'];
	$dokrad_lastname = $row['dokrad_lastname'];

	$fill = $get_approve_pacs['fill'];
	$query3 = "SELECT * 
		   	   FROM study 
		       INNER JOIN patient 
		       ON study.patient_fk = patient.pk 
		       INNER JOIN series
		       ON study.pk = series.study_fk
		       WHERE study_iuid = '$study_iuid' ";
	$data_exam = mysqli_query($conn_pacs, $query3);
	$row3 = mysqli_fetch_assoc($data_exam);
	$pat_id = $row3['pat_id'];
	$pat_name = $row3['pat_name'];
	$name1 = str_replace('^', ' ', $pat_name);
	$pat_sex = $row3['pat_sex'];
	$pat_birthdate = $row3['pat_birthdate'];
	// $pat_birthdate1 = date('Y-m-d', strtotime($row111["pat_birthdate"]));
	$accession_no = $row3['accession_no'];
	$mods_in_study = $row3['mods_in_study'];
	$ref_physician = $row3['ref_physician'];
	$perf_physician = $row3['perf_physician'];
	$perf_physician1 = str_replace('^', ' ', $perf_physician);
	$study_desc = $row3['study_desc'];
	$updated_time = $row3['updated_time'];
	$study_datetime = $row3['study_datetime'];
	$series_desc = $row3['series_desc'];

	mysqli_query($conn, "INSERT INTO xray_workload 
						(uid, acc, patientid, mrn, name, lastname, sex, birth_date, xray_type_code, prosedur, named, radiographer_name, dokradid, dokrad_name, dokrad_lastname, complete_date, complete_time, approve_date, approve_time, fill,study_datetime,updated_time) 

						 VALUES ('$study_iuid','$accession_no', '$pat_id','','$name1','','$pat_sex','$pat_birthdate', '$mods_in_study',
						 '$study_desc', '$ref_physician', '$perf_physician1', '$dokradid', '$dokrad_name', '$dokrad_lastname',
						 '$study_datetime', '$study_datetime', NOW(),NOW(), '$fill','$study_datetime','$updated_time') ");

	mysqli_query($conn_pacs, "UPDATE study SET img = 'approve' WHERE study_iuid = '$study_iuid'");

	mysqli_query($conn, "INSERT INTO xray_workload_radiographer (uid, acc, patientid, mrn, name, lastname, sex, birth_date, xray_type_code, prosedur, named, 
						 radiographer_name, dokradid, dokrad_name, dokrad_lastname, complete_date, complete_time, approve_date, approve_time,fill,status,study_datetime,updated_time) 

						 VALUES ('$study_iuid','$accession_no', '$pat_id','','$name1','','$pat_sex','$pat_birthdate','$mods_in_study',
						 '$series_desc','$ref_physician','$perf_physician1','$dokradid','$dokrad_name', '$dokrad_lastname','$study_datetime', '$study_datetime',NOW(),NOW(),'$fill','APPROVED','$study_datetime','$updated_time') ");

	mysqli_query($conn, "DELETE FROM xray_exam2 WHERE uid = '$study_iuid'");

	return mysqli_affected_rows($conn_pacs);
}

// ----------------------------------------------------------

function ubah_exam_pacs($post_exam)
{
	global $conn_pacs;
	$study_iuid = $post_exam['study_iuid'];
	$fill = $post_exam['fill'];

	$query = "UPDATE study SET 
				fill = '$fill'
				WHERE study_iuid = '$study_iuid'
	";
	mysqli_query($conn_pacs, $query);

	return mysqli_affected_rows($conn_pacs);
}

// ---------------------------------------------------------

function ashiap($post_fill)
{
	global $conn;
	$uid = $post_fill['uid'];
	$title = $post_fill['title'];
	$q3 = mysqli_query($conn, 'SELECT * FROM xray_template WHERE title = "$title"');
	$row3 = mysqli_fetch_assoc($q3);
	$fill = $row3['fill'];

	return mysqli_affected_rows($conn);
}

// =================================Workload Edit================================

function savedraftworkload($post_exam)
{
	global $conn;
	$uid = $post_exam['uid'];
	$fill = addslashes($post_exam['fill']);
	$patienttype = $post_exam['patienttype'];

	$query = "UPDATE xray_workload SET 
				fill = '$fill',
				approve_update = NOW(),
				approve_uptime = NOW(),
				patienttype = '$patienttype'
				WHERE uid = '$uid'
	";
	mysqli_query($conn, $query);

	$query = "UPDATE xray_workload_radiographer SET 
				fill = '$fill',
				patienttype = '$patienttype'
				WHERE uid = '$uid'
	";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function savetempworkload($post_exam_temp)
{
	global $conn;
	$title = $post_exam_temp['title'];
	$fill = $post_exam_temp['fill'];
	$username = $_SESSION['username'];
	if (empty($title)) {
		echo "<script>alert('Title belum diisi!');</script>";
	} else {
		$q2 = mysqli_query($conn, 'SELECT MAX(template_id) as pdf from xray_template');
		$row2 = mysqli_fetch_assoc($q2);
		$ai2 = $row2['pdf'] + 1;
		$query = "INSERT INTO xray_template
				VALUES 
				('$ai2','$title','$fill','$username')
				";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);
	}
}

function ubahworkload($post_edit_workload)
{
	global $conn;
	$uid = $post_edit_workload['uid'];
	$acc = $post_edit_workload['acc'];
	$patientid = $post_edit_workload['patientid'];
	$mrn = $post_edit_workload['mrn'];
	$name = addslashes($post_edit_workload['name']);
	$name1 = str_replace('^', ' ', $name);
	$lastname = addslashes($post_edit_workload['lastname']);
	$sex = $post_edit_workload['sex'];
	$birth_date = $post_edit_workload['birth_date'];
	$weight = $post_edit_workload['weight'];

	$xray_type_code = $post_edit_workload['xray_type_code'];
	$modalitas = mysqli_query($conn, "SELECT * FROM xray_modalitas WHERE xray_type_code = '$xray_type_code'");
	$row_modal = mysqli_fetch_assoc($modalitas);
	$typename = $row_modal['typename'];
	$xray_type_code = $row_modal['xray_type_code'];

	$depid = $post_edit_workload['depid'];
	$department = mysqli_query($conn, "SELECT * FROM xray_department WHERE depid = '$depid'");
	$row_depart = mysqli_fetch_assoc($department);
	$name_dep = addslashes($row_depart['name_dep']);

	@$prosedur = $post_edit_workload['prosedur'];

	$dokterid = $post_edit_workload['dokterid'];
	$namedluar = addslashes($post_edit_workload['namedluar']);
	$lastnamedluar = addslashes($post_edit_workload['lastnamedluar']);
	$emailluar = $post_edit_workload['emailluar'];

	$dokter = mysqli_query($conn, "SELECT * FROM xray_dokter WHERE dokterid = '$dokterid'");
	$row_dokter = mysqli_fetch_assoc($dokter);
	$named = addslashes($row_dokter['named']);
	$lastnamed = addslashes($row_dokter['lastnamed']);
	$email = $row_dokter['email'];

	$radiographer_id = $post_edit_workload['radiographer_id'];
	$radiographer = mysqli_query($conn, "SELECT * FROM xray_radiographer WHERE radiographer_id = '$radiographer_id'");
	$row_depart = mysqli_fetch_assoc($radiographer);
	$radiographer_name = addslashes($row_depart['radiographer_name']);
	$radiographer_lastname = addslashes($row_depart['radiographer_lastname']);

	$contrast = $post_edit_workload['contrast'];
	$priority = $post_edit_workload['priority'];
	$pat_state = addslashes($post_edit_workload['pat_state']);
	$contrast_allergies = $post_edit_workload['contrast_allergies'];
	$spc_needs = addslashes($post_edit_workload['spc_needs']);

	if (!$dokterid) {
		$query = "UPDATE xray_workload SET 
				acc = '$acc',
				patientid = '$patientid',
				mrn = '$mrn',
				name = '$name1',
				lastname = '$lastname',
				sex = '$sex',
				birth_date = '$birth_date',
				weight = '$weight',
				depid = '$depid',
				name_dep = '$name_dep',
				xray_type_code = '$xray_type_code',
				typename = '$typename',
				dokterid = '',
				named = '$namedluar',
				lastnamed = '$lastnamedluar',
				email = '$emailluar',
				contrast = '$contrast',
				priority = '$priority',
				pat_state = '$pat_state',
				contrast_allergies = '$contrast_allergies',
				spc_needs = '$spc_needs'
				WHERE uid = '$uid'
	";
		mysqli_query($conn, $query);

		mysqli_query($conn, "UPDATE xray_workload_radiographer SET 
				acc = '$acc',
				patientid = '$patientid',
				mrn = '$mrn',
				name = '$name1',
				lastname = '$lastname',
				sex = '$sex',
				birth_date = '$birth_date',
				weight = '$weight',
				depid = '$depid',
				name_dep = '$name_dep',
				xray_type_code = '$xray_type_code',
				typename = '$typename',
				dokterid = '$dokterid',
				named = '$named',
				lastnamed = '$lastnamed',
				email = '$email',
				contrast = '$contrast',
				priority = '$priority',
				pat_state = '$pat_state',
				contrast_allergies = '$contrast_allergies',
				spc_needs = '$spc_needs'
				WHERE uid = '$uid'");
	} else {
		$query = "UPDATE xray_workload SET 
				acc = '$acc',
				patientid = '$patientid',
				mrn = '$mrn',
				name = '$name1',
				lastname = '$lastname',
				sex = '$sex',
				birth_date = '$birth_date',
				weight = '$weight',
				depid = '$depid',
				name_dep = '$name_dep',
				xray_type_code = '$xray_type_code',
				typename = '$typename',
				dokterid = '$dokterid',
				named = '$named',
				lastnamed = '$lastnamed',
				email = '$email',
				contrast = '$contrast',
				priority = '$priority',
				pat_state = '$pat_state',
				contrast_allergies = '$contrast_allergies',
				spc_needs = '$spc_needs'
				WHERE uid = '$uid'
	";
		mysqli_query($conn, $query);

		mysqli_query($conn, "UPDATE xray_workload_radiographer SET 
				acc = '$acc',
				patientid = '$patientid',
				mrn = '$mrn',
				name = '$name1',
				lastname = '$lastname',
				sex = '$sex',
				birth_date = '$birth_date',
				weight = '$weight',
				depid = '$depid',
				name_dep = '$name_dep',
				xray_type_code = '$xray_type_code',
				typename = '$typename',
				dokterid = '$dokterid',
				named = '$named',
				lastnamed = '$lastnamed',
				email = '$email',
				contrast = '$contrast',
				priority = '$priority',
				pat_state = '$pat_state',
				contrast_allergies = '$contrast_allergies',
				spc_needs = '$spc_needs'
				WHERE uid = '$uid'");
	}

	return mysqli_affected_rows($conn);
}

// =================================Hapus Template================================

function hapus_temp($template_id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_template WHERE template_id = '$template_id' ");
	return mysqli_affected_rows($conn);
}

function hapus_temp_new($template_id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_template WHERE template_id = '$template_id' ");
	return mysqli_affected_rows($conn);
}

function ubah_temp_new($ubah_template_id)
{
	global $conn;
	$template_id = $ubah_template_id['template_id'];
	$title = $ubah_template_id['title'];
	$fill = $ubah_template_id['fill'];

	mysqli_query($conn, "UPDATE xray_template SET 
				title = '$title',
				fill = '$fill'
				WHERE template_id = '$template_id'
	");
	return mysqli_affected_rows($conn);
}

function new_temp($new_template)
{
	global $conn;
	$title = $new_template['title'];
	$fill = $new_template['fill'];
	$username = $_SESSION['username'];

	$q5 = mysqli_query($conn, 'SELECT MAX(template_id) as user_id5 from xray_template');
	$row5 = mysqli_fetch_assoc($q5);
	$ai5 = $row5['user_id5'] + 1;

	mysqli_query($conn, "INSERT INTO xray_template (template_id,title,fill,username) VALUES ('$ai5','$title','$fill','$username')");

	return mysqli_affected_rows($conn);
}

function password($passwordid)
{
	global $conn;
	$username = $_SESSION['username'];
	$password = $passwordid["password"];
	$password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	mysqli_query($conn, "UPDATE xray_login SET 
				password = '$password_hash'
				WHERE username = '$username'");

	mysqli_query($conn, "UPDATE xray_dokter_radiology SET 
				password = '$password_hash'
				WHERE username = '$username'");
}

function approvesignworkload($approvesign)
{
	global $conn;
	$approvedsign = $approvesign['approvedsign'];
	$uid = $approvesign['uid'];
	$uid2 = $uid . '.png';

	if (empty($approvedsign)) {
		echo "<script>alert('APPROVED BELUM DI CENTANG');</script>";
	} else {
		$query = "UPDATE xray_workload_radiographer SET
				signature = '$uid2',
				signature_datetime = NOW()
				WHERE uid = '$uid'
				";
		mysqli_query($conn, $query);

		$query2 = "UPDATE xray_workload SET
				signature = '$uid2',
				signature_datetime = NOW()
				WHERE uid = '$uid'
				";
		mysqli_query($conn, $query2);

		return mysqli_affected_rows($conn);
	}
}
