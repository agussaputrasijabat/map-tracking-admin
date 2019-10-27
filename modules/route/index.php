<?php

$deviceStatement = $conn->query("SELECT * FROM devices");
while ($device = $deviceStatement->fetch_object()) {
    $findDevice = $conn->query("SELECT * FROM routes WHERE device_id=$device->device_id")->fetch_object();
    if (empty($findDevice)) {
        $conn->query("INSERT INTO routes VALUES (null, $device->device_id, null, null)");
    }
}

$routeStatement = $conn->query("SELECT routes.*, devices.name AS device_name, locations_from.name AS location_from, locations_to.name AS location_to FROM routes 
LEFT JOIN locations locations_from ON locations_from.location_id=routes.location_from_id
LEFT JOIN locations locations_to ON locations_to.location_id=routes.location_to_id
LEFT JOIN devices ON  devices.device_id=routes.device_id");

?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Rute Kendaraan</h1>
    </div>
    <br />

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Kendaraan</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($route = $routeStatement->fetch_assoc()) : ?>
                    <tr>
                        <td><?= $route['device_name'] ?></td>
                        <td><?= $route['location_from'] ?? '-' ?></td>
                        <td><?= $route['location_to'] ?? '-' ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-secondary btn-edit-route" data-id="<?= $route['route_id'] ?>">Ubah Rute</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="route-modal" tabindex="-1" role="dialog" aria-labelledby="route-modal-Label" aria-hidden="true">
        <div class="modal-dialog" role="document">

        </div>
    </div>
</main>

<script>
    $('.btn-edit-route').click(function(e) {
        e.preventDefault();
        var route_id = $(this).data('id');
        $.get('modules/route/edit.php?route_id=' + route_id, function(res) {
            $('#route-modal .modal-dialog').html(res);
            $('#route-modal').modal('show');
        });
    })
</script>