<?php

$queryStatement = $conn->query("SELECT * FROM devices");
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kendaraan</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-secondary btn-add-device">Tambah</button>
        </div>
    </div>
    <br />

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">RFID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($device = $queryStatement->fetch_object()) : ?>
                    <tr>
                        <td><?= $device->rfid ?></td>
                        <td><?= $device->name ?></td>
                        <td>Rp.<?= $device->balance ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-secondary btn-edit-device" data-id="<?= $device->device_id ?>">Ubah</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="device-modal" tabindex="-1" role="dialog" aria-labelledby="device-modal-Label" aria-hidden="true">
        <div class="modal-dialog" role="document">

        </div>
    </div>
</main>

<script>
    $('.btn-add-device').click(function(e) {
        e.preventDefault();
        $.get('modules/device/add.php', function(res) {
            $('#device-modal .modal-dialog').html(res);
            $('#device-modal').modal('show');
        });
    })

    $('.btn-edit-device').click(function(e) {
        e.preventDefault();
        var device_id = $(this).data('id');
        $.get('modules/device/edit.php?device_id=' + device_id, function(res) {
            $('#device-modal .modal-dialog').html(res);
            $('#device-modal').modal('show');
        });
    })
</script>