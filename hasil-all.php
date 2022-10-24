<?php
require 'koneksi/koneksi.php';
require 'default-value.php';
require 'model/query-base-workload.php';
require 'model/query-base-order.php';
require 'model/query-base-study.php';
require 'model/query-base-patient.php';
require 'model/query-base-dokter-radiology.php';

$uid = $_POST['uid'];
$row = mysqli_fetch_assoc(mysqli_query(
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
    WHERE study.study_iuid = '$uid'
    ORDER BY study.updated_time DESC"
));
$pat_name = defaultValue($row['pat_name']);
$pat_sex = styleSex($row['pat_sex']);
$pat_birthdate = defaultValueDate($row['pat_birthdate']);
$age = diffDate($row['pat_birthdate']);
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
$weight = defaultValue($row['weight']);
$no_foto = defaultValue($row['no_foto']);
$address = defaultValue($row['address']);
$name_dep = defaultValue($row['name_dep']);
$named = defaultValue($row['named']);
$contrast = defaultValue($row['contrast']);
$priority = defaultValue($row['priority']);
$priority_doctor = defaultValue($row['priority_doctor']);
$radiographer_name = defaultValue($row['radiographer_name']);
$create_time = defaultValueDateTime($row['create_time']);
$pat_state = defaultValue($row['pat_state']);
$spc_needs = defaultValue($row['spc_needs']);
$payment = defaultValue($row['payment']);
$status = styleStatus($row['status']);
$approved_at = defaultValueDateTime($row['approved_at']);
$spendtime = spendTime($updated_time, $approved_at, $row['status']);
$fromorder = $row['fromorder'];
$pk_dokter_radiology = $row['pk_dokter_radiology'];

// kondisi mencari ditabel dokter radiology
$row_dokrad = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT $select_dokter_radiology 
    FROM $table_dokter_radiology 
    WHERE pk = '$pk_dokter_radiology'"
));

if ($row['status'] == 'waiting') {
    // jika status waiting kalo ada dokradid di xray_order tampilkan di xray_order
    $dokrad_name = defaultValue($row['dokrad_name']);
} else if ($row['status'] == 'approved') {
    // jika status approved ambil data dari pk_dokter_radiology tabel xray_dokter_radiology
    $dokrad_name = defaultValue($row_dokrad['dokrad_fullname']);
}

?>
<style>
    .fill {
        padding: 10px;
    }
</style>
<div class="col justify-content-center text-center">
    <div class="row-12">
        <?php
        if ($fromorder == 'SIMRS' || $fromorder == 'simrs') { ?>
            <i class="fas fa-exchange-alt text-info" title="terintegrasi dengan SIMRS"></i>
        <?php } ?>
    </div>
</div>
<div class="fill">
    <div class="table-responsive-sm">
        <table class="" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
            <thead class="thead1">
                <tr>
                    <td>Study Iuid</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $study_iuid; ?></td>
                </tr>
                <tr>
                    <td>Accession No</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $accession_no; ?></td>
                </tr>
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
                    <td align="left">&nbsp; <?= $pat_id; ?></td>
                </tr>
                <tr>
                    <td>No Foto</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $no_foto; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $pat_birthdate; ?></td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $age; ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $pat_sex; ?></td>
                </tr>
                <tr>
                    <td>Berat Badan</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $weight; ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $address; ?></td>
                </tr>
                <tr>
                    <td>Contrast</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $contrast; ?></td>
                </tr>
                <tr>
                    <td>Prioritas Pasien (SIMRS)</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $priority; ?></td>
                </tr>
                <tr>
                    <td>Prioritas Pasien (Hasil)</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $priority_doctor; ?></td>
                </tr>
                <tr>
                    <td>Pemeriksaan Utama</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $study_desc; ?></td>
                </tr>
                <tr>
                    <td>Jumlah Series / Image</td>
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
                    <td>Pelayanan Medis</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $pat_state; ?></td>
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
                    <td>Klinis</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $spc_needs; ?></td>
                </tr>
                <tr>
                    <td>Pembayaran</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $payment; ?></td>
                </tr>
                <tr>
                    <td>Waktu Order</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $create_time; ?></td>
                </tr>
                <tr>
                    <td>Waktu Pemeriksaan</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $study_datetime; ?></td>
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