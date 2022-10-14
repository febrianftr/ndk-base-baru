<?php 

require '../koneksi/koneksi.php';

session_start();

if(isset($_POST["From"], $_POST["to"], $_POST['keyword'], $_POST['checkbox'],$_POST['keyword_mrn'],
         $_POST['keyword_acc'])){

  $username = $_SESSION['username'];
  $checkboxfilter = implode("','", $_POST["checkbox"]);

  $query1 = "SELECT * 
        FROM xray_dokter WHERE username = '$username'";

  $data_dicom = mysqli_query($conn,$query1);
  $row = mysqli_fetch_assoc($data_dicom);
  $username2 = $row['username'];
  $username3 = $row['dokterid'];
  $result = '';
  $query = "SELECT * 
            FROM xray_workload 
            WHERE dokterid = '$username3' 
            AND approve_date BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."'
            AND CONCAT (name,' ',lastname) LIKE '%".$_POST['keyword']."%'
            AND mrn LIKE '%".$_POST['keyword_mrn']."%'
            AND acc LIKE '%".$_POST['keyword_acc']."%'
            AND xray_type_code IN('".$checkboxfilter."') 
            ORDER BY approve_time DESC";
  $sql = mysqli_query($conn, $query);
  $result .='
  <table class="table-dicom" style="margin-top: 3px;" border="1" cellpadding="8" cellspacing="0">
            <thead class="thead1">
              <tr>
                <th>MRN</th>
                <th>Radiology Physician</th>
                <th>Name</th>
                <th>Modality</th>
                <th>Procedure</th>
                <th>Refferal Physician</th>
                <th>Department</th>
                <th>Status</th>
                <th>Approved Date</th>
                <th>Report</th>
              </tr>
            </thead> ';
  if(mysqli_num_rows($sql) > 0)
  {
    while($row2 = mysqli_fetch_array($sql))
    {
            $priority = $row2['priority'];
            $text = preg_replace('/[^A-Za-z\ ]/', '', $priority);
            $approve_date = $row2['approve_date'];
            $sd = date("d F Y", strtotime($approve_date));
      $result .='
        <tr>  
          <td>'. $row2["mrn"] .'</td>  
          <td>'. $row2["dokrad_name"] .' '. $row2["dokrad_lastname"] .'</td>  
          <td>'. $row2["name"] .' '. $row2["lastname"] .'</td>  
          <td>'. $row2["xray_type_code"] .'</td>  
          <td>'. $row2["prosedur"] .'</td>  
          <td>'. $row2["named"] .' '. $row2["lastnamed"] .'</td>
          <td>'. $row2["name_dep"] .'</td>
          <td>' . $text .'</td>
          <td>' . $sd .'</td>
          <td>
              <a style="text-decoration:none;" class="ahref" href="../radiology/pdf/testpdf4.php?uid='. $row2["uid"] .'");" target="_blank">Show</a>
              <button class="btn btn-worklist3" type="button" data-toggle="modal" data-target="#myModal">XML</button>
             <a style="text-decoration: none;" class="ahref_email" href="../radiology/phpmailer/examples/gmail.php?uid='. $row2["uid"] .'" target="_blank">email</a>
          </td>
        </tr>';
    }
  }
  else
  {
    $result .='
    <tr>
    <td colspan="10">No Data Found</td>
    </tr>';
  }
  $result .='</table>';
  echo $result;
}

include('script-footer.php');
?>