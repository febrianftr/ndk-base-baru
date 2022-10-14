<?php
require '../koneksi/koneksi.php';
$pkfun = $_POST['pk'] . '.png';
// $query = "SELECT * FROM sales_funnel WHERE pk = '$pkfun'";
// $value = mysqli_query($conn, $query);
// $row1 = mysqli_fetch_assoc($value);
?>
<div class="fill">
    <center>
        <img src="phpqrcode/ttddokter/<?php echo $pkfun; ?>" style=" width:200px; max-width:200px;">

    </center>
</div>