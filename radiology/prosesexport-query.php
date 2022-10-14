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

  $username = $_SESSION['username'];

  $from = $_POST["from-radiology-workload"];
  $to = $_POST["to-radiology-workload"];

  $from_tgl = date('Y-m-d', strtotime($from));
  $to_tgl = date('Y-m-d', strtotime($to));

  $from_time = date('H:i', strtotime($from));
  $to_time = date('H:i', strtotime($to));

  $result1 = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE username = '$username' ");
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
    $prosedur = $row2['prosedur'];
    $prosedur = str_replace(",", "<br />", $prosedur);
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
          <td>' . $row["prosedur"] . '</td>
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
