<?php

include '../../db.php';
header('Content-Type: application/json');
extract($_POST);

$total_balance = 0;

$save = $conn->query("UPDATE devices SET balance=$total_balance WHERE device_id=$device_id");
echo json_encode(array("success" => $save));
exit;