<?php

require 'koneksi/koneksi.php';

require 'viewer-all.php';

$query = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer ORDER BY pk DESC LIMIT 1000");
$data = [];
$i = 1;
while ($row = mysqli_fetch_array($query)) {
    $uid = $row['uid'];
    // $query2 = mysqli_query($conn, "SELECT * FROM xray_series WHERE uid = '$uid'");
    // $row2 = mysqli_fetch_assoc($query2);
    // $body_part_series = $row2['body_part'];
    $prosedur1 = $row['prosedur'];
    // if ($prosedur == '') {
    //     $prosedur1 = $body_part_series;
    // } else {
    //     $prosedur1 = $prosedur;
    // }
    $name = $row['name'];
    $name = str_replace('^', ' ', $name);
    @$lastname = $row['lastname'];
    $fullname = $name . ' ' . $lastname;
    $fullname = utf8_encode($fullname);
    $birth_date = $row['birth_date'];
    $status = $row['status'];
    if ($status == 'ready to approve') {
        $status1 =  '<i style="color: #18A850;" class="fas fa-sync"> Waiting</i>';
    } else if ($status == 'APPROVED') {
        $status1 =  '<i style="color: #1862B0" class="fas fa-check-square"> Approved</i>';
    } else if ($status == 'backup') {
        $status1 =  '<i style="color: red" class="fas fa-check-square"> BACK UP</i>';
    }
    $bday = new DateTime($birth_date);
    $today = new DateTime(date('y-m-d'));
    $diff = $today->diff($bday);
    $named = $row['named'];
    $named = str_replace('^', ' ', $named);
    $fullnamed = $named . ' ' . $row['lastnamed'];
    $fulldokradname = $row['dokrad_name'] . ' ' . $row['dokrad_lastname'];
    $radiographer_name = $row['radiographer_name'];
    $radiographer_name = str_replace('^', ' ', $radiographer_name);
    $fullradiographername = $radiographer_name . ' ' . $row['radiographer_lastname'];
    $src_aet = $row['src_aet'];
    if ($src_aet == "NX_IGD") {
        $src_aet1 = "R. IGD";
    } else if ($src_aet == "NX_DEFAULT1") {
        $src_aet1 = "R. ARAFAH 1";
    } else if ($src_aet == "NX_DEFAULT2") {
        $src_aet1 = "R. ARAFAH 2";
    } else if ($src_aet == "FLC_STORE_SCU") {
        $src_aet1 = "Siemens";
    } else {
        $src_aet1 = "";
    }
    $complete_date = $row['complete_date'];
    $complete_time = $row['complete_time'];
    $complete = $row["complete_date"] . ' ' . $row["complete_time"];
    $updated_time = $row["updated_time"];
    $updated_time = date("d-m-Y H:i", strtotime($updated_time));
    $approve = $row["approve_date"] . ' ' . $row["approve_time"];
    if (!empty($approve == 0)) {
        $approve1 = " ";
    } else {
        $approve1 = date("d-m-Y H:i", strtotime($approve));
    }
    $sex = $row['sex'];
    if ($sex == 'M') {
        $sex1 = '<i style="color: #1f69b7;" class="fas fa-mars"> M</i>';
    } else if ($sex == 'L') {
        $sex1 = '<i style="color: #1f69b7;" class="fas fa-mars"> L</i>';
    } else if ($sex == 'P') {
        $sex1 = '<i style="color: #ff637e;" class="fas fa-venus"> P</i>';
    } else if ($sex == 'F') {
        $sex1 = '<i style="color: #ff637e;" class="fas fa-venus"> F</i>';
    } else if ($sex == 'O') {
        $sex1 = '<i class="fas fa-genderless"> O</i>';
    } else {
        $sex1 = '.';
    }
    $hasil = "";
    // $series_desc = $row['series_desc'];
    // $series_desc1 = substr($series_desc, 0, 10);
    $series_desc1 = '<a href="#" class="edit-record1 penawaran-a" data-id="' . $uid . '">Read More</a>';
    // if ($series_desc > $series_desc1) {
    //     $hasil .= '<a href="#" class="edit-record1 penawaran-a" data-id="' . $uid . '">Read More</a>';
    // } else {
    //     "";
    // }
    // if ($series_desc1 >= 2) {
    //     $series_desc1;
    // }
    $awal  = strtotime($complete); //waktu awal
    $akhir = strtotime($approve); //waktu akhir
    $diff1  = $akhir - $awal;
    $jam   = floor($diff1 / (60 * 60));
    $menit = $diff1 - $jam * (60 * 60);
    if (!empty($approve == 0) or !empty($complete == 0)) {
        $spendtime = '';
    } else {
        $spendtime = $jam .  ' jam, ' . floor($menit / 60) . ' menit';
    }

    $data[] = [
        "no" => $i,
        "report" =>
        PDFFIRST . $uid . PDFLAST .
            RADIANTFIRST . $uid . RADIANTLAST .
            DICOMFIRST . $uid . DICOMLAST .
            OHIFMOBILEFIRST . $uid . OHIFMOBILELAST .
            OHIFFIRST . $uid . OHIFLAST .
            HTMLFIRST . $uid . HTMLLAST .
            INOBITECFIRST . "'$uid'" . INOBITECLAST,
        // IPIVIEWFIRST . $uid . IPIVIEWLAST,
        "status" => $status1,
        "no_foto" => $row['patientid'],
        "mrn" => $row['mrn'],
        "name" => $fullname,
        "birth_date" => $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D',
        "sex" => @$sex1,
        "prosedur" => $prosedur1,
        "series_desc" => $series_desc1,
        "num_series" => $row['num_series'] . ' / ' . $row['num_instances'],
        "xray_type_code" => $row['xray_type_code'],
        "named" => $fullnamed,
        "name_dep" => $row['name_dep'],
        "dokrad_name" => $fulldokradname,
        "radiographer_name" => $fullradiographername,
        "operator" => $row['operator'],
        "updated_time" => $updated_time,
        "approve_date" => $approve1,
        "spendtime" => $spendtime
    ];
    $i++;
}

echo json_encode($data);
