<?php
require '../../koneksi/koneksi.php';
require '../../default-value.php';
require '../../model/query-base-workload.php';
require '../../model/query-base-order.php';
require '../../model/query-base-study.php';
require '../../model/query-base-patient.php';
require '../../model/query-base-dokter-radiology.php';

session_start();

$uid = $_GET["uid"];

$row = mysqli_fetch_assoc(mysqli_query(
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
    WHERE study.study_iuid = '$uid'"
));

$pat_name = substr(removeCharacter(ucwords(strtolower(defaultValue($row['pat_name'])))), 0, 24);
$pat_sex = $row['pat_sex'];
$pat_birthdate = diffDate($row['pat_birthdate']);
$study_datetime = defaultValueDateTime($row['study_datetime']);
$study_desc = substr(ucwords(strtolower(defaultValue($row['study_desc']))), 0, 29);
$pat_id = defaultValue($row['pat_id']);
$no_foto = defaultValue($row['no_foto']);
$address = ucwords(strtolower(defaultValue($row['address'])));
$name_dep = substr(ucwords(strtolower(defaultValue($row['name_dep']))), 0, 29);
$named = substr(ucwords(strtolower(defaultValue($row['named']))), 0, 29);
$spc_needs = substr(ucfirst(defaultValue($row['spc_needs'])), 0, 75);
$fill = $row['fill'];
$signature = $row['signature'];
$status = $row['status'];
$pk_dokter_radiology = $row['pk_dokter_radiology'];

// kondisi mencari ditabel dokter radiology
$row_dokrad = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT $select_dokter_radiology 
    FROM $table_dokter_radiology 
    WHERE pk = '$pk_dokter_radiology'"
));

$dokrad_name = ucwords(strtolower(defaultValue($row_dokrad['dokrad_fullname'])));
$nip = $row_dokrad['nip'];


if ($status == "waiting" || $status == '') {
    echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
        <script type='text/javascript'>
            setTimeout(function () { 
            swal({
                    title: 'Pasien ini belum di approve',
                    text:  '',
                    icon: 'error',
                    timer: 3000,
                    showConfirmButton: true
                });  
            }, 10); 
            window.setTimeout(function(){ 
                window.close();
            }, 1300); 
        </script>";
    exit();
}

//Based on HTML2PDF by Clément Lavoillotte
// memanggil library FPDF
require('fpdf.php');
require('hex.php');
require('html-parser.php');

// intance object dan memberikan pengaturan halaman PDF
$pdf = new PDF('P', 'mm', 'A4');

// membuat halaman baru
$pdf->SetMargins(10, 22, 8);
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial', '', 10);
// mencetak string 

$pdf->SetTitle('Hasil expertise');

$pdf->image('header-rs.jpg', 7, 2, 198);
$pdf->MultiCell(0, 1, ' 




                    ', 0, "J", false);


// ------------------------------------------------------------


$pdf->Cell(28, 5, 'No Foto', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(55, 5, $no_foto, 0, 0, 'L');
// ------------------
$pdf->Cell(35, 5, 'Ruang', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $name_dep, 0, 1, 'L');
// ------------------
$pdf->Cell(28, 5, 'No RM', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(55, 5, $pat_id, 0, 0, 'L');
// ------------------
$pdf->Cell(35, 5, 'Dokter Pengirim', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $named, 0, 1, 'L');
// -----------------
$pdf->Cell(28, 5, 'Nama', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(55, 5, $pat_name, 0, 0, 'L');
// -----------------
$pdf->Cell(35, 5, 'Dokter Radiologi', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $dokrad_name, 0, 1, 'L');
// -----------------
$pdf->Cell(28, 5, 'Tgl Lahir / Umur', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(55, 5, $pat_birthdate, 0, 0, 'L');
// -------------------
$pdf->Cell(35, 5, 'Waktu Pemeriksaan', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $study_datetime, 0, 1, 'L');
//-------------------
$pdf->Cell(28, 5, 'Jenis Kelamin', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(55, 5, $pat_sex, 0, 0, 'L');
// -----------------
$pdf->Cell(35, 5, 'Pemeriksaan', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $study_desc, 0, 1, 'L');
// -----------------
$pdf->Cell(28, 5, 'Klinis', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(158, 5, $spc_needs, 0, 2, 'L');
$pdf->Line(10, 59, 200, 59);

$fill = str_replace("&nbsp;", " ", $fill);
$fill = str_replace("&amp;", "&", $fill);
$fill = str_replace("&quot;", "\"", $fill);
$fill = str_replace("&#39;", "'", $fill);
$fill = str_replace("&middot;", "-", $fill);
$fill = str_replace("<ul>", "<br />", $fill);
$fill = str_replace("<li>", "   " . chr(149) . " ", $fill);
$fill = str_replace("</li>", "<br />", $fill);
$fill = str_replace("</ul>", "<br />", $fill);
$fill = str_replace('<div style="text-align: center;">', '<br /><p align="center">', $fill);
$fill = str_replace('<div style="text-align: left;">', '<br /><p align="left">', $fill);
$fill = str_replace('<div style="text-align: right;">', '<br /><p align="right">', $fill);
$fill = str_replace('<div style="text-align:center;">', '<br /><p align="center">', $fill);
$fill = str_replace('<div style="text-align:left;">', '<br /><p align="left">', $fill);
$fill = str_replace('<div style="text-align:right;">', '<br /><p align="right">', $fill);

$pdf->WriteHTML("<strong><u><p align='center'>Hasil Pemeriksaan Radiology</p></u></strong>");
$pdf->WriteHTML("<br>");
$pdf->WriteHtml($fill);
$pdf->WriteHTML("<br>");
$pdf->WriteHTML("<br>");

// jika ttd menggunakan signature
if (!empty($signature)) {
    $pdf->WriteHTML(
        "<p align='left' margin-left='50px;'>Terimakasih atas kepercayaan TS</p><br>
        <p align='left' margin-left='50px;'>Salam sejawat</p><br>
"
    );
    $pdf->image('../phpqrcode/ttddokter/' . $signature, NULL, NULL, 25);
} else {
    // jika ttd tidak menggunakan signature
    $pdf->WriteHTML(
        "<p align='right'>Terimakasih atas kepercayaan TS</p>
        <p align='center'>                                                                                                                                             Salam sejawat</p><br>
        <br><br><br><br><br>
        <p align='center'>                                                                                                                                                $dokrad_name <br />                                                                                                                                                NIP $nip</p>"
    );
}

$pdf->Output();
