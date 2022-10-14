<?php 
require '../koneksi/koneksi.php';

session_start();

$username = $_SESSION['username'];

$from = $_POST["From"];
$to = $_POST["to"];

$from1 = date('d/m/Y', strtotime($from));
$to1 = date('d/m/Y', strtotime($to));

$result1 = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE username = '$username' ");
$row1 = mysqli_fetch_assoc($result1);
$dokradid = $row1['dokradid'];

$checkboxfilter = implode("','", $_POST["modality"]);
$query =    "SELECT *
            FROM xray_workload 
            WHERE dokradid = '$dokradid' 
            AND approve_date BETWEEN '$from' AND '$to' 
            AND name LIKE '%" . $_POST['keyword'] . "%' 
            AND xray_type_code IN('" . $checkboxfilter . "') 
            ORDER BY approve_date DESC, approve_time DESC
            ";
$sql = mysqli_query($conn, $query);

$query1 =    "SELECT *, COUNT(*) as total 
            FROM xray_workload 
            WHERE dokradid = '$dokradid' 
            AND approve_date BETWEEN '$from' AND '$to' 
            AND name LIKE '%" . $_POST['keyword'] . "%' 
            AND xray_type_code IN('" . $checkboxfilter . "') 
            GROUP BY prosedur
            ";
$sql1 = mysqli_query($conn, $query1);

$num_rows = mysqli_num_rows($sql);
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=$from1-$to1.xls");

echo ' Tanggal ' . $from1 . ' - ' . $to1 . ' <br />';
echo ' Total <b>' . $num_rows . '</b> Study';

while ($row2 = mysqli_fetch_array($sql1)) {
  echo '<br /> Pemeriksaan <b>' . $row2['prosedur'] . '</b>';
  echo ' Jumlah : <b>' . $row2['total'] . '</b> Study';
}

 if(isset($_POST["export"])){
  $i = 1;
  $result = '';
  $result .='
  <table class="table-dicom" border="1" cellpadding="8" cellspacing="0">
            <thead class="thead1">
              <tr>
                <th>No</th>
                <th>MRN</th>
                <th>Patient Name</th>
                <th>SEX</th>
                <th>AGE</th>
                <th>Department</th>
                <th>Modality</th>
                <th>Main Procedure</th>
                <th>Procedure</th>
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
  if($num_rows > 0)
  {
    while($row = mysqli_fetch_array($sql))
    {
    	$birth_date = $row['birth_date'];
			$bday = new DateTime($birth_date);
			$today = new DateTime(date('y-m-d'));
			$diff = $today->diff($bday);
      $priority = $row['priority'];
      $text = preg_replace('/[^A-Za-z\ ]/', '', $priority);
      $approve = $row["approve_date"] .' '. $row["approve_time"];
      $updated_time = $row["updated_time"];
      $awal  = strtotime($updated_time); //waktu awal
      $akhir = strtotime($approve); //waktu akhir
      $diff1  = $akhir - $awal;
      $jam   = floor($diff1 / (60 * 60));
      $menit = $diff1 - $jam * (60 * 60);
      $approve_up = $row["approve_update"] .' '. $row["approve_uptime"];
      $mrn = $row['mrn'];
      $mrn1 = substr($mrn, 0,1);
      if ($mrn1 == "0") {
          $hasil0 = "'";
      }
      else{
        $hasil0 = "";
      }
      $result .='
        <tr>  
          <td>'. $i .'</td>
          <td align="left">'. $hasil0 . $mrn .'</td>  
          <td>'. $row["name"] .' '. $row["lastname"] .'</td>
          <td>'. $row["sex"] .'</td> 
          <td>'. $diff->y.'Y'. ' ' . $diff->m .'M'. ' ' . $diff->d .'D' .'</td>
          <td>'. $row["name_dep"] .'</td>
          <td>'. $row["xray_type_code"] .'</td> 
          <td>'. $row["prosedur"] .'</td>
          <td>'. $row["series_desc"] .'</td>
          <td>' . $text .'</td>
          <td>'. $row["named"] .' '. $row["lastnamed"] .'</td>
          <td>'. $row["radiographer_name"] .' '. $row["radiographer_lastname"] .'</td>
          <td>'. $row["dokrad_name"] .' '. $row["dokrad_lastname"] .'</td> 
          <td>'. $row["updated_time"] .'</td>  
          <td>'. $approve .'</td>
          <td>'. $jam .  ' jam, ' . floor( $menit / 60 ) . ' menit' .'</td>
          <td>'. $approve_up .'</td>
        </tr>';
        $i ++;
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
}
 ?>