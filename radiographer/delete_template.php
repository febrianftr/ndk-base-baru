<?php 
require 'function_radiographer.php';

session_start();

$template_id = $_GET["template_id"];

if ( hapus_temp_new($template_id) > 0 ) {
	echo "	
			<script>
				alert('Data Berhasil dihapus');
				document.location.href= 'view_template.php';
			</script>";

}else {
	echo "			
			<script>
				alert('Data Gagal dihapus');
				document.location.href= 'view_template.php';
			</script>";
}

 ?>
