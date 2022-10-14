<?php
require '../koneksi/koneksi.php';

@$study_iuid = $_POST['study_iuid'];

// $query = mysqli_query($conn, "SELECT * FROM xray_exam WHERE uid = '$uid' ");

session_start();

$query1 = "SELECT
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
INNER JOIN series ON series.study_fk = study.pk WHERE study_iuid = '$study_iuid'";
$pacs = mysqli_query($conn_pacs, $query1);
$row1 = mysqli_fetch_assoc($pacs);

$accession_no = $row1['accession_no'];
$pat_id = $row1['pat_id'];
$pat_name = $row1['pat_name'];
$pat_name1 = str_replace('^', ' ', $pat_name);
$pat_name1 = addslashes($pat_name1);
$pat_sex = $row1['pat_sex'];
$pat_birthdate = $row1['pat_birthdate'];
$mods_in_study = $row1['mods_in_study'];
$study_desc = $row1['study_desc'];
$ref_physician = $row1['ref_physician'];
$ref_physician1 = str_replace('^', ' ', $ref_physician);
$ref_physician1 = addslashes($ref_physician1);
$username = $_SESSION['username'];
$radiographer = mysqli_query($conn, "SELECT * FROM xray_radiographer WHERE username = '$username' ");
$row2 = mysqli_fetch_assoc($radiographer);
$radiographer_id = $row2['radiographer_id'];
$radiographer_name = addslashes($row2['radiographer_name']);
$radiographer_lastname = addslashes($row2['radiographer_lastname']);
$study_datetime = $row1['study_datetime'];
$updated_time = $row1['updated_time'];
$num_instances = $row1['num_instances'];
$num_series = $row1['num_series'];
$src_aet = $row1['src_aet'];
$pk = $row1['pk'];
$perf_physician = $row1['perf_physician'];
$perf_physician = str_replace('^', ' ', $perf_physician);
$perf_physician = addslashes($perf_physician);

if ($_SESSION['level'] == "radiographer") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title>About | Radiographer</title>
        <?php include('head.php'); ?>
    </head>


    <body>
    <?php include('sidebar.php'); ?>
    <div class="container-fluid" id="main">
        <div class="row">

            <div id="content1">
                <div class="container-fluid">
                    <div class="about-inti col-md-5 col-md-offset-3" style="background-color: #e1e1e1;">

                        <div class="work1" style="padding: 10px;height: auto;background-color: #1f69b7;color: #fff;font-weight: bold;">
                            <div class="col-md-6">
                                <table class="table-exam">
                                    <?php

                                    $bday = new DateTime($pat_birthdate);
                                    $today = new DateTime(date('y-m-d'));
                                    $diff = $today->diff($bday);
                                    ?>
                                    <tr>
                                        <td>Nama</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?= $pat_name1; ?></td>
                                    </tr>
                                    <tr>
                                        <td>No foto&nbsp;&nbsp;&nbsp;</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?= $pat_id; ?></td>
                                    </tr>
                                    <tr>
                                        <td>MRN</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?= $accession_no; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table-exam">
                                    <tr>
                                        <td>Age</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?= $diff->y . 'Y' . ' ' . $diff->m . 'M' . ' ' . $diff->d . 'D' ?></td>
                                    </tr>
                                    <tr>
                                        <td>Sex</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?= $pat_sex; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Prodecure&nbsp;&nbsp;&nbsp;</td>
                                        <td>&nbsp;:&nbsp;</td>
                                        <td><?= $study_desc; ?></td>
                                    </tr>

                                </table>
                            </div>
                        </div>


                        <form action="proses_exam.php" class="text-center border border-light p-5" method='post' style="padding: 10px;">
                            <input type="hidden" value="<?php echo $study_iuid; ?>" name="study_iuid">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Input KV
                                        <input style="height: 100px;" type="text" id="defaultContactFormName" class="form-control mb-4" name="kv" placeholder="INPUT KV">
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Input MaS
                                        <input style="height: 100px;" type="text" id="defaultContactFormName" class="form-control mb-4" name="mas" placeholder="INPUT MaS">
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Input Small Film
                                        <input style="height: 100px;" type="text" id="defaultContactFormName" class="form-control mb-4" name="filmsize8" placeholder="INPUT FILM SMALL">
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Input Medium Film
                                        <input style="height: 100px;" type="text" id="defaultContactFormName" class="form-control mb-4" name="filmsize10" placeholder="INPUT FILM MEDIUM">
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Film Small Reject
                                        <input style="height: 100px;" type="text" id="defaultContactFormName" class="form-control mb-4" name="filmreject8" placeholder="INPUT FILM SMALL REJECT">
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Film Medium Reject
                                        <input style="height: 100px;" type="text" id="defaultContactFormName" class="form-control mb-4" name="filmreject10" placeholder="INPUT FILM MEDIUM REJECT">
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <select style="font-size: 19px;" name="radiographer_name" id="defaultContactFormName">
                                        <option value="" selceted disable>Radiographer CR</option>
                                        <?php $query = mysqli_query($conn, "SELECT * FROM xray_radiographer");
                                        while ($row = mysqli_fetch_assoc($query)) { ?>

                                            <option value="<?= $row['radiographer_name']; ?>"><?= $row['radiographer_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">

                                    <select style="font-size: 19px;" name="operator" id="defaultContactFormName">
                                        <option value="" selceted disable>Radiographer 2</option>
                                        <?php $query = mysqli_query($conn, "SELECT * FROM xray_radiographer");
                                        while ($row = mysqli_fetch_assoc($query)) { ?>
                                            <option value="<?= $row['radiographer_name']; ?>"><?= $row['radiographer_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <textarea style="height: 100px;" type="text" id="defaultContactFormName" class="form-control mb-4" name="rephoto" placeholder="keterangan pengulangan foto.."></textarea>


                            <button class="btn btn-info btn-block btn-lg" type="submit" name="submit">INPUT</button>
                        </form>
                    </div>
                </div>
            </div>



            </div>       
    </div>

    <div class="footerindex">
        <div class="">
          <?php include('footer-itw.php'); ?>
        </div>
    </div>
        <?php include('script-footer.php'); ?>
    </body>

    </html>
<?php } else {
    header("location:../index.php");
} ?>