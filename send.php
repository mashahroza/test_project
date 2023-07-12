<?php
$fio = isset($_POST['fio']) ? $_POST['fio'] : false;
$phone = isset($_POST['phone']) ? $_POST['phone'] : false;
$pixelId = isset($_POST['pixelId']) ? $_POST['pixelId'] : false;

if ($fio && $phone && $pixelId) {
    $data = [
        'method' => 'addRequest',
        'id' => 23456,
        'user_id' => 11111111,
        'api_key' => '3dsaDsdd2cj34jkk4wkdadasdas24',
        'flow' => 'fdD74',
        'pers_info' => [
            'fio' => $fio,
            'phone' => $phone,
            'ip' => $_SERVER['REMOTE_ADDR']
        ]
    ];

    print_r($data);

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.lagoon.me/api/outsource',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    $res = json_decode($response);

    if (isset($res->result) && $res->result === 'success') {
        header('Location: /success.php?id=' . $id);
    } else {
        header('Location: /#form-header');
    }
}
