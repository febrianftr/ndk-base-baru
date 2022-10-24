<?php
require '../koneksi/koneksi.php';
require '../default-value.php';
require '../model/query-base-mwl-item.php';

$uid = $_POST['uid'];
$row = mysqli_fetch_assoc(mysqli_query(
    $conn_mppsio,
    "SELECT pat_name, 
    pat_sex, 
    pat_id,
    pat_birthdate, 
    accession_no, 
    modality, 
    start_datetime, 
    $select_mwl_item
    FROM $table_mwl_item
    JOIN patient
    ON mwl_item.patient_fk = patient.pk
    WHERE mwl_item.study_iuid = '$uid'
    ORDER BY patient.created_time DESC"
));
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
                    <td>study iuid</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['study_iuid_mppsio']); ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= str_replace('^^^^', '', defaultValue($row['pat_name'])); ?></td>
                </tr>
                <tr>
                    <td>id pasien</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['pat_id']); ?></td>
                </tr>
                <tr>
                    <td>accession no</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['accession_no']); ?></td>
                </tr>
                <tr>
                    <td>tanggal lahir</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValueDate($row['pat_birthdate']); ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['pat_sex']); ?></td>
                </tr>
                <tr>
                    <td>modality</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['modality']); ?></td>
                </tr>
                <tr>
                    <td>sps id</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['sps_id']); ?></td>
                </tr>
                <tr>
                    <td>req proc id</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['req_proc_id']); ?></td>
                </tr>
                <tr>
                    <td>Waktu Pemeriksaan</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValueDateTime($row['start_datetime']); ?></td>
                </tr>
                <tr>
                    <td>station aet</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['station_aet']); ?></td>
                </tr>
                <tr>
                    <td>nama radiografer</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $row['perf_physician'] == '^^^^' ? '-' : str_replace('^^^^', '', $row['perf_physician']); ?></td>
                </tr>
                <tr>
                    <td>waktu order</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValueDateTime($row['created_time']); ?></td>
                </tr>
            </thead>
        </table>
    </div>
</div>