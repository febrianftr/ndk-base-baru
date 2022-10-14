<?php
session_start();
include('head.php');
$username = $_SESSION['username']; ?>

<title>Template | Radiology</title>
<style type="text/css">
  .template-doc {
    height: 100%;
    width: 100%;
    padding: 5px;
  }

  .font-template1 {
    cursor: pointer;
  }

  #testDiv {
    width: 100%;
    height: 100%;
    overflow-x: scroll;
    border: 1px solid black;
    white-space: nowrap;
    font-size: 10;

  }

  .template-doc:hover {
    background-color: #ececec;
  }

  .template-doc-div {
    /*width: 120px;*/
    height: 40px;
    display: inline-block;
    padding: 5px;
    font-size: 15px;
  }
</style>

<div class="container-fluid" style="height: 120%;">
  <div id="testDiv">

    <?php
    $uid = $_GET['uid'];
    require '../koneksi/koneksi.php';
    $query = mysqli_query($conn, "SELECT * FROM xray_template where username = '$username' ORDER BY title ASC");
    $i = 1;
    while ($row = mysqli_fetch_assoc($query)) {
      $name = $row['title'];
      $template_id = $row['template_id'];
      if (($i - 1) % 21 == 0) {
        echo "<div class='template-doc-div'>";
      }

      $result = "<a href='worklist.php?uid=$uid&template_id=$template_id'><div class='template-doc'>" . $i . "." . "&nbsp" . "<i class='fas fa-file'></i> <label class='font-template1'>" . $name . "</label></a><a href='#' class='edit-recordworklist' data-id='$template_id'>
  <i class='fas fa-eye' title='Show Template'></i>
  </a></div>
  ";
      echo $result;
      if ($i % 21 == 0) {
        echo "</div>";
      }
      $i++;
    }

    ?>

  </div>
</div>



<?php
@$template_id = $_GET['template_id'];
$query3 = "SELECT *
										FROM xray_exam2
										WHERE uid = '$uid'
												";
$result3 = mysqli_query($conn, $query3);
$row3 = mysqli_fetch_assoc($result3);
$query = "SELECT *
												FROM xray_template
												WHERE template_id = '$template_id'
												";
$result = mysqli_query($conn, $query);
$row10 = mysqli_fetch_assoc($result);
if ($template_id == "") {
  $fill = $row3['fill'];
} else {
  $fill = $row10['fill'];
}
?>

<!-- Modal -->
<div class="modal fade" id="myModal5" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Report</h4>
      </div>
      <div class="modal-body">
        <textarea style="width: 100%; height: 320px;"><?= $row10['template_id'];  ?></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->


<!-- ------loader------ -->
<div class="disokin">
  <div class="spinner">
    <div><img src="../image/intiwid-logo-new-putih-2.png" style="width: 200px;margin-left: -75px; margin-bottom: 9px;"></div>
    <div class="back-loader">
      <span class="ball-1"></span>
      <span class="ball-2"></span>
      <span class="ball-3"></span>
      <span class="ball-4"></span>
      <span class="ball-5"></span>
      <span class="ball-6"></span>
      <span class="ball-7"></span>
      <span class="ball-8"></span>
    </div>
  </div>
</div>
<!-- ------loader------ -->






<?php include('script-footer.php'); ?>

<script>
  $(document).ready(function() {
    $('#testDiv').mousewheel(function(e, delta) {
      this.scrollLeft -= (delta * 80);
      e.preventDefault();
    });

  });
</script>

<script>
  // untuk menampilkan data popup
  $(function() {
    $(document).on('click', '.edit-recordworklist', function(e) {
      e.preventDefault();
      $("#myModal5").modal('show');
      $.post('hasil.php', {
          template_id: $(this).attr('data-id')
        },
        function(html) {
          $(".modal-body").html(html);
        }
      );
    });
  });
  // end untuk menampilkan data popup
</script>