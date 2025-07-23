<?php
require '../../default-value.php';
require '../../koneksi/koneksi.php';
require '../../model/query-base-series.php';
require '../../model/query-base-instance.php';
require '../../model/query-base-patient.php';
require '../../model/query-base-study.php';
require '../../model/query-base-workload.php';
require '../../model/query-base-order.php';
require '../../model/query-base-dokter-radiology.php';
require '../vendor/autoload.php';
require "pdf-function.php";

$uid = $_GET["uid"] ?? $_POST['uid'];
$series_iuid = explode(",", $_GET['series_iuid'] ?? $_POST['series_iuid']);

$pdf = pdfPage();

$pdf = pdfProsesExpertise($uid, $pdf);

$pdf->AddPage();

$pdf = pdfProsesImage($uid, $series_iuid, $pdf);

pdfOutput($uid, $pdf, "D");

mysqli_close($conn);
