<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

if (!isset($_GET['ip'])) {
    echo json_encode(['error' => 'Missing IP']);
    exit;
}

$ip = $_GET['ip'];

if (!filter_var($ip, FILTER_VALIDATE_IP)) {
    echo json_encode(['error' => 'Invalid IP']);
    exit;
}

$cacheDir = __DIR__ . '/cache';
$cacheFile = $cacheDir . '/' . md5($ip) . '.json';
$cacheTtl = 86400;

if (!file_exists($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTtl) {
    echo file_get_contents($cacheFile);
    exit;
}

$url = "https://freeipapi.com/api/json/$ip";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(['error' => 'Curl Error: ' . curl_error($ch)]);
    curl_close($ch);
    exit;
}

curl_close($ch);

file_put_contents($cacheFile, $response);

echo $response;