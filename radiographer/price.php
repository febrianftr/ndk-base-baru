<?php 
$xray_type_code = $_POST['xray_type_code'];
require '../koneksi/koneksi.php';
session_start();
$username = $_SESSION['username'];
$result4 = mysqli_query($conn, "SELECT * FROM xray_modalitas WHERE xray_type_code = '$xray_type_code'");
($row4 = mysqli_fetch_array($result4));
$result3 = mysqli_query($conn, "SELECT * FROM xray_department_order ORDER BY deporderid DESC LIMIT 0,99");
($row3 = mysqli_fetch_array($result3));
$result2 = mysqli_query($conn, "SELECT * FROM xray_dokter_order ORDER BY dokterorderid DESC LIMIT 0,99");
($row2 = mysqli_fetch_array($result2));
$result = mysqli_query($conn, "SELECT * FROM xray_patient_order ORDER BY patientorderid DESC LIMIT 0,99");
($row = mysqli_fetch_array($result));
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
$depid = $row3['depid'];
$typemod = $row4['typemod'];
$typename = $row4['typename'];
$q4 = mysqli_query($conn, 'SELECT MAX(typeorderid) as user_id4 from xray_modalitas_order');
$w4 = mysqli_fetch_array($q4);
$ai4 = $w4['user_id4'] + 1;
$query = "INSERT INTO xray_modalitas_order
        VALUES
        ('$ai4', '$xray_type_code', '$typename', '' )";

        mysqli_query($conn, $query);

if ($_SESSION['level'] == "radiographer") {
 ?>
 <!DOCTYPE html>
 <html>
 <head>
<?php include('head.php'); ?>
<title>Price</title>
 </head>
 <body>
  <div style="position: absolute; z-index: 100;"></div>
  <?php include('menu-bar.php'); ?><br>
  <nav aria-label="breadcrumb">
      <ol class="breadcrumb1 breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item"><a href="registration.php">Registration</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Order</li>
      </ol>
    </nav>

<div id="container1">
  <div id="content1">


<div class="table-view" id=content style="overflow-x:auto;">

<div class="container-fluid">
  <div class="row">
    <div class="col-md-4">
<h3><center>INFORMASI PASIEN</center></h3>
<p></p>
<table class="table-dicom" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
  <tr>
  <th>MRN</th>
  <th>NAMA PASIEN</th>
</tr>
<tr>
  <td><?php echo $row["mrn"]; ?></td>
  <td><?php echo $row["name"]." ".$row["lastname"]; ?></td>
</tr>
</table>
</div>
<div class="col-md-4">
<h3><center>INFORMASI DOKTER PENGIRIM</center></h3>
<p></p>
<table class="table-dicom" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
<tr>
  <th>DOKTER ID</th>
  <th>NAMA DOKTER</th>
</tr>
<tr>
  <td><?php echo $row2["dokterid"]; ?></td>
  <td><?php echo $row2["named"]." ".$row2['lastnamed']; ?></td>
</tr>
</table>
</div>
<div class="col-md-4">
<h3><center>INFORMASI DEPARTMENT</center></h3>
<p></p>
<table class="table-dicom" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
<tr>
  <th>DEPARTMENT ID</th>
  <th>NAMA DEPARTMENT</th>
</tr>
<tr>
  <td><?php echo $row3["depid"]; ?></td>
  <td><?php echo $row3["name_dep"]?></td>
</tr>
</table>
</div>
</div>
</div>

<div class="container-fluid">
<h3><center>INFORMASI MODALITAS</center></h3>
<P></P>
<table class="table-dicom" border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
<tr>
  <th>TIPE MODALITAS</th>
  <th>NAMA TIPE</th>
</tr>
<tr>
  <td><?php echo $row4["xray_type_code"]; ?></td>
  <td><?php echo $row4["typename"]?></td>
</tr>
</table>
</div>




<h3><center>PILIH PROSEDUR</center></h3>
<div class="container-fluid">
<?php $result5 = mysqli_query($conn, "SELECT * FROM xray_price WHERE type = '$xray_type_code'"); ?>
<div class="table-view" id=content style="overflow-x:auto;">
 <table style="margin-bottom: 100px;" class='table-dicom' border="1" cellpadding="8" cellspacing="0" style="margin-top: 3px;">
            <th><center>KODE</center></th>
            <th><center>PROSEDUR</center></th>
            <th><center>TIPE</center></th>
            <th><center>HARGA</center></th>
            <th><center></center></th>
            </tr>
<?php while($row5 = mysqli_fetch_array($result5))
                  :?>
                    <tr>
                    <td align=center>  <?= $row5['code_xray'] ?> </td>
                    <td align=center>  <?= $row5['prosedur'] ?> </td>
                    <td align=center>  <?= $row5['type'] ?>  </td>
                    <td align=center>  <?= $row5['price'] ?>  </td>
                    <td align=center><form id=order  name=order method=post action="radiographer.php ">
                       <input name="code_xray" type="hidden" id="code_xray" value=<?= $row5['code_xray'] ?>>
                       <button class ="btn-worklist" type="submit" name="button" id="button" value="SELECT">SELECT
                       </form>
                    </tr>
                  <?php endwhile; ?>
                  </table>
                </div>
 <?php ?>
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
<?php include('script-footer.php'); ?>

 </body>
 </html>
<?php } else {header("location:../index.php");} ?>