<?php

require 'koneksi/koneksi.php';

require 'viewer-all.php';

require 'default-value.php';

session_start();

$username = $_SESSION['username'];

// kondisi jika ada di dicom.php
$row_dokrad = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT * FROM xray_dokter_radiology WHERE username = '$username'"
));
$dokradid = $row_dokrad['dokradid'];
$http_referer = $_SERVER['HTTP_REFERER'] ?? '';
$explode = explode('/radiology', $http_referer);
$dicom = $explode[1] ?? '';
if ($dicom == '/dicom.php') {
    // (dicom.php) kondisi ketika dokradid is null (tidak integrasi simrs) dan ketika login dokter radiologi. berdasarkan priority CITO, updated_time DESC
    $kondisi = "WHERE xray_workload.status = 'waiting' 
                AND xray_order.dokradid = '$dokradid' 
                OR xray_order.dokradid IS NULL 
                ORDER BY xray_order.priority IS NULL, xray_order.priority ASC, study.updated_time DESC 
                LIMIT 3000";
} else {
    // (getAll.php) kondisi
    $kondisi = 'ORDER BY study.updated_time DESC LIMIT 1000';
}

$query = mysqli_query(
    $conn_pacsio,
    "SELECT patient.pat_id, 
    patient.pat_name, 
    patient.pat_birthdate, 
    patient.pat_sex,
    study.study_iuid,
    study.study_datetime,
    study.accession_no,
    study.ref_physician,
    study.study_desc,
    study.mods_in_study,
    study.num_series,
    study.num_instances,
    study.retrieve_aets,
    study.updated_time,
    xray_order.mrn,
    xray_order.address,
    xray_order.name_dep,
    xray_order.named,
    xray_order.radiographer_name,
    xray_order.dokrad_name,
    xray_order.create_time,
    xray_order.priority,
    xray_order.pat_state,
    xray_order.spc_needs,
    xray_order.payment,
    xray_order.examed_at,
    xray_order.fromorder,
    xray_order.patientid AS no_foto,
    xray_workload.status,
    xray_workload.fill,
    xray_workload.approved_at
    FROM $database_pacsio.patient AS patient
    JOIN $database_pacsio.study AS study
    ON patient.pk = study.patient_fk
    LEFT JOIN $database_ris.xray_order AS xray_order
    ON xray_order.uid = study.study_iuid
    LEFT JOIN $database_ris.xray_workload AS xray_workload
    ON study.study_iuid = xray_workload.uid
    $kondisi"
);
$data = [];
$i = 1;
while ($row = mysqli_fetch_array($query)) {
    $pat_name = defaultValue($row['pat_name']);
    $pat_sex = styleSex($row['pat_sex']);
    $pat_birthdate = diffDate($row['pat_birthdate']);
    $study_iuid = defaultValue($row['study_iuid']);
    $study_datetime = defaultValue($row['study_datetime']);
    $accession_no = defaultValue($row['accession_no']);
    $ref_physician = defaultValue($row['ref_physician']);
    $study_desc = defaultValue($row['study_desc']);
    $mods_in_study = defaultValue($row['mods_in_study']);
    $num_series = defaultValue($row['num_series']);
    $num_instances = defaultValue($row['num_instances']);
    $updated_time = defaultValueDateTime($row['updated_time']);
    $pat_id = defaultValue($row['pat_id']);
    $no_foto = defaultValue($row['no_foto']);
    $address = defaultValue($row['address']);
    $name_dep = defaultValue($row['name_dep']);
    $named = defaultValue($row['named']);
    $radiographer_name = defaultValue($row['radiographer_name']);
    $dokrad_name = defaultValue($row['dokrad_name']);
    $create_time = defaultValueDateTime($row['create_time']);
    $pat_state = defaultValue($row['pat_state']);
    $priority = defaultValue($row['priority']);
    $spc_needs = defaultValue($row['spc_needs']);
    $payment = defaultValue($row['payment']);
    $fromorder = $row['fromorder'];
    $status = styleStatus($row['status']);
    $fill = $row['fill'];
    $approved_at = defaultValueDateTime($row['approved_at']);
    $spendtime = spendTime($updated_time, $approved_at, $row['status']);

    $detail = '<a href="#" class="hasil-all penawaran-a" data-id="' . $row['study_iuid'] . '">' . removeCharacter($pat_name) . '</a>';

    if ($fromorder == 'SIMRS' || $fromorder == 'simrs') {
        $badge = SIMRS;
    } else {
        $badge = '';
    }

    // kondisi aksi jika ada dihalaman dicom.php
    if ($dicom == '/dicom.php') {
        // ketika fill kosong muncul worklist, dan ketika worklist sudah dibaca muncul draft
        if (!$fill || $fill == null) {
            $worklist = WORKLISTFIRST . $study_iuid . WORKLISTLAST;
        } else {
            $worklist = DRAFTFIRST . $study_iuid . DRAFTLAST;
        }

        $aksi = $worklist .
            CHANGEDOCTORFIRST . $study_iuid . CHANGEDOCTORLAST;
    } else {
        $aksi = PDFFIRST . $study_iuid . PDFLAST .
            RADIANTFIRST . $study_iuid . RADIANTLAST .
            DICOMFIRST . $study_iuid . DICOMLAST;
    }

    // kondisi jika prioriry normal dan CITO
    if ($priority == 'Normal' || $priority == 'NORMAL' || $priority == 'normal') {
        $priority_style = PRIORITYNORMAL;
    } else if ($priority == 'Cito' || $priority == 'CITO' || $priority == 'cito') {
        $priority_style = PRIORITYCITO;
    } else {
        $priority_style = '';
    }

    $data[] = [
        "no" => $i,
        "report" => $aksi,
        "status" => $status . '&nbsp;' . $badge,
        "pat_name" => $detail . '&nbsp;' . $priority_style,
        "mrn" => $pat_id,
        "no_foto" => $no_foto,
        "pat_birthdate" => $pat_birthdate,
        "pat_sex" => $pat_sex,
        "study_desc" => $study_desc,
        "series_desc" => READMORESERIESFIRST . $study_iuid . READMORESERIESLAST,
        "num_series" => $num_series . ' / ' . $num_instances,
        "mods_in_study" => $mods_in_study,
        "named" => $named,
        "name_dep" => $name_dep,
        "dokrad_name" => $dokrad_name,
        "radiographer_name" => $radiographer_name,
        "updated_time" => $updated_time,
        "approve_date" => $approved_at,
        "spendtime" => $spendtime
    ];
    $i++;
}

echo json_encode($data);
