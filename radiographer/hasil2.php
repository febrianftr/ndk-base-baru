<?php
require '../koneksi/koneksi.php';
$uid = $_POST['uid'];
$query = "SELECT * FROM xray_recyclebin WHERE uid = '$uid' GROUP BY series_desc";
$value = mysqli_query($conn, $query);
?>
<style>
	.fill{
		padding:50px;
	}
</style>
<div class="fill">
	<h4><strong><label>SERIES DESC </label>&nbsp;<label></label></strong></h4>
	<h4><strong>
	<?php 
	while($row1 = mysqli_fetch_assoc($value)){ 
		$series_desc = $row1['series_desc'];
		$series_desc1 = str_replace(",", "<br /> - ", $series_desc);
		?>
    <table>
    	<tr>
    		<td align="left"><?= '- '. $series_desc1; ?></td>
    	</tr>
    </table>
	<?php } ?>
	</strong></h4>
    <br>
    <p>
</div>