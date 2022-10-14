<?php

require '../koneksi/koneksi.php';

session_start();
$username = $_SESSION['username'];

$dokterradiology = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE username = '$username'");
$row2 = mysqli_fetch_assoc($dokterradiology);
$dokradid = $row2['dokradid'];
// $dokradid2 = $row2['dokradid2'];
$data_dicom2 = mysqli_query($conn, "SELECT * FROM xray_exam2 WHERE dokradid = '$dokradid' OR dokradid IS NULL order by priority DESC, updated_time DESC LIMIT 3000");
// AND src_aet NOT LIKE '%DCMSND%' 
$data = [];
$i = 1;
while ($row1 = mysqli_fetch_assoc($data_dicom2)) {

    $birth_date = $row1['birth_date'];
    $bday = new DateTime($birth_date);
    $today = new DateTime(date('y-m-d'));
    $diff = $today->diff($bday);
    $sex = $row1['sex'];
    $uid = $row1['uid'];
    $query2 = mysqli_query($conn, "SELECT * FROM xray_series WHERE uid = '$uid'");
    $row2 = mysqli_fetch_assoc($query2);
    $body_part_series = $row2['body_part'] ?? '';
    $prosedur = $row1['prosedur'] ?? '';
    if ($prosedur == '') {
        $prosedur1 = $body_part_series;
    } else {
        $prosedur1 = $prosedur;
    }
    $fullname = $row1['name'] . ' ' . $row1['lastname'];
    $fullname = utf8_encode($fullname);
    $fullnamed = $row1['named'] . ' ' . $row1['lastnamed'];
    $fullradiographername = $row1['radiographer_name'] . ' ' . $row1['radiographer_lastname'];
    $maruf = $row1['study_datetime'];
    $sandi = new DateTime($maruf);
    $jkw = $sandi->format('d F Y');
    $prbw = $sandi->format('H:i:s');

    $arrive_date = $row1["arrive_date"];
    $arrive_time = $row1["arrive_time"];
    $arrivedatetime = $arrive_date . ' ' . $arrive_time;
    $arrivedatetime = date("d-m-Y H:i", strtotime($arrivedatetime));
    $arrivedatetime = str_replace("01-01-1970 01:00", " ", $arrivedatetime);


    $study_datetime = $row1['study_datetime'];
    $study_datetime1 = date("d-m-Y H:i", strtotime($study_datetime));
    $updated_time = $row1['updated_time'];
    $updated_time1 = date("d-m-Y H:i", strtotime($updated_time));
    $sex = $row1['sex'];
    if ($sex == 'M') {
        $sex1 = '<i style="color: blue;" class="fas fa-mars"></i> M';
    } else if ($sex == 'L') {
        $sex1 = '<i style="color: blue;" class="fas fa-mars"></i> L';
    } else if ($sex == 'P') {
        $sex1 = '<i style="color: #ff637e;" class="fas fa-venus"></i> P';
    } else if ($sex == 'F') {
        $sex1 = '<i style="color: #ff637e;" class="fas fa-venus"></i> F';
    } else if ($sex == 'O') {
        $sex1 = '<i class="fas fa-genderless"></i> O';
    } else {
        $sex1 = '.';
    }
    $hasil = "";
    $series_desc1 = '<a href="#" class="edit-record1 penawaran-a" data-id="' . $uid . '">Read More</a>';
    // $series_desc = $row['series_desc'];
    // $series_desc1 = substr($series_desc, 0, 10);
    // if ($series_desc > $series_desc1) {
    //   $hasil .= '<a href="#" class="edit-record1 penawaran-a" data-id="' . $uid . '">Read More</a>';
    // } else {
    //   "";
    // }
    if ($series_desc1 >= 2) {
        $series_desc1;
    }
    $priority = $row1['priority'];
    $text = preg_replace('/[^A-Za-z\ ]/', '', $priority);

    $text2 = "";

    if ($text == 'Low') {
        $text2 = '<i style="color: #2d2;" class="fas fa-circle"></i> Low';
    } else if ($text == 'Medium') {
        $text2 = '<i style="color: yellow;" class="fas fa-circle"></i> Medium';
    } else if ($text == 'high') {
        $text2 =  '<i style="color: #fb9246;" class="fas fa-circle"></i> High';
    } else if ($text == 'Critical') {
        $text2 = '<i style="color: red;" class="fas fa-circle"></i> Critical';
    } else if ($text == 'Cito') {
        $text2 = '<i style="color: red;" class="fas fa-circle"></i> CITO';
    } else if ($text == 'Biasa') {
        $text2 = '<i style="color: #2d2;" class="fas fa-circle"></i> BIASA';
    }

    if (!$row1['fill']) {
        $btn = '<a href="worklist.php?uid=' . $row1['uid'] . '">
        <span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/write2.svg" data-toggle="tooltip" title="Go to Expertise" style="width: 110%;"></span>
        </a>';
    } else {
        $btn = '<a href="worklist.php?uid=' . $row1['uid'] . '">
            <span class="btn btn-warning btn-inti"><i class="fas fa-edit" data-toggle="tooltip" title="Go to expertise"></i></span>
        </a>';
    }
    if ($username == "demo2") {

        $data[] = [
            "no" => $i,
            "action" => $btn .
                '',
            "mrn" => utf8_encode($row1['mrn']) . ' / ' . utf8_encode($row1['patientid']),
            "name" => $fullname,
            "birth_date" => $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D',
            "sex" => $sex1,
            "xray_type_code" => $row1['xray_type_code'],
            "prosedur" => $prosedur1,
            "series_desc" => $series_desc1 . '<br /> ' . $hasil,
            "named" => $fullnamed,
            "radiographer_name" => $fullradiographername,
            "name_dep" => $row1['name_dep'],
            "priority" => $text2,
            "arrive_date" => $arrivedatetime,
            "complete_date" => $study_datetime1,
            "updated_time" => $updated_time1,
            "spc_needs" => $row1['spc_needs']
        ];
        $i++;
    } else {
        $data[] = [
            "no" => $i,
            "action" => $btn .
                '<a style="text-decoration: none;" href="changedoctorworklist.php?uid=' . $row1['uid'] . '"  onclick=\'return confirm("Ubah dokter radiology yang membaca?");\'><span class="btn rgba-stylish-slight btn-inti2" style="box-shadow: none;"><img src="../image/change.svg" data-toggle="tooltip" title="Switch Radiologist" style="width: 100%;"></span></a> <br>',
            "mrn" => utf8_encode($row1['mrn']) . ' / ' . utf8_encode($row1['patientid']),
            "name" => $fullname,
            "birth_date" => $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D',
            "sex" => $sex1,
            "xray_type_code" => $row1['xray_type_code'],
            "prosedur" => $prosedur1,
            "series_desc" => $series_desc1 . '<br /> ' . $hasil,
            "named" => $fullnamed,
            "radiographer_name" => $fullradiographername,
            "name_dep" => $row1['name_dep'],
            "priority" => $text2,
            "arrive_date" => $arrivedatetime,
            "complete_date" => $study_datetime1,
            "updated_time" => $updated_time1,
            "spc_needs" => $row1['spc_needs']
        ];
        $i++;
    }
}

echo json_encode($data);
