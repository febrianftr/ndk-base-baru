<?php

require '../koneksi/koneksi.php';

// -----------------mppsio------------------

$data_dicom3 = mysqli_query($conn_mppsio, "SELECT * FROM patient INNER JOIN mwl_item ON patient.pk = mwl_item.patient_fk ");
$data = [];
$i = 1;
while ($row = mysqli_fetch_array($data_dicom3)) {
    $pat_birthdate = $row['pat_birthdate'];
    $bday = new DateTime($pat_birthdate);
    $today = new DateTime(date('y-m-d'));
    $diff = $today->diff($bday);
    $pat_name = $row['pat_name'];
    $pat_name1 = preg_replace('/[^A-Za-z\ ]/', '', $pat_name);
    $perf_physician = $row['perf_physician'];
    $perf_physician1 = preg_replace('/[^A-Za-z\ ]/', '', $perf_physician);
    $pat_sex = $row['pat_sex'];
    if ($pat_sex == 'M') {
        $pat_sex1 = '<i style="color: blue;" class="fas fa-mars"></i> M';
    } else if ($pat_sex == 'F') {
        $pat_sex1 = '<i style="color: #ff637e;" class="fas fa-venus"></i> F';
    } else if ($pat_sex == 'O') {
        $pat_sex1 = '<i class="fas fa-genderless"></i> O';
    }
    $start_datetime = $row['start_datetime'];
    $startdatetime = date("d F Y", strtotime($start_datetime));
    $updated_time = $row['updated_time'];
    $updatedtime = date("d F Y", strtotime($updated_time));
    $created_time = $row['created_time'];
    $createdtime = date("d F Y", strtotime($created_time));
    $study_iuid = $row['study_iuid'];
    $data_dicom4 = mysqli_query($conn_pacs, "SELECT * FROM study WHERE study_iuid = '$study_iuid' ");
    $row1 = mysqli_fetch_assoc($data_dicom4);
    $study_iuid1 = $row1['study_iuid'];
    if (!$study_iuid1) {
        $data[] = [

            "no" => $i,
            "pat_id" => $row['pat_id'],
            "pat_name" => $pat_name1,
            "pat_birthdate" => $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D',
            "pat_sex" => $pat_sex1,
            "modality" => $row['modality'],
            "perf_physician" => $perf_physician1,
            "start_datetime" => $startdatetime,
            "updated_time" => $updatedtime,
            "created_time" => $createdtime,
            "action" => "<a class='btn-cancell' href='deletemwl.php?study_iuid=" . $study_iuid . "' onclick=\"return confirm('Teruskan Menghapus Data?');\">CANCEL</a>"
        ];
    } else {
        mysqli_query($conn_mppsio, "DELETE FROM mwl_item WHERE study_iuid = '$study_iuid1' ");
    }
    $i++;
}

echo json_encode($data);
