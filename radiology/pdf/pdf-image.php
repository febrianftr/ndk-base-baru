<?php
require "../../default-value.php";
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

$stmt = mysqli_prepare(
    $conn_pacsio,
    "SELECT 
    $select_patient,
    $select_study,
    $select_order,
    $select_workload
    FROM $table_patient
    JOIN $table_study
    ON patient.pk = study.patient_fk
    LEFT JOIN $table_order
    ON xray_order.uid = study.study_iuid
    LEFT JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
    WHERE study.study_iuid = ?"
);
mysqli_stmt_bind_param($stmt, "s", $uid);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

$pat_name = substr(removeCharacter(ucwords(strtolower(defaultValue($row['pat_name'])))), 0, 14);
$pat_sex = $row['pat_sex'];
$pat_birthdate = $row['pat_birthdate'];
$age = diffDate($pat_birthdate);
$study_datetime = defaultValueDateTime($row['study_datetime']);
$pat_id = defaultValue($row['pat_id']);
$study_desc_pacsio = substr(defaultValue($row['study_desc_pacsio']), 0, 23);

$pdf = pdfPage();

$pdf->SetFont('Arial', '', 8);

$pdf->Cell(35, 3, 'Nama / No RM', 0, 0, 'L');
$pdf->Cell(3, 3, ':', 0, 0, 'L');
$pdf->Cell(55, 3, $pat_name . ' / ' . $pat_id, 0, 0, 'L');

$pdf->Cell(35, 3, 'Tanggal Pemeriksaan', 0, 0, 'L');
$pdf->Cell(3, 3, ':', 0, 0, 'L');
$pdf->Cell(65, 3, defaultValueDate($study_datetime), 0, 1, 'L');

// $pdf->Cell(28, 3, 'No RM', 0, 0, 'L');
// $pdf->Cell(3, 3, ':', 0, 0, 'L');
// $pdf->Cell(55, 3, $pat_id, 0, 0, 'L');

$pdf->Cell(35, 3, 'Tgl Lahir / J.Kelamin', 0, 0, 'L');
$pdf->Cell(3, 3, ':', 0, 0, 'L');
$pdf->Cell(55, 3, defaultValueDate($pat_birthdate) . ' / ' . $pat_sex, 0, 0, 'L');

// $pdf->Cell(28, 3, 'Jenis Kelamin', 0, 0, 'L');
// $pdf->Cell(3, 3, ':', 0, 0, 'L');
// $pdf->Cell(55, 3, $pat_sex, 0, 0, 'L');

$pdf->Cell(35, 3, 'Jenis Pemeriksaan', 0, 0, 'L');
$pdf->Cell(3, 3, ':', 0, 0, 'L');
$pdf->Cell(65, 3, $study_desc_pacsio, 0, 1, 'L');

$pdf = pdfProsesImage($uid, $series_iuid, $pdf);

$pdf = pdfOutput($uid, $pdf, "D");

mysqli_close($conn);
