<?php
if (isset($_GET['norek'])) {
    $saldo = urlencode($_GET['norek']);

    // Construct the URL with parameters separated by slashes
    $apiUrl = "https://api.siunbin.com/api/v1/bank/rekening/saldo/$saldo";

    $data = file_get_contents($apiUrl);

    $dataArray = json_decode($data, true);

    // Redirect to the constructed URL
    header("Location: $apiUrl");
} else {
    echo "Required parameters are missing.";
}
