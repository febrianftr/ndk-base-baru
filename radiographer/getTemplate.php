<?php

require '../koneksi/koneksi.php';

session_start();

$username2 = $_SESSION['username'];

$query = mysqli_query($conn, "SELECT * FROM xray_template ORDER BY title ASC");
$data = [];
$i = 1;
while ($row = mysqli_fetch_array($query)) {
    $template_id = $row['template_id'];
    $title = $row['title'];
    $fill = $row['fill'];
    $username = $row['username'];

    $detail = '<a href="#" class="view-template penawaran-a" data-id="' . $template_id . '">' . $title . '</a>';

    $query1 = mysqli_query($conn, "SELECT * FROM xray_dokter_radiology WHERE username = '$username'");
    $row1 = mysqli_fetch_array($query1);
    $dokradfullname = $dokrad_name = $row1['dokrad_name'] . ' ' . $dokrad_lastname = $row1['dokrad_lastname'];
    $btn = '
    <a href="update_template.php?template_id=' . $template_id . ' "><img data-toggle="tooltip" title="Edit" class="iconbutton" src="../image/edit.png" style="height: 20px;"></a>' .
        '<a href="delete_template.php?template_id=' . $template_id . '" onclick=\'return confirm("Teruskan Menghapus Data?");\'><img style="height: 20px;" data-toggle="tooltip" title="Hapus" class="iconbutton" src="../image/delete.png"></a>';
    $data[] = [
        "no" => $i,
        "action" => $btn,
        "title" => $detail,
        "username" => $dokradfullname
    ];
    $i++;
}

echo json_encode($data);
