<?php

require '../koneksi/koneksi.php';

$_POST['study_iuid'];
$_POST['accession_no'];
$_POST['no_foto'];
$_POST['pat_id'];
$_POST['pat_name'];
$_POST['pat_birthdate'];
$_POST['address'];
$_POST['weight'];
$_POST['name_dep'];
$_POST['mods_in_study'];
$_POST['named'];
$_POST['contrast'];
$_POST['radiographer_name'];
$_POST['priority'];
$_POST['pat_state'];
$_POST['payment'];
$_POST['contrast_allergies'];
$_POST['spc_needs'];
$_POST['film_small'];
$_POST['film_medium'];
$_POST['film_large'];
$_POST['film_small'];
$_POST['film_medium'];
$_POST['film_large'];
$_POST['re_photo'];
$_POST['kv'];
$_POST['mas'];

mysqli_query(
    $conn,
    "UPDATE xray_order 
    SET priority = '$_POST[pat_state]' 
    WHERE uid = '1.2.40.0.13.1.1445277.20200704.20070204'"
);
