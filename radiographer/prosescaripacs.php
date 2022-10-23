<?php

require '../koneksi/koneksi.php';

session_start();

if (isset(
  $_POST["From"],
  $_POST["to"],
  $_POST['keyword'],
  $_POST['checkbox'],
  $_POST['keyword_mrn'],
  $_POST['keyword_acc']
)) {

  $username = $_SESSION['username'];
  $checkboxfilter = implode("','", $_POST["checkbox"]);

  $query1 = "SELECT * 
        FROM xray_radiographer";

  $data_dicom = mysqli_query($conn, $query1);
  $row = mysqli_fetch_assoc($data_dicom);
  $username2 = $row['username'];
  $username3 = $row['radiographer_id'];
  $query = "SELECT * 
            FROM xray_workload_radiographer 
            WHERE radiographer_id IS NULL
            AND complete_date BETWEEN '" . $_POST["From"] . "' AND '" . $_POST["to"] . "'
            AND CONCAT (name,' ',lastname) LIKE '%" . $_POST['keyword'] . "%'
            AND mrn LIKE '%" . $_POST['keyword_mrn'] . "%'
            AND acc LIKE '%" . $_POST['keyword_acc'] . "%'
            AND xray_type_code IN('" . $checkboxfilter . "') 
            ORDER BY complete_date DESC, complete_time DESC";
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
    <table class="table-dicom table-paginate" border="1" cellpadding="8" cellspacing="0">
      <thead class="thead1">
        <tr>
          <th>Accesion No.</th>
          <th>Radiographer</th>
          <th>Radiology Physician</th>
          <th>Name</th>
          <th>Age</th>
          <th>Sex</th>
          <th>Modality</th>
          <th>Procedure</th>
          <th>Refferal Physician</th>
          <th>Department</th>
          <th>Priority</th>
          <th>Complete Date</th>
          <th>Status</th>
          <th>Report</th>
        </tr>
      </thead>
      <?php

      while ($row2 = mysqli_fetch_assoc($sql)) : ?>
        <tr>
          <?php
          $priority = $row2['priority'];
          $text = preg_replace('/[^A-Za-z\ ]/', '', $priority);
          $complete_date = $row2['complete_date'];
          $sd = date("d F Y", strtotime($complete_date));
          $birth_date = $row2['birth_date'];
          $bday = new DateTime($birth_date);
          $today = new DateTime(date('y-m-d'));
          $diff = $today->diff($bday);
          ?>
          <td><?php echo $row2['acc']; ?></td>
          <td><?php echo $row2['radiographer_name'] . ' ' . $row2['radiographer_lastname']; ?></td>
          <td><?php echo $row2['dokrad_name'] . ' ' . $row2['dokrad_lastname']; ?></td>
          <td><?php echo $row2['name'] . ' ' . $row2['lastname']; ?></td>
          <td><?php echo $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D'; ?></td>

          <td>
            <?php if ($row2['sex'] == 'M') { ?>

              <i style="color: blue;" class="fas fa-mars"></i> M
            <?php } else if ($row2['sex'] == 'F') { ?>

              <i style="color: #ff637e;" class="fas fa-venus"></i> F
            <?php } else if ($row2['sex'] == 'O') { ?>

              <i style="color: red;" class="fas fa-genderless"></i> O
            <?php } ?>
          </td>


          <td><?php echo $row2['xray_type_code']; ?></td>
          <td><?php echo $row2['prosedur']; ?></td>
          <td><?php echo $row2['named'] . ' ' . $row2['lastnamed']; ?></td>
          <td><?php echo $row2['name_dep']; ?></td>
          <td style="text-align: left;">
            <?php if ($text == 'Low') { ?>

              <i style="color: #2d2;" class="fas fa-circle"></i> Low
            <?php } else if ($text == 'Medium') { ?>

              <i style="color: yellow;" class="fas fa-circle"></i> Medium
            <?php } else if ($text == 'high') { ?>

              <i style="color: #fb9246;" class="fas fa-circle"></i> High
            <?php } else if ($text == 'Critical') { ?>

              <i style="color: red;" class="fas fa-circle"></i> Critical
            <?php } ?>
          </td>
          <td><?php echo $sd; ?></td>
          <td>
            <?php if ($row2['status'] == 'ready to approve') { ?>

              <i style="color: #3DA83D;" class="fas fa-sync"> Ready to Approve</i>

            <?php } else if ($row2['status'] == 'APPROVED') { ?>

              <i style="color: #329ECF" class="fas fa-check-square"> Approved</i>
            <?php } ?>
          </td>
          <td>
            <a class="" href="" onclick="window.open('update_workload.php?uid=<?= $row2['uid']; ?>')">
              <img data-toggle="tooltip" title="Update" style="width: 20px;" src="../image/update.png">
            </a>
            <a class="" href="" onclick="window.open('../radiology/pdf/expertise.php?uid=<?= $row2['uid']; ?>')">
              <img data-toggle="tooltip" title="PDF" src="../image/pdf.png" style="width: 19px;">
            </a>

            <a style="text-decoration:none;" class="ahref-edit" href="http://192.168.2.125:3000/viewer/<?php echo $row1['uid']; ?>" target='_blank'>
              <img data-toggle="tooltip" title="View" src="../image/view.png" style="width: 18px;">
            </a>
            <a style="text-decoration:none;" class="ahref-edit" href="deleteworkload.php?uid=<?php echo $row1['uid']; ?>" onclick="return confirm('Are you sure delete?');">
              <img data-toggle="tooltip" title="Delete" src="../image/delete.png" style="width: 25px;">
            </a>
          </td>
        </tr>
      <?php endwhile; ?>

    </table>
  </div>
  <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/dataTables.bootstrap.js"></script>

  <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
      $('.table-paginate').dataTable();
    });
  </script>

  <script>
    $(document).ready(function() {
      $(".dataTables_filter").hide();
    });
  </script>
</body>

</html>