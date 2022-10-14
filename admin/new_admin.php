<?php
require 'function_dokter.php';
session_start();

if(isset($_POST["submit"]) ) {
$username = $_POST['username'];
$password = $_POST['password'];
$passwordulang = $_POST['passwordulang'];
$result = mysqli_query($conn, "SELECT * FROM xray_login INNER JOIN xray_admin ON xray_login.username = '$username' = xray_admin.username = '$username' ");
$row = mysqli_fetch_assoc($result);
$cek = mysqli_num_rows($result);
	if ($cek > 0)
		{
echo "<script>alert('username sudah ada');</script>";
}
else
{
if ($password == $passwordulang)
{
admin_tambah($_POST);
echo "<script>alert('Data berhasil dimasukkan');
document.location.href='view_admin.php';
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
		<title>Tambah Data Admin</title>
		<?php include('head.php'); ?>
	</head>
	<body>
		<?php include('menu-bar.php'); ?><br>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb1 breadcrumb">
				<li class="breadcrumb-item"><a href="index.php"><?= $lang['home'] ?></a></li>
				<li class="breadcrumb-item"><a href="administrator.php"><?= $lang['administrator'] ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $lang['new_admin'] ?></li>
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
		<h1 style="color: #ee7423"><?= $lang['add_admin'] ?></h1>
		<div class="container-fluid">
			<div class="row form-dokter">
				<form action="" method="post">
					
					<div class="col-md-5 col-md-offset-1">
						<label for="ad_name"><b><?= $lang['f_name'] ?> </b></label><br>
						<input type="text" name="ad_name" id="ad_name" placeholder="<?= $lang['input_f_name'] ?>" required>
						
						
						<label for="ad_lastnamed"><b><?= $lang['l_name'] ?></b></label><br>
						<input type="text" name="ad_lastname" id="ad_lastname" placeholder="<?= $lang['input_l_name'] ?>">
						<br>
						<label for="username"><b>Username</b></label><br>
						<input type="text" name="username" id="username" placeholder="<?= $lang['input_uname'] ?>" required>
						
					</div>
					<div class="col-md-5">
						
						<label for="password"><b><?= $lang['input_pw'] ?></b></label><br>
						<input type="password" name="password" id="password" placeholder="<?= $lang['input_pw'] ?>.." required>
						
						
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