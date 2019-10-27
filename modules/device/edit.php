<?php

include '../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    extract($_POST);
    $save = $conn->query("UPDATE devices SET rfid='$rfid', name='$name', balance=$balance WHERE device_id=$device_id");
    echo json_encode(array("success" => $save));
    exit;
}

$device_id = $_GET['device_id'] ?? 0;
$queryStatement = $conn->query("SELECT * FROM devices WHERE device_id=$device_id");
$device = $queryStatement->fetch_object();

?>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Lokasi <?= $device->device_id ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="form-edit-device" action="modules/device/edit.php" method="post" autocomplete="off">
            <input type="hidden" name="device_id" value="<?= $device->device_id ?>" />
            <div class="form-group">
                <label for="exampleInputEmail1">RFID</label>
                <input type="text" class="form-control" id="rfid" name="rfid" value="<?= $device->rfid ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $device->name ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Saldo</label>
                <input type="number" step="any" class="form-control" id="balance" name="balance" value="<?= $device->balance ?>">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<script>
    $(document).on('submit', '#form-edit-device', function(e) {
        e.preventDefault();
        var form = this;

        $.post($(form).attr('action'), $(form).serialize(), function(res) {
            location.reload();
        });
    })
</script>