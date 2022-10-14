<?php
require '../koneksi/koneksi.php';

@$uid = $_POST['uid'];

session_start();


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
                        <div class="about-inti col-md-5" style="background-color: #e1e1e1;">

                            <div class="work1 row" style="padding: 10px;height: auto;background-color: #1f69b7;color: #fff;font-weight: bold;margin-right: 0;margin-left: 0;">
                                <div class="col-md-6">
                                    <table class="table-exam">

                                        <?php $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM xray_exam WHERE uid = '$uid' "));
                                        $birth_date = $row['birth_date'];
                                        $bday = new DateTime($birth_date);
                                        $today = new DateTime(date('y-m-d'));
                                        $diff = $today->diff($bday);
                                        ?>
                                        <tr>
                                            <td>Nama</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td><?= $row['name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>No foto&nbsp;&nbsp;&nbsp;</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td><?= $row['patientid']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>MRN</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td><?= $row['mrn']; ?></td>
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
                                            <td><?= $row['sex']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Prodecure&nbsp;&nbsp;&nbsp;</td>
                                            <td>&nbsp;:&nbsp;</td>
                                            <td><?= $row['prosedur']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>


                            <form action="proses_exam_ris.php" class="text-center border border-light p-5" method='post' style="padding: 10px;">
                                <input type="hidden" value="<?php echo $uid; ?>" name="study_iuid">

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