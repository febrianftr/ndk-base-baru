<?php 
require 'function_dokter.php';

session_start();

$dokterid = $_GET["dokterid"];

if ( hapus($dokterid) > 0 ) {
	echo "	
			<script>
				alert('Data Berhasil dihapus');
				document.location.href= 'view_dokter.php';
			</script>";

}else {
	echo "			
			<script>
				alert('Data Gagal dihapus');
				document.location.href= 'view_dokter.php';
			</script>";
}

 ?>
