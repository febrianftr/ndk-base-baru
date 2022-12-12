<?php
require 'model/query-base-workload.php';
require 'model/query-base-study.php';

$query = "SELECT COUNT(*) AS total
FROM $table_study
JOIN $table_workload
ON study.study_iuid = xray_workload.uid ";

// total studies
$total = mysqli_fetch_assoc(mysqli_query(
  $conn_pacsio,
  $query . 'WHERE DATE(study_datetime) = CURRENT_DATE()'
));

// total waiting
$waiting = mysqli_fetch_assoc(mysqli_query(
  $conn_pacsio,
  $query . 'WHERE DATE(study_datetime) = CURRENT_DATE() AND status = "waiting"'
));

// total approved
$approved = mysqli_fetch_assoc(mysqli_query(
  $conn_pacsio,
  $query . ' WHERE DATE(approved_at) = CURRENT_DATE() AND status = "approved"'
));

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

  <div class="ovrflow">
    <table class="table-dicom" id="example" style="margin-top: 3px; width: 100px;" cellpadding="8" cellspacing="0">
      <thead class="thead1">
        <?php require 'thead.php'; ?>
      </thead>
    </table>
    <?php require 'modal.php'; ?>
  </div>
</div>

<style>
  .box-dashboard1 {
    background: #ececec;
    padding: 13px;
    border-radius: 10px;
    margin-bottom: 100px;
  }

  .info-box {
    background: #fff;
    height: 160px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0 3em;
    border: 1px solid #ede8f0;
    border-radius: 5px;
    margin: 5px 0;
  }

  .info-box .box-icon i {
    display: block;
    width: 48px;
    height: 48px;
    font-size: 50px;
    color: #fff;
  }

  .info-box .box-content {
    padding-left: 3em;
    white-space: nowrap;
    color: #d5d5d5;
    font-size: 15px;
  }

  .info-box .box-content .big {
    display: block;
    font-size: 2em;
    line-height: 150%;
    color: #fff;
    font-weight: bold;
  }

  .info-box .box-icon i,
  .content-wrap .info-boxes .info-box .box-icon i {
    fill: #99a0b0;
  }
</style>
<div class="container-fluid">
  <br><br>
  <div class="box-dashboard1">
    <div class="row">
      <div class="col-md-12">
        <center>
          <h2>
            Daily Report
          </h2>
        </center>
      </div>
      <div class="col-md-4">
        <div class="info-box" style="background-color: #356395;">
          <div class="box-icon">
            <i class="fas fa-users"></i>
          </div>
          <div class="box-content">
            <span class="big">
              <?= $total['total'] ?>
            </span>
            Today studies
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="info-box" style="background-color: #10a085;">
          <div class="box-icon">
            <i class="fas fa-user-check"></i>
          </div>

          <div class="box-content">
            <span class="big">
              <?= $approved['total']; ?>
            </span>
            Approved Reports
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="info-box" style="background-color: #ce6c25;">
          <div class="box-icon">
            <i class="fas fa-user-clock"></i>
          </div>

          <div class="box-content">
            <span class="big">
              <?= $waiting['total']; ?>
            </span>
            Waiting Reports
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="js/3.1.1/jquery.min.js"></script>
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
          "data": "pat_name"
        },
        {
          "data": "mrn"
        },
        {
          "data": "no_foto"
        },
        {
          "data": "pat_birthdate"
        },
        {
          "data": "pat_sex"
        },
        {
          "data": "study_desc"
        },
        {
          "data": "series_desc"
        },
        {
          "data": "mods_in_study"
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
          "data": "study_datetime"
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