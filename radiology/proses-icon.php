<?php 
	
	require '../koneksi/koneksi.php';

	$uid = $_GET['uid'];

	$data_exam = mysqli_query($conn_pacs,"SELECT * FROM study WHERE study_iuid = '$uid'");
	$row1 = mysqli_fetch_assoc($data_exam);
	$study_iuid = $row1['study_iuid'];
	$study_datetime = $row1['study_datetime'];
	$updated_time = $row1['updated_time'];

	// echo $uid;
	// echo $study_iuid;
	// echo $study_datetime;
	// echo $updated_time;
	$query1 = "UPDATE xray_exam2 SET
			   study_datetime = '$study_datetime',
			   updated_time = '$updated_time'
			   WHERE uid = '$study_iuid'
			  ";
    mysqli_query($conn, $query1);

    $query2 = "UPDATE xray_workload_radiographer SET
			   study_datetime = '$study_datetime',
			   updated_time = '$updated_time'
			   WHERE uid = '$study_iuid'";
    mysqli_query($conn, $query2);

    header("location:dicom.php");

?>