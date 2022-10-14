<?php
require '../koneksi/koneksi.php';
session_start();
$data_dicom = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                  ");
$data_modality = mysqli_query($conn,"SELECT * FROM xray_modalitas
                                  ");

// $complete_date = array();

while($row = mysqli_fetch_assoc($data_dicom)){
    $complete_date = $row['complete_date']; 
    echo date('F', strtotime($complete_date));
}

if ($_SESSION['level'] == "radiographer") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>About | Radiographer</title>
    <?php include('head.php'); ?>
  </head>
  <body>
    <?php include('menu-bar.php'); ?><br>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb1 breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">About</li>
      </ol>
    </nav>
    <div id="container1">
      <div id="content1">
        <div class="container-fluid">
          

                            <label class="work-1">Search by Date</label><br>
                            <div class="wrap-search">
                            <span class="date-icon">
                            <input type="text" name="From" id="From" class="form-control" 
                                   placeholder="From Date" value="2019-07-22" />
                            </span>
                            <span class="date-icon">
                            <input type="text" name="to" id="to" class="form-control" 
                                   placeholder="To Date" value="2019-07-22" /><br></span>
                            </div>
                            <div style="padding: 0px;" class="col-sm-4 input-checkbox"><label class="work-1">Search by Modality <div style="float: right;"><input type="checkbox" class="cboxtombol" style="margin-top: 0px;" checked> Check All</div></label>
                            <div class="wrap-search">
                            <!-- <div class="note5"><label>Search by Modality</label></div> -->
                            <?php $sql = mysqli_query($conn, "SELECT * FROM xray_modalitas"); 
                                  while($row = mysqli_fetch_assoc($sql)) : ?> 
                                  <tr>
                                    <td><input class="common_selector cbox search-input-workload" type="checkbox" id="checkbox" 
                                                name="modality[]" 
                                        value="<?= $row['xray_type_code']; ?>" checked></td>
                                        <td><label><?= $row['xray_type_code']; ?></label></td>
                                  </tr>
                            <?php endwhile; ?>
                            </div>
                         </div>
           
            <button class="btn btn-worklist btn-sm"  type="button" name="range" id="range"><i class="fas fa-search"></i> Search</button> 
            <h2>Chart</h2><br>           
            <div class="container">
              <div id="chartPasien"></div>
            </div>
          
          </div>
        </div>
      </div>
      <div class="footerindex">
        <div class="">
          <div class="footer-login col-sm-12"><br>
            <center><p>&copy; Powered by Intiwid IT Solution 2019</a>.</p></center>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <?php include('script-footer.php'); ?>
    <script type="text/javascript">
      Highcharts.chart('chartPasien', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Pasien Masuk Tahun 2019'
    },
    xAxis: {
        categories: <?= json_encode($complete_date); ?>,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Pasien'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} Pasien</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'USG',
        data: [ <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'USG'
                                                AND complete_date BETWEEN '2019-01-01' AND '2019-01-31' ");
                             echo mysqli_num_rows($usg); ?>
                             ,
                <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'USG'
                                                AND complete_date BETWEEN '2019-02-01' AND '2019-02-31' ");
                             echo mysqli_num_rows($usg); ?>,
                <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'USG'
                                                AND complete_date BETWEEN '2019-03-01' AND '2019-03-31' ");
                             echo mysqli_num_rows($usg); ?>,
                <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'USG'
                                                AND complete_date BETWEEN '2019-04-01' AND '2019-04-31' ");
                             echo mysqli_num_rows($usg); ?>,
                <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'USG'
                                                AND complete_date BETWEEN '2019-05-01' AND '2019-05-31' ");
                             echo mysqli_num_rows($usg); ?>,
                <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'USG'
                                                AND complete_date BETWEEN '2019-06-01' AND '2019-06-31' ");
                             echo mysqli_num_rows($usg); ?>,
                <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'USG'
                                                AND complete_date BETWEEN '2019-07-01' AND '2019-07-31' ");
                             echo mysqli_num_rows($usg); ?>,
                <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'USG'
                                                AND complete_date BETWEEN '2019-08-01' AND '2019-08-31' ");
                             echo mysqli_num_rows($usg); ?>,
                <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'USG'
                                                AND complete_date BETWEEN '2019-09-01' AND '2019-09-31' ");
                             echo mysqli_num_rows($usg); ?>,
                <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'USG'
                                                AND complete_date BETWEEN '2019-10-01' AND '2019-10-31' ");
                             echo mysqli_num_rows($usg); ?>,
                <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'USG'
                                                AND complete_date BETWEEN '2019-11-01' AND '2019-11-31' ");
                             echo mysqli_num_rows($usg); ?>,
                <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'USG'
                                                AND complete_date BETWEEN '2019-12-01' AND '2019-12-31' ");
                             echo mysqli_num_rows($usg); ?>
              
              ]
    },{
        name: 'CT',
        data: [<?php $ct = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CT'
                                                AND complete_date BETWEEN '2019-01-01' AND '2019-01-31' ");
                             echo mysqli_num_rows($ct); ?>
                             ,
                <?php $ct = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CT'
                                                AND complete_date BETWEEN '2019-02-01' AND '2019-02-31' ");
                             echo mysqli_num_rows($ct); ?>,
                <?php $ct = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CT'
                                                AND complete_date BETWEEN '2019-03-01' AND '2019-03-31' ");
                             echo mysqli_num_rows($ct); ?>,
                <?php $ct = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CT'
                                                AND complete_date BETWEEN '2019-04-01' AND '2019-04-31' ");
                             echo mysqli_num_rows($ct); ?>,
                <?php $ct = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CT'
                                                AND complete_date BETWEEN '2019-05-01' AND '2019-05-31' ");
                             echo mysqli_num_rows($ct); ?>,
                <?php $ct = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CT'
                                                AND complete_date BETWEEN '2019-06-01' AND '2019-06-31' ");
                             echo mysqli_num_rows($ct); ?>,
                <?php $ct = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CT'
                                                AND complete_date BETWEEN '2019-07-01' AND '2019-07-31' ");
                             echo mysqli_num_rows($ct); ?>,
                <?php $ct = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CT'
                                                AND complete_date BETWEEN '2019-08-01' AND '2019-08-31' ");
                             echo mysqli_num_rows($ct); ?>,
                <?php $ct = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CT'
                                                AND complete_date BETWEEN '2019-09-01' AND '2019-09-31' ");
                             echo mysqli_num_rows($ct); ?>,
                <?php $ct = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CT'
                                                AND complete_date BETWEEN '2019-10-01' AND '2019-10-31' ");
                             echo mysqli_num_rows($ct); ?>,
                <?php $ct = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CT'
                                                AND complete_date BETWEEN '2019-11-01' AND '2019-11-31' ");
                             echo mysqli_num_rows($ct); ?>,
                <?php $ct = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CT'
                                                AND complete_date BETWEEN '2019-12-01' AND '2019-12-31' ");
                             echo mysqli_num_rows($ct); ?>]
    },{
        name: 'CR',
        data: [<?php $CR = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CR'
                                                AND complete_date BETWEEN '2019-01-01' AND '2019-01-31' ");
                             echo mysqli_num_rows($CR); ?>
                             ,
                <?php $CR = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CR'
                                                AND complete_date BETWEEN '2019-02-01' AND '2019-02-31' ");
                             echo mysqli_num_rows($CR); ?>,
                <?php $CR = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CR'
                                                AND complete_date BETWEEN '2019-03-01' AND '2019-03-31' ");
                             echo mysqli_num_rows($CR); ?>,
                <?php $CR = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CR'
                                                AND complete_date BETWEEN '2019-04-01' AND '2019-04-31' ");
                             echo mysqli_num_rows($CR); ?>,
                <?php $CR = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CR'
                                                AND complete_date BETWEEN '2019-05-01' AND '2019-05-31' ");
                             echo mysqli_num_rows($CR); ?>,
                <?php $CR = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CR'
                                                AND complete_date BETWEEN '2019-06-01' AND '2019-06-31' ");
                             echo mysqli_num_rows($CR); ?>,
                <?php $CR = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CR'
                                                AND complete_date BETWEEN '2019-07-01' AND '2019-07-31' ");
                             echo mysqli_num_rows($CR); ?>,
                <?php $CR = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CR'
                                                AND complete_date BETWEEN '2019-08-01' AND '2019-08-31' ");
                             echo mysqli_num_rows($CR); ?>,
                <?php $CR = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CR'
                                                AND complete_date BETWEEN '2019-09-01' AND '2019-09-31' ");
                             echo mysqli_num_rows($CR); ?>,
                <?php $CR = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CR'
                                                AND complete_date BETWEEN '2019-10-01' AND '2019-10-31' ");
                             echo mysqli_num_rows($CR); ?>,
                <?php $CR = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CR'
                                                AND complete_date BETWEEN '2019-11-01' AND '2019-11-31' ");
                             echo mysqli_num_rows($CR); ?>,
                <?php $CR = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer 
                                                WHERE xray_type_code = 'CR'
                                                AND complete_date BETWEEN '2019-12-01' AND '2019-12-31' ");
                             echo mysqli_num_rows($CR); ?>]
    }]
});
    </script>
    <script>
  $('#From').datetimepicker({
    timepicker : false,
    format : 'Y-m-d'
  });
  $('#to').datetimepicker({
    timepicker : false,
    format : 'Y-m-d'
  });
</script>
<script>
$(document).ready(function(){

    $(document).on('click', '.cboxtombol', function() {
        $('.cbox').prop('checked', this.checked);
    });
    $(document).on('click','#range', function(){
        $('#chartPasien').html("<div class='preloader-css'><span></span><span></span><span></span><span></span><span></span></div>");
        var From = $('#From').val();
        var to = $('#to').val();
        var keyword = $('#keyword').val();
        var keyword_mrn = $('#keyword_mrn').val();
        var keyword_acc = $('#keyword_acc').val();
        var checkbox = get_filter('checkbox');
        if(From != '' && to != '' && checkbox != '')

        {
            $.ajax({
                url:"prosescarichart.php",
                method:"POST",
                data:{From:From, to:to, keyword:keyword, keyword_mrn:keyword_mrn,keyword_acc:keyword_acc, checkbox:checkbox},
                success:function(data)
                {
                    $('#chartPasien').html(data);
                }
            });
        }
        else
        {
            alert("Please Select Modality");
        }
    });
    function get_filter(class_name)
        {
            var filter = [];
            $('#'+class_name+':checked').each(function(){
                filter.push($(this).val());
            });
            return filter;
    }
    $('.common_selector').click(function(){
            purchase_order();
    });
});
</script>  </body>
</html>
<?php } else {header("location:../index.php");} ?>