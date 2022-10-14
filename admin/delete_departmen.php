<?php 
require 'function_dokter.php';

session_start();

$depid = $_GET["depid"];

if ( hapus_dep($depid) > 0 ) {
	echo "	
			<script>
				alert('Data Berhasil dihapus');
				document.location.href= 'view_departmen.php';
			</script>";

}else {
	echo "			
			<script>
				alert('Data Gagal dihapus');
				document.location.href= 'view_departmen.php';
			</script>";
}

 ?>
