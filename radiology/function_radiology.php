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

function update_draft($value)
{
	global $conn;
	$uid = $value['uid'];
	$fill = addslashes($value['fill']);

	mysqli_query(
		$conn,
		"UPDATE xray_workload SET 
		fill = '$fill'
		WHERE uid = '$uid'"
	);

	return mysqli_affected_rows($conn);
}

function insert_template_workload($post_exam_temp)
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

function insert_workload($value)
{
	global $conn;
	$uid = $value['uid'];
	$fill = addslashes($value['fill']);
	$username = $value['username'];
	$priority_doctor = $value['priority_doctor'];

	$dokter_radiologi = mysqli_fetch_assoc(mysqli_query(
		$conn,
		"SELECT * FROM xray_dokter_radiology WHERE username = '$username'"
	));
	$pk = $dokter_radiologi['pk'];

	mysqli_query(
		$conn,
		"UPDATE xray_workload 
		SET pk_dokter_radiology = '$pk',
		xray_workload.status = 'approved', 
		fill = '$fill',
		approved_at = NOW(),
		priority_doctor = '$priority_doctor'
		WHERE uid = '$uid'
		"
	);

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
    	(uid, acc, patientid, mrn, name, lastname, address, sex, birth_date, weight, name_dep, xray_type_code, prosedur,dokterid, named, lastnamed,email,radiographer_id,radiographer_name, radiographer_lastname,dokradid,dokrad_name,dokrad_lastname,create_time, schedule_date, schedule_time, contrast, priority, pat_state, contrast_allergies, spc_needs, payment, arrive_date, arrive_time,complete_date,complete_time,fill,study_datetime,updated_time, num_instances, num_series, series_desc, src_aet) VALUES
        ('$uid', '$acc', '$patientid', '$mrn', '$name', '$lastname', '$address', '$sex', '$birth_date', '$weight', '$name_dep', '$xray_type_code', '$prosedur','$dokterid', '$named', '$lastnamed','$email','$radiographer_id','$radiographer_name','$radiographer_lastname','$dokradid','$dokrad_name','$dokrad_lastname','$create_time', '$schedule_date', '$schedule_time', '$contrast', '$priority', '$pat_state', '$contrast_allergies', '$spc_needs','$payment','$arrive_date', '$arrive_time','$complete_date','$complete_time','$fill','$study_datetime','$updated_time', '$num_instances', '$num_series', '$series_desc', '$src_aet') ");

	return mysqli_affected_rows($conn);
}

function ubahdokterworklist($post)
{
	global $conn;

	$uid = $post['uid'];
	$dokradid = $post['dokradid'];
	$status = $post['status'];

	// echo $uid . ' ' . $status . ' ' . $dokradid;
	// die();

	$query4 = "SELECT * FROM xray_dokter_radiology WHERE dokradid = '$dokradid'";
	$data_exam1 = mysqli_query($conn, $query4);
	$row4 = mysqli_fetch_assoc($data_exam1);

	$pk = $row4['pk'];
	$dokradid1 = $row4['dokradid'];
	$dokradname1 = $row4['dokrad_name'];
	$dokradlastname1 = $row4['dokrad_lastname'];

	// echo $pk . ' ' . $dokradid1 . ' ' . $dokradname1 . ' ' . $dokradlastname1;
	// die();

	$querydokter = "SELECT pk FROM xray_order WHERE uid = '$uid'";
	$dataquerydokter = mysqli_query($conn, $querydokter);

	if (mysqli_num_rows($dataquerydokter) == '0') {
		$queryinsert = mysqli_query($conn, "INSERT INTO xray_order (uid, dokradid, dokrad_name) VALUES ('$uid','$dokradid1','$dokradname1')");
		mysqli_query($conn, $queryinsert);
	} else {
		$query = "UPDATE xray_order SET 
				dokradid = '$dokradid1',
				dokrad_name = '$dokradname1'
				WHERE uid = '$uid'
	";
		mysqli_query($conn, $query);
	}

	$query1 = "UPDATE xray_workload SET 
	pk_dokter_radiology = '$pk'
	WHERE uid = '$uid'
	";
	mysqli_query($conn, $query1);

	return mysqli_affected_rows($conn);
}

function ubahdokterworkload($post)
{
	global $conn;

	$uid = $post['uid'];
	$dokradid = $post['dokradid'];

	$query4 = "SELECT * FROM xray_dokter_radiology WHERE dokradid = '$dokradid'";
	$data_exam1 = mysqli_query($conn, $query4);
	$row4 = mysqli_fetch_assoc($data_exam1);

	$pk = $row4['pk'];
	$dokradid1 = $row4['dokradid'];
	$dokradname1 = $row4['dokrad_name'] . ' ' . $row4['dokrad_lastname'];

	$query = "UPDATE xray_order SET 
	dokradid = '$dokradid1',
	dokrad_name = '$dokradname1'
	WHERE uid = '$uid'
";
	mysqli_query($conn, $query);

	$query1 = "UPDATE xray_workload SET 
	pk_dokter_radiology = '$pk',
	status = 'waiting',
	fill = NULL,
	approved_at = NULL,
	approve_updated_at = NULL,
	signature = NULL,
	signature_datetime = NULL 
	WHERE uid = '$uid'
	";
	mysqli_query($conn, $query1);

	return mysqli_affected_rows($conn);
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

function update_workload($value)
{
	global $conn;

	$uid = $value['uid'];
	$fill = addslashes($value['fill']);
	$priority_doctor = $value['priority_doctor'];

	mysqli_query(
		$conn,
		"UPDATE xray_workload SET 
		fill = '$fill',
		approve_updated_at = NOW(),
		priority_doctor = '$priority_doctor'
		WHERE uid = '$uid'"
	);

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
	// $approvedsign = $approvesign['approvedsign'];
	$uid = $approvesign['uid'];
	$uid2 = $uid . '.png';

	$query2 = "UPDATE xray_workload SET
				signature = '$uid2',
				signature_datetime = NOW()
				WHERE uid = '$uid'
				";
	mysqli_query($conn, $query2);

	return mysqli_affected_rows($conn);
}
