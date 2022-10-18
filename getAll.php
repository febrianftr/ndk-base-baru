<?php

require 'koneksi/koneksi.php';

require 'viewer-all.php';

require 'default-value.php';

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
    xray_order.pat_state,
    xray_order.spc_needs,
    xray_order.payment,
    xray_order.examed_at,
    xray_order.patientid AS no_foto,
    xray_workload.status,
    xray_workload.approved_at
    FROM $database_pacsio.patient AS patient
    JOIN $database_pacsio.study AS study
    ON patient.pk = study.patient_fk
    LEFT JOIN $database_ris.xray_order AS xray_order
    ON xray_order.uid = study.study_iuid
    LEFT JOIN $database_ris.xray_workload AS xray_workload
    ON study.study_iuid = xray_workload.uid
    ORDER BY study.updated_time DESC 
    LIMIT 1000"
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
    $spc_needs = defaultValue($row['spc_needs']);
    $payment = defaultValue($row['payment']);
    $status = styleStatus($row['status']);
    $approved_at = defaultValueDateTime($row['approved_at']);
    $spendtime = spendTime($updated_time, $approved_at, $row['status']);

    $data[] = [
        "no" => $i,
        "report" =>
        PDFFIRST . $study_iuid . PDFLAST .
            RADIANTFIRST . $study_iuid . RADIANTLAST .
            DICOMFIRST . $study_iuid . DICOMLAST,
        "status" => $status,
        "no_foto" => $no_foto,
        "mrn" => $pat_id,
        "pat_name" => removeCharacter($pat_name),
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
