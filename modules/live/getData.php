<?php

include '../../db.php';
header('Content-Type: application/json');

$locations = array();
$devices = array();

$queryState = $conn->query("SELECT * FROM locations");
while ($location = $queryState->fetch_assoc()) {
    array_push($locations, $location);
}

$device_id = $_GET['device_id'] ?? 0;
$queryState = $conn->query("SELECT * FROM devices WHERE device_id=$device_id");
while ($device = $queryState->fetch_assoc()) {
    array_push($devices, $device);
}

echo json_encode(array('device' => $devices[0], 'locations' => $locations));
