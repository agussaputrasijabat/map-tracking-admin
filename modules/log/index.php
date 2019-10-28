<?php
$devices = array();
$deviceStatement = $conn->query("SELECT * FROM devices");
while ($device = $deviceStatement->fetch_assoc()) {
    array_push($devices, $device);
}
$deviceId = $_GET['device_id'] ?? $devices[0]['device_id'];
$device;

foreach ($devices as $key => $value) {
    if ($deviceId == $value['device_id']) $device = $value;
}

$logs = array();
$logStatement = $conn->query("SELECT device_log.* , devices.name AS device_name, locations.name AS location_name FROM device_log
INNER JOIN devices ON device_log.device_id=devices.device_id
INNER JOIN locations ON device_log.location_id=locations.location_id WHERE devices.device_id=$deviceId");

?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Riwayat Kendaraan #<?= $device['name'] ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <button type="button" class="btn btn-secondary text-center"><?= $device['name'] ?></button>
                <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    <?php foreach ($devices as $key => $value) : ?>
                        <?php if ($deviceId != $value['device_id']) : ?>
                            <a class="dropdown-item" href="?module=log&device_id=<?= $value['device_id'] ?>"><?= $value['name'] ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <br />

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Device</th>
                    <th scope="col">Location</th>
                    <th scope="col">Jarak</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Sisa Saldo</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while($log = $logStatement->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $log['device_name'] ?></td>
                        <td><?= $log['location_name'] ?></td>
                        <td><?= $log['distance'] ?> KM</td>
                        <td>Rp.<?= $log['price'] ?></td>
                        <td>Rp.<?= $log['balance'] ?></td>
                        <td><?= $log['datetime'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</main>