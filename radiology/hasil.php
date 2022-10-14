<?php 
require '../koneksi/koneksi.php';
$template_id = $_POST['template_id'];
$query = "SELECT * FROM xray_template WHERE template_id = '$template_id'";
$value = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($value);
 ?>
<div class="fill">

<h4><strong><label>Title :</label>&nbsp;<label><?= $row['title']; ?></label></strong></h4>
<br><p>
<?= $row['fill'];?></p>
</div>