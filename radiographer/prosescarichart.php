<?php 

require '../koneksi/koneksi.php';

session_start();

if(isset($_POST["From"], $_POST["to"], $_POST['keyword'], $_POST['checkbox'],$_POST['keyword_mrn'],
         $_POST['keyword_acc'])){

  $username = $_SESSION['username'];
  $checkboxfilter = implode("','", $_POST["checkbox"]);

  $query1 = "SELECT * 
        FROM xray_radiographer WHERE username = '$username'";

  $data_dicom = mysqli_query($conn,$query1);
  $row = mysqli_fetch_assoc($data_dicom);
  $username2 = $row['username'];
  $username3 = $row['radiographer_id'];
  $query = "SELECT * 
            FROM xray_workload_radiographer 
            WHERE complete_date BETWEEN '".$_POST["From"]."' AND '".$_POST["to"]."'
            AND CONCAT (name,' ',lastname) LIKE '%".$_POST['keyword']."%'
            AND mrn LIKE '%".$_POST['keyword_mrn']."%'
            AND acc LIKE '%".$_POST['keyword_acc']."%'
            AND xray_type_code IN('".$checkboxfilter."') 
            ORDER BY complete_date DESC, complete_time DESC";
  $sql = mysqli_query($conn, $query);
  $xray_type_code = array();
  while ($row1 = mysqli_fetch_assoc($sql1)) {
    $xray_type_code[] = $row1['xray_type_code']; 
  }
}
?>

          <!DOCTYPE html>
          <html>
          <head>
            <title></title>
          </head>
          <body>
             <div class="container">
              <div id="chartPasien"></div>
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
        categories: <?= json_encode($xray_type_code); ?>,
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
        data: [ <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload 
                                                WHERE xray_type_code = 'USG'
                                                AND complete_date BETWEEN '2019-01-01' AND '2019-01-31' ");
                             echo mysqli_num_rows($usg); ?>
                //              ,
                // <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload 
                //                                 WHERE xray_type_code = 'USG'
                //                                 AND complete_date BETWEEN '2019-02-01' AND '2019-02-31' ");
                //              echo mysqli_num_rows($usg); ?>,
                // <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload 
                //                                 WHERE xray_type_code = 'USG'
                //                                 AND complete_date BETWEEN '2019-03-01' AND '2019-03-31' ");
                //              echo mysqli_num_rows($usg); ?>,
                // <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload 
                //                                 WHERE xray_type_code = 'USG'
                //                                 AND complete_date BETWEEN '2019-04-01' AND '2019-04-31' ");
                //              echo mysqli_num_rows($usg); ?>,
                // <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload 
                //                                 WHERE xray_type_code = 'USG'
                //                                 AND complete_date BETWEEN '2019-05-01' AND '2019-05-31' ");
                //              echo mysqli_num_rows($usg); ?>,
                // <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload 
                //                                 WHERE xray_type_code = 'USG'
                //                                 AND complete_date BETWEEN '2019-06-01' AND '2019-06-31' ");
                //              echo mysqli_num_rows($usg); ?>,
                // <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload 
                //                                 WHERE xray_type_code = 'USG'
                //                                 AND complete_date BETWEEN '2019-07-01' AND '2019-07-31' ");
                //              echo mysqli_num_rows($usg); ?>,
                // <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload 
                //                                 WHERE xray_type_code = 'USG'
                //                                 AND complete_date BETWEEN '2019-08-01' AND '2019-08-31' ");
                //              echo mysqli_num_rows($usg); ?>,
                // <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload 
                //                                 WHERE xray_type_code = 'USG'
                //                                 AND complete_date BETWEEN '2019-09-01' AND '2019-09-31' ");
                //              echo mysqli_num_rows($usg); ?>,
                // <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload 
                //                                 WHERE xray_type_code = 'USG'
                //                                 AND complete_date BETWEEN '2019-10-01' AND '2019-10-31' ");
                //              echo mysqli_num_rows($usg); ?>,
                // <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload 
                //                                 WHERE xray_type_code = 'USG'
                //                                 AND complete_date BETWEEN '2019-11-01' AND '2019-11-31' ");
                //              echo mysqli_num_rows($usg); ?>,
                // <?php $usg = mysqli_query($conn,"SELECT * FROM xray_workload 
                //                                 WHERE xray_type_code = 'USG'
                //                                 AND complete_date BETWEEN '2019-12-01' AND '2019-12-31' ");
                //              echo mysqli_num_rows($usg); ?>

              ]
    },{
        name: 'DX',
        data: [<?php $DX = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer WHERE xray_type_code = 'DX' ");
                    echo mysqli_num_rows($DX); ?>]
    },{
        name: 'CR',
        data: [<?php $CR = mysqli_query($conn,"SELECT * FROM xray_workload_radiographer WHERE xray_type_code = 'CR' ");
                    echo mysqli_num_rows($CR); ?>]
    }]
});
    </script>
          </body>
          </html>