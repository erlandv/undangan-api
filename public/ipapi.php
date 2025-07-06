<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // biar bisa diakses dari frontend
header('Access-Control-Allow-Methods: GET');

if (!isset($_GET['ip'])) {
    echo json_encode(['error' => 'Missing IP']);
    exit;
}

$ip = $_GET['ip'];
$url = "https://freeipapi.com/api/json/$ip";

// Fetch from API
$response = file_get_contents($url);
echo $response;
