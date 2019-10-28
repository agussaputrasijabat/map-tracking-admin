<?php

$queryStatement = $conn->query("SELECT * FROM locations");
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lokasi</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-secondary btn-add-location">Tambah</button>
        </div>
    </div>
    <br />

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Kode Unik</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Latitude</th>
                    <th scope="col">Longitude</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($location = $queryStatement->fetch_object()) : ?>
                    <tr>
                        <td><?= $location->unique_id ?></td>
                        <td><?= $location->name ?></td>
                        <td><?= $location->latitude ?></td>
                        <td><?= $location->longitude ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-secondary btn-edit-location" data-id="<?= $location->location_id ?>">Ubah</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="location-modal" tabindex="-1" role="dialog" aria-labelledby="location-modal-Label" aria-hidden="true">
        <div class="modal-dialog" role="document">

        </div>
    </div>
</main>

<script>
    $('.btn-add-location').click(function(e) {
        e.preventDefault();
        Pace.start();
        $.get('modules/location/add.php', function(res) {
            $('#location-modal .modal-dialog').html(res);
            $('#location-modal').modal('show');
        });
    })

    $('.btn-edit-location').click(function(e) {
        e.preventDefault();
        Pace.start();
        var location_id = $(this).data('id');
        $.get('modules/location/edit.php?location_id=' + location_id, function(res) {
            $('#location-modal .modal-dialog').html(res);
            $('#location-modal').modal('show');
        });
    })
</script>