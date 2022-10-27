<?php
require 'function_radiology.php';

session_start();

$uid = $_GET["uid"];

if (ubahdokter($uid) > 0) {
	echo "	
			<script>
				alert('Berhasil diubah, silahkan ke physician worklist');
				document.location.href= 'workload.php';
			</script>";
} else {
	echo "			
			<script>
				alert('Data Gagal diubah');
				document.location.href= 'workload.php';
			</script>";
}
