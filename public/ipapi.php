<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

if (!isset($_GET['ip'])) {
    echo json_encode(['error' => 'Missing IP']);
    exit;
}

if (!filter_var($ip, FILTER_VALIDATE_IP)) {
    echo json_encode(['error' => 'Invalid IP']);
    exit;
}

$ip = $_GET['ip'];
$url = "https://freeipapi.com/api/json/$ip";

// Fetch from API
$response = file_get_contents($url);
echo $response;