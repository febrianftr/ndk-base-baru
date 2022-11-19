<?php
require 'function_dokter.php';

session_start();

$pk = $_GET["pk"];

if (delete_department($pk) > 0) {
	echo "<script>
			alert('Data Berhasil dihapus');
			document.location.href= 'view_department.php';
		</script>";
} else {
	echo "<script>
			alert('Data Gagal dihapus');
			document.location.href= 'view_department.php';
		</script>";
}
