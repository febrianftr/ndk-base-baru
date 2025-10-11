<?php
$date = date('d-m-Y 23:59', strtotime("-30 days"));
$date2 = date('d-m-Y 23:59');
?>
<style>
    .worklist-header1 {
        font-size: 24px;
        font-weight: 500;
        margin-bottom: 20px;
    }

    /* Filter button and dropdown */
    .filter-container1 {
        position: relative;
        display: inline-block;
    }

    .filter-dropdown1 {
        position: absolute;
        top: 45px;
        left: 0;
        background: #26282c;
        border: 1px solid #363636;
        color: #eee;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 260px;
        display: none;
        z-index: 1000;
        padding: 15px;
    }

    .filter-header1 {
        font-weight: 600;
        margin-bottom: 10px;
    }

    .save-view1 {
        text-align: right;
        font-size: 0.9em;
    }

    .save-view1 a {
        text-decoration: none;
        color: #007bff;
    }

    .save-view1 a:hover {
        text-decoration: underline;
    }

    .search-box1 {
        width: 100%;
        padding: 8px 10px;
        margin-bottom: 10px;
        border: 1px solid #363636;
        border-radius: 4px;
        background-color: #363636;
        color: #eee;
    }

    .checkbox-list1 label {
        display: block;
        padding: 3px 0;
    }

    .filter-row1 {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-row1 .filter-input1 {
        flex: 1;
        font-size: 12px;
        color: #fff !important;
        background-color: #363636;
        border: unset;
        padding-left: 28px;
    }

    .filter-row1 .filter-input1:focus {
        color: #fff;
        background-color: #3c3939;
        border-color: unset;
        box-shadow: unset;
    }

    input.form-control {
        border-radius: 3px;
    }

    .filter-btn1 {
        white-space: nowrap;
        color: #fff;
        background-color: #3b57b3;
        border-radius: 3px;
        padding: 9px 33px;
        box-shadow: none;
        font-size: 9px;
    }



    .filter-btn1:hover {
        background-color: #2f54cdff;
        color: #fff;
        box-shadow: none;
    }

    .view-all1 {
        cursor: pointer;
    }

    .date-icon::before {
        display: inline-block;
        font-family: "Font Awesome 5 Free", "Font Awesome 5 Brands";
        content: "\f073";
        color: #cacaca;
        margin: 24px 0px 0px 10px;
        position: absolute;
        font-size: 15px;
    }

    .date-icon input {
        font-size: 14px;
        padding-left: 30px;
    }

    #selectedZonesPreview1 .zone-tag1 {
        display: inline-block;
        background-color: #2d2d2d;
        color: #737373;
        border-radius: 15px;
        padding: 3px 10px;
        font-size: 10px;
        margin: 6px 2px;
    }

    .zone-tag1 .remove-zone1 {
        margin-left: 6px;
        cursor: pointer;
        font-weight: bold;
        transition: color 0.2s ease;
    }

    .zone-tag1 .remove-zone1:hover {
        color: #ff4d4d;
    }

    .btn-fil {
        white-space: nowrap;
        border-radius: 3px;
        padding: 12px 33px;
        box-shadow: none;
        font-size: 9px;
    }

    /* Gaya dasar chip preview */
    .zone-tag1 {
        display: inline-flex;
        align-items: center;
        background-color: #f1f3f4;
        border-radius: 20px;
        padding: 4px 8px;
        font-size: 12px;
        margin: 4px;
    }

    /* Tombol X berbentuk lingkaran */
    .remove-filter1 {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 16px;
        height: 16px;
        font-size: 11px;
        margin-left: 6px;
        border-radius: 50%;
        color: #96a4c1;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        border: 1px solid #bccdf0;
    }

    /* Efek hover */
    .remove-filter1:hover {
        border: 1px solid #7e8dac;
    }

    .sidebar-search1 {
        width: unset;
    }

    .dataTables_length label {
        display: inline-block;
        margin-bottom: 6px;
    }

    .chip-nd {
        position: absolute;
        left: -140px;
        top: -24px;
    }

    .filter-nd {
        position: absolute;
        top: 40px;
        left: 160px;
        width: 100%;
        background-color: #1e1e1e;
        padding: 10px 15px;
        z-index: 10;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    /* Responsif */
    @media (max-width: 1149px) {
        .filter-nd {
            flex-direction: column;
            align-items: stretch;
            position: static;
        }

        .chip-nd {
            position: static;
        }
    }
</style>



<form action="#" method="post" class="filter-nd">
    <div class="container-fluid">
        <div class="row">
            <!-- Filter + Search Row -->
            <div class="filter-row1 form-row align-items-center">
                <!-- Filter Button + Dropdown -->
                <div class="col-auto" style="padding-right: 0px; padding-left: 0px;">
                    <div class="filter-container1">
                        <a href="#" id="filterToggle1" class="btn filter-btn1">
                            <i class="fa fa-filter"></i> Filters
                        </a>
                        <div class="filter-dropdown1" id="filterDropdown1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="font-weight-bold active"><?= $lang['search_date'] ?></label>
                            </div>
                            <div style="padding: 0px;" class="input-date">
                                <span class="date-icon">
                                    From
                                    <input type="text" name="from_study_datetime" id="from_study_datetime" class="form-control" placeholder="From Date" value="<?= $date ?>" autocomplete="off" />
                                </span>
                                <span class="date-icon">
                                    To
                                    <input type="text" name="to_study_datetime" id="to_study_datetime" class="form-control" placeholder="To Date" value="<?= $date2 ?>" autocomplete="off" />
                                </span>
                            </div>
                            <hr>

                            <div class="mb-2">
                                <label class="font-weight-bold">Modality</label>
                                <input type="text" id="searchZones1" class="search-box1" placeholder="<?= $lang['search_mod'] ?>..">
                            </div>

                            <div class="checkbox-list1">
                                <label><input type="checkbox" id="checkAll1" checked> <strong>Check All</strong></label>
                                <?php
                                $sql = mysqli_query(
                                    $conn_pacsio,
                                    "SELECT mods_in_study FROM study GROUP BY mods_in_study"
                                );
                                while ($row = mysqli_fetch_assoc($sql)) { ?>
                                    <label><input type="checkbox" class="zone-check1" id="checkbox" name="mods_in_study[]" value="<?= $row['mods_in_study']; ?>" checked> <?= $row['mods_in_study']; ?></label>
                                <?php } ?>
                                <a id="viewAll1" class="d-block mt-2 text-primary view-all1" style="display:none;">View all..</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Inputs -->

                <div class="col-auto sidebar-search1" style="padding-right: 0px; padding-left: 0px;">
                    <img src="../image/new/name-nd.svg" alt="Search" class="search-img1">
                    <input type="text" class="form-control filter-input1" name="pat_name" id="pat_name" placeholder="Name">
                </div>
                <div class="col-auto sidebar-search1" style="padding-right: 0px; padding-left: 0px;">
                    <img src="../image/new/mrn-nd.svg" alt="Search" class="search-img1">
                    <input type="text" class="form-control filter-input1" name="mrn" id="mrn" placeholder="MRN">
                </div>
                <?php if ($level == 'radiology') { ?>
                    <div class="col-auto sidebar-search1" style="padding-right: 0px; padding-left: 0px;">
                        <img src="../image/new/ex-nd.svg" alt="Search" class="search-img1">
                        <input type="text" class="form-control filter-input1" name="fill" id="fill" placeholder="Expertise">
                    </div>
                <?php } else if ($level == 'radiographer' || $level == 'refferal') { ?>
                    <div class="col-auto sidebar-search1" style="padding-right: 0px; padding-left: 0px;">
                        <img src="../image/new/foto-nd.svg" alt="Search" class="search-img1">
                        <input type="text" class="form-control filter-input1" name="patientid" id="patientid" placeholder="No Foto">
                    </div>
                <?php } else { ?>
                    <div class="col-auto sidebar-search1" style="padding-right: 0px; padding-left: 0px;">
                        <img src="../image/new/foto-nd.svg" alt="Search" class="search-img1">
                        <input type="text" class="form-control filter-input1" name="patientid" id="patientid" placeholder="No Foto">
                    </div>
                <?php } ?>


                <div class="col-auto" style="padding-right: 0px; padding-left: 0px;">
                    <button class="btn btn-success-nd text-white btn-fil shadow-none waves-effect waves-light" type="button" name="range" id="range"><i class="fas fa-search"></i></button>
                </div>
                <div class="col-auto" style="padding-right: 0px; padding-left: 0px;">
                    <button class="btn btn-danger-nd text-white btn-fil shadow-none waves-effect waves-light" type="reset" name="range" id="range"><i class="fas fa-redo"></i></button>
                </div>
            </div>
            <!-- ==== end of form filter new ===== -->

        </div>
        <div class="row chip-nd">
            <span id="selectedZonesPreview1"></span>
        </div>
    </div>
</form>