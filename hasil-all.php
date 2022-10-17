<?php
require 'koneksi/koneksi.php';
require 'default-value.php';

$uid = $_POST['uid'];
$row = mysqli_fetch_assoc(mysqli_query(
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
	WHERE study.study_iuid = '$uid'
    ORDER BY study.updated_time DESC"
));
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
$mrn = defaultValue($row['mrn']);
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
?>
<style>
    .fill {
        padding: 10px;
    }
</style>

<div class="fill">
    <div class="table-responsive-sm">
        <table class="" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
            <thead class="thead1">
                <tr>
                    <td>Status</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $status; ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= removeCharacter($pat_name); ?></td>
                </tr>
                <tr>
                    <td>MRN</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $mrn; ?></td>
                </tr>
                <tr>
                    <td>No Foto</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $no_foto; ?></td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $pat_birthdate; ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $pat_sex; ?></td>
                </tr>
                <tr>
                    <td>Pemeriksaan Utama</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $study_desc; ?></td>
                </tr>
                <tr>
                    <td>#S / #I</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $num_series . ' / ' . $num_instances; ?></td>
                </tr>
                <tr>
                    <td>Modality</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $mods_in_study; ?></td>
                </tr>
                <tr>
                    <td>Dokter Pengirim</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $named; ?></td>
                </tr>
                <tr>
                    <td>Poli</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $name_dep; ?></td>
                </tr>
                <tr>
                    <td>Dokter Radiologi</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $dokrad_name; ?></td>
                </tr>
                <tr>
                    <td>Nama Radiografer</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $radiographer_name; ?></td>
                </tr>
                <tr>
                    <td>Waktu Selesai Pemeriksaan</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $updated_time; ?></td>
                </tr>
                <tr>
                    <td>Waktu Selesai Dibaca</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $approved_at; ?></td>
                </tr>
                <tr>
                    <td>Waktu Tunggu</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $spendtime; ?></td>
                </tr>
            </thead>
        </table>
    </div>
</div>