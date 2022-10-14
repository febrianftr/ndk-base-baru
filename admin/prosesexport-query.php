<?php 
require '../koneksi/koneksi.php';

session_start();

  // Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=DataPatient.xls");

 // ---------------------------------------------------- radiology workload------------------------------------------------
 if(isset($_POST["radiologyworkload"])){
  $username = $_SESSION['username'];
    $query1 = "SELECT * FROM xray_dokter_radiology WHERE username = '$username'";
  $data_dicom = mysqli_query($conn,$query1);
  $row12 = mysqli_fetch_assoc($data_dicom);
  $username2 = $row12['username'];
  $dokradid = $row12['dokradid'];
  $result = '';
  $query = "SELECT * 
            FROM xray_workload
            WHERE approve_date BETWEEN '".$_POST["from-radiology-workload"]."' AND '".$_POST["to-radiology-workload"]."'
            ORDER BY approve_time DESC";
  $sql = mysqli_query($conn, $query);
  $result .='
  <table class="table-dicom" border="1" cellpadding="8" cellspacing="0">
            <thead class="thead1">
              <tr>
                <th>ACC NUMBER</th>
                <th>RADIOLOGY PHYSICIAN</th>
                <th>PATIENT NAME</th>
                <th>AGE</th>
                <th>WEIGHT</th>
                <th>PROSEDURE</th>
                <th>RADIOGRAPHER NAME</th>
                <th>REFERRAL PHYSICIAN</th>
                <th>PDC</th>
                <th>APPROVE DATE & TIME</th>
                <th>SPEND TIME</th>
                <th>APPROVE UPDATE DATE & TIME</th>
              </tr>
            </thead> ';
  if(mysqli_num_rows($sql) > 0)
  {
    while($row = mysqli_fetch_array($sql))
    {
      $birth_date = $row['birth_date'];
      $bday = new DateTime($birth_date);
      $today = new DateTime(date('y-m-d'));
      $diff = $today->diff($bday);
      $updated_time = $row["updated_time"];
      $approve = $row["approve_date"] .' '. $row["approve_time"];
      $awal  = strtotime($updated_time); //waktu awal
      $akhir = strtotime($approve); //waktu akhir
      $diff1  = $akhir - $awal;
      $jam   = floor($diff1 / (60 * 60));
      $menit = $diff1 - $jam * (60 * 60);
      $result .='
        <tr>  
          <td>'. $row["acc"] .'</td>
          <td>'. $row["dokrad_name"] .' '. $row["dokrad_lastname"] .'</td>
          <td>'. $row["name"] .' '. $row["lastname"] .'</td>
          <td>'. $diff->y.'Y'. ' ' . $diff->m .'M'. ' ' . $diff->d .'D' .'</td>
          <td>'. $row["weight"] .'</td>
          <td>'. $row["prosedur"] .'</td>
          <td>'. $row["radiographer_name"] .' '. $row["radiographer_lastname"] .'</td>
          <td>'. $row["named"] .' '. $row["lastnamed"] .'</td>
          <td>'. $updated_time .'</td>
          <td>'. $approve .'</td>
          <td>'. $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit' .'</td>
          <td>'.  $approve .'</td>
        </tr>';
    }
  }
  else
  {
    $result .='
    <tr>
    <td colspan="5">No Item Found</td>
    </tr>';
  }
  $result .='</table>';
  echo $result;
  exit;
}
// ---------------------------------------------------- referral workload------------------------------------------------
 if(isset($_POST["refferalworkload"])){
  $result = '';
  $query = "SELECT * 
            FROM xray_workload_radiographer 
            WHERE complete_date BETWEEN '".$_POST["from-refferal-workload"]."' AND '".$_POST["to-refferal-workload"]."' 
            ORDER BY complete_time DESC";
  $sql = mysqli_query($conn, $query);
  $result .='
  <table class="table-dicom" border="1" cellpadding="8" cellspacing="0">
            <thead class="thead1">
              <tr>
                <th>REFERRAL PHYSICIAN</th>
                <th>PATIENT NAME</th>
                <th>AGE</th>
                <th>WEIGHT</th>
                <th>RADIOLOGY PHYSICIAN</th>
                <th>RADIOGRAPHER NAME</th>
                <th>ARRIVE DATE & TIME</th>
                <th>COMPLETE DATE & TIME</th>
                <th>STATUS</th>
              </tr>
            </thead> ';
  if(mysqli_num_rows($sql) > 0)
  {
    while($row = mysqli_fetch_array($sql))
    {
      $birth_date = $row['birth_date'];
      $bday = new DateTime($birth_date);
      $today = new DateTime(date('y-m-d'));
      $diff = $today->diff($bday);
      $result .='
        <tr>  
          <td>'. $row["named"] .' '. $row["lastnamed"] .'</td>
          <td>'. $row["name"] .' '. $row["lastname"] .'</td>
          <td>'. $diff->y.'Y'. ' ' . $diff->m .'M'. ' ' . $diff->d .'D' .'</td>
          <td>'. $row["weight"] .'</td>
          <td>'. $row["dokrad_name"] .' '. $row["dokrad_lastname"] .'</td>
          <td>'. $row["radiographer_name"] .' '. $row["radiographer_lastname"] .'</td>
          <td>'. $row["arrive_date"] .' '. $row["arrive_time"] .'</td>
          <td>'. $row["complete_date"] .' '. $row["complete_time"] .'</td>
          <td>'. $row["status"] .'</td>
        </tr>';
    }
  }
  else
  {
    $result .='
    <tr>
    <td colspan="5">No Item Found</td>
    </tr>';
  }
  $result .='</table>';
  echo $result;
  exit;
}
// ---------------------------------------------------- radiographer workload------------------------------------------------
 if(isset($_POST["radiographerworkload"])){
  $result = '';
  $query = "SELECT * 
            FROM xray_workload_radiographer 
            WHERE complete_date BETWEEN '".$_POST["from-radiographer-workload"]."' AND '".$_POST["to-radiographer-workload"]."' 
            ORDER BY complete_time DESC";
  $sql = mysqli_query($conn, $query);
  $result .='
  <table class="table-dicom" border="1" cellpadding="8" cellspacing="0">
            <thead class="thead1">
              <tr>
                <th>ACC NUMBER</th>
                <th>RADIOGRAPHER NAME</th>
                <th>PATIENT NAME</th>
                <th>AGE</th>
                <th>WEIGHT</th>
                <th>PROSEDURE</th>
                <th>RADIOLOGY PHYSICIAN</th>
                <th>ARRIVE DATE & TIME</th>
                <th>COMPLETE DATE & TIME</th>
                <th>STATUS</th>
              </tr>
            </thead> ';
  if(mysqli_num_rows($sql) > 0)
  {
    while($row = mysqli_fetch_array($sql))
    {
      $birth_date = $row['birth_date'];
      $bday = new DateTime($birth_date);
      $today = new DateTime(date('y-m-d'));
      $diff = $today->diff($bday);
      $result .='
        <tr>  
          <td>'. $row["acc"] .'</td>
          <td>'. $row["radiographer_name"] .' '. $row["radiographer_lastname"] .'</td>
          <td>'. $row["name"] .' '. $row["lastname"] .'</td>
          <td>'. $diff->y.'Y'. ' ' . $diff->m .'M'. ' ' . $diff->d .'D' .'</td>
          <td>'. $row["weight"] .'</td>
          <td>'. $row["prosedur"] .'</td>
          <td>'. $row["dokrad_name"] .' '. $row["dokrad_lastname"] .'</td>
          <td>'. $row["arrive_date"] .' '. $row["arrive_time"] .'</td>
          <td>'. $row["complete_date"] .' '. $row["complete_time"] .'</td>
          <td>'. $row["status"] .'</td>
        </tr>';
    }
  }
  else
  {
    $result .='
    <tr>
    <td colspan="5">No Item Found</td>
    </tr>';
  }
  $result .='</table>';
  echo $result;
  exit;
}
// -----------------------------------------workload radiographer modalitas--------------------------------------------
if(isset($_POST["workloadradiographermod"])){
  $checkboxfilter = implode("','", $_POST["checkbox"]);
 $result = '';
  $query = "SELECT * 
            FROM xray_workload_radiographer 
            WHERE complete_date BETWEEN '".$_POST["from-radiographer-workload-mod"]."' AND '".$_POST["to-radiographer-workload-mod"]."' 
            AND xray_type_code IN('".$checkboxfilter."') 
            ORDER BY complete_time DESC";
  $sql = mysqli_query($conn, $query);
  $result .='
  <table class="table-dicom" border="1" cellpadding="8" cellspacing="0">
            <thead class="thead1">
              <tr>
                <th>ACC NUMBER</th>
                <th>MODALITY</th>
                <th>NAME MODALITY</th>
                <th>PROSEDURE</th>
                <th>ARRIVE DATE & TIME</th>
                <th>COMPLETE DATE & TIME</th>
              </tr>
            </thead> ';
  if(mysqli_num_rows($sql) > 0)
  {
    while($row = mysqli_fetch_array($sql))
    {
      $result .='
        <tr>  
          <td>'. $row["acc"] .'</td>
          <td>'. $row["xray_type_code"] .'</td>
          <td>'. $row["typename"] .'</td>
          <td>'. $row["prosedur"] .'</td>
          <td>'. $row["arrive_date"] .' '. $row["arrive_time"] .'</td>
          <td>'. $row["complete_date"] .' '. $row["complete_time"] .'</td>
        </tr>';
    }
  }
  else
  {
    $result .='
    <tr>
    <td colspan="5">No Item Found</td>
    </tr>';
  }
  $result .='</table>';
  echo $result;
  exit;
}
 ?>