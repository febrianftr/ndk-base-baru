<?php 
require '../koneksi/koneksi.php';

session_start();

if (isset($_POST['submit'])){
	// $length = 4;
	// $patientid = '';
	// for ($i=0;$i<$length;$i++){
	// $patientid .= rand (1, 9);}
	$q = mysqli_query($conn, 'SELECT MAX(patientid) as user_id from xray_patient');
	$row = mysqli_fetch_assoc($q);
	$ai = $row['user_id'] + 1;
	$mrn = $_POST['mrn'];

	$result = mysqli_query($conn, "SELECT mrn from xray_patient WHERE mrn = '$mrn' ");
	$row = mysqli_fetch_assoc($result);
	$cek = mysqli_num_rows($result);

	$name = $_POST['name'];
	$lastname = $_POST['lastname'];
	// $ssn = $_POST['ssn'];
	$sex = $_POST["sex"];
	$birth_date = $_POST["birth_date"];;
	$weight = $_POST["weight"];
	$address = $_POST["address"];
	$village = $_POST["village"];

	$kodearea = $_POST["kodearea"];
	$telpaja = $_POST["phone"];
	$telpdoang = ltrim($telpaja, "0");
	$phone = $kodearea . '' . $telpdoang;

	$email = $_POST["email"];

	$note = $_POST["note"];
	$city = $_POST["city"];
	$sub_district = $_POST["sub_district"];
	$post_code = $_POST["post_code"];
	$province = $_POST["province"];
	$country = $_POST["country"];

	if ($cek > 0) {
		echo "<script>alert('MRN sudah terdaftar');
			  document.location.href='registration.php';</script>";
	}
	else{
		$query = "INSERT INTO xray_patient (pk,patientid,mrn,name,lastname, sex,birth_date,weight,address,phone,email,note,village,city,sub_district,post_code,province,country,create_date)
				VALUES
				('$ai', '$ai', '$mrn', '$name', '$lastname','$sex', '$birth_date', '$weight', '$address', '$phone', '$email', '$note', '$village', '$city', '$sub_district', '$post_code', '$province', '$country', NOW())";

				mysqli_query($conn, $query);
				echo "<script>alert('Data Pasien Berhasil Dimasukkan');
		  		  document.location.href='inputorder.php';</script>";
	}
}
