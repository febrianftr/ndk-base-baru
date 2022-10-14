<?php
require '../koneksi/koneksi.php';
session_start();
if ($_SESSION['level'] == "admin") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include('head.php'); ?>
    <title>Report | radiology</title>
  </head>
  <body>
    <?php include('menu-bar.php'); ?><br>

    <nav aria-label="breadcrumb">
				  <ol class="breadcrumb1 breadcrumb" >
				    <li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				    <li class="breadcrumb-item active" aria-current="page">Workload</li>
				  </ol>
				</nav>
<div id="container1">
      <div id="content1">
<div class="body">

<div class="container-fluid">	


	<div class="container-fluid report-th">
		<div class="col-md-4">
			<center><strong><h5 style="margin: 3px 0px; color: #fff;">Query to Excel</h5></strong></center>
		</div>
		<div class="col-md-5">
			<center><strong><h5 style="margin: 3px 0px;"><?= $lang['select_date'] ?></h5></strong></center>
		</div>
		<div class="col-md-3">
			<center><strong><h5 style="margin: 3px 0px;"><?= $lang['action'] ?></h5></strong></center>
		</div>
	</div>
    <form action="prosesexport-query.php" method="POST">	


    <div class="container-fluid report-bg">
    	<div class="col-md-4">
			<h5 style="margin-top: 16px; ">1.) Radiology Workload All</h5>
		</div>
		
			<div class="col-md-5 wrap-search report-input">
				<span class="date-icon2">
				<input type="text" name="from-radiology-workload" id="from-radiology-workload" class="form-control" placeholder="From Date" autocomplete="off" />
				</span>
				<span class="date-icon2">
				<input type="text" name="to-radiology-workload" id="to-radiology-workload" class="form-control" placeholder="To Date" autocomplete="off" /><br>
				</span>
			</div>
			<div class="col-md-3"><center>
				<button style="margin: 10px 0px;" class="btn btn-excel"  type="submit" name="radiologyworkload" id="radiologyworkload"><i class="fas fa-file-excel"></i> Export to Excel</button></center>
			
		</div>
	</div>
		
			<!---->

			 <div class="container-fluid report-bg">
    	<div class="col-md-4">
			<h5 style="margin-top: 16px; ">2.) Radiographer Workload All</h5>
		</div>
		
			<div class="col-md-5 wrap-search report-input">
				<span class="date-icon2">
				<input type="text" name="from-radiographer-workload" id="from-radiographer-workload" class="form-control" placeholder="From Date" autocomplete="off" />
				</span>
				<span class="date-icon2">
				<input type="text" name="to-radiographer-workload" id="to-radiographer-workload" class="form-control" placeholder="To Date" autocomplete="off" /><br>
				</span>
			</div>
			<div class="col-md-3"><center>
				<button style="margin: 10px 0px;" class="btn btn-excel"  type="submit" name="radiographerworkload" id="radiographerworkload"><i class="fas fa-file-excel"></i> Export to Excel</button></center>
			
		</div>
	</div>

<!-- 
			<label>Radiographer Workload All</label>
			<div class="wrap-search">
				<span class="date-icon2">
				<input type="text" name="from-radiographer-workload" id="from-radiographer-workload" class="form-control" placeholder="From Date" autocomplete="off" />
				</span>
				<span class="date-icon2">
				<input type="text" name="to-radiographer-workload" id="to-radiographer-workload" class="form-control" placeholder="To Date" autocomplete="off" /><br>
				</span>
				<button class="btn btn-excel"  type="submit" name="radiographerworkload" id="radiographerworkload"><i class="fas fa-search"></i> Search</button>
			</div> -->
			<!---->


			 <div class="container-fluid report-bg">
    	<div class="col-md-4">
			<h5 style="margin-top: 16px; ">3.) Refferal Workload Radiographer</h5>
		</div>
		
			<div class="col-md-5 wrap-search report-input">
				<span class="date-icon2">
				<input type="text" name="from-refferal-workload" id="from-refferal-workload" class="form-control" placeholder="From Date" autocomplete="off" />
				</span>
				<span class="date-icon2">
				<input type="text" name="to-refferal-workload" id="to-refferal-workload" class="form-control" placeholder="To Date" autocomplete="off" /><br>
				</span>
			</div>
			<div class="col-md-3"><center>
				<button style="margin: 10px 0px;" class="btn btn-excel"  type="submit" name="refferalworkload" id="refferalworkload"><i class="fas fa-file-excel"></i> Export to Excel</button></center>
			
		</div>
	</div>


			<!-- <label>Refferal Workload Radiographer</label>
			<div class="wrap-search">
				<span class="date-icon2">
				<input type="text" name="from-refferal-workload" id="from-refferal-workload" class="form-control" placeholder="From Date" autocomplete="off" />
				</span>
				<span class="date-icon2">
				<input type="text" name="to-refferal-workload" id="to-refferal-workload" class="form-control" placeholder="To Date" autocomplete="off" /><br>
				</span>
				<button class="btn btn-excel"  type="submit" name="refferalworkload" id="refferalworkload"><i class="fas fa-search"></i> Search</button>
			</div> -->
			<!---->

			<div class="container-fluid report-bg">
    	<div class="col-md-4">
			<h5 style="margin-top: 25px;  ">4.) Workload Radiographer By Modality</h5>
		</div>
		
			<div style="height: 67px; padding-top: 20px;" class="col-md-2 wrap-search report-input">
				<span class="date-icon2">
				<input type="text" name="from-radiographer-workload-mod" id="from-radiographer-workload-mod" class="form-control" placeholder="From Date" autocomplete="off" />
				</span>
				<span class="date-icon2">
				<input type="text" name="to-radiographer-workload-mod" id="to-radiographer-workload-mod" class="form-control" placeholder="To Date" autocomplete="off" /><br>
				</span>
			</div>
			<div class="col-md-3" style="border-right: 3px solid #40a789; color: #000; padding-top: 2px;">
				<input type="checkbox" class="cboxtombol" style="margin-top: 0px;" checked> Check All <br>
				<?php $sql = mysqli_query($conn, "SELECT * FROM xray_modalitas"); 
					while($row = mysqli_fetch_assoc($sql)) : ?> 
					<tr>
						<td><input class="common_selector cbox" type="checkbox" id="checkbox" name="checkbox[]" 
								   value="<?= $row['xray_type_code']; ?>" checked></td>
						 <td><label><?= $row['xray_type_code']; ?></label></td>
					</tr>
				<?php endwhile; ?>
			</div>
			<div class="col-md-3" style="padding-top: 10px;"><center>
				<button style="margin: 10px 0px;" class="btn btn-excel"  type="submit" name="workloadradiographermod" id="workloadradiographermod"><i class="fas fa-file-excel"></i> Export to Excel</button></center>
			
		</div>
	</div>


			<!-- <label>Workload Radiographer By Modality</label>
			<div class="wrap-search">
				<span class="date-icon2">
				<input type="text" name="from-radiographer-workload-mod" id="from-radiographer-workload-mod" class="form-control" placeholder="From Date" autocomplete="off" />
				</span>
				<span class="date-icon2">
				<input type="text" name="to-radiographer-workload-mod" id="to-radiographer-workload-mod" class="form-control" placeholder="To Date" autocomplete="off" />
				</span>
				<input type="checkbox" class="cboxtombol" style="margin-top: 0px;" checked> Check All
				<?php $sql = mysqli_query($conn, "SELECT * FROM xray_modalitas"); 
					while($row = mysqli_fetch_assoc($sql)) : ?> 
					<tr>
						<td><input class="common_selector cbox" type="checkbox" id="checkbox" name="checkbox[]" 
								   value="<?= $row['xray_type_code']; ?>" checked></td>
						 <td><label><?= $row['xray_type_code']; ?></label></td>
					</tr>
				<?php endwhile; ?>
				<button class="btn btn-excel"  type="submit" name="workloadradiographermod" id="workloadradiographermod"><i class="fas fa-search"></i> Search</button>
			</div> -->
	
	</form>

	</div>
</div>
</div>
<div class="footerindex">
    <div class="">
          <div class="footer-login col-sm-12"><br>
            <center><p>&copy; Powered by Intiwid IT Solution 2019</a>.</p></center>
          </div> 
        </div>
</div>
</div>
    <?php include('script-footer.php'); ?>
    <script type="text/javascript" src="js/jquery.datetimepicker.full.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.min.css">
    <script>
    	$(document).ready(function(){
    		$('.cboxtombol').click(function(){
       			$('.cbox').prop('checked', this.checked);
    		});
    		// --------------------
    		$('#from-radiology-workload').datetimepicker({
		     	timepicker: false,
		     	format:'Y-m-d'
	     	});
	     	$('#to-radiology-workload').datetimepicker({
		     	timepicker: false,
		     	format:'Y-m-d',
	     	});
	     	// --------------------
	     	$('#from-radiographer-workload').datetimepicker({
		     	timepicker: false,
		     	format:'Y-m-d'
	     	});
	     	$('#to-radiographer-workload').datetimepicker({
		     	timepicker: false,
		     	format:'Y-m-d',
	     	});
	     	// --------------------
	     	$('#from-refferal-workload').datetimepicker({
		     	timepicker: false,
		     	format:'Y-m-d'
	     	});
	     	$('#to-refferal-workload').datetimepicker({
		     	timepicker: false,
		     	format:'Y-m-d',
	     	});
	     	// --------------------
	     	$('#from-radiographer-workload-mod').datetimepicker({
		     	timepicker: false,
		     	format:'Y-m-d'
	     	});
	     	$('#to-radiographer-workload-mod').datetimepicker({
		     	timepicker: false,
		     	format:'Y-m-d',
	     	});
    	});
    </script>
    

  </body>
</html>
<?php } else { header("location:../index.php");} ?>