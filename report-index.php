<div class="row">
	<div id="content1">
		<div class="body">
			<div class="container-fluid">
				<div class="col-12" style="padding-left: 0;">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.php">Home</a></li>
							<li class="breadcrumb-item active">Report Excel</li>
						</ol>
					</nav>
				</div>
				<div class="cont-regist">
					<div>
						<h4>Excel Report</h4>
					</div>
					<form id="report-excel" method="get">
						<div class="row justify-content-center align-items-center" style="padding: 10px; border-radius: 5px; border: solid 2px #eff1f7;">

							<div class="col-md-2" style="padding: 4px;">
								<div class="input-group input-group-regist input-regist input-group-icon">
									<input type="text" name="from_workload" id="from_workload" placeholder="From Date" autocomplete="off" />
									<div class="input-icon"><i class="fas fa-calendar-alt"></i></div>
								</div>
							</div>
							<div class="col-md-2" style="padding: 4px;">
								<div class="input-group input-group-regist input-regist input-group-icon">
									<input type="text" name="to_workload" id="to_workload" placeholder="To Date" autocomplete="off" />
									<div class="input-icon"><i class="fas fa-calendar-alt"></i></div>
								</div>
							</div>
							<div class="col-md-4">
								<input type="checkbox" class="cboxtombol" style="margin-top: 0px;" checked> <?= $lang['check_all'] ?> Modality
								<ul class="ks-cboxtags">
									<?php
									$study = mysqli_query(
										$conn_pacsio,
										"SELECT mods_in_study FROM study GROUP BY mods_in_study LIMIT 15"
									);
									while ($row = mysqli_fetch_assoc($study)) { ?>
										<li><label><input class="common_selector cbox checkbox4 search-input-workload" type="checkbox" id="mods_in_study" name="mods_in_study" value="<?= $row['mods_in_study']; ?>" checked><span><?= $row['mods_in_study']; ?></span></label></li>
									<?php } ?>
								</ul>
							</div>
							<div class="col-md-2">
								Priority Doctor :
								<ul class="ks-cboxtags">
									<li><label><input class="common_selector cbox5 checkbox4 search-input-workload" type="checkbox" id="priority_doctor" name="priority_doctor" value="normal" checked><span>Normal</span></label></li>
									<li><label><input class="common_selector cbox5 checkbox4 search-input-workload" type="checkbox" id="priority_doctor" name="priority_doctor" value="cito" checked><span>Cito</span></label></li>
								</ul>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="sel1">Select Radiographer:</label>
									<select class="form-control select2" multiple="multiple" name="radiographer" id="radiographer" style="width: 100%;">
										<option value="all">Semua</option>
										<?php
										$query_radiografer = mysqli_query($conn, "SELECT * FROM xray_order WHERE radiographer_name IS NOT NULL GROUP BY radiographer_name LIMIT 30");
										while ($radiografer = mysqli_fetch_array($query_radiografer)) { ?>
											<option value="<?php echo $radiografer['radiographer_name']; ?>"><?php echo $radiografer['radiographer_name'] . ' ' . $radiografer['radiographer_lastname']; ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-12" style="background: #f9f9f9; border-radius: 5px;">
								<button style="margin: 10px 0px; float: right; padding: 10px 30px; border-radius: 5px; border: none; font-weight: bold; font-size: 18px;" class="btn-excel" type="submit"><i class="fas fa-file-excel"></i>
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