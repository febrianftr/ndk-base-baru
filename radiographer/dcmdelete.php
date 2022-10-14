<?php
// $file_pointer = 'temp/rafli.dcm';
// unlink($file_pointer);
$directory = escapeshellarg('C://xampp/htdocs/intiwid2022/radiographer/dcm_temp');
exec("rmdir /s /q $directory");
sleep(2);
header('location:dcm_send.php');
