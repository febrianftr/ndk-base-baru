<?php
$date = date('d-m-Y 23:59', strtotime("-30 days"));
$date2 = date('d-m-Y 23:59');
?>




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

                <div class="col-auto" style="padding-right: 0px; padding-left: 0px;">
                    <img src="../image/new/name-nd.svg" alt="Search" class="search-img1">
                    <input type="text" class="form-control filter-input1" name="pat_name" id="pat_name" placeholder="Name">
                </div>
                <div class="col-auto" style="padding-right: 0px; padding-left: 0px;">
                    <img src="../image/new/mrn-nd.svg" alt="Search" class="search-img1">
                    <input type="text" class="form-control filter-input1" name="mrn" id="mrn" placeholder="MRN">
                </div>
                <?php if ($level == 'radiology') { ?>
                    <div class="col-auto" style="padding-right: 0px; padding-left: 0px;">
                        <img src="../image/new/ex-nd.svg" alt="Search" class="search-img1">
                        <input type="text" class="form-control filter-input1" name="fill" id="fill" placeholder="Expertise">
                    </div>
                <?php } else if ($level == 'radiographer' || $level == 'refferal') { ?>
                    <div class="col-auto" style="padding-right: 0px; padding-left: 0px;">
                        <img src="../image/new/foto-nd.svg" alt="Search" class="search-img1">
                        <input type="text" class="form-control filter-input1" name="patientid" id="patientid" placeholder="No Foto">
                    </div>
                <?php } else { ?>
                    <div class="col-auto" style="padding-right: 0px; padding-left: 0px;">
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