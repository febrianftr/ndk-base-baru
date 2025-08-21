<?php
require '../koneksi/koneksi.php';
require '../viewer-all.php';
require '../default-value.php';
require '../model/query-base-workload.php';
require '../model/query-base-order.php';
require '../model/query-base-study.php';
require '../model/query-base-patient.php';
require '../bahasa.php';

$pk_parent = $_POST['pk_parent'];
$pk_child = $_POST['pk_child'];
$study_iuid_parent = $_POST['study_iuid_parent'];

$is_study_series = $_POST['is_study_series'] == 'study' ? 'study' : 'series';

$row_study = mysqli_fetch_assoc(mysqli_query(
    $conn_pacsio,
    "SELECT 
    $select_patient,
    $select_study,
    $select_order,
    $select_workload
    FROM $table_patient
    JOIN $table_study
    ON patient.pk = study.patient_fk
    JOIN $table_workload
    ON study.study_iuid = xray_workload.uid
    LEFT JOIN $table_order
    ON xray_order.uid = study.study_iuid
    WHERE study.pk = '$pk_parent'"
));

?>
<style>
    .fill {
        padding: 50px;
    }
</style>
<div class="fill">
    <h5 class="text-center font-weight-bold">Copy <?= $is_study_series ?></h5>
    <div class="table-responsive-sm">
        <h6 class="font-weight-bold">Pasien Saat Ini</h6>
        <table class="" id="example" style="margin-top: 3px;" cellpadding="8" cellspacing="0">
            <thead class="thead1">
                <tr>
                    <td>Study Iuid</td>
                    <td>&nbsp;: </td>
                    <td align="left" class="font-weight-bold">&nbsp; <?= defaultValue($row_study['study_iuid']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['patient_name'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= removeCharacter($row_study['pat_name']); ?></td>
                </tr>
                <tr>
                    <td>MRN</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultValue($row_study['pat_id']); ?></td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td>&nbsp;: </td>
                    <td align="left">&nbsp; <?= defaultvalue(date("d-m-Y", strtotime($row_study['pat_birthdate']))); ?></td>
                </tr>
                <tr>
                    <td>Acc</td>
                    <td>&nbsp;: </td>
                    <td align="left" class="font-weight-bold">&nbsp; <?= defaultValue($row_study['acc']); ?></td>
                </tr>
                <tr>
                    <td>Modality</td>
                    <td>&nbsp;: </td>
                    <td align="left" class="font-weight-bold">&nbsp; <?= defaultValue($row_study['mods_in_study']); ?></td>
                </tr>
                <tr>
                    <td><?= $lang['study'] ?></td>
                    <td>&nbsp;: </td>
                    <td align="left" class="font-weight-bold">&nbsp; <?= defaultValue($row_study['study_desc_pacsio']); ?></td>
                </tr>
            </thead>
        </table>
    </div>
    <br>
    <table class="table-dicom" id="example-copy-image" border="0" cellpadding="8" cellspacing="0">
        <thead>
            <tr bgcolor=#CCCCCC>
                <th>No</th>
                <th>Action</th>
                <th style="width: 70px;">Status</th>
                <th><?= $lang['patient_name'] ?></th>
                <th>MRN</th>
                <th><?= $lang['date_birth'] ?></th>
                <th><?= $lang['sex'] ?></th>
                <th><?= $lang['modality'] ?></th>
                <th><?= $lang['study'] ?></th>
                <th>Accession No</th>
                <th><?= $lang['exam_date'] ?></th>
            </tr>
        </thead>
    </table>
    <br>
    <p>
</div>
<script>
    $(document).ready(function() {
        let a = $('#modal-copy-image #example-copy-image').DataTable({
            "ajax": {
                "url": "getCopyImage.php?pk_parent=<?= $pk_parent; ?>&pk_child=<?= $pk_child; ?>&study_iuid_parent=<?= $study_iuid_parent; ?>&is_study_series=<?= $is_study_series; ?>",
                "dataSrc": ""
            },
            "columns": [{
                    // "class": 'dt-control',
                    "data": "no"
                },
                {
                    "data": "action"
                },
                {
                    "data": "status"
                },
                {
                    "data": "pat_name"
                },
                {
                    "data": "pat_id"
                },
                {
                    "data": "pat_birthdate"
                },
                {
                    "data": "pat_sex"
                },
                {
                    "data": "mods_in_study"
                },
                {
                    "data": "study_desc"
                },
                {
                    "data": "accession_no"
                },
                {
                    "data": "study_datetime"
                },
            ]
        });
    });
</script>