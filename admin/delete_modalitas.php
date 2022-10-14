<?php 
require 'function_dokter.php';

session_start();

$idmod = $_GET["idmod"];

if ( hapus_mod($idmod) > 0 ) {
	echo "	
			<script>
				alert('Data Berhasil dihapus');
				document.location.href= 'view_modalitas.php';
			</script>";

}else {
	echo "			
			<script>
				alert('Data Gagal dihapus');
				document.location.href= 'view_modalitas.php';
			</script>";
}

 ?>
