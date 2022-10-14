<?php 
require 'function_dokter.php';

session_start();

$dokradid = $_GET["dokradid"];
$id_table = $_GET["id_table"];

if ( hapus_rad($dokradid,$id_table) > 0 ) {
	echo "	
			<script>
				alert('Data Berhasil dihapus');
				document.location.href= 'view_dokter_radiology.php';
			</script>";

}else {
	echo "			
			<script>
				alert('Data Gagal dihapus');
				document.location.href= 'view_dokter_radiology.php';
			</script>";
}

 ?>
