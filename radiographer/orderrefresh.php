<?php

require '../koneksi/koneksi.php';


// -------------------------- SELECT WAITING KIRIM KE PACS ----------------------------------

// $pacs = mysqli_query($conn_pacs, "SELECT
// * FROM xray_order where fromorder = 'ris ");
?>
<meta http-equiv="refresh" content="5" />
<table>
	<tr>
		<th>
			<center>UID</center>
		</th>
		<th>
			<center>MRN/Patient ID</center>
		</th>
		<th>
			<center>Nama</center>
		</th>
		<th>
			<center>Jenis Kelamin</center>
		</th>
		<th>
			<center>Nama Type</center>
		</th>
		<th>
			<center>Prosedur</center>
		</th>
		<th>
			<center>Nama Dokter </center>
		</th>
		<th>
			<center>Waktu Order</center>
		</th>
		<th>
			<center>action</center>
		</th>
	</tr>
	<?php $result = mysqli_query($conn, "SELECT * FROM xray_order where fromorder = 'SIMRS' order by pk ASC"); ?>
	<?php while ($row = mysqli_fetch_array($result)) {
		$uid = $row['uid'];
	?>
		<form action="orderrefreshproses.php" method="POST">
			<tr>
				<input name="uid" type="hidden" id="uid" value="<?= $uid; ?>">
				<td><?php echo $uid; ?></td>
				<td align=center><?= $row['mrn']; ?></td>
				<td align=center><?= $row['name']; ?> <?= $row['lastname']; ?></td>
				<td align=center><?= $row['sex']; ?></td>
				<td align=center><?= $row['type']; ?></td>
				<td align=center><?= $row['prosedur']; ?></td>
				<td align=center><?= $row['named']; ?> <?= $row['lastnamed']; ?></td>
				<td align=center><?= $row['create_time']; ?></td>
				<?php
				
				?>
				<td><input type="submit" name="submit" value="proses exam" id="modal"></td>
			</tr>
		</form>
	
	<?php } ?>
</table>
<?php require 'script-footer.php' ?>
<script>
$(document).ready(function() {
$("#modal").trigger("click");
});
</script>