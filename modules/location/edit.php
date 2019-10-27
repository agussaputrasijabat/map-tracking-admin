<?php

include '../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    extract($_POST);
    $save = $conn->query("UPDATE locations SET unique_id='$unique_id', name='$name', latitude=$latitude, longitude=$longitude WHERE location_id=$location_id");
    echo json_encode(array("success" => $save));
    exit;
}

$location_id = $_GET['location_id'] ?? 0;
$queryStatement = $conn->query("SELECT * FROM locations WHERE location_id=$location_id");
$location = $queryStatement->fetch_object();

?>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Lokasi <?= $location->location_id ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="form-edit-location" action="modules/location/edit.php" method="post">
            <input type="hidden" name="location_id" value="<?= $location->location_id ?>" />
            <div class="form-group">
                <label for="exampleInputEmail1">Unique ID</label>
                <input type="text" class="form-control" id="unique_id" name="unique_id" value="<?= $location->unique_id ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $location->name ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Latitude</label>
                <input type="text" class="form-control" id="latitude" name="latitude" value="<?= $location->latitude ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Longitude</label>
                <input type="text" class="form-control" id="longitude" name="longitude" value="<?= $location->longitude ?>">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<script>
    $(document).on('submit', '#form-edit-location', function(e) {
        e.preventDefault();
        var form = this;

        $.post($(form).attr('action'), $(form).serialize(), function(res) {
            location.reload();
        });
    })
</script>