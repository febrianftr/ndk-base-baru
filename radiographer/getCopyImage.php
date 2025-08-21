<?php
require '../koneksi/koneksi.php';
require '../default-value.php';
require '../model/query-base-order.php';
require '../model/query-base-study.php';
require '../model/query-base-patient.php';
require '../model/query-base-workload.php';
require '../viewer-all.php';
require '../date-time-zone.php';
$i = 1;
$pk_parent = $_GET['pk_parent'];
$pk_child = $_GET['pk_child'];
$study_iuid_parent = $_GET['study_iuid_parent'];

$is_study_series = $_GET['is_study_series'] == 'study' ? 'study' : 'series';

$query = mysqli_query(
    $conn,
    "SELECT 
    study.pk AS pk_study,
    patient.pk AS pk_patient,
    pat_id,
    pat_name,
    pat_sex,
    pat_birthdate,
    study_iuid,
    study_datetime,
    mods_in_study,
    study.accession_no,
    study_desc,
    study.updated_time,
    fromorder,
    priority,
    status
    FROM $table_patient
    LEFT JOIN $table_study
    ON patient.pk = study.patient_fk
    JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
    LEFT JOIN $table_order
    ON xray_order.uid = xray_workload.uid
    ORDER BY study.study_datetime DESC
    LIMIT 1500"
);
while ($row = mysqli_fetch_assoc($query)) {
    $study_iuid = defaultValue($row['study_iuid']);
    $pk_study_copy = defaultValue($row['pk_study']);
    $pk_patient_copy = defaultValue($row['pk_patient']);
    $pat_name = defaultValue($row['pat_name']);
    $pat_id = defaultValue($row['pat_id']);
    // $no_foto = defaultValue($row['no_foto']);
    $accession_no = defaultValue($row['accession_no']);
    $mods_in_study = defaultValue($row['mods_in_study']);
    $pat_sex = styleSex($row['pat_sex']);
    $pat_birthdate = diffDate($row['pat_birthdate']);
    $study_desc = defaultValue($row['study_desc']);
    $study_datetime = defaultValueDateTime($row['study_datetime']);
    $status = styleStatus($row['status'], $study_iuid);
    $priority = defaultValue($row['priority']);
    $fromorder = $row['fromorder'];
    // kondisi ketika data dari simrs
    if ($fromorder == 'SIMRS' || $fromorder == 'simrs') {
        $badge = SIMRS;
    } else {
        $badge = '';
    }

    // kondisi jika prioriry normal dan CITO
    if ($priority == 'Normal' || $priority == 'NORMAL' || $priority == 'normal') {
        $priority_style = PRIORITYNORMAL;
    } else if ($priority == 'Cito' || $priority == 'CITO' || $priority == 'cito') {
        $priority_style = PRIORITYCITO;
    } else {
        $priority_style = '';
    }

    $detail = '<div class="penawaran-a" data-id="' . $row['study_iuid'] . '">' . removeCharacter(mb_convert_encoding($pat_name, 'UTF-8', 'ISO-8859-1')) . '</div>';

    $name_attr = $is_study_series == 'study' ? "name='save_copy_study'" : "name='save_copy_series'";
    $button = "<input type='hidden' name='copy' value='$pk_study_copy'>
        <input type='hidden' name='current' value='$pk_child'>
        <input type='hidden' name='study_iuid_current' value='$study_iuid_parent'>
        <input type='hidden' name='study_iuid_copy' value='$study_iuid'>
        <button type='submit' $name_attr style='width: 100%;margin: 0;padding: 5px 5px; font-size:12px;background-color: #fff;color: #3443eb;border: 2px solid #3443eb;border-radius: 7px;' class='ahref-edit btn btn-sm btn-delete-study' onclick=\"return confirm('Are you sure copy?');\">Copy $is_study_series</button>";

    $data[] = [
        "no" => $i,
        "action" => "<form method='POST' action='#'>$button</form>",
        "accession_no" => $accession_no,
        "status" => $status . '&nbsp;' . $badge,
        "pat_name" => $detail . '&nbsp;' . $priority_style,
        "pat_id" => $pat_id,
        "pat_birthdate" => $pat_birthdate,
        "pat_sex" => $pat_sex,
        "mods_in_study" => $mods_in_study,
        "study_desc" => $study_desc,
        "study_datetime" => $study_datetime,
    ];
    $i++;
}

echo json_encode($data);

mysqli_close($conn);
