<?php
require 'koneksi/koneksi.php';
require 'log.php';

$aet = $_POST['aet'];
$uid = $_POST['uid'];
$acc = $_POST['acc'];
$inputcd = 'cd C:\dcmsyst\tool-2.0.26\bin &&';
$inputdcm = ' dcmqr dcmPACS@127.0.0.1:11118 -qStudyInstanceUID=' . $uid . ' -cmove ' . $aet;
$input = $inputcd . $inputdcm;
exec($input, $output);

$input_insert = mysqli_real_escape_string($conn, $input);
$output_insert = json_encode($output, true);

mysqli_query(
    $conn,
    "INSERT INTO dicom_router (uid, acc, request, response, created_at, updated_at) 
    VALUES ('$uid', '$acc', '$input_insert', '$output_insert', NOW(), NOW())"
);

$message = implode(PHP_EOL, $output);

logging(PHP_EOL . PHP_EOL . "['uid' : $uid, 'aet' : $aet]" . PHP_EOL . $message, "log/send-dicom.log");

echo json_encode([
    'status' => 200,
    'output' => implode('<br />', $output),
    'input' => $inputdcm
]);
