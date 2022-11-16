<?php
require 'function_dokter.php';

session_start();

$id = $_GET["id"];

if (delete_dokter($id) > 0) {
	echo "<script>
			alert('Berhasil dihapus!');
			document.location.href= 'view_dokter.php';
		</script>";
} else {
	echo "<script>
			alert('Gagal dihapus!');
			document.location.href= 'view_dokter.php';
		</script>";
}
