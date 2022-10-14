<?php 
require 'function_radiology.php';

session_start();

$study_iuid = $_GET["study_iuid"];
$template_id = $_GET["template_id"];

if ( hapus_temp($template_id) > 0 ) {
	echo "	
			<script>
				alert('Template Berhasil dihapus');
				document.location.href= 'worklist.php?study_iuid=".$study_iuid."';
			</script>";
			

}else {
	echo "			
			<script>
				alert('Template Gagal dihapus');
				document.location.href= 'worklist.php?study_iuid=".$study_iuid."';
			</script>";
}

 ?>
