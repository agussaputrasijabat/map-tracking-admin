<?php

include '../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  header('Content-Type: application/json');
  extract($_POST);

  $queryStatement = $conn->query("SELECT * FROM devices WHERE device_id=$device_id");
  $device = $queryStatement->fetch_object();
  $total_balance = doubleval($device->balance) + doubleval($balance);

  $save = $conn->query("UPDATE devices SET balance=$total_balance WHERE device_id=$device_id");
  echo json_encode(array("success" => $save));
  exit;
}

$device_id = $_GET['device_id'] ?? 0;
$queryStatement = $conn->query("SELECT * FROM devices WHERE device_id=$device_id");
$device = $queryStatement->fetch_object();

?>

<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Tambah Saldo #<?= $device->name ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form id="form-balance-device" action="modules/device/balance.php" method="post" autocomplete="off">
      <input type="hidden" name="device_id" value="<?= $device->device_id ?>" />
      <div class="form-group">
        <label for="exampleInputEmail1">Saldo</label>
        <input type="number" step="any" class="form-control" id="balance" name="balance" value="0">
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>

<script>
  $(document).on('submit', '#form-balance-device', function(e) {
    e.preventDefault();
    var form = this;

    $.post($(form).attr('action'), $(form).serialize(), function(res) {
      location.reload();
    });
  })
</script>