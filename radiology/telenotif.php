<?php
require '../koneksi/koneksi.php';

session_start();
$username = $_SESSION['username'];
$uid = $_GET['uid'];

$query = mysqli_query($conn, "SELECT * FROM xray_workload WHERE uid = '$uid'");
$row = mysqli_fetch_assoc($query);
$dokterid = $row['dokterid'];

// -------------------------------xray_workload-----------------------------------


$query3 = "SELECT * FROM xray_dokter WHERE dokterid = '$dokterid' ";

$result3 = mysqli_query($conn, $query3);

$row3 = mysqli_fetch_assoc($result3);

$nama = $row3['named'] . ' ' . $row3['lastnamed'];

$idtele = $row3['idtele'];

// $otp = $row3['email'];

// $link = "http://intimedik.com:8089/intimedika/portal/portal-sales?p=penawaran&act=index";
$token = "5414794545:AAGl8kEfUPyF-32OG3niUvWpRcJ5SSyrZ8c"; // token bot

$data = [
    'text' => "Halo " . $nama . ", Pasien Anda sudah Selesai, berikut hasil pemeriksaannya:
    1. Link Expertise : http://192.168.10.144:8089/intiwid2022/radiology/pdf/testpdf4.php?uid=" . $uid . "
    2. Link Foto : http://192.168.10.144:91/viewer/" . $uid,
    'chat_id' => $idtele  //contoh bot, group id -442697126
];

file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));

echo "<script>window.close('Notification Delivered');</script>";
