<?php

include '../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    extract($_POST);
    $save = $conn->query("INSERT INTO locations VALUES (null, '$unique_id', '$name', $latitude, $longitude)");
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
        <form id="form-add-location" action="modules/location/add.php" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Unique ID</label>
                <input type="text" class="form-control" id="unique_id" name="unique_id">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Latitude</label>
                <input type="number" step="any" class="form-control" id="latitude" name="latitude">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Longitude</label>
                <input type="number" step="any" class="form-control" id="longitude" name="longitude">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<script>
    $(document).on('submit', '#form-add-location', function(e) {
        e.preventDefault();
        var form = this;

        $.post($(form).attr('action'), $(form).serialize(), function(res) {
            location.reload();
        });
    })
</script>