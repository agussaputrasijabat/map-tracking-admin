<?php

include '../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    extract($_POST);
    $save = $conn->query("UPDATE routes SET location_from_id=$location_from_id, location_to_id=$location_to_id WHERE route_id=$route_id");
    echo json_encode(array("success" => $save));
    exit;
}

$locations = array();
$locationStatement = $conn->query("SELECT * FROM locations");
while ($location =  $locationStatement->fetch_object()) {
    array_push($locations, $location);
}

$route_id = $_GET['route_id'] ?? 0;
$route = $conn->query("SELECT routes.*, devices.name AS device_name, locations_from.name AS location_from, locations_to.name AS location_to FROM routes 
LEFT JOIN locations locations_from ON locations_from.location_id=routes.location_from_id
LEFT JOIN locations locations_to ON locations_to.location_id=routes.location_to_id
LEFT JOIN devices ON  devices.device_id=routes.device_id WHERE routes.route_id=$route_id")->fetch_object();

?>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Rute <?= $route->route_id ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="form-edit-route" action="modules/route/edit.php" method="post" autocomplete="off">
            <input type="hidden" name="route_id" value="<?= $route->route_id ?>" />
            <div class="form-group">
                <label for="exampleInputEmail1">Kendaraan</label>
                <input type="text" class="form-control" id="device_id" name="device_id" value="<?= $route->device_name ?>" readonly>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">From</label>
                <select class="form-control" name="location_from_id" id="location_from_id">
                    <?php foreach ($locations as $location) : ?>
                        <option value="<?= $location->location_id ?>"><?= $location->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">To</label>
                <select class="form-control" name="location_to_id" id="location_to_id">
                    <?php foreach ($locations as $location) : ?>
                        <option value="<?= $location->location_id ?>"><?= $location->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<script>
    $('#location_from_id').val('<?= $route->location_from_id ?>');
    $('#location_to_id').val('<?= $route->location_to_id ?>');
    $(document).on('submit', '#form-edit-route', function(e) {
        e.preventDefault();
        var form = this;
        if ($('#location_from_id').val() == $('#location_to_id').val()) {
            alert('Keberangkatan tidak boleh sama');
            return;
        }

        $.post($(form).attr('action'), $(form).serialize(), function(res) {
            location.reload();
        });
    })
</script>