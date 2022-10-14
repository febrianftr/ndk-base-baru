<?php

require '../koneksi/koneksi.php';

session_start();


if ($_SESSION['level'] == "radiology") {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('head.php'); ?>
<title>Registration | Radiology</title>
</head>

<body>
<?php include('menu-bar.php'); ?>

</div>
<h3 class="textsearchpasien">Cari Data Pasien</h3>
<hr class="hrregist">
<div id="content1">
 <div class="searchpatient">	
		<form method="post" action="inputorder.php" >
			    			<button class="buttonsearch button1" type="submit" name="submit2">
			    		<i class="fas fa-search"></i><span>SEARCH</span></button>
 </div>	

 <div class="searchform">	
	<!-- <table class="tablesearch" cellspacing="0" cellpadding="0"> -->
			<tr>
				<td>
						<label>MRN</label><br>	
							<input type="text" name="mrn" placeholder="Search by MRN.."><br>
							<label>Name</label><br>	
							<input type="text" name="name" value="" placeholder="Search by Name.."><br>
						<label>Lastname</label><br>	
							<input type="text" name="lastname" placeholder="Search by last name.. "><br>
								
				</td>
			</tr>
		</form>
	<!-- </table> -->
 </div>	
</div>

	
<div id="footer2"><br>
	<h3 class="textsearchnewpasien">Registrasi Pasien Baru</h3>
	<hr class="hrregist2">
	<form action="afterregist.php" method="post">
		<div class="regist">
			<div class="regist1">
				<label for="mrn"><b>MRN</b> </label><br>
				<input type="text"	name="mrn" id="mrn" placeholder="Masukan MRN.."></input><br>

				<label for="name"><b>Nama Depan</b></label><br>
				<input type="text"	name="name" id="name" placeholder="Masukan Nama Depan.."></input><br>
		
				<label for="lastname"><b>Nama Belakang</b></label><br>
				<input type="text"	name="lastname" id="lastname" placeholder="Masukan Nama Belakang.."></input><br>
			
				<label for="ssn"><b>No. KTP</b></label><br>
				<input type="text"	name="ssn" id="ssn" placeholder="Masukan Nomer KTP.."></input><br><br>
			
				<label for="sex"><b>Jenis Kelamin</b></label><br>
				<label class="container">Laki - laki
				<input type="radio" checked="checked" name="sex" value="Laki-Laki">
				<span class="checkmark"></span>
				</label>
				<label class="container">Perempuan
				<input type="radio" name="sex" value="Perempuan">
				<span class="checkmark"></span>
				</label>
				<label class="container">Other
				<input type="radio" name="sex" value="Other">
				 <span class="checkmark"></span>
				</label><br>
			
				<label><b>Tanggal Lahir</b></label><br>
				<select name="birth_date">
				<option value="dd">Tanggal</option>

				<?php for ($d = 1; $d <= 31; $d++) { ?>
				<option value="<?php echo $d ?>"><?php echo $d ?></option>
				<?php } ?>
				</select>

				
				<select name="bulan">
				<option value="MM">Bulan</option>
				<?php for ($m = 0; $m <= 11; $m++) { ?>
				<?php 
						$nama_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
				 ?>
				 <option value="<?php echo $m ?>"><?php echo $nama_bulan[$m] ?></option>
				<?php } ?>
				</select>	

				
				<select name="tahun">
				<option value="YYYY">Tahun</option>
				<?php for ($y = date('Y'); $y >= 1900; $y--) { ?>
				<option value="<?php echo $y; ?>"><?php echo $y ?></option>
				<?php } ?>
				</select><br><br>
					
				<label for="road"><b>Berat Badan</b></label><br>
				<input type="text"	name="weight" id="road" placeholder="Masukan Berat Badan.."></input>
				<br>

				<label for="address"><b>Alamat</b></label><br>
				<textarea type="text" name="address" id="address" placeholder="Masukan Alamat.."></textarea><br>

			</div><br>
			<div class="regist2">
			
				<label for="road"><b>Kelurahan</b></label><br>
				<input type="text"	name="village" id="road" placeholder="Masukan Kelurahan.."></input>
				<br>
			
			
				<label for="village"><b>Kecamatan</b></label><br>
				<input type="text"	name="sub_district" id="village" placeholder="Masukan Kecamatan.."></input><br>
			
				<label for="amphoe_code"><b>Kota</b></label><br>
				<input type="text"	name="city" id="amphoe_code" placeholder="Masukan Kota.."></input><br>
			
			
				<label for="province_code"><b>Provinsi</b></label><br>
				<input type="text"	name="province" id="province_code" placeholder="Masukan Provinsi.."></input><br>
			
			
			
				<label for="tambon_code"><b>Kode Pos</b></label><br>
				<input type="text"	name="post_code" id="tambon_code" placeholder="Masukan Kode POS.."></input><br>
			

				<label for="country_code"><b>Negara</b></label><br>
				<input type="text"	name="country" id="country_code" placeholder="Masukan Negara.."></input><br>
			
			
				<label for="note"><b>Note</b></label><br>
				<textarea type="text" name="note" id="note" placeholder="Catatan.."></textarea><br>
			
			
				<label for="phone"><b>No. Telepon</b></label><br>
				<input type="text"	name="phone" id="phone" placeholder="Masukan Nomer Telepon.."></input><br>
			
			
				<label for="email"><b>E-Mail</b></label><br>
				<input type="text"	name="email" id="email" placeholder="Masukan Email.."></input>
		</div>
		<button class="buttonsearch button1" type="submit" name="submit"><span>Tambah Data</span></button>
		</div>
		
	</form>
</div>
	 <?php 
mysqli_query($conn, "DELETE FROM xray_patient_order");
mysqli_query($conn, "DELETE FROM xray_dokter_order");
mysqli_query($conn, "DELETE FROM xray_department_order");
mysqli_query($conn, "DELETE FROM xray_type_order");
return mysqli_affected_rows($conn);
						  ?>

	</body>
	</html>
	 <?php } else {header("location:../index.php");} ?>