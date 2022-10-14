<?php
include "phpqrcode/qrlib.php";
require "../koneksi/koneksi.php";
require '../viewer-all.php';
$uid = $_GET['uid'];
$query = "SELECT * FROM xray_workload_radiographer WHERE uid = '$uid'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$acc = $row['acc'];
$dokradid = $row['dokradid'];
// $query2 = "SELECT * FROM xray_dokter_ WHERE uid = '$uid'";
// $result2 = mysqli_query($conn, $query2);
// $row2 = mysqli_fetch_assoc($result2);
$dokrad_name = $row['dokrad_name'];
$dokrad_lastname = $row['dokrad_lastname'];
$series_desc = $row['series_desc'];
$study_datetime = $row['study_datetime'];
$signature_datetime = $row['signature_datetime'];
$prosedur = $row['prosedur'];
$signature_datetime2 = date("d-M-Y H:i", strtotime($signature_datetime));
$viewer =  OHIFMOBILEFIRST . $uid . OHIFMOBILELAST;
//DATA PASIEN//
// QRcode::png("Nama Patient: $name
// ID : $acc
// Pemeriksaan : $prosedur $series_desc
// Jam Pemeriksaan : $study_datetime
// Approved By $dokrad_name $dokrad_lastname
// Approve Sign in $signature_datetime2", "phpqrcode/ttddokter/$uid.png", "L", 4, 4);
// echo "<img src='phpqrcode/ttddokter/$uid.png' />";
//DATA PASIEN//
//LINK GAMBAR//
QRcode::png("$viewer", "phpqrcode/ttddokter/$uid.png", "L", 4, 4);
// echo "<img src='phpqrcode/ttddokter/$uid.png' />";
//LINK GAMBAR//
$query2 = "UPDATE xray_dokter_radiology SET
				otp = NULL
				WHERE dokradid = '$dokradid'
				";
mysqli_query($conn, $query2);
header('refresh:5;//' . $_SERVER['SERVER_NAME'] . ':8089/intiwid2022/radiology/workload.php');
