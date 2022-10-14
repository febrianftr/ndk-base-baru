<?php 
require 'function_radiographer.php';

session_start();

$uid = $_GET["uid"];

$username = $_SESSION['username'];
if ( hapus_worklist($uid,$username) > 0 ) {
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
