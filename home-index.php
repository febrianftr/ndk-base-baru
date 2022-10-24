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

  .info-box .box-icon svg {
    display: block;
    width: 48px;
    height: 48px;
  }

  .info-box .box-content {
    padding-left: 1.25em;
    white-space: nowrap;
  }

  .info-box .box-content .big {
    display: block;
    font-size: 2em;
    line-height: 150%;
    color: #1b253d;
  }

  .info-box .box-icon svg path,
  .content-wrap .info-boxes .info-box .box-icon svg circle {
    fill: #99a0b0;
  }
</style>
<div class="container-fluid">
  <br><br>
  <div class="row">
    <div class="col-md-12">
      <h2>
        Daily Report
      </h2>
    </div>
    <div class="col-md-4">
      <div class="info-box">
        <div class="box-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M21 20V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v16a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1zm-2-1H5V5h14v14z"></path>
            <path d="M10.381 12.309l3.172 1.586a1 1 0 0 0 1.305-.38l3-5-1.715-1.029-2.523 4.206-3.172-1.586a1.002 1.002 0 0 0-1.305.38l-3 5 1.715 1.029 2.523-4.206z"></path>
          </svg>
        </div>
        <div class="box-content">
          <span class="big">44.51</span>
          Current price ($)
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="info-box">
        <div class="box-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M20 10H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V11a1 1 0 0 0-1-1zm-1 10H5v-8h14v8zM5 6h14v2H5zM7 2h10v2H7z"></path>
          </svg>
        </div>

        <div class="box-content">
          <span class="big">132</span>
          Related articles
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="info-box">
        <div class="box-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M12 3C6.486 3 2 6.364 2 10.5c0 2.742 1.982 5.354 5 6.678V21a.999.999 0 0 0 1.707.707l3.714-3.714C17.74 17.827 22 14.529 22 10.5 22 6.364 17.514 3 12 3zm0 13a.996.996 0 0 0-.707.293L9 18.586V16.5a1 1 0 0 0-.663-.941C5.743 14.629 4 12.596 4 10.5 4 7.468 7.589 5 12 5s8 2.468 8 5.5-3.589 5.5-8 5.5z"></path>
          </svg>
        </div>

        <div class="box-content">
          <span class="big">24</span>
          Conversations
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