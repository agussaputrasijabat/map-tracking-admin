<?php

$queryStatement = $conn->query("SELECT notifications.*, locations.name AS location_name FROM notifications LEFT JOIN locations ON locations.location_id=notifications.location_id");
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Notifikasi</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-secondary btn-add-notification">Tambah</button>
        </div>
    </div>
    <br />

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Pesan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($notification = $queryStatement->fetch_object()) : ?>
                    <tr>
                        <td><?= $notification->location_name ?></td>
                        <td><?= $notification->content ?></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-delete-notification" data-id="<?= $notification->notification_id ?>">Hapus</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary btn-edit-notification" data-id="<?= $notification->notification_id ?>">Ubah</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="notification-modal" tabindex="-1" role="dialog" aria-labelledby="notification-modal-Label" aria-hidden="true">
        <div class="modal-dialog" role="document">

        </div>
    </div>
</main>

<script>
    $('.btn-add-notification').click(function(e) {
        e.preventDefault();
        Pace.start();
        $.get('modules/notification/add.php', function(res) {
            $('#notification-modal .modal-dialog').html(res);
            $('#notification-modal').modal('show');
        });
    })

    $('.btn-edit-notification').click(function(e) {
        e.preventDefault();
        Pace.start();
        var notification_id = $(this).data('id');
        $.get('modules/notification/edit.php?notification_id=' + notification_id, function(res) {
            $('#notification-modal .modal-dialog').html(res);
            $('#notification-modal').modal('show');
        });
    })

    $('.btn-delete-notification').click(function(e) {
        e.preventDefault();
        var notification_id = $(this).data('id');
        Pace.start();
        $.get('modules/notification/delete.php?notification_id=' + notification_id, function(res) {
            location.reload();
        });
    })
</script>