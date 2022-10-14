<?php 

require '../koneksi/koneksi.php';

session_start();

if(isset($_POST["From"], $_POST["to"], $_POST['keyword'], $_POST['modality'],
         $_POST['keyword_mrn'], $_POST['keyword_acc'])){

  $username = $_SESSION['username'];
  $checkboxmodality = implode("','", $_POST["modality"]);
  // ---------------- UNTUK PAYMENT ASURANSI LAINNYA BELUM AKTIF-------------------------
  $checkboxpayment = implode("','", $_POST["payment"]);

  $query1 = "SELECT * 
        FROM xray_dokter_radiology WHERE username = '$username'";

  $data_dicom = mysqli_query($conn,$query1);
  $row = mysqli_fetch_assoc($data_dicom);
  $username2 = $row['username'];
  $username3 = $row['dokradid'];
  $query = "SELECT * 
            FROM xray_workload 
            WHERE dokradid = '$username3' 
            AND approve_date BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."'
            AND CONCAT (name,' ',lastname) LIKE '%".$_POST['keyword']."%'
            AND mrn LIKE '%".$_POST['keyword_mrn']."%'
            AND acc LIKE '%".$_POST['keyword_acc']."%'
            AND xray_type_code IN('".$checkboxmodality."')
            ORDER BY approve_date DESC, approve_time DESC";
  $sql = mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <div id="purchase_order" class="col-md-12" style="overflow-x:auto;">
  <table class="table-dicom table-paginate" style="margin-top: 3px;" border="1" cellpadding="8" cellspacing="0">
            <thead class="thead1">
              <tr>
                <th>NO</th>
                <th>MRN</th>
                <th>Radiology Physician</th>
                <th>Name</th>
                <th>Age</th>
                <th>Sex</th>
                <th>Modality</th>
                <th>Procedure</th>
                <th>Refferal Physician</th>
                <th>Department</th>
                <th>Status</th>
                <th>Approved Date</th>
                <th>Report</th>
              </tr>
            </thead>
            
        <?php 
        $i = 1;
        while($row2 = mysqli_fetch_array($sql)) { ?>
          <tr>  
          <?php 
          $birth_date = $row2['birth_date'];
          $bday = new DateTime($birth_date);
          $today = new DateTime(date('y-m-d'));
          $diff = $today->diff($bday);
          $name = $row2['name'];
          $name1 = preg_replace('/[^A-Za-z\ ]/', '', $name); 
          $uid = $row2['uid'];
          $priority = $row2['priority'];
          $text = preg_replace('/[^A-Za-z\ ]/', '', $priority);
          $approve_date = $row2['approve_date'];
          $ap_date = date("d F Y", strtotime($approve_date));
    ?>
          <td><?php echo $i; ?></td>
          <td><?php echo $row2["mrn"]; ?></td>  
          <td><?php echo $row2["dokrad_name"] .' '. $row2["dokrad_lastname"]; ?></td>  
          <td><?php echo $name1 .' '. $row2["lastname"]; ?></td>  
          <td><?php echo $diff->y.'Y'. ' ' . $diff->m .'M'. ' ' . $diff->d .'D'; ?></td>
          <td><?php echo $row2['sex']; ?></td>
          <td><?php echo $row2["xray_type_code"]; ?></td>  
          <td><?php echo $row2["prosedur"]; ?></td>  
          <td><?php echo $row2["named"] .' '. $row2["lastnamed"]; ?></td>
          <td><?php echo $row2['name_dep']; ?></td>
          <td><?php echo $text; ?></td>
          <td><?php echo $ap_date; ?></td>
          <td>
            <a class="" href="update_workload.php?uid=<?php echo $uid; ?>">
              <img style="width: 20px;" src="../image/update.png">
            </a>

            <a class="" href="workload-edit.php?uid=<?php echo $uid; ?>">
              <img style="width: 20px;" src="../image/edit.png">
            </a>

            <a style="text-decoration:none;" class="" href="pdf/testpdf4.php?uid=<?php echo $uid; ?>" target="_blank">
              <img src="../image/pdf.png" style="width: 25px;">
            </a>

            <a style="text-decoration: none;" class="" href="../radiology/phpmailer/examples/gmail.php?uid=<?php echo $uid; ?>" target="_blank">
              <img src="../image/email.png" style="width: 23px;">
            </a>
            
            <?php include '../viewer-ohif.php'; ?>
              <?php include '../viewer-dicom.php'; ?>
          </td>
        </tr>
        <?php $i++; ?>
    <?php } ?>
  </table>
</div>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
          <script type="text/javascript" src="js/dataTables.bootstrap.js"></script>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
 $('.table-paginate').dataTable();
 } );
</script>

 <script>
 $(document).ready(function(){
  $(".dataTables_filter").hide();
  });
 </script>

</body>
</html>