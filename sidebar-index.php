<?php
// include '../contract-service.php';
?>

<!-- ------loader------ -->
<div class="disokin">
    <div class="spinner">
        <div><img src="../image/logo-front.png" style="width: 201px;margin-left: -75px; margin-bottom: 9px;"></div>
        <div class="back-loader">
            <span class="ball-1"></span>
            <span class="ball-2"></span>
            <span class="ball-3"></span>
            <span class="ball-4"></span>
            <span class="ball-5"></span>
            <span class="ball-6"></span>
            <span class="ball-7"></span>
            <span class="ball-8"></span>
        </div>
    </div>
</div>
<!-- ------loader------ -->





<?php include "../bahasa.php"; ?>
<div class="nav-side-menu">
    <div class="brand">
        <div style="width: 200px; padding: 8px 10px 0px 15px; margin: 7px 0;"><img style="width: 100%;" src="../image/logo-front.png"></div>
    </div>
    <div class="user-sidebar">
        <i class="fas fa-user fa-lg"></i> : <?= $_SESSION['username']; ?>
    </div>
    <!-- <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content1"></i> -->
    <div class="toggle-btn">
        <label for="burger" class="burger-bar">
            <input id="burger" type="checkbox" data-toggle="collapse" data-target="#menu-content1">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>




    <div class="menu-list1">
        <ul id="menu-content1" class="menu-content1 collapse out">

            <li data-target="#home1">
                <a href="index.php">
                    <i class="fa fa-home fa-lg"></i> <?= $lang['home'] ?>
                </a>
            </li>

            <!-- =================SIDEBAR RADIOGRAPHER====================== -->
            <?php if ($_SESSION['level'] == 'radiographer') { ?>
                <li data-toggle="collapse" data-target="#products1" class="collapsed">
                    <a href="#" class="products1"><i class="fa fa-user fa-lg"></i> <?= $lang['patient_order'] ?> <label class="products1-arrow"><span class="arrow"></span></label></a>
                </li>
                <ul class="sub-menu1 collapse" id="products1">
                    <li id="regist1"><a href="registration.php"><?= $lang['registration'] ?></a></li>
                    <li id="order3"><a href="order2.php"><?= $lang['all_order'] ?></a></li>
                    <li id="exam3"><a href="exam2.php"><?= $lang['examroom'] ?></a></li>
                </ul>

                <li data-toggle="collapse" data-target="#service" class="collapsed">
                    <a href="#" class="services"><i class="fa fa-file-alt fa-lg"></i> <?= $lang['report'] ?><label class="services-arrow"><span class="arrow"></span></label></a>
                </li>
                <ul class="sub-menu1 collapse" id="service">
                    <li id="workload1"><a href="workload.php"><?= $lang['workload'] ?></a></li>
                    <li id="report1"><a href="report.php"><?= $lang['download_excel'] ?></a></li>
                    <li id="expertise-history"><a href="workload-fill.php">Expertise History</a></li>
                    <li id="uploadexcel1"><a href="uploadexcel.php"><?= $lang['backup_excel'] ?></a></li>
                    <li id="downloadexcel1"><a href="downloadexcel.php">Storage Excel</a></li>
                    <li id="chart2"><a href="chart.php"><?= $lang['chart'] ?></a></li>
                </ul>

                <li id="storage1">
                    <a href="storage.php">
                        <i class="fa fa-database fa-lg"></i> <?= $lang['storage'] ?>
                    </a>
                </li>
            <?php } ?>
            <!-- =================END OF SIDEBAR RADIOGRAPHER====================== -->

            <!-- =================SIDEBAR DOKTER RADIOLOGI====================== -->
            <?php if ($_SESSION['level'] == 'radiology') { ?>
                <li id="worklist1">
                    <a href="dicom.php">
                        <i class="fas fa-user-edit fa-lg"></i> Worklist
                    </a>
                </li>

                <li data-toggle="collapse" data-target="#service" class="collapsed">
                    <a href="#" class="products1"><i class="fa fa-file-alt fa-lg"></i> <?= $lang['report'] ?> <label class="products1-arrow"><span class="arrow"></label></span></a>
                </li>
                <ul class="sub-menu1 collapse" id="service">
                    <li id="workload1"><a href="workload.php">Expertise Approved</a></li>
                    <li id="report1"><a href="report.php"><?= $lang['download_excel'] ?></a></li>
                    <li id="expertise-history"><a href="workload-fill.php">Expertise History</a></li>
                    <li id="query"><a href="query.php">Query</a></li>
                </ul>

                <li data-toggle="collapse" data-target="#template" class="collapsed">
                    <a href="#" class="services"><i class="fas fa-file-medical fa-lg"></i> Template Expertise <label class="services-arrow"><span class="arrow"></label></span></a>
                </li>
                <ul class="sub-menu1 collapse" id="template">
                    <li id="newt1"><a href="new_template.php">New Template</a></li>
                    <li id="viewt1"><a href="view_template.php">View Template</a></li>
                </ul>
            <?php } ?>
            <!-- =================END OF SIDEBAR DOKTER RADIOLOGI====================== -->

            <!-- =================END OF SIDEBAR POLI====================== -->
            <?php if ($_SESSION['level'] == 'refferal') { ?>
                <script type="text/javascript" src="js/jquery.min.js"></script>
                <li id="expertise-history">
                    <a href="workload-fill.php">
                        <i class="fa fa-history fa-lg"></i>
                        Expertise History
                    </a>
                </li>
                <li id="query1">
                    <a href="workload.php">
                        <i class="fa fa-file-alt fa-lg"></i> Query
                    </a>
                </li>
            <?php } ?>
            <!-- =================END OF SIDEBAR DOKTER RADIOLOGI====================== -->

            <li id="settings1">
                <a href="settings.php">
                    <i class="fa fa-wrench fa-lg"></i> <?= $lang['settings'] ?>
                </a>
            </li>
            <li id="logout2" class="logout1">
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt fa-lg"></i> <?= $lang['logout'] ?>
                </a>
            </li>
        </ul>


    </div>
</div>