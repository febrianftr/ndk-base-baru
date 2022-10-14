<?php

require '../koneksi/koneksi.php';

// require __DIR__ . '/vendor/autoload.php';

// use GuzzleHttp\Client;

$acc = $_GET['acc'];
$mrn = $_GET['mrn'];

// get order
$row = mysqli_fetch_array(mysqli_query(
    $conn,
    "SELECT * FROM xray_order WHERE acc = '$acc' AND mrn LIKE '%$mrn%' "
));

// cek order
$cekorder = mysqli_affected_rows($conn);

// name_dep, prosedur, dokterid, spc_needs, payment, priority, pat_state, named, dokradid, dokrad_name
$address = $row["address"];
$name_dep = $row["name_dep"];
$prosedur = $row["prosedur"];
$dokterid = $row["dokterid"];
$named = $row["named"];
$spc_needs = $row["spc_needs"];
$payment = $row["payment"];
$priority = $row["priority"];
$pat_state = $row["pat_state"];
$dokradid = $row["dokradid"];
$dokrad_name = $row["dokrad_name"];
$radiographer_id = $row["radiographer_id"];
$radiographer_name = $row["radiographer_name"];
$xray_type_code = $row["xray_type_code"];
$sex = $row["sex"];
$birth_date = $row["birth_date"];
$accOrder = $row["acc"];

// echo $name_dep . '. ' . $prosedur . '. ' . $dokterid . '. ' . $named . '. ' . $spc_needs . '. ' . $payment . '. ' . $priority . '. ' . $pat_state . '. ' . $dokradid . '. ' . $dokrad_name;

// get workload radiographer
$row_workload = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT * FROM xray_workload_radiographer WHERE acc = '$acc' AND mrn LIKE '%$mrn%' AND fromorder = 'terkirim'"
));

$cekworkload = mysqli_affected_rows($conn);

if ($cekorder <= 0) {
    // jika tidak ada acc number di xray_order
    // echo "data tidak ada di SIMRS";
    echo "
        <script>
        alert('acc number simrs tidak sesuai / kesalahan input acc number dialat');
        document.location.href= 'workload.php';
        </script>";
} else if ($cekworkload > 0) {
    // jika ada acc number di xray_workload
    // echo "data sudah ada di RIS / kesalahan input acc number dialat";
    echo "
        <script>
        alert('acc number sudah ada diRIS');
        document.location.href= 'workload.php';
        </script>";
} else {
    // echo "data masuk ke RIS";
    $explode = explode(",", $radiographer_name);
    for ($i = 0; $i < count($explode); $i++) {
        $strupper = strtoupper($explode[$i]);
        $strupper = trim($strupper);
        mysqli_query($conn, "INSERT INTO xray_report_excel (uid_report, radiographer_name_report) VALUES ('$uid', '$strupper')");
    }

    mysqli_query($conn, "UPDATE xray_workload_radiographer 
                            SET address = '$address',
                            name_dep = '$name_dep', 
                            prosedur = '$prosedur', 
                            dokterid = '$dokterid',
                            named = '$named', 
                            spc_needs = '$spc_needs', 
                            payment = '$payment',
                            priority = '$priority', 
                            pat_state = '$pat_state', 
                            fromorder = 'terkirim',
                            dokradid = '$dokradid',
                            dokrad_name = '$dokrad_name',
                            xray_type_code = '$xray_type_code',
                            radiographer_id = '$radiographer_id',
                            radiographer_name = '$radiographer_name',
                            birth_date = '$birth_date',
                            sex = '$sex'
                            WHERE acc = '$acc' 
                            ");

    mysqli_query($conn, "UPDATE xray_exam2 
                            SET address = '$address',
                            name_dep = '$name_dep', 
                            prosedur = '$prosedur', 
                            dokterid = '$dokterid',
                            named = '$named', 
                            spc_needs = '$spc_needs', 
                            payment = '$payment',
                            priority = '$priority', 
                            pat_state = '$pat_state', 
                            fromorder = 'terkirim',
                            dokradid = '$dokradid',
                            dokrad_name = '$dokrad_name',
                            xray_type_code = '$xray_type_code',
                            radiographer_id = '$radiographer_id',
                            radiographer_name = '$radiographer_name',
                            birth_date = '$birth_date',
                            sex = '$sex'
                            WHERE acc = '$acc' 
        ");
    echo "
        <script>
            alert('data berhasil di Ubah');
            document.location.href= 'workload.php';
        </script>";
}
