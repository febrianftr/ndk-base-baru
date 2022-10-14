<?php
require '../koneksi/koneksi.php';

session_start();

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=DataPatient.xls");

header('Cache-Control: max-age=0');

// ---------------------------------------------------- radiology workload------------------------------------------------
if (isset($_POST["radiologyworkload"])) {

  $dokradid1 = $_POST['dokradid'];

  $from = $_POST["from-radiology-workload"];
  $to = $_POST["to-radiology-workload"];

  $from_tgl = date('Y-m-d', strtotime($from));
  $to_tgl = date('Y-m-d', strtotime($to));

  $from_time = date('H:i', strtotime($from));
  $to_time = date('H:i', strtotime($to));

  $result1 = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE dokradid = '$dokradid1' ");
  $row1 = mysqli_fetch_assoc($result1);
  $dokradid = $row1['dokradid'];

  $checkboxfilter = implode("','", $_POST["modality"]);
  $query =    "SELECT *
            FROM xray_workload 
            WHERE dokradid = '$dokradid' 
            AND approve_date BETWEEN '$from_tgl' AND '$to_tgl' AND approve_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "') 
            ORDER BY approve_date DESC, approve_time DESC
            ";
  $sql = mysqli_query($conn, $query);

  $query1 =    "SELECT *, COUNT(*) as total 
            FROM xray_workload 
            WHERE dokradid = '$dokradid' 
            AND approve_date BETWEEN '$from_tgl' AND '$to_tgl' AND approve_time BETWEEN '$from_time' AND '$to_time' 
            AND xray_type_code IN('" . $checkboxfilter . "') 
            GROUP BY prosedur
            ";
  $sql1 = mysqli_query($conn, $query1);

  $num_rows = mysqli_num_rows($sql);

  $result1 = '';

  $result1 .= 'Tanggal ' . $from . ' - ' . $to;
  $result1 .= '<br/>&nbsp;';
  $j = 1;
  $result1 .= '
  <table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>No</th>
      <th>Main Procedure</th>
      <th>Study</th>
    </tr>
  </thead>
  ';
  while ($row2 = mysqli_fetch_array($sql1)) {
    $uid2 = $row2['uid'];
    $queryseries = mysqli_query($conn, "SELECT * FROM xray_series WHERE uid = '$uid2'");
    $rowseries = mysqli_fetch_assoc($queryseries);
    $body_part_series = $rowseries['body_part'];
    $prosedur = $row2['prosedur'];
    if ($prosedur == '') {
      $prosedur1 = $body_part_series;
    } else {
      $prosedur1 = $prosedur;
    }
    $prosedur1 = str_replace(",", "<br />", $prosedur1);
    $result1 .= '
    <tr>
    <td align="center">' . $j . '</td>
    <td>' . $prosedur1 . '</td>
    <td align="center">' . $row2['total'] . '</td>
    </tr>
    ';
    $j++;
  }
  $result1 .= '
    <tr>
    <td></td>
    <td><b>All study totals</b></td>
    <td align="center"><b>' . $num_rows . '</b></td>
    </tr>
    ';
  $result1 .= '</table><br />';
  echo $result1;
  // ------
  $result = '';
  $i = 1;
  $result .= '
  <table class="table-dicom" border="1" cellpadding="8" cellspacing="0">
            <thead class="thead1">
              <tr>
                <th>No</th>
                <th>Patient Name</th>
                <th>SEX</th>
                <th>PatientId</th>
                <th>AGE</th>
                <th>Department</th>
                <th>Modality</th>
                <th>Main Procedure</th>
                <th>Priority</th>
                <th>Refferal Physician</th>
                <th>Radiographer</th>
                <th>Radiology Physician</th>
                <th>PDC</th>
                <th>Approved DateTime</th>
                <th>Spend Time</th>
                <th>Approved Update</th>
              </tr>
            </thead> ';
  if ($num_rows > 0) {
    while ($row = mysqli_fetch_array($sql)) {
      $uid = $row['uid'];
      $query2 = mysqli_query($conn, "SELECT * FROM xray_series WHERE uid = '$uid'");
      $row2 = mysqli_fetch_assoc($query2);
      $body_part_series = $row2['body_part'];
      $prosedur = $row['prosedur'];
      if ($prosedur == '') {
        $prosedur1 = $body_part_series;
      } else {
        $prosedur1 = $prosedur;
      }
      $birth_date = $row['birth_date'];
      $bday = new DateTime($birth_date);
      $today = new DateTime(date('y-m-d'));
      $diff = $today->diff($bday);
      $priority = $row['priority'];
      $text = preg_replace('/[^A-Za-z\ ]/', '', $priority);
      $approve = $row["approve_date"] . ' ' . $row["approve_time"];
      $updated_time = $row["updated_time"];
      $complete = $row["complete_date"] . ' ' . $row["complete_time"];
      $awal  = strtotime($complete); //waktu awal
      $akhir = strtotime($approve); //waktu akhir
      $diff1  = $akhir - $awal;
      $jam   = floor($diff1 / (60 * 60));
      $menit = $diff1 - $jam * (60 * 60);
      $approve_up = $row["approve_update"] . ' ' . $row["approve_uptime"];
      $patientid = $row['patientid'];
      $patientid1 = substr($patientid, 0, 1);
      if ($patientid1 == "0") {
        $hasil1 = "'";
      } else {
        $hasil1 = "";
      }
      // ---
      $mrn = $row['mrn'];
      $mrn1 = substr($mrn, 0, 1);
      if ($mrn1 == "0") {
        $hasil0 = "'";
      } else {
        $hasil0 = "";
      }
      $result .= '
        <tr>  
          <td>' . $i . '</td>
          <td>' . $row["name"] . ' ' . $row["lastname"] . '</td>
          <td align="center">' . $row["sex"] . '</td> 
          <td align="left">' . $hasil1 . $patientid . '</td>  
          <td>' . $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D' . '</td>
          <td>' . $row["name_dep"] . '</td>
          <td>' . $row["xray_type_code"] . '</td>
          <td>' . $prosedur1 . '</td>
          <td>' . $text . '</td>
          <td>' . $row["named"] . ' ' . $row["lastnamed"] . '</td>
          <td>' . $row["radiographer_name"] . ' ' . $row["radiographer_lastname"] . '</td>
          <td>' . $row["dokrad_name"] . ' ' . $row["dokrad_lastname"] . '</td> 
          <td>' . $complete . '</td>  
          <td>' . $approve . '</td>
          <td>' . $jam .  ' jam, ' . floor($menit / 60) . ' menit' . '</td>
          <td>' . $approve_up . '</td>
        </tr>';
      $i++;
    }
  } else {
    $result .= '
    <tr>
    <td colspan="5">No Item Found</td>
    </tr>';
  }
  $result .= '</table>';
  echo $result;
  exit;
}
// ---------------------------------------------------- referral workload------------------------------------------------
//  if(isset($_POST["refferalworkload"])){
//   $result = '';
//   $query = "SELECT * 
//             FROM xray_workload_radiographer 
//             WHERE complete_date BETWEEN '".$_POST["from-refferal-workload"]."' AND '".$_POST["to-refferal-workload"]."' 
//             ORDER BY complete_time DESC";
//   $sql = mysqli_query($conn, $query);
//   $result .='
//   <table class="table-dicom" border="1" cellpadding="8" cellspacing="0">
//             <thead class="thead1">
//               <tr>
//                 <th>REFERRAL PHYSICIAN</th>
//                 <th>PATIENT NAME</th>
//                 <th>AGE</th>
//                 <th>WEIGHT</th>
//                 <th>RADIOLOGY PHYSICIAN</th>
//                 <th>RADIOGRAPHER NAME</th>
//                 <th>ARRIVE DATE & TIME</th>
//                 <th>COMPLETE DATE & TIME</th>
//                 <th>STATUS</th>
//               </tr>
//             </thead> ';
//   if(mysqli_num_rows($sql) > 0)
//   {
//     while($row = mysqli_fetch_array($sql))
//     {
//       $birth_date = $row['birth_date'];
//       $bday = new DateTime($birth_date);
//       $today = new DateTime(date('y-m-d'));
//       $diff = $today->diff($bday);
//       $result .='
//         <tr>  
//           <td>'. $row["named"] .' '. $row["lastnamed"] .'</td>
//           <td>'. $row["name"] .' '. $row["lastname"] .'</td>
//           <td>'. $diff->y.'Y'. ' ' . $diff->m .'M'. ' ' . $diff->d .'D' .'</td>
//           <td>'. $row["weight"] .'</td>
//           <td>'. $row["dokrad_name"] .' '. $row["dokrad_lastname"] .'</td>
//           <td>'. $row["radiographer_name"] .' '. $row["radiographer_lastname"] .'</td>
//           <td>'. $row["arrive_date"] .' '. $row["arrive_time"] .'</td>
//           <td>'. $row["complete_date"] .' '. $row["complete_time"] .'</td>
//           <td>'. $row["status"] .'</td>
//         </tr>';
//     }
//   }
//   else
//   {
//     $result .='
//     <tr>
//     <td colspan="5">No Item Found</td>
//     </tr>';
//   }
//   $result .='</table>';
//   echo $result;
//   exit;
// }
// ---------------------------------------------------- radiographer workload------------------------------------------------
if (isset($_POST["radiographerworkload"])) {

  $from = $_POST["from-radiographer-workload"];
  $to = $_POST["to-radiographer-workload"];

  $from_tgl = date('Y-m-d', strtotime($from));
  $to_tgl = date('Y-m-d', strtotime($to));

  $from_time = date('H:i', strtotime($from));
  $to_time = date('H:i', strtotime($to));

  $username = $_SESSION['username'];

  $checkboxfilter = implode("','", $_POST["modality1"]);
  $checkboxfiltertype = implode("','", $_POST["patienttype"]);
  $radiographer = implode("','", $_POST['radiographer']);
  if ($radiographer == "all") {
    // radiographer All
    // menampilkan data pasien
    $query = "SELECT * 
            FROM xray_workload_radiographer 
            WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "')
            AND patienttype IN('" . $checkboxfiltertype . "')
            ORDER BY complete_date DESC, complete_time DESC";
    $sql = mysqli_query($conn, $query);

    $num_rows = mysqli_num_rows($sql);

    // total semua data prosedur
    $query1 = "SELECT *, COUNT(*) as total
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "')
            AND patienttype IN('" . @$checkboxfiltertype . "')  
            GROUP BY prosedur
            ";
    $sql1 = mysqli_query($conn, $query1);
    // total semua data status
    $query2 = "SELECT *, COUNT(*) as totalstatus
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "')
            AND patienttype IN('" . @$checkboxfiltertype . "')  
            GROUP BY status
            ";
    $sql2 = mysqli_query($conn, $query2);
    // total status by appproved
    $query3 = "SELECT * 
  FROM xray_workload_radiographer 
   WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
  AND xray_type_code IN('" . $checkboxfilter . "') 
  AND patienttype IN('" . @$checkboxfiltertype . "') 
  
  AND status = 'APPROVED' 
  ORDER BY complete_date DESC, complete_time DESC";
    $sql3 = mysqli_query($conn, $query3);
    $num_rows3 = mysqli_num_rows($sql3);

    echo 'Tanggal ' . $from . ' - ' . $to;
    $result2 = '';
    $result2 .= '
  <table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>Status</th>
      <th>Total</th>
      <th>Persentase</th>
    </tr>
  </thead>
  ';
    while ($row3 = mysqli_fetch_array($sql2)) {
      $status = $row3['status'];
      $query4 = "SELECT * 
    FROM xray_workload_radiographer 
     WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
    AND xray_type_code IN('" . $checkboxfilter . "') 
    AND patienttype IN('" . @$checkboxfiltertype . "') 
    AND status = '$status'";
      $sql4 = mysqli_query($conn, $query4);
      $num_rows4 = mysqli_num_rows($sql4);
      @$totalstatus = $row3['totalstatus'];
      @$presentaseapproved = ($num_rows4 / $num_rows) * 100;
      $result2 .= '

    <tr>
    <td>' . $status . '</td>
    <td align="center">' . $num_rows4  . '</td>
    <td align="center">' . round($presentaseapproved, 2) . '%' . '</td>
    </tr>
    ';
    }
    $result2 .= '</table><br />';
    echo $result2;
    // --------
    $result3 = '';
    $result3 .= '
  <table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>< 3 Jam</th>
      <th>> 3 Jam</th>
      <th>Persentase Approved < 3 jam</th>
    </tr>
  </thead>
  ';
    $query5 = "SELECT * 
  FROM xray_workload_radiographer 
   WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
  AND xray_type_code IN('" . $checkboxfilter . "')
  AND patienttype IN('" . @$checkboxfiltertype . "') 
  AND status = 'APPROVED'";
    $sql5 = mysqli_query($conn, $query5);
    $num_rows5 = mysqli_num_rows($sql5);
    $approve3hours = 0;
    $noapprove3hours = 0;
    while ($row5 = mysqli_fetch_array($sql5)) {
      $updated_time = $row5['updated_time'];
      $approve_date = $row5['approve_date'];
      $approve_time = $row5['approve_time'];
      $approve = $row5['approve_date'] . ' ' . $row5['approve_time'];
      $complete = $row5['complete_date'] . ' ' . $row5['complete_time'];
      $awal  = strtotime($complete); //waktu awal
      $akhir = strtotime($approve); //waktu akhir
      $diff1  = $akhir - $awal;
      $jam   = floor($diff1 / (60 * 60));
      $menit = $diff1 - $jam * (60 * 60);
      if ($jam < 3) {
        $approve3hours++;
      } else {
        $noapprove3hours++;
      }
    }
    @$presentaseapproved3hours = ($approve3hours / $num_rows5) * 100;
    $result3 .= '
    <tr>
    <td>' . $approve3hours . '</td>
    <td align="center">' . $noapprove3hours  . '</td>
    <td align="center">' . round($presentaseapproved3hours, 2) . '%' . '</td>
    </tr>
    ';

    $result3 .= '</table><br />';
    echo $result3;
    // --------
    $result1 = '';
    $j = 1;
    $result1 .= '
  <table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>No</th>
      <th>Main Procedure</th>
      <th>Study</th>
    </tr>
  </thead>
  ';
    while ($row2 = mysqli_fetch_array($sql1)) {
      $uid2 = $row2['uid'];
      $queryseries3 = mysqli_query($conn, "SELECT * FROM xray_series WHERE uid = '$uid2'");
      $rowseries3 = mysqli_fetch_assoc($queryseries3);
      $body_part_series = $rowseries3['body_part'];
      $prosedur = $row2['prosedur'];
      if ($prosedur == '') {
        $prosedur1 = $body_part_series;
      } else {
        $prosedur1 = $prosedur;
      }
      $prosedur1 = str_replace(",", "<br />", $prosedur1);
      $result1 .= '
    <tr>
    <td align="center">' . $j . '</td>
    <td>' . $prosedur . '</td>
    <td align="center">' . $row2['total'] . '</td>
    </tr>
    ';
      $j++;
    }
    $result1 .= '
    <tr>
    <td></td>
    <td><b>All study totals</b></td>
    <td align="center"><b>' . $num_rows . '</b></td>
    </tr>
    ';
    $result1 .= '</table><br />';
    echo $result1;
    // ------------------------
    $result = '';
    $i = 1;
    $result .= '
  <table class="table-dicom" border="1" cellpadding="8" cellspacing="0">
            <thead class="thead1">
              <tr>
              <th rowspan="3">No</th>
              <th rowspan="3">PATIENT NAME</th>
              <th rowspan="3">SEX</th>
              <th rowspan="3">PATIENTID</th>
              <th rowspan="3">RADIOGRAPHER NAME</th>
              <th rowspan="3">AGE</th>
              <th rowspan="3">DEPARTMENT</th>
              <th rowspan="3">MODALITY</th>
              <th rowspan="3">PROCEDUR</th>
              <th colspan="4">FILM</th>
              <th colspan="2" rowspan="2">EKSPOSED</th>
              <th rowspan="3">XRAY TYPE</th>
              <th colspan="2" rowspan="2">FORM REGISTRATION</th>
              <th rowspan="3">PATIENT STATUS</th>
              <th rowspan="3">REGISTRATION PATIENT DATE</th>
              <th rowspan="3">SEND MODALITY DATE</th>
              <th rowspan="3">PDC</th>
              <th rowspan="3">Approve Date</th>
              <th rowspan="3">Spend Time</th>
              <th rowspan="3">PAYMENT</th>
              <th rowspan="3">STATUS</th>
              <th rowspan="3">Jam Konsul</th>
              <th rowspan="3">Hasil Kritis</th>
              <th rowspan="3">Jam Pelaporan</th>
              <th rowspan="3">Nama Pelapor</th>
              <th rowspan="3">Penerima Laporan</th>
              <th rowspan="3">Tindak Lanjut</th>
              </tr>
            </thead> 
            <tr>
            <th colspan="2">Amount Of Use</th>
            <th colspan="2">Amount Of Reject</th>
            </tr>
            <tr>
            <th align="center">&nbsp; 8</th>
            <th align="center">10</th>   
            <th align="center">&nbsp; 8</th>
            <th align="center">10</th>
            <th>KV</th>
            <th>MAS</th>
            <th align="center">Complete</th>
            <th align="center">Not Complete</th>
            
            </tr>
            ';
    if ($num_rows > 0) {
      while ($row = mysqli_fetch_array($sql)) {
        $approve = $row['approve_date'] . ' ' . $row['approve_time'];
        $complete = $row['complete_date'] . ' ' . $row['complete_time'];
        $awal  = strtotime($complete); //waktu awal
        $akhir = strtotime($approve); //waktu akhir
        $diff1  = $akhir - $awal;
        $jam   = floor($diff1 / (60 * 60));
        $menit = $diff1 - $jam * (60 * 60);
        if (!empty($approve == 0) or !empty($complete == 0)) {
          $spendtime = '';
        } else {
          $spendtime = $jam .  ' jam, ' . floor($menit / 60) . ' menit';
        }
        $birth_date = $row['birth_date'];
        $bday = new DateTime($birth_date);
        $today = new DateTime(date('y-m-d'));
        $diff = $today->diff($bday);
        $arrive_date = $row["arrive_date"];
        $arrive_date1 = str_replace("0000-00-00", " ", $arrive_date);
        $arrive_time = $row["arrive_time"];
        $arrive_time1 = str_replace("00:00:00", " ", $arrive_time);
        $uid = $row['uid'];
        $queryseries3 = mysqli_query($conn, "SELECT * FROM xray_series WHERE uid = '$uid'");
        $rowseries3 = mysqli_fetch_assoc($queryseries3);
        $body_part_series = $rowseries3['body_part'];
        $prosedur = $row['prosedur'];
        if ($prosedur == '') {
          $prosedur1 = $body_part_series;
        } else {
          $prosedur1 = $prosedur;
        }
        $prosedur1 = str_replace(",", "<br />", $prosedur1);
        $mrn = $row['mrn'];
        $mrn1 = substr($mrn, 0, 1);
        if ($mrn1 == "0") {
          $hasil0 = "'";
        } else {
          $hasil0 = "";
        }
        $patientid = $row['patientid'];
        $patientid1 = substr($patientid, 0, 1);
        if ($patientid1 == "0") {
          $hasil1 = "'";
        } else {
          $hasil1 = "";
        }
        $formregistration = $row['formregistration'];
        if ($formregistration == 'tidak lengkap') {
          $formregistrationtidaklengkap = 1;
          $formregistrationlengkap = null;
        } elseif ($formregistration == 'lengkap') {
          $formregistrationlengkap = 1;
          $formregistrationtidaklengkap = null;
        }
        $result .= '
        <tr>
        <td align="center">' . $i . '</td>
        <td>' . $row["name"] . ' ' . $row["lastname"] . '</td>
        <td align="center">' . $row["sex"] . '</td>
        <td align="center">' . $hasil1 . $patientid . '</td>
        <td>' . $row["radiographer_name"] . ' ' . $row["radiographer_lastname"] . '</td>
        <td>' . $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D' . '</td>
        <td>' . $row["name_dep"] . '</td>
        <td>' . $row["xray_type_code"] . '</td>
        <td>' . $prosedur1 . '</td>
        <td>' . $row['filmsize8'] . '</td>
        <td>' . $row['filmsize10'] . '</td>
        <td>' . $row['filmreject8'] . '</td>
        <td>' . $row['filmreject10'] . '</td>
        <td>' . $row['kv'] . '</td>
        <td>' . $row['mas'] . '</td>
        <td>' . $row['xraytype'] . '</td>
        <td>' . @$formregistrationlengkap . '</td>
        <td>' . @$formregistrationtidaklengkap . '</td>
        <td>' . $row['patienttype'] . '</td>
        <td>' . $row["create_time"] . '</td>
        <td align="right">' . $arrive_date1 . ' ' . $arrive_time1 . '</td>
        <td>' . $complete . '</td>
        <td>' . $approve . '</td>
        <td>' . $spendtime . '</td>
        <td>' . $row["payment"] . '</td>
        <td>' . $row["status"] . '</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>';
        $i++;
      }
      $query6 = "SELECT * 
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "')
            AND patienttype IN('" . @$checkboxfiltertype . "') 
            AND formregistration = 'lengkap' 
            ORDER BY complete_date DESC, complete_time DESC";
      $sql6 = mysqli_query($conn, $query6);
      $num_rows6 = mysqli_num_rows($sql6);
      // ------
      $query7 = "SELECT * 
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "')
            AND patienttype IN('" . @$checkboxfiltertype . "') 
            AND formregistration = 'tidak lengkap' 
            ORDER BY complete_date DESC, complete_time DESC";
      $sql7 = mysqli_query($conn, $query7);
      $num_rows7 = mysqli_num_rows($sql7);
      // ------
      $query8 = "SELECT SUM(filmsize8) AS sumfilm8
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "') 
            AND patienttype IN('" . @$checkboxfiltertype . "') 
            ORDER BY complete_date DESC, complete_time DESC";
      $sql8 = mysqli_query($conn, $query8);
      $row8 = mysqli_fetch_assoc($sql8);
      // ------
      $query9 = "SELECT SUM(filmsize10) AS sumfilm10
    FROM xray_workload_radiographer 
     WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
    AND xray_type_code IN('" . $checkboxfilter . "') 
    AND patienttype IN('" . @$checkboxfiltertype . "') 
    ORDER BY complete_date DESC, complete_time DESC";
      $sql9 = mysqli_query($conn, $query9);
      $row9 = mysqli_fetch_assoc($sql9);
      // ------
      $query10 = "SELECT SUM(filmreject8) AS sumfilmreject8
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "')
            AND patienttype IN('" . @$checkboxfiltertype . "') 
            ORDER BY complete_date DESC, complete_time DESC";
      $sql10 = mysqli_query($conn, $query10);
      $row10 = mysqli_fetch_assoc($sql10);
      // ------
      $query11 = "SELECT SUM(filmreject10) AS sumfilmreject10
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "') 
            AND patienttype IN('" . @$checkboxfiltertype . "') 
            ORDER BY complete_date DESC, complete_time DESC";
      $sql11 = mysqli_query($conn, $query11);
      $row11 = mysqli_fetch_assoc($sql11);
      // ------
      $result .= '
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th>' . $row8['sumfilm8'] . '</th>
      <th>' . $row9['sumfilm10'] . '</th>
      <th>' . $row10['sumfilmreject8'] . '</th>
      <th>' . $row11['sumfilmreject10'] . '</th>
      <th></th>
      <th></th>
      <th></th>
      <th>' . $num_rows6 . '</th>
      <th>' . $num_rows7 . '</th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    ';
    } else {
      $result .= '
    <tr>
    <td colspan="5">No Item Found</td>
    </tr>';
    }
    $result .= '</table>';
    echo $result;
    exit;
    // end radiographer all
  } else {
    // menampilkan data pasien
    $query = "SELECT * 
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "')
            AND patienttype IN('" . $checkboxfiltertype . "')
            AND radiographer_name IN('" . $radiographer . "')
            ORDER BY complete_date DESC, complete_time DESC";
    $sql = mysqli_query($conn, $query);

    $num_rows = mysqli_num_rows($sql);

    // total semua data prosedur
    $query1 = "SELECT *, COUNT(*) as total
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "')
            AND patienttype IN('" . @$checkboxfiltertype . "')
            AND radiographer_name IN('" . $radiographer . "')  
            GROUP BY prosedur
            ";
    $sql1 = mysqli_query($conn, $query1);
    // total semua data status
    $query2 = "SELECT *, COUNT(*) as totalstatus
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "')
            AND patienttype IN('" . @$checkboxfiltertype . "')  
            AND radiographer_name IN('" . $radiographer . "')
            GROUP BY status
            ";
    $sql2 = mysqli_query($conn, $query2);
    // total status by appproved
    $query3 = "SELECT * 
  FROM xray_workload_radiographer 
   WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
  AND xray_type_code IN('" . $checkboxfilter . "') 
  AND patienttype IN('" . @$checkboxfiltertype . "') 
  AND radiographer_name IN('" . $radiographer . "')
  AND status = 'APPROVED' 
  ORDER BY complete_date DESC, complete_time DESC";
    $sql3 = mysqli_query($conn, $query3);
    $num_rows3 = mysqli_num_rows($sql3);

    echo 'Tanggal ' . $from . ' - ' . $to;
    $result2 = '';
    $result2 .= '
  <table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>Status</th>
      <th>Total</th>
      <th>Persentase</th>
    </tr>
  </thead>
  ';
    while ($row3 = mysqli_fetch_array($sql2)) {
      $status = $row3['status'];
      $query4 = "SELECT * 
    FROM xray_workload_radiographer 
     WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
    AND xray_type_code IN('" . $checkboxfilter . "') 
    AND patienttype IN('" . @$checkboxfiltertype . "') 
    AND radiographer_name IN('" . $radiographer . "')
    AND status = '$status'";
      $sql4 = mysqli_query($conn, $query4);
      $num_rows4 = mysqli_num_rows($sql4);
      @$totalstatus = $row3['totalstatus'];
      @$presentaseapproved = ($num_rows4 / $num_rows) * 100;
      $result2 .= '

    <tr>
    <td>' . $status . '</td>
    <td align="center">' . $num_rows4  . '</td>
    <td align="center">' . round($presentaseapproved, 2) . '%' . '</td>
    </tr>
    ';
    }
    $result2 .= '</table><br />';
    echo $result2;
    // --------
    $result3 = '';
    $result3 .= '
  <table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>< 3 Jam</th>
      <th>> 3 Jam</th>
      <th>Persentase Approved < 3 jam</th>
    </tr>
  </thead>
  ';
    $query5 = "SELECT * 
  FROM xray_workload_radiographer 
   WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
  AND xray_type_code IN('" . $checkboxfilter . "')
  AND patienttype IN('" . @$checkboxfiltertype . "') 
  AND radiographer_name IN('" . $radiographer . "')
  AND status = 'APPROVED'";
    $sql5 = mysqli_query($conn, $query5);
    $num_rows5 = mysqli_num_rows($sql5);
    $approve3hours = 0;
    $noapprove3hours = 0;
    while ($row5 = mysqli_fetch_array($sql5)) {
      $updated_time = $row5['updated_time'];
      $approve_date = $row5['approve_date'];
      $approve_time = $row5['approve_time'];
      $approve = $row5['approve_date'] . ' ' . $row5['approve_time'];
      $complete = $row5['complete_date'] . ' ' . $row5['complete_time'];
      $awal  = strtotime($complete); //waktu awal
      $akhir = strtotime($approve); //waktu akhir
      $diff1  = $akhir - $awal;
      $jam   = floor($diff1 / (60 * 60));
      $menit = $diff1 - $jam * (60 * 60);
      if ($jam < 3) {
        $approve3hours++;
      } else {
        $noapprove3hours++;
      }
    }
    @$presentaseapproved3hours = ($approve3hours / $num_rows5) * 100;
    $result3 .= '
    <tr>
    <td>' . $approve3hours . '</td>
    <td align="center">' . $noapprove3hours  . '</td>
    <td align="center">' . round($presentaseapproved3hours, 2) . '%' . '</td>
    </tr>
    ';

    $result3 .= '</table><br />';
    echo $result3;
    // --------
    $result1 = '';
    $j = 1;
    $result1 .= '
  <table border="1" cellpadding="8" cellspacing="0">
  <thead>
    <tr>
      <th>No</th>
      <th>Main Procedure</th>
      <th>Study</th>
    </tr>
  </thead>
  ';
    while ($row2 = mysqli_fetch_array($sql1)) {
      $uid2 = $row2['uid'];
      $queryseries3 = mysqli_query($conn, "SELECT * FROM xray_series WHERE uid = '$uid2'");
      $rowseries3 = mysqli_fetch_assoc($queryseries3);
      $body_part_series = $rowseries3['body_part'];
      $prosedur = $row2['prosedur'];
      if ($prosedur == '' or $prosedur == NULL) {
        $prosedur1 = $body_part_series;
      } else {
        $prosedur1 = $prosedur;
      }
      $prosedur1 = str_replace(",", "<br />", $prosedur1);
      $result1 .= '
    <tr>
    <td align="center">' . $j . '</td>
    <td>' . $prosedur1 . '</td>
    <td align="center">' . $row2['total'] . '</td>
    </tr>
    ';
      $j++;
    }
    $result1 .= '
    <tr>
    <td></td>
    <td><b>All study totals</b></td>
    <td align="center"><b>' . $num_rows . '</b></td>
    </tr>
    ';
    $result1 .= '</table><br />';
    echo $result1;
    // ------------------------
    $result = '';
    $i = 1;
    $result .= '
  <table class="table-dicom" border="1" cellpadding="8" cellspacing="0">
            <thead class="thead1">
              <tr>
              <th rowspan="3">No</th>
              <th rowspan="3">PATIENT NAME</th>
              <th rowspan="3">SEX</th>
              <th rowspan="3">PATIENTID</th>
              <th rowspan="3">RADIOGRAPHER NAME</th>
              <th rowspan="3">AGE</th>
              <th rowspan="3">DEPARTMENT</th>
              <th rowspan="3">MODALITY</th>
              <th rowspan="3">PROCEDUR</th>
              <th colspan="4">FILM</th>
              <th colspan="2" rowspan="2">EKSPOSED</th>
              <th rowspan="3">XRAY TYPE</th>
              <th colspan="2" rowspan="2">FORM REGISTRATION</th>
              <th rowspan="3">PATIENT STATUS</th>
              <th rowspan="3">REGISTRATION PATIENT DATE</th>
              <th rowspan="3">SEND MODALITY DATE</th>
              <th rowspan="3">PDC</th>
              <th rowspan="3">Approve Date</th>
              <th rowspan="3">Spend Time</th>
              <th rowspan="3">PAYMENT</th>
              <th rowspan="3">STATUS</th>
              <th rowspan="3">Jam Konsul</th>
              <th rowspan="3">Hasil Kritis</th>
              <th rowspan="3">Jam Pelaporan</th>
              <th rowspan="3">Nama Pelapor</th>
              <th rowspan="3">Penerima Laporan</th>
              <th rowspan="3">Tindak Lanjut</th>
              </tr>
            </thead> 
            <tr>
            <th colspan="2">Amount Of Use</th>
            <th colspan="2">Amount Of Reject</th>
            </tr>
            <tr>
            <th align="center">&nbsp; 8</th>
            <th align="center">10</th>   
            <th align="center">&nbsp; 8</th>
            <th align="center">10</th>
            <th>KV</th>
            <th>MAS</th>
            <th align="center">Complete</th>
            <th align="center">Not Complete</th>
            
            </tr>
            ';
    if ($num_rows > 0) {
      while ($row = mysqli_fetch_array($sql)) {
        $uid = $row['uid'];
        $queryseries2 = mysqli_query($conn, "SELECT * FROM xray_series WHERE uid = '$uid'");
        $rowseries2 = mysqli_fetch_assoc($queryseries2);
        $body_part_series = $rowseries2['body_part'];
        $prosedur = $row['prosedur'];
        if ($prosedur == '') {
          $prosedur1 = $body_part_series;
        } else {
          $prosedur1 = $prosedur;
        }
        $birth_date = $row['birth_date'];
        $bday = new DateTime($birth_date);
        $today = new DateTime(date('y-m-d'));
        $diff = $today->diff($bday);
        $arrive_date = $row["arrive_date"];
        $arrive_date1 = str_replace("0000-00-00", " ", $arrive_date);
        $arrive_time = $row["arrive_time"];
        $arrive_time1 = str_replace("00:00:00", " ", $arrive_time);

        $prosedur1 = str_replace(",", "<br />", $prosedur);
        $complete = $row['complete_date'] . ' ' . $row['complete_time'];
        $approve = $row['approve_date'] . ' ' . $row['approve_time'];
        $awal  = strtotime($complete); //waktu awal
        $akhir = strtotime($approve); //waktu akhir
        $diff1  = $akhir - $awal;
        $jam   = floor($diff1 / (60 * 60));
        $menit = $diff1 - $jam * (60 * 60);
        if (!empty($approve == 0) or !empty($complete == 0)) {
          $spendtime = '';
        } else {
          $spendtime = $jam .  ' jam, ' . floor($menit / 60) . ' menit';
        }
        $mrn = $row['mrn'];
        $mrn1 = substr($mrn, 0, 1);
        if ($mrn1 == "0") {
          $hasil0 = "'";
        } else {
          $hasil0 = "";
        }
        $patientid = $row['patientid'];
        $patientid1 = substr($patientid, 0, 1);
        if ($patientid1 == "0") {
          $hasil1 = "'";
        } else {
          $hasil1 = "";
        }
        $formregistration = $row['formregistration'];
        if ($formregistration == 'tidak lengkap') {
          $formregistrationtidaklengkap = 1;
          $formregistrationlengkap = null;
        } elseif ($formregistration == 'lengkap') {
          $formregistrationlengkap = 1;
          $formregistrationtidaklengkap = null;
        }
        $result .= '
        <tr>
        <td align="center">' . $i . '</td>
        <td>' . $row["name"] . ' ' . $row["lastname"] . '</td>
        <td align="center">' . $row["sex"] . '</td>
        <td align="center">' . $hasil1 . $patientid . '</td>
        <td>' . $row["radiographer_name"] . ' ' . $row["radiographer_lastname"] . '</td>
        <td>' . $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D' . '</td>
        <td>' . $row["name_dep"] . '</td>
        <td>' . $row["xray_type_code"] . '</td>
        <td>' . $prosedur1 . '</td>
        <td>' . $row['filmsize8'] . '</td>
        <td>' . $row['filmsize10'] . '</td>
        <td>' . $row['filmreject8'] . '</td>
        <td>' . $row['filmreject10'] . '</td>
        <td>' . $row['kv'] . '</td>
        <td>' . $row['mas'] . '</td>
        <td>' . $row['xraytype'] . '</td>
        <td>' . @$formregistrationlengkap . '</td>
        <td>' . @$formregistrationtidaklengkap . '</td>
        <td>' . $row['patienttype'] . '</td>
        <td>' . $row["create_time"] . '</td>
        <td align="right">' . $arrive_date1 . ' ' . $arrive_time1 . '</td>
        <td>' . $complete . '</td>   
        <td>' . $row["approve_date"] . ' ' . $row["approve_time"] . '</td>
        <td>' . $spendtime . '</td>
        <td>' . $row["payment"] . '</td>
        <td>' . $row["status"] . '</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>';
        $i++;
      }
      $query6 = "SELECT * 
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "')
            AND patienttype IN('" . @$checkboxfiltertype . "') 
            AND radiographer_name IN('" . $radiographer . "')
            AND formregistration = 'lengkap' 
            ORDER BY complete_date DESC, complete_time DESC";
      $sql6 = mysqli_query($conn, $query6);
      $num_rows6 = mysqli_num_rows($sql6);
      // ------
      $query7 = "SELECT * 
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "')
            AND patienttype IN('" . @$checkboxfiltertype . "') 
            AND radiographer_name IN('" . $radiographer . "')
            AND formregistration = 'tidak lengkap' 
            ORDER BY complete_date DESC, complete_time DESC";
      $sql7 = mysqli_query($conn, $query7);
      $num_rows7 = mysqli_num_rows($sql7);
      // ------
      $query8 = "SELECT SUM(filmsize8) AS sumfilm8
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "') 
            AND patienttype IN('" . @$checkboxfiltertype . "') 
            AND radiographer_name IN('" . $radiographer . "')
            ORDER BY complete_date DESC, complete_time DESC";
      $sql8 = mysqli_query($conn, $query8);
      $row8 = mysqli_fetch_assoc($sql8);
      // ------
      $query9 = "SELECT SUM(filmsize10) AS sumfilm10
    FROM xray_workload_radiographer 
     WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
    AND xray_type_code IN('" . $checkboxfilter . "') 
    AND patienttype IN('" . @$checkboxfiltertype . "') 
    AND radiographer_name IN('" . $radiographer . "')
    ORDER BY complete_date DESC, complete_time DESC";
      $sql9 = mysqli_query($conn, $query9);
      $row9 = mysqli_fetch_assoc($sql9);
      // ------
      $query10 = "SELECT SUM(filmreject8) AS sumfilmreject8
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "')
            AND patienttype IN('" . @$checkboxfiltertype . "') 
            AND radiographer_name IN('" . $radiographer . "')
            ORDER BY complete_date DESC, complete_time DESC";
      $sql10 = mysqli_query($conn, $query10);
      $row10 = mysqli_fetch_assoc($sql10);
      // ------
      $query11 = "SELECT SUM(filmreject10) AS sumfilmreject10
            FROM xray_workload_radiographer 
             WHERE complete_date BETWEEN '$from_tgl' AND '$to_tgl' AND complete_time BETWEEN '$from_time' AND '$to_time'
            AND xray_type_code IN('" . $checkboxfilter . "') 
            AND patienttype IN('" . @$checkboxfiltertype . "') 
            AND radiographer_name IN('" . $radiographer . "')
            ORDER BY complete_date DESC, complete_time DESC";
      $sql11 = mysqli_query($conn, $query11);
      $row11 = mysqli_fetch_assoc($sql11);
      // ------
      $result .= '
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th>' . $row8['sumfilm8'] . '</th>
      <th>' . $row9['sumfilm10'] . '</th>
      <th>' . $row10['sumfilmreject8'] . '</th>
      <th>' . $row11['sumfilmreject10'] . '</th>
      <th></th>
      <th></th>
      <th></th>
      <th>' . $num_rows6 . '</th>
      <th>' . $num_rows7 . '</th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    ';
    } else {
      $result .= '
    <tr>
    <td colspan="5">No Item Found</td>
    </tr>';
    }
    $result .= '</table>';
    echo $result;
    exit;
  }
}
// -----------------------------------------workload radiographer modalitas--------------------------------------------
// if(isset($_POST["workloadradiographermod"])){
//   $checkboxfilter = implode("','", $_POST["checkbox"]);
//  $result = '';
//   $query = "SELECT * 
//             FROM xray_workload_radiographer 
//             WHERE complete_date BETWEEN '".$_POST["from-radiographer-workload-mod"]."' AND '".$_POST["to-radiographer-workload-mod"]."' 
//             AND xray_type_code IN('".$checkboxfilter."') 
//             ORDER BY complete_time DESC";
//   $sql = mysqli_query($conn, $query);
//   $result .='
//   <table class="table-dicom" border="1" cellpadding="8" cellspacing="0">
//             <thead class="thead1">
//               <tr>
//                 <th>ACC NUMBER</th>
//                 <th>MODALITY</th>
//                 <th>NAME MODALITY</th>
//                 <th>PROSEDURE</th>
//                 <th>ARRIVE DATE & TIME</th>
//                 <th>COMPLETE DATE & TIME</th>
//               </tr>
//             </thead> ';
//   if(mysqli_num_rows($sql) > 0)
//   {
//     while($row = mysqli_fetch_array($sql))
//     {
//       $result .='
//         <tr>  
//           <td>'. $row["acc"] .'</td>
//           <td>'. $row["xray_type_code"] .'</td>
//           <td>'. $row["typename"] .'</td>
//           <td>'. $row["prosedur"] .'</td>
//           <td>'. $row["arrive_date"] .' '. $row["arrive_time"] .'</td>
//           <td>'. $row["complete_date"] .' '. $row["complete_time"] .'</td>
//         </tr>';
//     }
//   }
//   else
//   {
//     $result .='
//     <tr>
//     <td colspan="5">No Item Found</td>
//     </tr>';
//   }
//   $result .='</table>';
//   echo $result;
//   exit;
// }
