<?php
require 'function_dokter.php';
session_start();

if(isset($_POST["submit"]) ) {
$username = $_POST['username'];
$password = $_POST['password'];
$passwordulang = $_POST['passwordulang'];
$radiographer_email = $_POST['radiographer_email'];
$result = mysqli_query($conn, "SELECT * FROM xray_login
							INNER JOIN xray_radiographer
							ON xray_login.username = '$username' = xray_radiographer.username = '$username' ");
$row = mysqli_fetch_assoc($result);
$cek = mysqli_num_rows($result);
if ($cek > 0)
		{
echo "<script>alert('username sudah ada');</script>";
}
elseif (!filter_var($radiographer_email, FILTER_VALIDATE_EMAIL))
{
echo "<script>alert('Format Email salah');</script>";
}
else
{
if ($password == $passwordulang)
{
tambah_grapher($_POST);
echo "<script>alert('Data berhasil dimasukkan');
document.location.href='view_dokter_radiographer.php';
</script>";
}
else
{
echo "<script>alert('password tidak sama');</script>";
}
}
}
if ($_SESSION['level'] == "admin") {
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tambah Data Radiographer</title>
		<?php include('head.php'); ?>
	</head>
	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $lang['new_radiographer'] ?></li>
				<li style="float: right;">
						<label>Zoom</label>
						<a href="#" id="decfont"><i class="fas fa-minus-circle"></i></a>
						<a href="#" id="incfont"><i class="fas fa-plus-circle"></i></a>
					</li>
			</ol>
		</nav>

		<div id="container1">
			<div id="content1">
	
	<div class="body">
		<h1 style="color: #ee7423"><?= $lang['add_radiographer'] ?></h1>
		<div class="container-fluid">
			<div class="row form-dokter">
				<form action="" method="post">
					<div class="col-md-5 col-md-offset-1">
						
						
						<label for="radiographer_name"><b><?= $lang['f_name'] ?> </b></label><br>
						<input type="text" name="radiographer_name" id="radiographer_name" placeholder="<?= $lang['input_f_name'] ?>" required>
						
						
						<label for="radiographer_lastname"><b><?= $lang['l_name'] ?></b></label><br>
						<input type="text" name="radiographer_lastname" id="radiographer_lastname" placeholder="<?= $lang['input_l_name'] ?>">
						<br>
						
						<label for="radiographer_sex"><b><?= $lang['sex'] ?></b></label><br>
						<!-- <input type="radio" name="radiographer_sex"	value="Laki-Laki" required>laki-laki</input>
						<input type="radio" name="radiographer_sex" value="Perempuan" required>perempuan</input> -->
						<label class="radio-admin">
							<input type="radio" checked="checked" name="radiographer_sex" value="Laki-Laki" required> <?= $lang['male'] ?>
							<span class="checkmark"></span>
						</label><br>
						<label class="radio-admin">
							<input type="radio" name="radiographer_sex" value="Perempuan" required> <?= $lang['female'] ?>
							<span class="checkmark"></span>
						</label><br>
						<label class="radio-admin">
							<input type="radio" name="radiographer_sex" value="Other" required> <?= $lang['other'] ?>
							<span class="checkmark"></span>
						</label>
						<br>
						
						<label for="radiographer_tlp"><b><?= $lang['no_telp'] ?></b></label><br>
						<div class="input-group">
							<div style="border: 0px; font-size: 13px;" class="input-group-addon select-input">
								<select name="kodearea">
									<option value="+62"> +62 | Indonesia</option>
									<option value="+60">+60 | Malaysia</option>
									<option value="+95">+95 | Myanmar</option>
									<option value="+673">+673 | Brunei Darussalam</option>
									<option value="+855">+855 | Kamboja</option>
									<option value="+856">+856 | Laos</option>
									<option value="+670">+670 | Timor Leste</option>
									<option value="+65">+65 | Singapura</option>
									<option value="+66">+66 | Thailand</option>
									<option value="+63">+63 | Filipina</option>
								</select>
							</div>
							<input type="text" name="radiographer_tlp" id="radiographer_tlp" placeholder="<?= $lang['input_telp'] ?>" required>
						</div>
					</div>
					<div class="col-md-5">
						
						<label for="radiographer_email"><b>Email</b></label><br>
						<input type="text" name="radiographer_email" id="radiographer_email" placeholder="<?= $lang['input_email'] ?>" required>
						
						
						<label for="username"><b>Username</b></label><br>
						<input type="text" name="username" id="username" required placeholder="<?= $lang['input_uname'] ?>">
						
						
						<label for="password"><b>Password</b></label><br>
						<input type="password" name="password" id="password" placeholder="<?= $lang['input_pw'] ?>" required>
						
						
						<label for="passwordulang"><b><?= $lang['input_pw2'] ?></b></label><br>
						<input type="password" name="passwordulang" id="passwordulang" placeholder="<?= $lang['input_pw2'] ?>.." required>
						
						
						
						<button class="button1" type="submit" name="submit"><?= $lang['add_data'] ?></button>
					</div>
					
				</form>
			</div>
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
	
</body>
</html>
<?php } else {header("location:../index.php");} ?>