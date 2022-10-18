<?php
require '../koneksi/koneksi.php';
require '../default-value.php';
$uid = $_POST['uid'];
$row = mysqli_fetch_assoc(mysqli_query(
    $conn_mppsio,
    "SELECT xray_order.uid, 
    xray_order.acc, 
    xray_order.patientid, 
    xray_order.mrn,
    xray_order.name,
    xray_order.address,
    xray_order.weight,
    xray_order.named,
    xray_order.dokrad_name,
    xray_order.priority,
    xray_order.pat_state,
    xray_order.spc_needs,
    xray_order.payment,
    xray_order.sex,
    xray_order.birth_date,
    xray_order.xray_type_code,
    xray_order.radiographer_name,
    xray_order.prosedur,
    xray_order.create_time,
    xray_order.schedule_date,
    xray_order.schedule_time,
    xray_order.fromorder,
    xray_order.deleted_at,
    mwl_item.sps_id, 
    mwl_item.study_iuid AS study_iuid_mppsio,
    study.study_iuid AS study_iuid_pacsio
    FROM $database_ris.xray_order AS xray_order
    LEFT JOIN mppsio.mwl_item AS mwl_item
    ON xray_order.uid = mwl_item.study_iuid
    LEFT JOIN pacsio.study AS study
    ON study.study_iuid = xray_order.uid
    WHERE xray_order.uid = '$uid'
    LIMIT 1"
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
                    <td>uid</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= $row['uid']; ?></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['name']) ?></td>
                </tr>
                <tr>
                    <td>MRN</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['mrn']); ?></td>
                </tr>
                <tr>
                    <td>id pasien</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['patientid']); ?></td>
                </tr>
                <tr>
                    <td>accession no</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['acc']); ?></td>
                </tr>
                <tr>
                    <td>tanggal lahir</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValueDate($row['birth_date']); ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['address']); ?></td>
                </tr>
                <tr>
                    <td>Berat Badan</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['weight']); ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['sex']); ?></td>
                </tr>
                <tr>
                    <td>Dokter Pengirim</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['named']); ?></td>
                </tr>
                <tr>
                    <td>Dokter Radiologi</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['dokrad_name']); ?></td>
                </tr>
                <tr>
                    <td>Priority</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['priority']); ?></td>
                </tr>
                <tr>
                    <td>Pelayanan Medis</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['pat_state']); ?></td>
                </tr>
                <tr>
                    <td>modality</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['xray_type_code']); ?></td>
                </tr>
                <tr>
                    <td>Waktu Pemeriksaan</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValueDateTime($row['schedule_date'] . ' ' . $row['schedule_time']); ?></td>
                </tr>
                <tr>
                    <td>nama radiografer</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['radiographer_name']); ?></td>
                </tr>
                <tr>
                    <td>Klinis</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['spc_needs']); ?></td>
                </tr>
                <tr>
                    <td>Pembayaran</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row['payment']); ?></td>
                </tr>
                <tr>
                    <td>waktu order</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValueDateTime($row['create_time']); ?></td>
                </tr>
            </thead>
        </table>
    </div>
</div>