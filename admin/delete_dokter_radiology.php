<?php
require 'function_dokter.php';

session_start();

$pk = $_GET["pk"];
$id_table = $_GET["id_table"];

if (delete_dokter_radiology($pk, $id_table) > 0) {
	echo "<script>
			alert('Berhasil dihapus!');
			document.location.href= 'view_dokter_radiology.php';
		</script>";
} else {
	echo "<script>
			alert('Gagal dihapus!');
			document.location.href= 'view_dokter_radiology.php';
		</script>";
}
