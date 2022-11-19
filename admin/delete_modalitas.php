<?php
require 'function_dokter.php';

session_start();

$pk = $_GET["pk"];

if (delete_modalitas($pk) > 0) {
	echo "<script>
			alert('Berhasil dihapus!');
			document.location.href= 'view_modalitas.php';
		</script>";
} else {
	echo "<script>
			alert('Gagal dihapus!');
			document.location.href= 'view_modalitas.php';
		</script>";
}
