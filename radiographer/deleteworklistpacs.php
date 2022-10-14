<?php 
require 'function_radiographer.php';

session_start();

$study_iuid = $_GET["study_iuid"];

if ( hapus_worklistpacs($study_iuid) > 0 ) {
	echo "	
			<script>
				alert('Data Berhasil dihapus');
				document.location.href= 'dicom.php';
			</script>";

}else {
	echo "			
			<script>
				alert('Data Gagal dihapus');
				document.location.href= 'dicom.php';
			</script>";
}

 ?>
