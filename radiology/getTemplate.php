<?php

require '../koneksi/koneksi.php';

session_start();

$username = $_SESSION['username'];

$query = mysqli_query($conn, "SELECT * FROM xray_template WHERE username = '$username' ORDER BY title ASC");
$data = [];
$i = 1;
while ($row = mysqli_fetch_array($query)) {
    $template_id = $row['template_id'];
    $title = $row['title'];
    $fill = $row['fill'];
    if ($username != "demo2") {
        $btn = '
    <a href="update_template.php?template_id=' . $template_id . ' "><img data-toggle="tooltip" title="Edit" class="iconbutton" src="../image/edit.png" style="height: 20px;"></a>' .
            '<a href="delete_template.php?template_id=' . $template_id . '" onclick=\'return confirm("Teruskan Menghapus Data?");\'><img style="height: 20px;" data-toggle="tooltip" title="Hapus" class="iconbutton" src="../image/delete.png"></a>';
        $data[] = [
            "no" => $i,
            "action" => $btn,
            "title" => $title
        ];
        $i++;
    } else {
        $btn = '
    <a href="#!" onclick=\'return confirm("Akses Demo Terbatas");\'><img data-toggle="tooltip" title="Edit" class="iconbutton" src="../image/edit.png" style="height: 20px;"></a>' .
            '<a href="#!" onclick=\'return confirm("Akses Demo Terbatas");\'><img style="height: 20px;" data-toggle="tooltip" title="Hapus" class="iconbutton" src="../image/delete.png"></a>';
        $data[] = [
            "no" => $i,
            "action" => $btn,
            "title" => $title
        ];
        $i++;
    }
}

echo json_encode($data);
