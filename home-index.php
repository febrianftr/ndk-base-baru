<?php
$query = '';
$querywaitingapprove = '';
$queryapproved = '';
$querymodality = '';

$query .= "SELECT * FROM xray_workload_radiographer WHERE complete_date = CURRENT_DATE() ";

$querymodality .= "AND xray_type_code IN('CR','CT','CTSR', 'DX', 'US', '') ";

$querywaitingapprove .= "AND status = 'ready to approve' ";

$queryapproved .= "AND status = 'APPROVED' ";

// total study hari ini

$resultwaitingtotal = mysqli_query($conn, $query . $querymodality);

$waitingtotal = mysqli_num_rows($resultwaitingtotal);

$waitingtotal1 = "";
if ($waitingtotal > 0) {
  $waitingtotal1  = $waitingtotal;
} else {
  $waitingtotal1 = $waitingtotal = "-";
}

// waiting approve hari ini 

$resultwaitingapprove = mysqli_query($conn, $query . $querymodality . $querywaitingapprove);

$waitingapprove = mysqli_num_rows($resultwaitingapprove);

$waitingapprove1 = "";
if ($waitingapprove > 0) {
  $waitingapprove1  = $waitingapprove;
} else {
  $waitingapprove1 = $waitingapprove = "-";
}

// approve hari ini

$resultqueryapproved = mysqli_query($conn, $query . $querymodality . $queryapproved);

$approved = mysqli_num_rows($resultqueryapproved);

$approved1 = "";
if ($approved > 0) {
  $approved1  = $approved;
} else {
  $approved1 = $approved = "-";
}

function hex2rgba($color, $opacity = false)
{

  $default = 'rgb( 0, 0, 0 )';

  /**
   * Return default if no color provided
   */
  if (empty($color)) {

    return $default;
  }

  /**
   * Sanitize $color if "#" is provided
   */
  if ($color[0] == '#') {

    $color = substr($color, 1);
  }

  /**
   * Check if color has 6 or 3 characters and get values
   */
  if (strlen($color) == 6) {

    $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
  } elseif (strlen($color) == 3) {

    $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
  } else {

    return $default;
  }

  /**
   * [$rgb description]
   * @var array
   */
  $rgb =  array_map('hexdec', $hex);

  /**
   * Check if opacity is set(rgba or rgb)
   */
  if ($opacity) {

    if (abs($opacity) > 1)

      $opacity = 1.0;

    $output = 'rgba( ' . implode(",", $rgb) . ',' . $opacity . ' )';
  } else {

    $output = 'rgb( ' . implode(",", $rgb) . ' )';
  }

  /**
   * Return rgb(a) color string
   */
  return $output;
}
?>

<style type="text/css">
  .chart_index {
    background-color: #f7f7f7;
    padding: 10px;
    opacity: 0.9;
    border-radius: 0 0 5px 5px;
  }

  .footerindex {
    position: fixed;
  }
</style>
<meta http-equiv="refresh" content="600" />
<br>



<div class=" container-fluid ovrflow scroller-itwd">
  <!-- <a href="../chat/index.php">CHAT</a> -->
  <div class="ovrflow">



    <table class="table-dicom" id="example" style="margin-top: 3px; width: 2397px;" cellpadding="8" cellspacing="0">
      <thead class="thead1">
        <tr>
          <th>NO</th>
          <th>Action</th>
          <th>Status</th>
          <th>No Foto</th>
          <th>MRN</th>
          <th><?= $lang['name'] ?></th>
          <th><?= $lang['age'] ?></th>
          <th><?= $lang['sex'] ?></th>
          <th>Main Prosedur</th>
          <th><?= $lang['procedure'] ?></th>
          <th>#S / #I</th>
          <th><?= $lang['modality'] ?></th>
          <th><?= $lang['referral_physician'] ?></th>
          <th><?= $lang['departmen'] ?></th>
          <th><?= $lang['radiology_physician'] ?></th>
          <th>Radiographer CR</th>
          <th>Radiographer 2</th>
          <th>PDC</th>
          <th><?= $lang['approve_date'] ?></th>
          <th><?= $lang['spend_time'] ?></th>
        </tr>
      </thead>
    </table>
    <!-- The Modal -->
    <div class="modal" id="myModal1">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <!-- <h1 class="modal-title">Modal Heading</h1> -->
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <h3>Specification</h3>
            <p><?php echo $row1['uid']; ?></p>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
    <!-- End The Modal -->

  </div>
</div>

<div class="container-fluid"><br>
  <center>
    <h2><?= $lang['daily_report'] ?></h2>
  </center><br>
  <div class="row">
    <div style="height: auto; padding: 0;" class="col-md-6">
      <div class="">
        <!-- <hr class="hr-home"> -->
        <div class="chart-box2" style="padding: 0px;">
          <div class="label-chart"><?= $lang['today_chart'] ?></div>
          <div class="chart_index" style="overflow-x:auto;">

            <center>
              <h2><?= $lang['patient_data_rad'] ?><br /><?php echo $date = date('d-F-Y'); ?></h2>
            </center>
            <div style="width: 600px;margin: 0px auto;">
              <canvas id="myChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div style="padding: 0;" class="col-md-6">
      <div class="">
        <div class="chart-box2" style="padding: 0px;">
          <div class="label-chart"><?= $lang['today_exam_studies'] ?></div>
          <div class="home-box3 chart_index">
            <!-- <h1>The best specialists of the Radiology expect you</h1> -->

            <table class="table-home">
              <tr>
                <td><?= $lang['studies'] ?></td>
                <td>&nbsp;:&nbsp; </td>
                <td><?php echo $waitingtotal1; ?></td>
              </tr>
              <tr>
                <td><?= $lang['waiting_report'] ?></td>
                <td>&nbsp;:&nbsp;</td>
                <td><?php echo $waitingapprove1; ?></td>
              </tr>
              <tr>
                <td><?= $lang['approved_report'] ?></td>
                <td>&nbsp;:&nbsp;</td>
                <td><?php echo $approved1; ?></td>
              </tr>
              <!-- <tr>
                <td>Cancel</td>
                <td>&nbsp;:&nbsp;</td>
                <td>2</td>
              </tr> -->
            </table>

            <div class="home-logos">
              <img class="img3" src="../image/intiwid-logo.svg">

            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>




<div style="margin-bottom: 100px; width: 100%;">

</div>
<script type="text/javascript" src="js/Chart.js"></script>
<script src="js/3.1.1/jquery.min.js"></script>
<script>
  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: [
        <?php $sql = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer GROUP BY src_aet");
        while ($row = mysqli_fetch_assoc($sql)) {
          $ae_title = $row['src_aet'];
          $modalityy = $row['xray_type_code'];
          $sql2 = mysqli_query($conn_pacs, "SELECT * FROM ae WHERE aet = '$ae_title'");
          $row2 = mysqli_fetch_assoc($sql2);
          $pat_id_issuer = $row2['pat_id_issuer'];
          echo '"' . $modalityy . ' ' . $pat_id_issuer . '"' . ',';
        }
        ?>
      ],
      datasets: [{
        label: '',
        data: [
          <?php
          $sql3 = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer GROUP BY src_aet");
          while ($row3 = mysqli_fetch_assoc($sql3)) {
            $src_aet = $row3['src_aet'];
            $jml_CR = mysqli_query($conn, "select * from xray_workload_radiographer where src_aet = '$src_aet' AND complete_date = CURRENT_DATE()");
            echo mysqli_num_rows($jml_CR);
          ?>, <?php } ?>
        ],
        backgroundColor: [
          <?php
          $sql4 = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer GROUP BY src_aet");
          while ($row4 = mysqli_fetch_assoc($sql4)) {
            $src_aet2 = $row4['src_aet'];
            $sql5 = mysqli_query($conn_pacs, "select * from ae where aet = '$src_aet2'");
            $row5 = mysqli_fetch_assoc($sql5);
            $color = $row5['color'];
            $rgbrafli = hex2rgba($color, 0.4);
            $rgb2 = "'";
            $rgb3 = ",";
            $rgb313 = $rgb2 . $rgbrafli . $rgb2 . $rgb3;
            echo $rgb313;
          }
          ?>
        ],
        borderColor: [
          <?php
          $sql4 = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer GROUP BY src_aet");
          while ($row4 = mysqli_fetch_assoc($sql4)) {
            $src_aet2 = $row4['src_aet'];
            $sql5 = mysqli_query($conn_pacs, "select * from ae where aet = '$src_aet2'");
            $row5 = mysqli_fetch_assoc($sql5);
            $color = $row5['color'];
            $rgbrafli = hex2rgba($color, 1);
            $rgb2 = "'";
            $rgb3 = ",";
            $rgb313 = $rgb2 . $rgbrafli . $rgb2 . $rgb3;
            echo $rgb313;
          }
          ?>
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
<script>
  $('document').ready(function() {
    var table = $('#example').dataTable({
      "ajax": {
        "url": "../getAll.php",
        "dataSrc": ""
      },
      "columns": [{
          "data": "no"
        },
        {
          "data": "report"
        },
        {
          "data": "status"
        },
        {
          "data": "no_foto"
        },
        {
          "data": "mrn"
        },
        {
          "data": "name"
        },
        {
          "data": "birth_date"
        },
        {
          "data": "sex"
        },
        {
          "data": "prosedur"
        },
        {
          "data": "series_desc"
        },
        {
          "data": "num_series"
        },
        {
          "data": "xray_type_code"
        },
        {
          "data": "named"
        },
        {
          "data": "name_dep"
        },
        {
          "data": "dokrad_name"
        },
        {
          "data": "radiographer_name"
        },
        {
          "data": "operator"
        },
        {
          "data": "updated_time"
        },
        {
          "data": "approve_date"
        },
        {
          "data": "spendtime"
        }
      ]
    });
  });
</script>