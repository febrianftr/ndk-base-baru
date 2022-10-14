<?php

require '../koneksi/koneksi.php';

$uid = $_GET["uid"];

mysqli_query($conn, "DELETE FROM xray_order 
				WHERE uid = '$uid'
				");
echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
<script type='text/javascript'>
setTimeout(function () { 
swal({
		   title: 'Data Berhasil Dihapus',
		   text:  '',
		   icon: 'error',
		   timer: 3000,
		   showConfirmButton: true
	   });  
},10); 
window.setTimeout(function(){ 
 window.location.replace('order2.php');
} ,1500); 
</script>";
