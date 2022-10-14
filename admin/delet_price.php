<?php 
require 'function_dokter.php';

session_start();

$idharga = $_GET["idharga"];

if ( hapus_price($idharga) > 0 ) {
	echo "	
			<script>
				alert('Data Berhasil dihapus');
				document.location.href= 'view_price.php';
			</script>";

}else {
	echo "			
			<script>
				alert('Data Gagal dihapus');
				document.location.href= 'view_price.php';
			</script>";
}

 ?>