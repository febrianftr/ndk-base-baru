<?php 
require 'function_dokter.php';

session_start();

$admin_id = $_GET["admin_id"];
$id_table = $_GET["id_table"];

if ( hapus_admin($admin_id,$id_table) > 0 ) {
	echo "	
			<script>
				alert('Data Berhasil dihapus');
				document.location.href= 'view_admin.php';
			</script>";

}else {
	echo "			
			<script>
				alert('Data Gagal dihapus');
				document.location.href= 'view_admin.php';
			</script>";
}

 ?>
