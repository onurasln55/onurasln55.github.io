<?php

// API anahtarını al
$api_key = $_POST['api_key'];

// Hash listesi dosyasını oku
$hash_list = file($_FILES['hash_list']['tmp_name']);

// Hash listesi dosyasında her satır için
foreach ($hash_list as $hash) {
    // VirusTotal API'sine istek gönder
    $url = "https://www.virustotal.com/api/v3/search?query=" . trim($hash);
    $headers = array(
        "Accept: application/json",
        "x-apikey: " . $api_key
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    // JSON sonucunu dekode et
    $json_response = json_decode($response, true);
    $data = $json_response["data"];

    // Analiz sonuçlarını işle
    $attributes = $data[0]["attributes"];
    $malicious = $attributes["last_analysis_stats"]["malicious"];
    $scan_date = $attributes["last_analysis_date"];
    $md5 = $attributes["md5"];
    $scan_id = $data[0]["id"];
    $scan_link = "https://www.virustotal.com/gui/file/" . $scan_id;
    echo "Hash: " . $hash . "<br>";
    echo "Malicious: " . $malicious . "<br>";
    echo "Scan date: " . $scan_date . "<br>";
    echo "MD5: " . $md5 . "<br>";
    echo "Scan link: " . $scan_link . "<br>";
}

?>
