<?php
require '../koneksi/koneksi.php';
require '../default-value.php';
require '../model/query-base-study.php';
require '../model/query-base-patient.php';
require '../model/query-base-workload.php';
require '../model/query-base-series.php';
require '../model/query-base-instance.php';
require '../model/query-base-order.php';
require '../model/query-base-dokter-radiology.php';
require __DIR__ . '/vendor/autoload.php';

session_start();
$uid = $_GET['uid'];
$ipLokal = "127.0.0.1";
$ipDirect = $_SERVER['SERVER_NAME'];

use GuzzleHttp\Client;

try {
    $client_validation = new Client();

    $link_dicom = "http://$ipLokal:9090/dcm4chee-arc/aets/DCM4CHEE/rs/studies/$uid/series";
    // $link_dicom = "http://118.99.77.50:9090/dcm4chee-arc/aets/DCM4CHEE/rs/studies/1.3.12.2.1107.5.1.7.106949.30000024042307531537400000008/series";

    $response_validation = $client_validation->request(
        "GET",
        $link_dicom,
    );

    if ($response_validation->getStatusCode() == 204) {
        echo "<script>
        alert('Data tidak ditemukan');
        window.history.go(-1);
        </script>";
        exit;
    }
} catch (\Throwable $th) {
    echo "<script>
            alert('(validasi koneksi down)');
            window.history.go(-1);
        </script>";
}

$hostname = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM xray_hostname_publik"));

$row = mysqli_fetch_assoc(mysqli_query(
    $conn_pacsio,
    "SELECT 
	pat_id,
	pat_name,
	pat_sex,
	study_desc,
	mods_in_study,
	accession_no,
    study.num_series,
	study.pk as pk_study
	FROM $table_patient
	JOIN $table_study
	ON patient.pk = study.patient_fk
	WHERE study_iuid = '$uid'"
));

$pat_name = defaultValue($row['pat_name']);
$pat_id = defaultValue($row['pat_id']);
$pat_sex = styleSex($row['pat_sex']);
$mods_in_study = defaultValue($row['mods_in_study']);
$study_desc = defaultValue($row['study_desc']);
$num_series = defaultValue($row['num_series']);
$acc = defaultValue($row['accession_no']);
$pk_study = defaultValue($row['pk_study']);
$server_name = $_SERVER['SERVER_NAME'];

if (isset($_POST['expertise_image_pdf']) || isset($_POST['image_pdf']) || isset($_POST['image_jpg']) || isset($_POST['image_dicom'])) {
    $series_iuids = isset($_POST["series_iuid"]) ? $_POST["series_iuid"] : [];
    $uid = $_POST["uid"];
    $series_iuid = implode(",", $series_iuids);
    if ($series_iuid == "" || $series_iuid == NULL) {
        echo "<script>alert('Pilih salah satu series')</script>";
    } else {
        if (isset($_POST['expertise_image_pdf'])) {
            header("location:../radiology/pdf/pdf-expertise-image.php?uid=$uid&series_iuid=$series_iuid");
        } else if (isset($_POST['image_pdf'])) {
            header("location:../radiology/pdf/pdf-image.php?uid=$uid&series_iuid=$series_iuid");
        } else if (isset($_POST['image_jpg'])) {
            $client = new Client();

            $zip = new ZipArchive;

            # create a temp file & open it
            $tmp_file = tempnam('.', '');

            //Opening/Create a new zip archive
            if ($zip->open($tmp_file, ZipArchive::CREATE) !== TRUE) {
                die("Can't open {$tmp_file} file.");
            }
            try {
                foreach ($series_iuids as $index => $series_iuid) {
                    // menampilkan series
                    $row_study_series = mysqli_fetch_assoc(mysqli_query(
                        $conn_pacsio,
                        "SELECT
                        $select_series
                        FROM $table_series
                        WHERE series.series_iuid = '$series_iuid' AND modality NOT IN('SR')"
                    ));
                    $pk_series = $row_study_series["pk_series"];

                    // menampilkan instance
                    $series_instance = mysqli_query(
                        $conn_pacsio,
                        "SELECT
                        $select_instance
                        FROM $table_instance
                        WHERE series_fk = '$pk_series'"
                    );

                    while ($row_series_instance = mysqli_fetch_assoc($series_instance)) {
                        $sop_iuid = $row_series_instance["sop_iuid"];
                        $link_dicom_jpg = "http://$ipLokal:9090/dcm4chee-arc/aets/DCM4CHEE/wado?requestType=WADO&studyUID=$uid&seriesUID=$series_iuid&objectUID=$sop_iuid";
                        // $link_dicom_jpg = "http://118.99.77.50:9090/dcm4chee-arc/aets/DCM4CHEE/wado?requestType=WADO&studyUID=1.3.12.2.1107.5.1.7.106949.30000024042307531537400000008";

                        // $dir = "C:\Users\akses\Downloads\\$pat_name_filter $study_datetime_filter\\$uid\\$series_iuid";
                        // if (!file_exists($dir)) {
                        //     mkdir($dir, 0777, true);
                        // }

                        $response = $client->request(
                            "GET",
                            $link_dicom_jpg,
                            // ["sink" => "$dir\\$sop_iuid.jpg"]
                        );
                        $content = $response->getBody()->getContents();
                        $zip->addFromString($uid . "/" . $series_iuid . "/" . $sop_iuid . ".jpg", $content);
                    }
                }

                $zip->close();

                //Force to download the created zip file .
                $name = trim(removeCharacter(preg_replace('/[^a-zA-Z\s]/', '', $pat_name)));
                header("Content-type: application/zip");
                header("Content-Disposition: attachment; filename=$name-$pat_id.zip");
                header("Pragma: no-cache");
                header("Expires: 0");
                readfile($tmp_file);
                unlink($tmp_file);
            } catch (GuzzleHttp\Exception\GuzzleException $th) {
                $zip->close();
                readfile($tmp_file);
                unlink($tmp_file);
                echo "<script>
                        alert('(koneksi down)');
                        window.close();
                    </script>";
            }
        } else if (isset($_POST['image_dicom'])) {
            // ketika pilih semua series maka download by study
            if (count($series_iuids) >= $num_series) {
                $kondisi = "";
            } else if (count($series_iuids) == 1) {
                // ketika pilih satu series maka download by series
                $kondisi = "series/" . $series_iuids[0];
            }

            $link_dicom_jpg = "http://$ipDirect:9090/dcm4chee-arc/aets/DCM4CHEE/rs/studies/$uid/$kondisi?accept=application%2Fzip&dicomdir=false";
            // $link_dicom_jpg = "http://118.99.77.50:9090/dcm4chee-arc/aets/DCM4CHEE/rs/studies/1.3.12.2.1107.5.1.7.106949.30000024042307531537400000008?accept=application%2Fzip&dicomdir=false";
            header("location:$link_dicom_jpg");
        }
    }
}


if ($_SESSION['level'] == "radiographer") {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Choose Series</title>
        <script type="text/javascript" src="../js/sweetalert.min.js" />
        </script>
        <?php include('head.php'); ?>
    </head>

    <body style="background-color: #1f69b7;">
        <?php include('../sidebar-index.php'); ?>
        <div class="container-fluid" id="content2">
            <div class="row">
                <div id="content1">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="col-md-6 box-change-dokter table-box">
                            <div class="radiobtn1">
                                <form method="POST" target="_blank">
                                    <input type="hidden" name="uid" value="<?= $uid ?>" id="uid">
                                    <input type="hidden" name="acc" value="<?= $acc ?>" id="acc">

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <table>
                                                    <tr>
                                                        <td>UID </td>
                                                        <td>&nbsp;&nbsp;: <?= $uid ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Pasien </td>
                                                        <td>&nbsp;&nbsp;: <?= removeCharacter($pat_name) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>MRN </td>
                                                        <td>&nbsp;&nbsp;: <?= $pat_id ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-5">
                                                <table>
                                                    <tr>
                                                        <td>Jenis Kelamin </td>
                                                        <td>&nbsp;&nbsp;: <?= $pat_sex ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pemeriksaan </td>
                                                        <td>&nbsp;&nbsp;: <?= $study_desc ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Modality </td>
                                                        <td>&nbsp;&nbsp;: <?= $mods_in_study ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>Pilih Series, lalu download untuk menghasilkan output</h6>
                                    <hr>
                                    <label class="radio-admin">
                                        <input type="checkbox" class="check-series-iuids" id="check-all" data-num-series="<?= $num_series; ?>">
                                        <h6 class="font-weight-bold"><?= $lang['check_all'] ?> Series</h6>
                                        <span class="checkmark"></span>
                                    </label>
                                    <br><br><br>
                                    <?php
                                    $sql = mysqli_query(
                                        $conn_pacsio,
                                        "SELECT series_desc, series_iuid, body_part, num_instances FROM series WHERE series.study_fk = '$pk_study'"
                                    );
                                    while ($row = mysqli_fetch_assoc($sql)) { ?>
                                        <label class="radio-admin">
                                            <input type="checkbox" class="check-series-iuid" name="series_iuid[]" id="series_iuid[]" value="<?= $row['series_iuid']; ?>"><?= $row['series_desc'] . ' / ' . $row['body_part'] . ' / ' . $row['num_instances']; ?>
                                            <br><img src="http://<?= $ipDirect; ?>:9090/dcm4chee-arc/aets/DCM4CHEE/wado?requestType=WADO&studyUID=<?= $uid; ?>&seriesUID=<?= $row['series_iuid']; ?>" alt="" width="200">
                                            <span class="checkmark"></span>
                                        </label><br><br>
                                    <?php } ?>
                                    <hr>
                                    <a class="btn btn-info btn-md" href="workload.php" style="border-radius: 5px; box-shadow:none">Back</a>
                                    <button class="btn btn-info btn-md" type="submit" id="expertise_image_pdf" name="expertise_image_pdf" style="border-radius: 5px; box-shadow:none">
                                        IMAGE & EXPERTISE (PDF)
                                    </button>
                                    <button class="btn btn-info btn-md" type="submit" id="image_pdf" name="image_pdf" style="border-radius: 5px; box-shadow:none">
                                        IMAGE (PDF)
                                    </button>
                                    <button class="btn btn-info btn-md" type="submit" id="image_jpg" name="image_jpg" style="border-radius: 5px; box-shadow:none">
                                        IMAGE (JPG)
                                    </button>
                                    <button class="btn btn-info btn-md" type="submit" id="image_dicom" name="image_dicom" style="border-radius: 5px; box-shadow:none">
                                        IMAGE (DICOM)
                                    </button>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
				<div id="content1">
					<div class="d-flex justify-content-center align-items-center">
						<div class="col-md-6 box-change-dokter table-box">
							<h6>Input</h6>
							<p id="input"></p>
							<h6>Output</h6>
							<p id="output"></p>
						</div>
					</div>
				</div>
			</div> -->
        </div>

        <?php include('script-footer.php'); ?>
    </body>
    <script>
        let allSeries = $('#check-all').data("num-series");
        $("#expertise_image_pdf").prop("disabled", true);
        $("#image_pdf").prop("disabled", true);
        $("#image_jpg").prop("disabled", true);
        $("#image_dicom").prop("disabled", true);

        $('.check-series-iuids').click(function() {
            let checkedSeriesAll = $('.check-series-iuid').prop('checked', this.checked);
            // jika true total series 
            if (this.checked === true) {
                $("#expertise_image_pdf").prop("disabled", false);
                $("#image_pdf").prop("disabled", false);
                $("#image_jpg").prop("disabled", false);
                $("#image_dicom").prop("disabled", false)
            } else {
                // jika false total 0
                $("#expertise_image_pdf").prop("disabled", true);
                $("#image_pdf").prop("disabled", true);
                $("#image_jpg").prop("disabled", true);
                $("#image_dicom").prop("disabled", true)
            }
        });

        $('input[class=check-series-iuid]').click(function() {
            let checkedSeries = $("input[class=check-series-iuid]:checked").length;

            // ketika yang diplih 1 series atau semua series maka tombol aktif semua
            if (checkedSeries == 1 || checkedSeries >= allSeries) {
                $("#expertise_image_pdf").prop("disabled", false);
                $("#image_pdf").prop("disabled", false);
                $("#image_jpg").prop("disabled", false);
                $("#image_dicom").prop("disabled", false)
            } else {
                // selain itu series tombol image dicom tidak aktif
                $("#image_dicom").prop("disabled", true)
            }

            // ketika series dipilih semua maka checkall series aktif semua
            if (checkedSeries >= allSeries) {
                $('.check-series-iuids').prop('checked', true);
            } else {
                $('.check-series-iuids').prop('checked', false);
            }

        });
    </script>

    </html>
<?php } else {
    header("location:../index.php");
} ?>