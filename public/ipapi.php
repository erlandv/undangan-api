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

$url = "https://freeipapi.com/api/json/$ip";
$response = file_get_contents($url);
echo $response;