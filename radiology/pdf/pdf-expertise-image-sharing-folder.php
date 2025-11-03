<script type="text/javascript" src="../../js/sweetalert.min.js"></script>
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
$level = $_GET['level'];

$stmt = mysqli_prepare(
    $conn_pacsio,
    "SELECT 
    pat_name,
    pat_id,
    pat_birthdate
    FROM patient
    JOIN study
    ON patient.pk = study.patient_fk
    WHERE study.study_iuid = ?"
);
mysqli_stmt_bind_param($stmt, "s", $uid);
mysqli_stmt_execute($stmt);
$row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
$pat_birthdate = $row['pat_birthdate'];

$pdf = pdfPage();

// $pdf->SetProtection(array(), date('dmY', strtotime($pat_birthdate)), "27102108");

$pdf = pdfProsesExpertise($uid, $pdf);

$pdf->AddPage();

$pdf = pdfProsesImage($uid, $series_iuid, $pdf);

$pat_name = substr(removeCharacter(ucwords(strtolower(defaultValue($row['pat_name'])))), 0, 23);
$pat_id = defaultValue($row['pat_id']);

// jika tidak ada foldernya, membuat folder berdasarkan hasil expertise pertama kali.
$dir = "expertise-image-share/";
if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

$pdf->Output("F", "$dir/$uid.pdf");

// $allFiles = scandir($dir);
// foreach ($allFiles as $file) {
//     $pdf = pathinfo($file, PATHINFO_EXTENSION);
//     if ($pdf === "pdf") {
//         $tanggal = gmdate("Y-m-d", filemtime($dir . $file));
//         if (file_exists($dir . $file)) {
//             if ($tanggal < date("Y-m-d")) {
//                 // echo $file . " / " . $tanggal . "<br />";
//                 unlink($dir . $file);
//             }
//         }
//     }
// }

echo "<script type='text/javascript'>
        setTimeout(function () { 
        swal({
                title: 'Berhasil save!',
                text:  'Selanjutnya kirim notifikasi ke pasien',
                icon: 'success',
                timer: 1000,
                showConfirmButton: true
            });  
        },10); 
        window.setTimeout(function(){ 
        document.location.href= '../../$level/view-push-notification.php?uid=$uid';
        },1000);
</script>";

mysqli_close($conn);
