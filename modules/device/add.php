<?php

include '../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    extract($_POST);
    $dt = date("Y-m-d H:i:s");
    $save = $conn->query("INSERT INTO devices VALUES (null, 1,'$rfid', '$name', $balance, '$dt', '$dt')");
    echo json_encode(array("success" => $save));
    exit;
}

?>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Lokasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="form-add-device" action="modules/device/add.php" method="post" autocomplete="off">
            <div class="form-group">
                <label for="exampleInputEmail1">RFID</label>
                <input type="text" class="form-control" id="rfid" name="rfid" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Saldo</label>
                <input type="number" step="any" class="form-control" id="balance" name="balance" value="0" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<script>
    $(document).on('submit', '#form-add-device', function(e) {
        e.preventDefault();
        var form = this;
        Pace.start();
        $.post($(form).attr('action'), $(form).serialize(), function(res) {
            location.reload();
        });
    })
</script>