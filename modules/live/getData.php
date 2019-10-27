<?php

include '../../db.php';
include '../../functions.php';
header('Content-Type: application/json');

$locations = array();
$devices = array();
$routes = array();

$queryState = $conn->query("SELECT * FROM locations");
while ($location = $queryState->fetch_assoc()) {
    array_push($locations, $location);
}

$queryState = $conn->query("SELECT * FROM routes");
while ($route = $queryState->fetch_assoc()) {
    array_push($routes, $route);
}

$device_id = $_GET['device_id'] ?? 0;
$currentDevice = array();
$queryState = $conn->query("SELECT * FROM devices");
while ($device = $queryState->fetch_assoc()) {
    $device['route'] = search($routes, 'device_id', $device['device_id'])[0];
    $device['location'] = search($locations, 'location_id', $device['location_id'])[0];
    array_push($devices, $device);
    if ($device['device_id'] == $device_id) {
        $currentDevice = $device;
    }
}

echo json_encode(array('device' => $currentDevice, 'locations' => $locations, 'routes' => $routes, 'devices' => $devices));
