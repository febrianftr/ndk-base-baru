<?php
require 'function_radiographer.php';
session_start();

$username = $_SESSION['username'];

if (isset($_POST["submit"])) {
  if (inputorder($_POST)) {
    echo "

";
  } else {
    echo "
<script>
  alert('Gagal menambahkan data');
  document.location.href= 'registration-live.php';
</script>";
  }
}
// ------
if (isset($_POST["popup"])) {
  if (inputpopup($_POST)) {
    echo "
<script>
  alert('Berhasil menambahkan data dokter pengirim');
  document.location.href= 'registration-live.php';
</script>
";
  } else {
    echo "
<script>
  alert('Gagal menambahkan data dokter pengirim');
  document.location.href= 'registration-live.php';
</script>";
  }
}

if ($_SESSION['level'] == "radiographer") {
?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <?php include('head.php'); ?>


    <script>
      // Ignore this in your implementation
      window.isMbscDemo = true;
    </script>
    <title>Registration | Radiographer</title>

  </head>

  <body>
    <?php include('sidebar.php'); ?>
    <div class="container-fluid" id="main">
      <div class="row">

        <div id="content1">

          <div class="container-fluid">
            <div class="row">
              <div class="col-12" style="padding-left: 0;">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="registration.php">Registration</a></li>
                    <li class="breadcrumb-item"><a href="inputorder.php">Create Order</a></li>
                    <li class="breadcrumb-item active">Information Order</li>
                  </ol>
                </nav>
              </div>
              <div class="col-md-6 left-information">
                <h1 class="informasi-tambahan2">
                  <center><?= $lang['info_order'] ?></center>
                </h1>
                <hr>
                <form action="" method="POST">

                  <div class="row info-pat">
                    <div class="info-left col-sm-5">
                      <table class="infopatientworklist" border="0">
                        <?php
                        $result1 = mysqli_query($conn, "SELECT * FROM xray_patient_order WHERE username = '$username' ORDER BY patientorderid DESC LIMIT 0,99");
                        $row1 = mysqli_fetch_assoc($result1);
                        $birth_date = $row1['birth_date'];
                        $bday = new DateTime($birth_date);
                        $today = new DateTime(date('y-m-d'));
                        $diff = $today->diff($bday);
                        ?>
                        <tr>
                          <input type="hidden" name="<?= $row1['patientid']; ?>">
                          <td><b><?= $lang['name'] ?></b>
                          <td>&nbsp;&nbsp;:&nbsp;</td>
                          <td><?= $row1['name'] . ' ' . $row1['lastname']; ?></td>
                          </td>
                        </tr>
                        <tr>
                          <td><b>MRN</b>
                          <td>&nbsp;&nbsp;:&nbsp;</td>
                          <td><?= $row1['mrn']; ?></td>
                          </td>
                        </tr>
                      </table>
                    </div>

                    <div class="info-right col-sm-5">
                      <table class="infopatientworklist" border="0">
                        <tr>
                          <td><b><?= $lang['sex'] ?></b>
                          <td>&nbsp;&nbsp;:&nbsp;</td>
                          <td><?= $row1['sex']; ?></td>
                          </td>
                        </tr>
                        <tr>
                          <td><b><?= $lang['age'] ?></b>
                          <td>&nbsp;&nbsp;:&nbsp;</td>
                          <td><?php echo $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D'; ?></td>
                          </td>

                        </tr>
                      </table>
                    </div>
                  </div>
                  <div>


                    <div class="dokteravail">
                      <label for="dokterid"><?= $lang['referral_physician'] ?></label><br>
                      <select class="selectpicker" data-size="10" data-live-search="true" data-width="100%" name="dokterid" id="dokterid" data-style="btn-info">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM xray_dokter");
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                          <option style="font-weight: bold; font-size: 12px;" value="<?= $row['dokterid']; ?>"><b><?= $row['named'] . ' ' . $row['lastnamed']; ?></b></option>
                        <?php } ?>
                        <option value="" id="dokter_lain"><?= $lang['other_physician'] ?></option>
                      </select>
                      <a href="#" data-toggle="collapse" data-target="#demo" value="" class="dok_lain"><?= $lang['other_physician'] ?></a>
                    </div>



                    <div id="demo" class="collapse">
                      <!-- <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo"><?= $lang['hide_input'] ?></button> -->
                      <!-- <hr> -->
                      <label><?= $lang['f_name'] ?></label>

                      <input type="text" name="namedluar" placeholder="<?= $lang['input_f_name'] ?>">
                      <label><?= $lang['l_name'] ?></label>
                      <input type="text" name="lastnamedluar" placeholder="<?= $lang['input_l_name'] ?>">
                      <!-- <label>Email</label>
                            <input type="text" name="emailluar" placeholder="<?= $lang['input_email'] ?>"> --><br>
                      <hr>
                    </div>



                  </div>
                  <label><?= $lang['select_poly'] ?> :</label> <br>
                  <select class="selectpicker" data-size="10" data-live-search="true" data-width="100%" name="depid" data-style="btn-info">
                    <?php
                    $result4 = mysqli_query($conn, "SELECT * FROM xray_department");
                    while ($row4 = mysqli_fetch_array($result4)) { ?>
                      <option value="<?= $row4['depid']; ?>" data-tokens=""><?= $row4['name_dep']; ?></option>
                    <?php } ?>
                  </select><br>

                  <label><?= $lang['select_mod'] ?>:</label> <br>

                  <select class="selectpicker" data-size="10" data-live-search="true" data-width="100%" name="xray_type_code" id="modalitas" data-style="btn-info">
                    <option>----Pilih Modality-----</option>
                    <?php
                    $result5 = mysqli_query($conn, "SELECT * FROM xray_modalitas");
                    while ($row5 = mysqli_fetch_array($result5)) { ?>
                      <option value="<?= $row5["xray_type_code"]; ?>" data-subtext="<?= $row5['typename']; ?>"><?= $row5['xray_type_code']; ?></option>
                    <?php } ?>
                  </select>

                  <div class="select-procedure">
                    <label><?= $lang['select_procedure']; ?></label> <br>
                    <select data-size="10" data-live-search="true" data-width="100%" name="main_prosedur[]" id="prosedur" multiple="multiple" style="height: 242px;">

                    </select>
                  </div>

              </div>

              <div class="col-md-6">
                <div class="regist" style="margin-bottom: 100px;">
                  <div class="input-tambahan">
                    <center>
                      <h1 class="informasi-tambahan"><?= $lang['additional_form'] ?></h1>
                    </center>
                    <hr>
                    <div class="input_adm">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-6"><br>
                            <label for="schedule_date"><b><?= $lang['exam_date'] ?></b></label>
                            <input type="text" name="schedule_date" id="schedule_date" autocomplete="off"></input>
                          </div>
                          <div class="col-md-6"><br>
                            <label for="schedule_time"><b><?= $lang['exam_time'] ?></b></label><br>
                            <input type="text" name="schedule_time" id="schedule_time" autocomplete="off"></input>
                          </div>
                        </div>
                      </div>
                      <div class="container-fluid"><br>
                        <label for="contrast">Contrast</label><br>
                        <label class="radio-admin" style="display: block;">
                          <input type="radio" name="contrast" value="Perlu Kontras" required> <?= $lang['using_contrast'] ?>
                          <span class="checkmark"></span>
                        </label><br>
                        <label class="radio-admin" style="display: block;">
                          <input type="radio" checked="checked" name="contrast" value="Tidak perlu contrast" required> <?= $lang['not_using_contrast'] ?>
                          <span class="checkmark"></span>
                        </label><br><br>
                        <label for="priority"><b><?= $lang['priority'] ?></b></label><br>
                        <select name="priority">
                          <option value="normal">normal</option>
                          <option value="cito">cito</option>
                        </select><br>
                        <br>
                        <label for="pat_state"><b><?= $lang['patient_state'] ?></b></label><br>
                        <select name="pat_state">
                          <option value="Rawat Inap"><?= $lang['inpatient'] ?></option>
                          <option value="Rawat Jalan"><?= $lang['outpatient'] ?></option>
                        </select><br>
                        <br>
                        <label for="contrast_allergies"><b><?= $lang['contrast_allergy'] ?></b></label><br>
                        <select name="contrast_allergies">
                          <option value="Tidak Alergi Contrast"><?= $lang['no'] ?></option>
                          <option value="Alergi Contrast"><?= $lang['yes'] ?></option>
                        </select><br>
                        <!-- <label for="payment"><b>Payment</b></label><br>
                                <label class="radio-admin">
                                  <input type="radio" checked="checked" name="payment" value="BPJS" required> BPJS
                                  <span class="checkmark"></span>
                                </label><br>
                                <label class="radio-admin">
                                  <input type="radio" checked="checked" name="payment" value="umum" required> Umum
                                  <span class="checkmark"></span>
                                </label><br>
                                <label class="radio-admin">
                                  <input type="radio" checked="checked" name="payment" value="" required> Asuransi ...
                                  <span class="checkmark"></span></label>
                                  <input type="text" name="other_payment" placeholder="Masukan jenis asuransi.."> -->
                        <br>
                        <label for="spc_needs"><b><?= $lang['spc_needs'] ?></b></label><br>
                        <textarea rows="4" cols="50" type="text" name="spc_needs" id="spc_needs" style="width: 315; height: 90px;"></textarea><br><br>
                        <button class="btn btn-info btn-lg" type="submit" name="submit" style="border-radius: 5px; box-shadow:none"><b>Order</b></button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>

    <div class="footerindex">
      <div class="">
        <?php include('footer-itw.php'); ?>
      </div>
    </div>

    <?php include('script-footer.php'); ?>
    <script>
      $(document).ready(function() {
        $("li[data-target='#products1']").addClass("active");
        $("ul[id='products1'] li[id='regist1']").addClass("active");
      });
    </script>



    <script src="js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.min.css">
    <script>
      $(document).ready(function() {
        $('#modalitas').change(function() {
          if ($(this).val() != '') {
            var action = $(this).attr("id");
            var query = $(this).val();
            var result = '';
            if (action == "modalitas") {
              result = 'prosedur';
            }
            $.ajax({
              url: "registration-prosedur.php",
              method: "POST",
              data: {
                action: action,
                query: query
              },
              success: function(data) {
                $('#' + result).html(data);
              }
            })
          }
        });
      });
    </script>
    <!-- ------ -->
    <script>
      $(document).ready(function() {
        $('#modalitas').change(function() {
          if ($(this).val() != '') {
            var action1 = $(this).attr("id");
            var query = $(this).val();
            var result = '';
            if (action1 == "modalitas") {
              result = 'prosedur1';
            }
            $.ajax({
              url: "registration-prosedur.php",
              method: "POST",
              data: {
                action1: action1,
                query: query
              },
              success: function(data) {
                $('#' + result).html(data);
              }
            })
          }
        });
      });
    </script>
    <!-- ------ -->
    <script>
      $(document).ready(function() {
        $('#modalitas').change(function() {
          if ($(this).val() != '') {
            var action2 = $(this).attr("id");
            var query = $(this).val();
            var result = '';
            if (action2 == "modalitas") {
              result = 'prosedur2';
            }
            $.ajax({
              url: "registration-prosedur.php",
              method: "POST",
              data: {
                action2: action2,
                query: query
              },
              success: function(data) {
                $('#' + result).html(data);
              }
            })
          }
        });
      });
    </script>
    <!-- -------- -->
    <script>
      $('#schedule_date').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
      });
      $('#schedule_time').datetimepicker({
        datepicker: false,
        step: 1,
        format: 'H:i:s'
      });
    </script>



  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>