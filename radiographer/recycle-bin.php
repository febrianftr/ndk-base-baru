<?php
require '../koneksi/koneksi.php';
require '../viewer-all.php';
require '../default-value.php';
require '../model/query-base-priv-study.php';
require '../model/query-base-priv-patient.php';
require '../js/proses/function.php';
include "../bahasa.php";
session_start();

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

if (isset($_POST["send_wado"])) {
    try {
        $client = new Client([
            'base_uri' => "http://$_SERVER[SERVER_ADDR]:19898",
        ]);

        $data = [
            'auth' => ['admin', 'efotoadmin'],
            'form_params' => [
                "methodIndex" => $_POST["methodIndex"],
                "action" => "invokeOp",
                "name" => "dcm4chee.archive:service=ContentEditService",
                "arg0" => $_POST["pk"]
            ],
            'http_errors' => false
        ];

        $response = $client->request('POST', '/jmx-console/HtmlAdaptor', $data);
        $body = $response->getBody();
        $data = json_decode($body, true);

        echo "<script>
                alert('WADO Success');
            </script>";
    } catch (GuzzleHttp\Exception\GuzzleException $th) {
        echo "<script>
                alert('WADO (koneksi down)');
            </script>";
    }
}

// --------------------------------

if ($_SESSION['level'] == "radiographer") {
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html>

    <head>
        <title>Recycle Bin | Radiographer</title>
        <?php include('head.php'); ?>
        <style>
            @media only screen and (max-width: 800px) {
                .menu-size2 {
                    visibility: hidden;
                }
            }

            @media only screen and (max-width: 768px) {
                .footerindex {
                    position: fixed;
                }
            }
        </style>
    </head>

    <body>
        <?php include('../sidebar-index.php'); ?>
        <div class="container-fluid" id="main">
            <div class="row">
                <div class="col-12" style="padding: 0;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Recycle Bin</li>
                        </ol>
                    </nav>
                </div>
                <div class="table-view">
                    <h3 class="text-center">Recycle Bin</h3>
                    <hr>
                    <div class="col-md-12 table-box" style="overflow-x:auto;">
                        <table class="table-dicom" id="purchase_order" cellpadding="8" cellspacing="0">
                            <thead class="thead1">
                                <tr>
                                    <td>Restore</td>
                                    <td>Patient Name</td>
                                    <td>MRN</td>
                                    <td>Study Iuid</td>
                                    <td>Accession No</td>
                                    <td>Delete</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = mysqli_query(
                                    $conn_pacsio,
                                    "SELECT 
                                $select_priv_patient,
                                $select_priv_study
                                FROM $table_priv_patient
                                LEFT JOIN $table_priv_study
                                ON priv_patient.pk = priv_study.patient_fk ORDER BY priv_study.pk DESC"
                                );

                                if (mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $pk_priv_patient = $row['pk_priv_patient'];
                                        $pk_priv_study = $row['pk_priv_study'];
                                        $patient_fk = $row['patient_fk'];
                                        $pat_name = defaultValue(removeCharacter($row['pat_name']));
                                        $pat_id = defaultValue($row['pat_id']);
                                        $pat_id_issuer = defaultValue($row['pat_id_issuer']);
                                        $study_iuid = defaultValue($row['study_iuid']);
                                        $accession_no = defaultValue($row['accession_no']);
                                ?>
                                        <tr>
                                            <td>
                                                <form method="POST" action="#">
                                                    <input type="hidden" name="pk" value="<?= $pk_priv_study; ?>">
                                                    <input type="hidden" name="methodIndex" value="21">
                                                    <button class="ahref-edit" name="send_wado" style="text-decoration:none;" onclick="return confirm('Are you sure restore?');">
                                                        RESTORE
                                                        <!-- <span class="btn red lighten-1 btn-intiwid1"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i></span> -->
                                                    </button>
                                                </form>
                                            </td>
                                            <td><?= $pat_name ?></td>
                                            <td><?= $pat_id ?></td>
                                            <td><?= $study_iuid ?></td>
                                            <td><?= $accession_no ?></td>
                                            <td>
                                                <form method="POST" action="#">
                                                    <input type="hidden" name="pk" value="<?= $pk_priv_study; ?>">
                                                    <input type="hidden" name="methodIndex" value="25">
                                                    <button class="ahref-edit" name="send_wado" style="text-decoration:none;" onclick="return confirm('Are you sure delete?');">
                                                        DELETE
                                                        <!-- <span class="btn red lighten-1 btn-intiwid1"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i></span> -->
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="10">Data Tidak Ada</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/3.1.1/jquery.min.js"></script>
        <script src="../js/proses/workload-fill-detail.js?v=<?= $random; ?>"></script>
        <br><br>
        <div class="footerindex">
            <div class="">
                <?php include('footer-itw.php'); ?>
            </div>
        </div>
        <?php include('script-footer.php'); ?>
    </body>

    </html>
    <script>
        $(document).ready(function() {
            $("li[id='recycle-bin']").addClass("active");
            $("li[id='recycle-bin'] a i").css('color', '#bdbdbd');
        });
    </script>
<?php } else {
    header("location:../index.php");
} ?>