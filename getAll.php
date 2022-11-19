<?php

require 'koneksi/koneksi.php';
require 'viewer-all.php';
require 'default-value.php';
require 'model/query-base-workload.php';
require 'model/query-base-order.php';
require 'model/query-base-study.php';
require 'model/query-base-patient.php';
require 'model/query-base-dokter-radiology.php';
session_start();

$username = $_SESSION['username'];

// kondisi jika ada di dicom.php
$row_dokrad = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT $select_dokter_radiology 
    FROM $table_dokter_radiology 
    WHERE username = '$username'"
));
$dokradid = $row_dokrad['dokradid'];
$http_referer = $_SERVER['HTTP_REFERER'] ?? '';
$explode = explode('/radiology', $http_referer);
$dicom = $explode[1] ?? '';
if ($dicom == '/dicom.php') {
    // (dicom.php) berdasarkan priority CITO, updated_time DESC
    // kondisi ketika bridging simrs status waiting dan dokradid simrs (xray_order)
    // OR kondisi pk_dokter_radiology is null (tidak integrasi simrs) dan ketika login dokter radiologi. 
    $kondisi = "WHERE (xray_workload.status = 'waiting' AND xray_order.dokradid = '$dokradid')
                OR (xray_order.dokradid IS NULL)
                ORDER BY xray_order.priority IS NULL, xray_order.priority ASC, study.study_datetime DESC 
                LIMIT 3000";
} else {
    // (getAll.php) kondisi
    $kondisi = 'ORDER BY study.study_datetime DESC LIMIT 1000';
}

$query = mysqli_query(
    $conn_pacsio,
    "SELECT 
    $select_patient,
    $select_study,
    $select_order,
    $select_workload
    FROM $table_patient
    JOIN $table_study
    ON patient.pk = study.patient_fk
    LEFT JOIN $table_order
    ON xray_order.uid = study.study_iuid
    LEFT JOIN $table_workload
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
    $study_datetime = defaultValueDateTime($row['study_datetime']);
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
    $dokradid = defaultValue($row['dokradid']);
    $create_time = defaultValueDateTime($row['create_time']);
    $pat_state = defaultValue($row['pat_state']);
    $priority = defaultValue($row['priority']);
    $spc_needs = defaultValue($row['spc_needs']);
    $payment = defaultValue($row['payment']);
    $fromorder = $row['fromorder'];
    $status = styleStatus($row['status']);
    $fill = $row['fill'];
    $approved_at = defaultValueDateTime($row['approved_at']);
    $spendtime = spendTime($study_datetime, $approved_at, $row['status']);
    $pk_dokter_radiology = $row['pk_dokter_radiology'];
    //kondisi status change doctor
    if ($row['status'] == 'approved') {
        $workloadstat = 'approved';
    } else {
        $workloadstat = 'waiting';
    }
    //kondisi status change doctor
    $detail = '<a href="#" class="hasil-all penawaran-a" data-id="' . $row['study_iuid'] . '">' . removeCharacter($pat_name) . '</a>';

    if ($fromorder == 'SIMRS' || $fromorder == 'simrs') {
        $badge = SIMRS;
    } else {
        $badge = '';
    }

    // kondisi ketika dokter belum ada menggunakan icon berbeda
    if ($fromorder == null && $pk_dokter_radiology == null) {
        $icon_change_doctor = CHANGEDOCTORICONNO;
    } else {
        $icon_change_doctor = CHANGEDOCTORICONYES;
    }

    // kondisi aksi jika ada dihalaman dicom.php
    if ($dicom == '/dicom.php') {
        // kondisi ketika xray_workload masuk dari trigger
        if ($status != '-') {
            // kondisi ketika pasien manual tetapi pk_dokter_radiologi null 
            if ($fromorder == null && $pk_dokter_radiology == null) {
                $aksi = '?';
            } else {
                // kondisi ketika pasien manual tetapi pk_dokter_radiologi sudah ada 
                if (!$fill || $fill == null) {
                    // ketika fill kosong muncul worklist
                    $worklist = WORKLISTFIRST . $study_iuid . WORKLISTLAST;
                } else {
                    // ketika worklist sudah dibaca muncul draft
                    $worklist = DRAFTFIRST . $study_iuid . DRAFTLAST;
                }

                $aksi = $worklist .
                    CHANGEDOCTORFIRST . $study_iuid . CHANGEDOCTORMID . $dokradid . CHANGEDOCTORSTAT . $workloadstat . CHANGEDOCTORLAST . $icon_change_doctor . CHANGEDOCTORVERYLAST;
            }
        } else {
            // kondisi ketika xray_workload TIDAK masuk dari trigger
            $aksi = '!TRIGGER!';
        }
    } else {
        $aksi = PDFFIRST . $study_iuid . PDFLAST .
            OHIFOLDFIRST . $study_iuid . OHIFOLDLAST;
    }

    // kondisi jika prioriry normal dan CITO
    if ($priority == 'Normal' || $priority == 'NORMAL' || $priority == 'normal') {
        $priority_style = PRIORITYNORMAL;
    } else if ($priority == 'Cito' || $priority == 'CITO' || $priority == 'cito') {
        $priority_style = PRIORITYCITO;
    } else {
        $priority_style = '';
    }

    // kondisi mencari ditabel dokter radiology
    $row_dokrad = mysqli_fetch_assoc(mysqli_query(
        $conn,
        "SELECT $select_dokter_radiology 
        FROM $table_dokter_radiology 
        WHERE pk = '$pk_dokter_radiology'"
    ));

    if ($row['status'] == 'waiting' || $row['status'] == '') {
        // jika status waiting kalo ada dokradid di xray_order tampilkan di xray_order
        $dokrad_name = defaultValue($row['dokrad_name']);
    } else if ($row['status'] == 'approved') {
        // jika status approved ambil data dari pk_dokter_radiology tabel xray_dokter_radiology
        $dokrad_name = defaultValue($row_dokrad['dokrad_fullname']);
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
        "study_datetime" => $study_datetime,
        "approve_date" => $approved_at,
        "spendtime" => $spendtime
    ];
    $i++;
}

echo json_encode($data);

mysqli_close($conn);
