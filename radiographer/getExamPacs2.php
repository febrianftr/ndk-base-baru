<?php

require '../koneksi/koneksi.php';

$pacs = mysqli_query($conn_pacs, "SELECT
study.patient_fk,
series.study_fk,
patient.merge_fk,
patient.pat_id,
patient.pat_id_issuer,
patient.pat_name,
patient.pat_fn_sx,
patient.pat_gn_sx,
patient.pat_i_name,
patient.pat_p_name,
patient.pat_birthdate,
patient.pat_sex,
patient.pat_custom1,
patient.pat_custom2,
patient.pat_custom3,
patient.created_time,
patient.pat_attrs,
study.pk,
study.accno_issuer_fk,
study.study_iuid,
study.study_id,
study.study_datetime,
study.accession_no,
study.ref_physician,
study.ref_phys_fn_sx,
study.ref_phys_gn_sx,
study.ref_phys_i_name,
study.ref_phys_p_name,
study.study_desc,
study.study_custom1,
study.study_custom2,
study.study_custom3,
study.study_status_id,
study.mods_in_study,
study.cuids_in_study,
study.num_series,
study.num_instances,
study.ext_retr_aet,
study.retrieve_aets,
study.fileset_iuid,
study.fileset_id,
study.availability,
study.study_status,
study.checked_time,
study.updated_time,
study.created_time,
study.study_attrs,
study.chargeId,
study.totalCharge,
study.billId,
study.invoiceNo,
study.batchNo,
study.img,
study.fill,
study.del,
series.mpps_fk,
series.inst_code_fk,
series.series_iuid,
series.series_no,
series.modality,
series.body_part,
series.laterality,
series.series_desc,
series.institution,
series.station_name,
series.department,
series.perf_physician,
series.perf_phys_fn_sx,
series.perf_phys_gn_sx,
series.perf_phys_i_name,
series.perf_phys_p_name,
series.pps_start,
series.pps_iuid,
series.series_custom1,
series.series_custom2,
series.series_custom3,
series.src_aet,
series.ext_retr_aet,
series.retrieve_aets,
series.fileset_iuid,
series.fileset_id,
series.availability,
series.series_status,
series.created_time,
series.series_attrs,
series.content_time
FROM
patient
INNER JOIN study ON study.patient_fk = patient.pk
INNER JOIN series ON series.study_fk = study.pk ORDER BY study.study_datetime DESC LIMIT 300");

$data = [];
$i = 1;
while ($row1 = mysqli_fetch_array($pacs)) {
    $study_iuid = $row1['study_iuid'];
    $del = $row1['del'];
    $pat_birthdate = $row1['pat_birthdate'];
    $bday = new DateTime($pat_birthdate);
    $today = new DateTime(date('y-m-d'));
    $diff = $today->diff($bday);
    $pat_sex = $row1['pat_sex'];
	if ($pat_sex == 'M') {
        $pat_sex1 = '<i style="color: blue;" class="fas fa-mars"></i> M';
    } else if ($pat_sex == 'L') {
        $pat_sex1 = '<i style="color: blue;" class="fas fa-mars"></i> L';
    } else if ($pat_sex == 'P') {
        $pat_sex1 = '<i style="color: #ff637e;" class="fas fa-venus"></i> P';
    } else if ($pat_sex == 'F') {
        $pat_sex1 = '<i style="color: #ff637e;" class="fas fa-venus"></i> F';
    } else if ($pat_sex == 'O') {
        $pat_sex1 = '<i class="fas fa-genderless"></i> O';
    } else {$pat_sex1 = '.';}
    $pat_name = $row1['pat_name'];
    $pat_name1 = str_replace("^", " ", $pat_name);
    $ref_physician = $row1['ref_physician'];
    $ref_physician1 = str_replace("^", " ", $ref_physician);
    $data_dicom4 = mysqli_query($conn, "SELECT * FROM xray_workload_radiographer WHERE uid = '$study_iuid' ");
    $row3 = mysqli_fetch_assoc($data_dicom4);
    $uid1 = $row3['uid'];
    $pk = $row1['pk'];
    $pacs1 = mysqli_query($conn_pacs, "SELECT * FROM series INNER JOIN study ON series.study_fk = study.pk WHERE study_fk = '$pk'");

    $data_dicom5 = mysqli_query($conn, "SELECT * FROM xray_exam2 WHERE uid = '$study_iuid' ");
    $row4 = mysqli_fetch_assoc($data_dicom5);
    $uid2 = $row4['uid'];

    $data_dicom6 = mysqli_query($conn, "SELECT * FROM xray_exam WHERE uid = '$study_iuid' ");
    $row5 = mysqli_fetch_assoc($data_dicom6);
    $uid3 = $row5['uid'];

    $btnexam = "<form id=order name=order method=post action='proses_before_exam2.php'>
        <input name='study_iuid' type='hidden' id='study_iuid' value='" . $row1['study_iuid'] . "'>
        <button class='btn-ex' type='submit' name='button' id='button' value='Create Order'>END EXAM
    </form>";
    if (!$del) {
        if (!$uid3) {
            if (!$uid1 and !$uid2) {
                $data[] = [
                    "no" => $i,
                    "pat_id" => $row1['pat_id'],
                    "pat_name" => $pat_name1,
                    "pat_birthdate" => $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D',
                    "pat_sex" => $pat_sex1,
                    "mods_in_study" => $row1['mods_in_study'],
                    "study_desc" => $row1['study_desc'],
                    "ref_physician" => $ref_physician1,
                    "study_datetime" => $row1['study_datetime'],
                    "action" => $btnexam
                ];
            }
        }
    }
    $i++;
}

echo json_encode($data);
