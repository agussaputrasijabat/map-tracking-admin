<?php

include '../../db.php';
header('Content-Type: application/json');
$notification_id = $_GET['notification_id'] ?? 0;
$save = $conn->query("DELETE FROM notifications WHERE notification_id=$notification_id");
echo json_encode(array("success" => $save));
