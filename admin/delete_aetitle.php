<?php
require 'function_dokter.php';

session_start();

$pk = $_GET["pk"];

if (delete_aetitle($pk) > 0) {
	echo "<script type='text/javascript'>
	setTimeout(function () { 
	swal({
			   title: 'Data Berhasil Dihapus',
			   text:  '',
			   icon: 'success',
			   timer: 1000,
			   showConfirmButton: true
		   });  
	},10); 
	window.setTimeout(function(){ 
	 window.location.replace('view_aetitle.php');
	} ,1000); 
   </script>";
} else {
	echo "<script type='text/javascript'>
	setTimeout(function () { 
	swal({
			   title: 'Data Gagal Dihapus',
			   text:  '',
			   icon: 'error',
			   timer: 1000,
			   showConfirmButton: true
		   });  
	},10); 
	window.setTimeout(function(){ 
	 window.location.replace('view_aetitle.php');
	} ,1000); 
   </script>";
}
