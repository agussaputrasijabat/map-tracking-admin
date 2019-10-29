<?php

include '../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    extract($_POST);
    $dt = date("Y-m-d H:i:s");
    $save = $conn->query("INSERT INTO notifications VALUES (null, $location_id, '$content')");
    echo json_encode(array("success" => $save));
    exit;
}

$locations = array();
$locationStatement = $conn->query("SELECT * FROM locations");
while ($location =  $locationStatement->fetch_object()) {
    array_push($locations, $location);
}

?>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pemberitahuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="form-add-device" action="modules/notification/add.php" method="post" autocomplete="off">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Lokasi</label>
                <select class="form-control" name="location_id" id="location_id">
                    <?php foreach ($locations as $location) : ?>
                        <option value="<?= $location->location_id ?>"><?= $location->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Pesan</label>
                <textarea class="form-control" id="content" name="content" required></textarea>
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