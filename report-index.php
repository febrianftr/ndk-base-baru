 <style>
 	/* ===== DARK MODE UNTUK BOOTSTRAP SELECT (selectpicker) ===== */
 	.bootstrap-select .dropdown-toggle,
 	.bootstrap-select .dropdown-menu {
 		background-color: #222 !important;
 		color: #ddd !important;
 		border: 1px solid #444 !important;
 	}

 	/* Tombol utama (closed state) */
 	.bootstrap-select .dropdown-toggle {
 		background-color: #222 !important;
 		color: #ddd !important;
 	}

 	/* Panah di kanan */
 	.bootstrap-select .filter-option-inner-inner {
 		color: #ddd !important;
 	}

 	/* Daftar item dropdown */
 	.bootstrap-select .dropdown-menu li a {
 		color: #ccc !important;
 		background-color: transparent !important;
 	}

 	.bootstrap-select .dropdown-menu li a:hover,
 	.bootstrap-select .dropdown-menu li.active a {
 		background-color: #444 !important;
 		color: #fff !important;
 	}

 	/* Search bar di dropdown */
 	.bootstrap-select .bs-searchbox input {
 		background-color: #333 !important;
 		color: #eee !important;
 		border: 1px solid #555 !important;
 	}

 	/* Scrollbar dark */
 	.bootstrap-select .dropdown-menu.inner {
 		scrollbar-color: #555 #222;
 	}

 	/* === DARK MODE UNTUK SELECT2 === */

 	/* Wrapper utama */
 	.select2-container--default .select2-selection--single,
 	.select2-container--default .select2-selection--multiple {
 		background-color: #1e1e1e !important;
 		border: 1px solid #444 !important;
 		color: #ddd !important;
 	}

 	/* Text di dalam select */
 	.select2-container--default .select2-selection__rendered {
 		color: #ddd !important;
 	}

 	/* Placeholder */
 	.select2-container--default .select2-selection__placeholder {
 		color: #888 !important;
 	}

 	/* Dropdown list */
 	.select2-container--default .select2-results>.select2-results__options {
 		background-color: #1e1e1e !important;
 		color: #ddd !important;
 	}

 	/* Hover di dropdown */
 	.select2-container--default .select2-results__option--highlighted[aria-selected] {
 		background-color: #333 !important;
 		color: #fff !important;
 	}

 	/* Selected item (multi-select) */
 	.select2-container--default .select2-selection--multiple .select2-selection__choice {
 		background-color: #333 !important;
 		border: 1px solid #555 !important;
 		color: #ccc !important;
 	}

 	.select2-container--default .select2-results__option[aria-selected="true"] {
 		background-color: #1e1e1e;
 	}

 	/* Tag close button */
 	.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
 		color: #999 !important;
 	}

 	.select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
 		color: #fff !important;
 	}

 	/* Search input di dropdown */
 	.select2-container--default .select2-search--dropdown .select2-search__field {
 		background-color: #2a2a2a !important;
 		color: #eee !important;
 		border: 1px solid #444 !important;
 	}

 	/* Border focus */
 	.select2-container--default.select2-container--focus .select2-selection--multiple {
 		border-color: #777 !important;
 	}
 </style>
 <div class="row">
 	<div id="content1">
 		<div class="body">
 			<div class="container-fluid">
 				<div class="col-12" style="padding: 0;">
 					<nav aria-label="breadcrumb">
 						<ol class="breadcrumb">
 							<li class="breadcrumb-item"><a href="#">Home</a></li>
 							<li class="breadcrumb-item active">Report Excel</li>
 						</ol>
 					</nav>
 				</div>
 				<div class="cont-regist">
 					<div>
 						<h4>Excel Report</h4>
 					</div>
 					<form method="POST" action="../proses-export-excel.php">
 						<div class="row justify-content-center align-items-center" style="padding: 10px; border-radius: 5px; border: solid 2px #363636; margin-bottom: 5px;;">
 							<div class="col-md-3" style="padding: 4px;">
 								<div class="input-group input-group-regist input-regist input-group-icon">
 									<input type="text" name="from_workload" id="from_workload" placeholder="From Date" autocomplete="off" required />
 									<div class="input-icon"><i class="fas fa-calendar-alt"></i></div>
 								</div>
 							</div>
 							<div class="col-md-3" style="padding: 4px;">
 								<div class="input-group input-group-regist input-regist input-group-icon">
 									<input type="text" name="to_workload" id="to_workload" placeholder="To Date" autocomplete="off" required />
 									<div class="input-icon"><i class="fas fa-calendar-alt"></i></div>
 								</div>
 							</div>
 						</div>
 						<!-- <div class="row justify-content-center align-items-center" style="padding: 10px; border-radius: 5px; border: solid 2px #363636; margin-bottom: 5px;;">
							<div class="col-md-6">
								<input type="checkbox" class="check-genders" style="margin-top: 0px;" checked> <?= $lang['check_all'] ?> Gender
								<ul class="ks-cboxtags">
									<li><label><input class="common_selector check-gender checkbox4 search-input-workload" type="checkbox" id="gender" name="gender[]" value="F" checked><span>F</span></label></li>
									<li><label><input class="common_selector check-gender checkbox4 search-input-workload" type="checkbox" id="gender" name="gender[]" value="M" checked><span>M</span></label></li>
								</ul>
							</div>
						</div> -->
 						<div class="row justify-content-center align-items-center" style="padding: 10px; border-radius: 5px; border: solid 2px #363636; margin-bottom: 5px;;">
 							<div class="col-md-6">
 								<input type="checkbox" class="check-modalities" style="margin-top: 0px;" checked> <label class="label-report1"><?= $lang['check_all'] ?> Modality</label>
 								<ul class="ks-cboxtags">
 									<?php
										$study = mysqli_query(
											$conn_pacsio,
											"SELECT mods_in_study FROM study GROUP BY mods_in_study"
										);
										while ($row = mysqli_fetch_assoc($study)) { ?>
 										<li><label><input class="common_selector check-modality checkbox4 search-input-workload" type="checkbox" id="mods_in_study" name="mods_in_study[]" value="<?= $row['mods_in_study']; ?>" checked><span><?= $row['mods_in_study']; ?></span></label></li>
 									<?php } ?>
 								</ul>
 							</div>
 						</div>
 						<div class="row justify-content-center align-items-center" style="padding: 10px; border-radius: 5px; border: solid 2px #363636; margin-bottom: 5px;;">
 							<div class="col-md-6">
 								<input type="checkbox" class="check-priorities" style="margin-top: 0px;" checked> <label class="label-report1"><?= $lang['check_all'] ?> Priority: </label>
 								<ul class="ks-cboxtags">
 									<li><label><input class="common_selector check-priority cbox5 checkbox4 search-input-workload" type="checkbox" id="priority" name="priority[]" value="normal" checked><span>Normal</span></label></li>
 									<li><label><input class="common_selector check-priority cbox5 checkbox4 search-input-workload" type="checkbox" id="priority" name="priority[]" value="cito" checked><span>Cito</span></label></li>
 								</ul>
 							</div>
 						</div>
 						<div class="row justify-content-center align-items-center" style="padding: 10px; border-radius: 5px; border: solid 2px #363636; margin-bottom: 5px;;">
 							<div class="col-md-6">
 								<input type="checkbox" class="check-contrasts" style="margin-top: 0px;" checked> <label class="label-report1"><?= $lang['check_all'] ?> Contrast:</label>
 								<ul class="ks-cboxtags">
 									<li><label><input class="common_selector check-contrast cbox5 checkbox4 search-input-workload" type="checkbox" id="contrast" name="contrast[]" value="1" checked><span>Kontras</span></label></li>
 									<li><label><input class="common_selector check-contrast cbox5 checkbox4 search-input-workload" type="checkbox" id="contrast" name="contrast[]" value="0" checked><span>Tidak Kontras</span></label></li>
 								</ul>
 							</div>
 						</div>
 						<div class="row justify-content-center align-items-center" style="padding: 10px; border-radius: 5px; border: solid 2px #363636; margin-bottom: 5px;;">
 							<div class="col-md-6">
 								<div class="form-group">
 									<label for="sel1" class="label-report1">Select Radiographer:</label>
 									<select class="form-control select2" multiple="multiple" name="radiographer[]" id="radiographer" style="width: 100%;" required>
 										<option value="all" selected>Semua</option>
 										<?php
											$query_radiografer = mysqli_query($conn, "SELECT radiographer_id, radiographer_name, radiographer_lastname FROM xray_radiographer");
											while ($radiografer = mysqli_fetch_array($query_radiografer)) { ?>
 											<option value="<?php echo $radiografer['radiographer_id']; ?>"><?php echo $radiografer['radiographer_name'] . ' ' . $radiografer['radiographer_lastname']; ?></option>
 										<?php
											}
											?>
 									</select>
 								</div>
 							</div>
 						</div>
 						<div class="row justify-content-center align-items-center" style="padding: 10px; border-radius: 5px; border: solid 2px #363636; margin-bottom: 5px;;">
 							<div class="col-md-6">
 								<div class="form-group">
 									<label for="sel1" class="label-report1">Select Department:</label>
 									<select class="form-control select2" multiple="multiple" name="dep_id[]" id="dep_id" style="width: 100%;" required>
 										<option value="all" selected>Semua</option>
 										<?php
											$query_department = mysqli_query($conn, "SELECT dep_id, name_dep FROM xray_department");
											while ($department = mysqli_fetch_array($query_department)) { ?>
 											<option value="<?php echo $department['dep_id']; ?>"><?php echo $department['name_dep']; ?></option>
 										<?php
											}
											?>
 									</select>
 								</div>
 							</div>
 						</div>
 						<div class="row justify-content-center align-items-center" style="padding: 10px; border-radius: 5px; border: solid 2px #363636; margin-bottom: 5px;;">
 							<div class="col-md-6">
 								<div class="form-group">
 									<label for="sel1" class="label-report1">Select Radiologist:</label>
 									<select class="form-control select2" multiple="multiple" name="dokradid[]" id="dokradid" style="width: 100%;" required>
 										<option value="all" selected>Semua</option>
 										<?php
											$query_radiologist = mysqli_query(
												$conn,
												"SELECT dokradid, dokrad_name, dokrad_lastname FROM xray_dokter_radiology WHERE username NOT IN ('sarah', 'hardian_dokter')"
											);
											while ($radiologist = mysqli_fetch_assoc($query_radiologist)) { ?>
 											<option value="<?php echo $radiologist['dokradid']; ?>"><?php echo $radiologist['dokrad_name'] . ' ' . $radiologist['dokrad_lastname']; ?></option>
 										<?php } ?>
 									</select>
 								</div>
 							</div>
 						</div>
 						<div class="row justify-content-center align-items-center" style="padding: 10px; border-radius: 5px; border: solid 2px #363636; margin-bottom: 5px;;">
 							<div class="col-md-6">
 								<input type="checkbox" class="check-statuses" style="margin-top: 0px;" checked> <label class="label-report1"><?= $lang['check_all'] ?> Status :</label>
 								<ul class="ks-cboxtags">
 									<li><label><input class="common_selector check-status cbox5 checkbox4 search-input-workload" type="checkbox" id="status" name="status[]" value="waiting" checked><span>Waiting</span></label></li>
 									<li><label><input class="common_selector check-status cbox5 checkbox4 search-input-workload" type="checkbox" id="status" name="status[]" value="approved" checked><span>Approved</span></label></li>
 								</ul>
 							</div>
 						</div>
 						<div class="row justify-content-center align-items-center">
 							<div class="col-md-6" style="border-radius: 5px;">
 								<button style="margin: 10px 0px; float: left; padding: 10px 30px; border-radius: 5px; border: none; font-weight: bold; font-size: 18px;" class="btn-excel" type="submit"><i class="fas fa-file-excel"></i>
 									<span class="spinner-grow spinner-grow-sm loading" role="status" aria-hidden="true"></span>
 									<p class="loading" style="display:inline;">Loading...</p>
 									<p class="ubah" style="display:inline;">Excel</p>
 								</button>
 							</div>
 						</div>
 					</form>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
 </div>