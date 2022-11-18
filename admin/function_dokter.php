<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

///////DOKTER PENGIRIM///////////////////////////////////////////////////////////////

//untuk insert atau menambahkan
function new_dokter($value)
{
	global $conn;
	$dokterid = $value["dokterid"];
	$named = $value["named"];
	$lastnamed = $value["lastnamed"];
	$telp = $value["telp"];
	$email = $value["email"];
	// $username = $value["username"];
	// $password = $value["password"];
	// $password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	mysqli_query(
		$conn,
		"INSERT INTO xray_dokter (dokterid, named, lastnamed, telp, email) 
		VALUES ('$dokterid','$named', '$lastnamed', '$telp', '$email')"
	);

	// mysqli_query(
	// 	$conn,
	// 	"INSERT INTO xray_login (username, password, level, date) 
	// 	VALUES ('$username', '$password_hash','refferal', NOW())"
	// );

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function delete_dokter($id)
{
	global $conn;

	mysqli_query(
		$conn,
		"DELETE FROM xray_dokter 
		WHERE id = '$id'"
	);

	return mysqli_affected_rows($conn);
}


//untuk mengubah / edit
function update_dokter($value)
{
	global $conn;

	$id = $value["id"];
	$dokterid = $value["dokterid"];
	$named = $value["named"];
	$lastnamed = $value["lastnamed"];
	$telp = $value["telp"];
	$email = $value["email"];

	mysqli_query(
		$conn,
		"UPDATE xray_dokter SET 
		dokterid = '$dokterid',
		named = '$named',
		lastnamed ='$lastnamed',
		telp ='$telp',
		email ='$email'
		WHERE id = '$id'"
	);

	return mysqli_affected_rows($conn);
}

///////DOKTER RADIOLOGY///////////////////////////////////////////////////////////////

//untuk insert atau menambahkan
function tambah_rad($post_dokter_radiology)
{
	global $conn;
	$dokrad_name = $post_dokter_radiology["dokrad_name"];
	$dokradid = $post_dokter_radiology["dokradid"];
	$dokrad_lastname = $post_dokter_radiology["dokrad_lastname"];
	$dokrad_sex = $post_dokter_radiology["dokrad_sex"];
	$kodearea = $post_dokter_radiology["kodearea"];
	$telp = $post_dokter_radiology["dokrad_tlp"];
	$telpdoang = ltrim($telp, "0");
	$dokrad_tlp = $kodearea . '' . $telpdoang;
	$dokrad_email = $post_dokter_radiology["dokrad_email"];

	$name = $_FILES["file"]["name"];
	$file_tmp = $_FILES["file"]["tmp_name"];
	move_uploaded_file($file_tmp, '../image/' . $name);

	$nametemp = $_FILES["filetemp"]["name"];
	$file_tmp = $_FILES["filetemp"]["tmp_name"];
	move_uploaded_file($file_tmp, '../image/' . $nametemp);

	$username = $post_dokter_radiology["username"];
	$password = $post_dokter_radiology["password"];
	$password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	$q3 = mysqli_query($conn, 'SELECT MAX(dokradid) as user_id3 from xray_dokter_radiology');
	$row3 = mysqli_fetch_assoc($q3);
	$ai3 = $row3['user_id3'] + 1;

	$q4 = mysqli_query($conn, 'SELECT MAX(id_table) as user_id4 from xray_login');
	$row4 = mysqli_fetch_assoc($q4);
	$ai4 = $row4['user_id4'] + 1;

	//query insert data

	$query = "INSERT INTO xray_dokter_radiology (dokradid, dokrad_name, dokrad_lastname, dokrad_sex, dokrad_tlp, dokrad_email, dokrad_img, imgtemp, username, password)
				VALUES 
				('$dokradid', '$dokrad_name', '$dokrad_lastname', '$dokrad_sex', '$dokrad_tlp', '$dokrad_email', '$name', '$nametemp', '$username', '$password_hash')
				";
	$query_login = "INSERT INTO xray_login
				VALUES 
				('$ai4', '$username', '$password_hash','radiology', NOW(), '')
				";

	mysqli_query($conn, $query);
	mysqli_query($conn, $query_login);

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function hapus_rad($dokradid, $id_table)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_dokter_radiology WHERE dokradid = $dokradid");
	mysqli_query($conn, "DELETE FROM xray_login WHERE id_table = $id_table");

	return mysqli_affected_rows($conn);
}


//untuk mengubah / edit
function ubah_rad($ubah_dokter_radiology)
{
	global $conn;
	$pk = $ubah_dokter_radiology["pk"];
	$dokradid = $ubah_dokter_radiology["dokradid"];
	$dokrad_name = $ubah_dokter_radiology["dokrad_name"];
	$dokrad_lastname = $ubah_dokter_radiology["dokrad_lastname"];
	$dokrad_sex = $ubah_dokter_radiology["dokrad_sex"];
	$dokrad_tlp = $ubah_dokter_radiology["dokrad_tlp"];
	$dokrad_email = $ubah_dokter_radiology["dokrad_email"];

	// $name = $_FILES["file"]["name"];
	// $file_tmp = $_FILES["file"]["tmp_name"];
	// move_uploaded_file($file_tmp, '../image/' . $name);

	//query insert data
	$query = "UPDATE xray_dokter_radiology SET 
				dokradid = '$dokradid',
				dokrad_name = '$dokrad_name',
				dokrad_lastname ='$dokrad_lastname',
				dokrad_sex = '$dokrad_sex',
				dokrad_tlp = '$dokrad_tlp',
				dokrad_email = '$dokrad_email'
				WHERE pk = $pk
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubah_radtemp($ubah_temp)
{
	global $conn;
	$dokradid = $ubah_temp["dokradid"];
	$nametemp = $_FILES["filetemp"]["name"];
	$file_tmp = $_FILES["filetemp"]["tmp_name"];
	move_uploaded_file($file_tmp, '../image/' . $nametemp);

	$query = "UPDATE xray_dokter_radiology SET 
				imgtemp = '$nametemp'
				WHERE dokradid = '$dokradid'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubah_radprofile($ubah_img)
{
	global $conn;
	$dokradid = $ubah_img["dokradid"];
	$nametemp = $_FILES["filetemp"]["name"];
	$file_tmp = $_FILES["filetemp"]["tmp_name"];
	move_uploaded_file($file_tmp, '../image/' . $nametemp);

	$query = "UPDATE xray_dokter_radiology SET 
				dokrad_img = '$nametemp'
				WHERE dokradid = '$dokradid'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
/////end of DOKTER RADIOLOGY///////////////////////////////////////////////////////////////

///////DOKTER RADIOGRAPHER///////////////////////////////////////////////////////////////

//untuk insert atau menambahkan
function tambah_grapher($post_dokter_radiographer)
{
	global $conn;
	$radiographer_name = $post_dokter_radiographer["radiographer_name"];
	$radiographer_lastname = $post_dokter_radiographer["radiographer_lastname"];
	$radiographer_sex = $post_dokter_radiographer["radiographer_sex"];

	$kodearea = $post_dokter_radiographer["kodearea"];
	$telp = $post_dokter_radiographer["radiographer_tlp"];
	$telpdoang = ltrim($telp, "0");
	$radiographer_tlp = $kodearea . '' . $telpdoang;

	$radiographer_email = $post_dokter_radiographer["radiographer_email"];
	$username = $post_dokter_radiographer["username"];
	$password = $post_dokter_radiographer["password"];
	$password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	$q4 = mysqli_query($conn, 'SELECT MAX(radiographer_id) as user_id4 from xray_radiographer');
	$row4 = mysqli_fetch_assoc($q4);
	$ai44 = $row4['user_id4'] + 1;

	$q4 = mysqli_query($conn, 'SELECT MAX(id_table) as user_id4 from xray_login');
	$row4 = mysqli_fetch_assoc($q4);
	$ai4 = $row4['user_id4'] + 1;



	//query insert data
	$query = "INSERT INTO xray_radiographer
				VALUES 
				('$ai44', '$radiographer_name', '$radiographer_lastname', '$radiographer_sex', '$radiographer_tlp', '$username','$radiographer_email','$password_hash')
				";
	$query_login = "INSERT INTO xray_login
				VALUES 
				('$ai4', '$username', '$password_hash','radiographer', NOW(), '')
				";
	mysqli_query($conn, $query);
	mysqli_query($conn, $query_login);

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function hapus_grapher($radiographer_id, $id_table)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_radiographer WHERE radiographer_id = $radiographer_id");
	mysqli_query($conn, "DELETE FROM xray_login WHERE id_table = $id_table");

	return mysqli_affected_rows($conn);
}


//untuk mengubah / edit
function ubah_grapher($ubah_dokter_radiographer)
{
	global $conn;
	$radiographer_id = $ubah_dokter_radiographer["radiographer_id"];
	$radiographer_name = $ubah_dokter_radiographer["radiographer_name"];
	$radiographer_lastname = $ubah_dokter_radiographer["radiographer_lastname"];
	$radiographer_sex = $ubah_dokter_radiographer["radiographer_sex"];
	$radiographer_tlp = $ubah_dokter_radiographer["radiographer_tlp"];
	$radiographer_email = $ubah_dokter_radiographer["radiographer_email"];


	//query insert data
	$query = "UPDATE xray_radiographer SET 
				radiographer_name = '$radiographer_name',
				radiographer_lastname ='$radiographer_lastname',
				radiographer_sex = '$radiographer_sex',
				radiographer_tlp = '$radiographer_tlp',
				radiographer_email = '$radiographer_email'
				WHERE radiographer_id = $radiographer_id
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
/////end of DOKTER RADIOGRAPHER///////////////////////////////////////////////////////////////

///////////////////////////DEPARTMEN/////////////////////////////////

//untuk insert atau menambahkan
function tambah_dep($post_departmen)
{
	global $conn;
	$depid = $post_departmen['depid'];
	$name_dep = $post_departmen['name_dep'];


	//query insert data
	$query = "INSERT INTO xray_department
				VALUES
				('$depid', '$name_dep')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function hapus_dep($depid)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_department 
				WHERE depid = $depid
				");

	return mysqli_affected_rows($conn);
}


//untuk mengubah / edit
function ubah_dep($post_departmen)
{
	global $conn;
	$depid = $post_departmen['depid'];
	$name_dep = $post_departmen['name_dep'];


	//query insert data
	$query = "UPDATE xray_department SET
				name_dep = '$name_dep'
				WHERE depid = '$depid'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

///////////////end of DEPARTMEN////////////////////////


////////////////Modalitas////////////////////////

//untuk insert atau menambahkan
function tambah_mod($post_mod)
{
	global $conn;
	$q2 = mysqli_query($conn, 'SELECT MAX(idmod) as user_id2 from xray_modalitas');
	$row2 = mysqli_fetch_assoc($q2);
	$ai2 = $row2['user_id2'] + 1;
	$xray_type_code = $post_mod['xray_type_code'];
	$typename = $post_mod['typename'];

	$name = $_FILES["file"]["name"];
	$file_tmp = $_FILES["file"]["tmp_name"];
	$dokrad_img = move_uploaded_file($file_tmp, '../gambar/' . $name);


	//query insert data
	$query = "INSERT INTO xray_modalitas
				VALUES
				('$ai2','$xray_type_code', '$typename', '$name')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function hapus_mod($idmod)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_modalitas 
				WHERE idmod = '$idmod'
				");
	return mysqli_affected_rows($conn);
}



//untuk mengubah / edit
function ubah_mod($post_mod)
{
	global $conn;
	$idmod = $post_mod['idmod'];
	$xray_type_code = $post_mod['xray_type_code'];
	$typename = $post_mod['typename'];
	$typemod = $post_mod['typemod'];

	$name = $_FILES["file"]["name"];
	$file_tmp = $_FILES["file"]["tmp_name"];
	move_uploaded_file($file_tmp, '../gambar/' . $name);

	//query insert data
	$query = "UPDATE xray_modalitas SET
				xray_type_code = '$xray_type_code',
				typename = '$typename',
				imgmod = '$name'
				WHERE idmod = '$idmod'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

/////////END OF MODALITAS/////////////////////////////

/////////////////////PRICE///////////////////////////


function tambah_price($post_price)
{
	global $conn;
	// $code_xray = $post_price['code_xray'];
	// $prosedur = $post_price['prosedur'];
	$idmod = $post_price['idmod'];
	$result = mysqli_query($conn, "SELECT * FROM xray_modalitas WHERE idmod = '$idmod' ");
	$row = mysqli_fetch_assoc($result);
	$xray_type_code = $row['xray_type_code'];
	$main_prosedur = $post_price['main_prosedur'];
	$price = $post_price['price'];

	$q1 = mysqli_query($conn, 'SELECT MAX(idharga) as user_id1 from xray_price');
	$row1 = mysqli_fetch_assoc($q1);
	$ai1 = $row1['user_id1'] + 1;


	//query insert data
	$query = "INSERT INTO xray_price
				(idharga,main_prosedur,type,price)
				VALUES
				('$ai1','$main_prosedur','$xray_type_code', '$price')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function hapus_price($idharga)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_price 
				WHERE idharga = '$idharga'
				");
	return mysqli_affected_rows($conn);
}



//untuk mengubah / edit
function ubah_price($post_price)
{
	global $conn;
	$idharga = $post_price['idharga'];
	// $code_xray = $post_price['code_xray'];
	// $prosedur = $post_price['prosedur'];
	$main_prosedur = $post_price['main_prosedur'];
	$price = $post_price['price'];

	$idmod = $post_price['idmod'];

	$result = mysqli_query($conn, "SELECT * FROM xray_modalitas WHERE idmod = '$idmod' ");
	$row1 = mysqli_fetch_assoc($result);
	$xray_type_code = $row1['xray_type_code'];

	//query insert data
	$query = "UPDATE xray_price SET
				main_prosedur = '$main_prosedur',
				type = '$xray_type_code',
				price = '$price'
				WHERE idharga = '$idharga'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

///////ADMIN///////////////////////////////////////////////////////////////

//untuk insert atau menambahkan
function admin_tambah($post_admin)
{
	global $conn;
	$ad_name = $post_admin["ad_name"];
	$ad_lastname = $post_admin["ad_lastname"];
	$username = $post_admin["username"];
	$password = $post_admin["password"];
	$password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	$q = mysqli_query($conn, 'SELECT MAX(admin_id) as user_id from xray_admin');
	$row = mysqli_fetch_assoc($q);
	$ai = $row['user_id'] + 1;

	$q4 = mysqli_query($conn, 'SELECT MAX(id_table) as user_id4 from xray_login');
	$row4 = mysqli_fetch_assoc($q4);
	$ai4 = $row4['user_id4'] + 1;


	//query insert data
	$query = "INSERT INTO xray_admin
				VALUES 
				('$ai','$ad_name', '$ad_lastname', '$username', '$password_hash')
				";
	$query_login = "INSERT INTO xray_login
				VALUES 
				('$ai4', '$username', '$password_hash','admin', NOW(), '')
				";
	mysqli_query($conn, $query);
	mysqli_query($conn, $query_login);

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function hapus_admin($admin_id, $id_table)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_admin WHERE admin_id = $admin_id");
	mysqli_query($conn, "DELETE FROM xray_login WHERE id_table = $id_table");

	return mysqli_affected_rows($conn);
}


//untuk mengubah / edit
function ubah_admin($ubah_admin)
{
	global $conn;
	$admin_id = $ubah_admin["admin_id"];
	$ad_name = $ubah_admin["ad_name"];
	$ad_lastname = $ubah_admin["ad_lastname"];


	//query insert data
	$query = "UPDATE xray_admin SET 
				ad_name = '$ad_name',
				ad_lastname ='$ad_lastname'
				WHERE admin_id = '$admin_id'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
/////end of ADMIN///////////////////////////////////////////////////////////////

///////superadmin///////////////////////////////////////////////////////////////

//untuk insert atau menambahkan
function superadmin_tambah($post_superadmin)
{
	global $conn;
	$sa_name = $post_superadmin["sa_name"];
	$sa_lastname = $post_superadmin["sa_lastname"];
	$username = $post_superadmin["username"];
	$contract_password = $post_superadmin["contract_password"];
	$password_hash_contract = password_hash($contract_password, PASSWORD_BCRYPT, array('cost' => 12));
	$password = $post_superadmin["password"];
	$password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	$q = mysqli_query($conn, 'SELECT MAX(said) as user_id from xray_superadmin');
	$row = mysqli_fetch_assoc($q);
	$ai = $row['user_id'] + 1;

	$q4 = mysqli_query($conn, 'SELECT MAX(id_table) as user_id4 from xray_login');
	$row4 = mysqli_fetch_assoc($q4);
	$ai4 = $row4['user_id4'] + 1;


	//query insert data
	$query = "INSERT INTO xray_superadmin
				VALUES 
				('$ai','$sa_name', '$sa_lastname', '$username', '$password_hash')
				";
	$query_login = "INSERT INTO xray_login
				VALUES 
				('$ai4', '$username', '$password_hash','superadmin', NOW(), '$password_hash_contract')
				";
	mysqli_query($conn, $query);
	mysqli_query($conn, $query_login);

	return mysqli_affected_rows($conn);
}

//untuk menghapus
function hapus_superadmin($said, $id_table)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM xray_superadmin WHERE said = $said");
	mysqli_query($conn, "DELETE FROM xray_login WHERE id_table = $id_table");

	return mysqli_affected_rows($conn);
}


//untuk mengubah / edit
function ubah_superadmin($ubah_superadmin)
{
	global $conn;
	$said = $ubah_superadmin["said"];
	$sa_name = $ubah_superadmin["sa_name"];
	$sa_lastname = $ubah_superadmin["sa_lastname"];


	//query insert data
	$query = "UPDATE xray_superadmin SET 
				sa_name = '$sa_name',
				sa_lastname ='$sa_lastname'
				WHERE said = '$said'
	";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
/////end of superadmin///////////////////////////////////////////////////////////////

/////////////////////////// berita ////////////////////////////////////////////////

function berita($post_berita)
{
	global $conn;
	$berita = $post_berita['berita'];

	$q5 = mysqli_query($conn, 'SELECT MAX(id) as user_id5 from xray_berita');
	$row5 = mysqli_fetch_assoc($q5);
	$ai5 = $row5['user_id5'] + 1;

	mysqli_query($conn, "INSERT INTO xray_berita (id,berita,tanggal) VALUES ('$ai5','$berita',NOW())");

	return mysqli_affected_rows($conn);
}

//////////////////////// end of berita //////////////////////////////////////////////////////////////////////

function new_ae($value)
{
	global $conn_pacsio;
	$aetitle = $value['aetitle'];
	$ip = $value['ip'];
	$port = $value['port'];
	// $color = $value['color'];

	mysqli_query(
		$conn_pacsio,
		"INSERT INTO ae (aet, hostname, port, installed) 
		VALUES ('$aetitle', '$ip', '$port', 1)"
	);

	return mysqli_affected_rows($conn_pacsio);
}

function update_ae($value)
{
	global $conn_pacsio;
	$pk = $value['pk'];
	$aetitle = $value['aetitle'];
	$ip = $value['ip'];
	$port = $value['port'];
	// $color = $value['color'];

	mysqli_query(
		$conn_pacsio,
		"UPDATE ae SET 
		aet = '$aetitle',
		hostname = '$ip',
		port = '$port'
		WHERE pk = '$pk'
	"
	);
	return mysqli_affected_rows($conn_pacsio);
}

function delete_ae($pk)
{
	global $conn_pacsio;
	mysqli_query(
		$conn_pacsio,
		"DELETE FROM ae WHERE pk = '$pk'"
	);
	return mysqli_affected_rows($conn_pacsio);
}
