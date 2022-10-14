<?php 
require 'function_dokter.php';

session_start();

$said = $_GET["said"];
$id_table = $_GET["id_table"];

if ( hapus_superadmin($said,$id_table) > 0 ) {
	echo "	
			<script>
				alert('Data Berhasil dihapus');
				document.location.href= 'view_superadmin.php';
			</script>";

}else {
	echo "			
			<script>
				alert('Data Gagal dihapus');
				document.location.href= 'view_superadmin.php';
			</script>";
}

 ?>
