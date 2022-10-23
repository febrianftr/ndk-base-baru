<?php
require '../koneksi/koneksi.php';
$CR = 'CR';
$result = mysqli_query($conn, "SELECT berita FROM xray_berita ORDER BY id DESC");
$workload = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer");
$data = mysqli_query($conn, "select * from xray_workload_radiographer WHERE xray_type_code='$CR' AND complete_date = CURRENT_DATE()");
$CR1 = mysqli_num_rows($data);
$C1 = mysqli_fetch_assoc($data);
$updated_time = $C1['updated_time'];
$A1 = date("d/F/Y", strtotime($updated_time));
?>

<style type="text/css">
  .chart_index {
    background-color: #fff;
    padding: 10px;
    opacity: 0.9;
  }
</style>
<div style="height: auto;" class="hero-image container-fluid">

  <div class="col-md-5 col-md-offset-1">
    <div class="logo3">
      <img class="img-responsive" src="../image/intiwid-logo.png">
    </div>
    <hr style="margin: 0px;" class="hrindex">
    <div class="logo4">
      <img class="img-responsive" src="../image/logo-rispacs1.png">
    </div>
  </div>


  <div class="col-md-5">
    <div class="chart_index" style="overflow-x:auto;">
      <center>
        <h2><?= $lang['patient_data_rad'] ?><br /><?php echo $date = date('d-F-Y'); ?></h2>
      </center>
      <div style="width: 700px;margin: 0px auto;">
        <canvas id="myChart"></canvas>
      </div>


    </div>

  </div>
</div>
<br>



<div style="overflow-x:auto;" class="dashboard-home container-fluid">
  <h2>
    <center>Dashboard</center>
  </h2>
  <hr class="hr-home">
  <table class="table-dicom" id="example" style="margin-top: 3px;" border="1" cellpadding="8" cellspacing="0">
    <thead class="thead1">
      <tr>
        <th>PK</th>
        <th>MRN</th>
        <th><?= $lang['name'] ?></th>
        <th><?= $lang['age'] ?></th>
        <th><?= $lang['sex'] ?></th>
        <th><?= $lang['procedure'] ?></th>
        <th><?= $lang['modality'] ?></th>
        <th><?= $lang['referral_physician'] ?></th>
        <th><?= $lang['departmen'] ?></th>
        <th><?= $lang['radiology_physician'] ?></th>
        <th><?= $lang['name_radiographer'] ?></th>
        <th>PDC</th>
        <th><?= $lang['approve_date'] ?></th>
        <th><?= $lang['spend_time'] ?></th>
        <th>Status</th>
        <th>Report</th>
      </tr>
    </thead>
    <?php while ($row1 = mysqli_fetch_assoc($workload)) :
      $birth_date = $row1['birth_date'];
      $bday = new DateTime($birth_date);
      $today = new DateTime(date('y-m-d'));
      $diff = $today->diff($bday);
      $name = $row1['name'];
      $name1 = preg_replace('/[^A-Za-z\ ]/', ' ', $name);
      $named = $row1['named'];
      $lastnamed = $row1['lastnamed'];
      $named1 = preg_replace('/[^A-Za-z\ ]/', '', $named);
      $lastnamed1 = preg_replace('/[^A-Za-z\ ]/', '', $lastnamed);
      $updated_time = $row1["updated_time"];
      $approve = $row1["approve_date"] . ' ' . $row1["approve_time"];
      $uid = $row1['uid'];
      $priority = $row1['priority'];
      $text = preg_replace('/[^A-Za-z\ ]/', '', $priority);

      $awal  = strtotime($updated_time); //waktu awal
      $akhir = strtotime($approve); //waktu akhir
      $diff1  = $akhir - $awal;
      $jam   = floor($diff1 / (60 * 60));
      $menit = $diff1 - $jam * (60 * 60);
    ?>
      <tr>
        <td><?php echo $row1['pk']; ?></td>
        <td><?php echo $row1['mrn']; ?></td>
        <td><?php echo $name1 . ' ' . $row1['lastname']; ?></td>
        <td><?php echo $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D'; ?></td>
        <td>
          <?php if ($row1['sex'] == 'M') { ?>

            <i style="color: blue;" class="fas fa-mars"></i> M
          <?php } else if ($row1['sex'] == 'F') { ?>

            <i style="color: #ff637e;" class="fas fa-venus"></i> F
          <?php } else if ($row1['sex'] == 'O') { ?>

            <i class="far fa-genderless"></i> O
          <?php } ?>
        </td>
        <td><?php echo $row1['prosedur']; ?></td>
        <td><?php echo $row1['xray_type_code']; ?></td>
        <td><?php echo $named1 . ' ' . $lastnamed1; ?></td>
        <td><?php echo $row1['name_dep']; ?></td>
        <td><?php echo $row1['dokrad_name'] . ' ' . $row1['dokrad_lastname']; ?></td>
        <td><?php echo $row1['radiographer_name'] . ' ' . $row1['radiographer_lastname']; ?></td>
        <td><?php echo $row1['updated_time']; ?></td>
        <td><?php echo $row1['approve_date'] . ' ' . $row1['approve_time']; ?></td>
        <td><?php
            if (!empty($approve == 0) or !empty($updated_time == 0)) {
              echo '';
            } else {
              echo $jam .  ' jam, ' . floor($menit / 60) . ' menit';
            }
            ?></td>
        <td>
          <?php if ($row1['status'] == 'ready to approve') { ?>

            <i style="color: #3DA83D;" class="fas fa-sync"> Ready to Approve</i>

          <?php } else if ($row1['status'] == 'APPROVED') { ?>

            <i style="color: #329ECF" class="fas fa-check-square"> Approved</i>
          <?php } ?>
        </td>
        <td>
          <a style="text-decoration:none;" class="" href="../radiology/pdf/expertise.php?uid=<?= $row1['uid']; ?>" target="_blank">
            <img data-toggle="tooltip" title="PDF" src="../image/pdf.png" style="width: 25px;">
          </a>

          <!-- <a style="font-size: 10px;" class="" type="button" data-toggle="modal" data-target="#myModal"> -->
          <!-- <img data-toggle="tooltip" title="XML Upgrade to Enterprise" src="../image/xml.png" style="width: 25px;"> -->
          <!-- </a> -->
          <?php include '../viewer-ohif.php'; ?>
        </td>
      </tr>
    <?php endwhile; ?>

  </table>
  <hr class="hr-home">
</div>
<div style="margin-bottom: 100px; width: 100%;">

</div>

<div style="position: fixed; z-index: 99;" class="footerindex">

  <div class="">
    <div class="footer-login col-sm-12"><br>
      <center>
        <p>&copy; Powered by Intiwid IT Solution 2019</a>.</p>
      </center>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/Chart.js"></script>
<script>
  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ["CR", "CT", "PX", "USG"],
      datasets: [{
        label: '',
        data: [
          <?php
          $jml_CR = mysqli_query($conn, "select * from xray_workload_radiographer where xray_type_code='CR' AND complete_date = CURRENT_DATE()");
          echo mysqli_num_rows($jml_CR);
          ?>,
          <?php
          $jml_CT = mysqli_query($conn, "select * from xray_workload_radiographer where xray_type_code='CT' AND complete_date = CURRENT_DATE()");
          echo mysqli_num_rows($jml_CT);
          ?>,
          <?php
          $jml_PX = mysqli_query($conn, "select * from xray_workload_radiographer where xray_type_code='PX' AND complete_date = CURRENT_DATE()");
          echo mysqli_num_rows($jml_PX);
          ?>,
          <?php
          $jml_USG = mysqli_query($conn, "select * from xray_workload_radiographer where xray_type_code='USG' AND complete_date = CURRENT_DATE()");
          echo mysqli_num_rows($jml_USG);
          ?>
        ],
        backgroundColor: [
          'rgba(214, 148, 41, 0.4)',
          'rgba(54, 162, 235, 0.4)',
          'rgba(26, 184, 15, 0.4)',
          'rgba(18, 181, 178, 0.4)'
        ],
        borderColor: [
          'rgba(138, 85, 0, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(9, 138, 0, 1))',
          'rgba(16, 162, 160, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true
          }
        }]
      }
    }
  });
</script>