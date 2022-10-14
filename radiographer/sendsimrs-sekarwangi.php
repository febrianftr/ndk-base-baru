<?php

require '../koneksi/koneksi.php';

require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

$acc = $_GET['acc'];
$uid = $_GET['uid'];

// jika get berhasil mendapatkan ACC NUMBER dari simrs
try {

    $client = new Client([
        'base_uri' => 'http://182.253.102.213:553',
    ]);

    // get
    $responseGet = $client->request('GET', '/simrs-ws/api/PACS/app/getPeriksaRad?WS_KEY=SKW@QWERTY&acc_number=' . $acc, [
        'auth' => [
            'PACS_user',
            'intiwid'
        ]
    ]);

    $body = $responseGet->getBody();
    $string = $body->getContents();
    $json = json_decode($string);
    // name_dep, prosedur, dokterid, spc_needs, payment, priority, pat_state, named, dokradid, dokrad_name
    $mrn = $json->data->mrn;
    $name_dep = $json->data->name_dep;
    $prosedur = $json->data->prosedur;
    $dokterid = $json->data->dokterid;
    $named = $json->data->named;
    $spc_needs = $json->data->spc_needs;
    $payment = $json->data->payment;
    $priority = $json->data->priority;
    $pat_state = $json->data->pat_state;
    $dokradid = $json->data->dokradid;
    $dokrad_name = $json->data->dokrad_name;

    $workload = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM xray_workload_radiographer WHERE acc = '$acc'"));
    $cekworkload = mysqli_affected_rows($conn);

    // jika mrn dari RISPACS sama dengan MRN SIMRS
    if ($workload['mrn'] == $mrn) {
        echo "mrn sama. data masuk";
        // post jika POST KE SIMRS mengubah UID.
        try {
            $responsePost = $client->request('POST', '/simrs-ws/api/PACS/app/updatePeriksaRad', [
                'auth' => [
                    'PACS_user',
                    'intiwid'
                ],
                'json' => [
                    "WS_KEY" => "SKW@QWERTY",
                    "acc_number" => $acc,
                    "uid" => $uid,
                ],
                'http_errors' => false
            ]);

            mysqli_query($conn, "UPDATE xray_workload_radiographer 
                                SET name_dep = '$name_dep', 
                                prosedur = '$prosedur', 
                                dokterid = '$dokterid', 
                                named = '$named',
                                spc_needs = '$spc_needs', 
                                payment = '$payment',
                                priority = '$priority', 
                                pat_state = '$pat_state', 
                                fromorder = 'terkirim',
                                dokradid = '$dokradid',
                                dokrad_name = '$dokrad_name' 
                                WHERE acc = '$acc' 
                                ");

            mysqli_query($conn, "UPDATE xray_exam2 
                                SET name_dep = '$name_dep', 
                                prosedur = '$prosedur', 
                                dokterid = '$dokterid', 
                                named = '$named',
                                spc_needs = '$spc_needs', 
                                payment = '$payment',
                                priority = '$priority', 
                                pat_state = '$pat_state', 
                                fromorder = 'terkirim',
                                dokradid = '$dokradid',
                                dokrad_name = '$dokrad_name' 
                                WHERE acc = '$acc' 
            ");
            echo "
            <script>
                alert('data berhasil di Ubah');
                document.location.href= 'workload.php';
            </script>";
        } catch (\Throwable $th) {
            echo "
            <script>
                alert('uid tidak terupdate');
                document.location.href= 'workload.php';
            </script>";
        }
    } else {
        echo "
        <script>
            alert('MRN tidak sama / kesalahan input acc number dialat');
            document.location.href= 'workload.php';
        </script>";
    }
    // Jika tidak dapat acc number dari SIMRS
} catch (\GuzzleHttp\Exception\RequestException $e) {
    if ($e->hasResponse()) {
        $response = $e->getResponse();
        $array = json_decode((string) $response->getBody(), true);
        echo "
        <script>
            alert('$array[message]');
            document.location.href= 'workload.php';
        </script>";
    }
}
