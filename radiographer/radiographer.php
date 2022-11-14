<?php
$code_xray = $_POST['code_xray'];
require '../koneksi/koneksi.php';
session_start();
$username = $_SESSION['username'];
$result5 = mysqli_query($conn, "SELECT * FROM xray_price WHERE code_xray = '$code_xray'");
($row5 = mysqli_fetch_array($result5));
$result4 = mysqli_query($conn, "SELECT * FROM xray_modalitas_order ORDER BY typeorderid DESC LIMIT 0,99");
($row4 = mysqli_fetch_array($result4));
$result3 = mysqli_query($conn, "SELECT * FROM xray_department_order ORDER BY deporderid DESC LIMIT 0,99");
($row3 = mysqli_fetch_array($result3));
$result2 = mysqli_query($conn, "SELECT * FROM xray_dokter_order ORDER BY dokterorderid DESC LIMIT 0,99");
($row2 = mysqli_fetch_array($result2));
$result = mysqli_query($conn, "SELECT * FROM xray_patient_order ORDER BY patientorderid DESC LIMIT 0,99");
($row = mysqli_fetch_array($result));
$username = $_SESSION['username'];
$patientid = $row['patientid'];
$mrn = $row['mrn'];
$name = $row['name'];
$lastname = $row['lastname'];
$sex = $row['sex'];
$birth_date = $row['birth_date'];
$weight = $row['weight'];
$dokterid = $row2['dokterid'];
$named = $row2['named'];
$lastnamed = $row2['lastnamed'];
$email = $row2['email'];
$name_dep = $row3['name_dep'];
$dep_id = $row3['dep_id'];
$typemod = $row4['typemod'];
$xray_type_code = $row4['xray_type_code'];
$prosedur = $row5['prosedur'];
$price = $row5['price'];
$q5 = mysqli_query($conn, 'SELECT MAX(priceorderid) as user_id5 from xray_price_order');
$w5 = mysqli_fetch_array($q5);
$ai5 = $w5['user_id5'] + 1;
$query = "INSERT INTO xray_price_order
VALUES
('$ai5', '$code_xray', '$prosedur', '$type', '$price')";
mysqli_query($conn, $query);
// ------------------------------radiographer-----------------------
$result6 = mysqli_query($conn, "SELECT * FROM xray_radiographer WHERE username = '$username' ");
$row6 = mysqli_fetch_array($result6);
$radiographer_id = $row6['radiographer_id'];
$radiographer_name = $row6['radiographer_name'];
$radiographer_lastname = $row6['radiographer_lastname'];
$radiographer_sex = $row6['radiographer_sex'];
$radiographer_tlp = $row6['radiographer_tlp'];
$radiographer_email = $row6['radiographer_email'];
$q6 = mysqli_query($conn, 'SELECT MAX(radiographer_idorder) as user_id6 from xray_radiographer_order');
$w6 = mysqli_fetch_array($q6);
$ai6 = $w6['user_id6'] + 1;
$query = "INSERT INTO xray_radiographer_order
VALUES
('$ai6', '$radiographer_id', '$radiographer_name', '$radiographer_lastname', '$radiographer_sex', '$radiographer_tlp', '$radiographer_email')";
mysqli_query($conn, $query);
header("location:order.php");
if ($_SESSION['level'] == "radiographer") {
?>
  <!DOCTYPE html>
  <html>

  <head>
  </head>

  <body>
    <?php
    $result6 = mysqli_query($conn, "SELECT * FROM xray_radiographer WHERE username = '$username' "); ?>
    <?php while ($row6 = mysqli_fetch_array($result6)) : ?>
      <form id=order name=order method=post action="order.php ">
        <input name="radiographer_id" type="hidden" id="radiographer_id" value="<?= $row6['radiographer_id'] ?>">
        <button class="btn-worklist" type="submit" name="button" id="button" value="SELECT">SELECT
      </form>
    <?php endwhile; ?>
  </body>

  </html>
<?php } else {
  header("location:../index.php");
} ?>