<?php 
require 'function_dokter.php';

session_start();

$radiographer_id = $_GET["radiographer_id"];
$id_table = $_GET["id_table"];

if ( hapus_grapher($radiographer_id,$id_table) > 0 ) {
	echo "	
			<script>
				alert('Data Berhasil dihapus');
				document.location.href= 'view_dokter_radiographer.php';
			</script>";

}else {
	echo "			
			<script>
				alert('Data Gagal dihapus');
				document.location.href= 'view_dokter_radiographer.php';
			</script>";
}

 ?>
