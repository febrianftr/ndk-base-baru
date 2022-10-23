<?php
// memanggil library FPDF

require '../../koneksi/koneksi.php';

session_start();

$uid = $_GET["uid"];

$query1 = "SELECT * FROM xray_workload_radiographer WHERE uid = '$uid' ";

$result1 = mysqli_query($conn, $query1);

$row1 = mysqli_fetch_assoc($result1);

$dokradid = $row1['dokradid'];
$status1 = $row1['status'];
$signature = $row1['signature'];

if ($status1 == "ready to approve") {
    echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
    <script type='text/javascript'>
    setTimeout(function () { 
    swal({
               title: 'Data Belum Di Approve',
               text:  '',
               icon: 'error',
               timer: 3000,
               showConfirmButton: true
           });  
    },10); 
    window.setTimeout(function(){ 
        window.close();
    } ,1300); 
   </script>";
    exit();
}

$result2 = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE dokradid = '$dokradid' ");
$row3 = mysqli_fetch_assoc($result2);

$imgtemp = $row3['imgtemp'];

if ($imgtemp == "") {
    echo "<script>alert('Silahkan masukkan template ttd dokter di halaman admin');
         window.close();</script>";
}

// -------------------------------xray_workload-----------------------------------

$query = "SELECT * FROM xray_workload WHERE uid = '$uid' ";

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);

$query2 = "SELECT * FROM xray_testpdf ORDER BY pdf_id DESC";

$result2 = mysqli_query($conn, $query2);

$row2 = mysqli_fetch_assoc($result2);

$dokradid = $row['dokradid'];
$name = $row['name'] . ' ' . $row['lastname'];
$name1 = str_replace('^', '', $name);
$name2 = substr($name1, 0, 24);
$lastname = $row['lastname'];
$patientid = $row['patientid'];
$mrn = $row['mrn'];
$address = $row['address'];
$sex = $row['sex'];
$birth_date = $row['birth_date'];
$birth_date1 = date("d-m-Y", strtotime($birth_date));
$query4 = mysqli_query($conn, "SELECT * FROM xray_series WHERE uid = '$uid'");
$row4 = mysqli_fetch_assoc($query4);
$body_part_series = $row4['body_part'];
$prosedur = $row['prosedur'];
if ($prosedur == '') {
    $prosedur1 = $body_part_series;
} else {
    $prosedur1 = $prosedur;
}
$prosedur1 = substr($prosedur1, 0, 29);
$schedule_date = $row['schedule_date'];
$name_dep = $row['name_dep'];
$name_dep = substr($name_dep, 0, 29);
$named = $row['named'];
$lastnamed = $row['lastnamed'];
$named = str_replace('^', '', $named);
$email = $row['email'];
$lastnamed = str_replace('^', '', $lastnamed);
$fullnamed = $named . ' ' . $lastnamed;
$fullnamed = substr($fullnamed, 0, 29);
$bday = new DateTime($birth_date);
$today = new DateTime(date('y-m-d'));
$diff = $today->diff($bday);
$updated_time = $row['updated_time'];
$updated_time1 = date("d-m-Y H:i", strtotime($updated_time));
$approve_date = $row['approve_date'];
$approve_time = $row['approve_time'];
$approve_date1 = date("d-m-Y", strtotime($approve_date));
$approve_time1 = date("H:i", strtotime($approve_time));
$spc_needs = $row['spc_needs'];
$spc_needs = substr($spc_needs, 0, 75);

$fill = $row['fill'];

$query3 = "SELECT * FROM xray_dokter_radiology WHERE dokradid = '$dokradid' ";

$result3 = mysqli_query($conn, $query3);

$row3 = mysqli_fetch_assoc($result3);

$imgtemp = $row3['imgtemp'];
$dokrad_name = $row3['dokrad_name'];
$dokrad_lastname = $row3['dokrad_lastname'];
$dokrad_email = $row3['dokrad_email'];

//Based on HTML2PDF by Clément Lavoillotte

require('fpdf.php');
require('hex.php');
require('html-parser.php');

// intance object dan memberikan pengaturan halaman PDF
$pdf = new PDF('P', 'mm', 'A4');

// $pdf->SetTopMargin(10);
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
$pdf->Cell(55, 5, $patientid, 0, 0, 'L');
// ------------------
$pdf->Cell(35, 5, 'Ruang', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $name_dep, 0, 1, 'L');
// ------------------
$pdf->Cell(28, 5, 'No RM', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(55, 5, $mrn, 0, 0, 'L');
// ------------------
$pdf->Cell(35, 5, 'Dokter Pengirim', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $fullnamed, 0, 1, 'L');
// -----------------
$pdf->Cell(28, 5, 'Nama', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(55, 5, $name2, 0, 0, 'L');
// -----------------
$pdf->Cell(35, 5, 'Dokter Radiologi', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $dokrad_name . ' ' . $dokrad_lastname, 0, 1, 'L');
// -----------------
$pdf->Cell(28, 5, 'Tgl Lahir / Umur', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(55, 5, $birth_date1 . ' / ' . $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D', 0, 0, 'L');
// -------------------
$pdf->Cell(35, 5, 'Waktu Pemeriksaan', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $updated_time1, 0, 1, 'L');
//-------------------
$pdf->Cell(28, 5, 'Jenis Kelamin', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(55, 5, $sex, 0, 0, 'L');
// -----------------
$pdf->Cell(35, 5, 'Pemeriksaan', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(65, 5, $prosedur1, 0, 1, 'L');
// -----------------
$pdf->Cell(28, 5, 'Klinis', 0, 0, 'L');
$pdf->Cell(3, 5, ':', 0, 0, 'L');
$pdf->Cell(158, 5, $spc_needs, 0, 2, 'L');
$pdf->Line(10, 59, 200, 59);
// $pdf->Cell(35, 5, '', 0, 0, 'L');
// $pdf->Cell(3, 5, '', 0, 0, 'L');
// $pdf->Cell(55, 5, '', 0, 1, 'L');
// // -----------------
// $pdf->Cell(35, 5, '', 'B', 0, 'L');
// $pdf->Cell(3, 5, '', 'B', 0, 'L');
// $pdf->Cell(55, 5, '', 'B', 0, 'L');
// // ------------------
// $pdf->Cell(40, -35, 'Klinis', 'T', 0, 'L');
// $pdf->Cell(3, -35, ':', 0, 0, 'L');
// $pdf->MultiCell(55, 5, 'ASDSADSADSADSADSADSADSADSADSADSADSADSADSADA', 'RB', 'L');
// ------------------
// $pdf->SetLineWidth(0.1);

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

// jika menggunakan image di ttd
// $pdf->image('../../image/' . $imgtemp, 135, 245, 65);
// if ($signature) {
//     $pdf->image('../phpqrcode/ttddokter/' . $signature, 155, 257, -250);
// }
// jika image di ttd

// jika write html
if (!empty($signature)) {
    $pdf->WriteHTML(
        "<b><p align='left' margin-left='50px;'>Pemeriksa,</p></b><br>
<b><p align='left' margin-left='50px;'>BTK</p></b><br>
"
    );
    $pdf->image('../phpqrcode/ttddokter/' . $signature, NULL, NULL, 25);
} else {
    $pdf->WriteHTML(
        "<b><p align='left' margin-left='50px;'>Pemeriksa,</p></b><br>
<br><br><br><br><br>
"
    );
}
$pdf->WriteHTML(
    '<b><u>(' . $dokrad_name . ' ' . $dokrad_lastname . ')</u></b>',
    0,
    'L'
);
// jika write html
$pdf->Output();
