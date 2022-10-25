<?php
require 'function_radiology.php';

session_start();

$uid = $_GET["uid"];
$template_id = $_GET["template_id"];
$halaman = $_GET["halaman"];

if (hapus_temp($template_id) > 0) {
	echo "	
			<script>
				alert('Template Berhasil dihapus');
				document.location.href= '$halaman.php?uid=" . $uid . "';
			</script>";
} else {
	echo "			
			<script>
				alert('Template Gagal dihapus');
				document.location.href= '$halaman.php?uid=" . $uid . "';
			</script>";
}
