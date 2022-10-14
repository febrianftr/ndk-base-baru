<?php 
require 'function_radiographer.php';

session_start();

$uid = $_GET["uid"];
$template_id = $_GET["template_id"];

if ( hapus_temp($template_id) > 0 ) {
	echo "	
			<script>
				alert('Template Berhasil dihapus');
				document.location.href= 'worklist.php?uid=".$uid."';
			</script>";
			

}else {
	echo "			
			<script>
				alert('Template Gagal dihapus');
				document.location.href= 'worklist.php?uid=".$uid."';
			</script>";
}

 ?>
