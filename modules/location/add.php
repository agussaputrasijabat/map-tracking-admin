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
        <div class="row">
            <div class="col-6">
                <form id="form-add-location" action="modules/location/add.php" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Unique ID</label>
                        <input type="text" class="form-control" id="unique_id" name="unique_id" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Latitude</label>
                        <input type="number" step="any" class="form-control" id="latitude" name="latitude" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Longitude</label>
                        <input type="number" step="any" class="form-control" id="longitude" name="longitude" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <div class="col-6">
                <div id="MapLocation" style="height: 350px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('submit', '#form-add-location', function(e) {
        e.preventDefault();
        var form = this;
        Pace.start();
        $.post($(form).attr('action'), $(form).serialize(), function(res) {
            location.reload();
        });
    })

    $(document).ready(function() {
        var map = L.map('MapLocation').setView(new L.LatLng(0.474736, 101.4405126), 13);

        L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            attribution: '&copy; 5 Orang Pendekar Dari Pelita Indonesia'
        }).addTo(map);

        map.attributionControl.setPrefix(false);

        var marker = new L.marker(new L.LatLng(0.474736, 101.4405126), {
            draggable: 'true'
        });

        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
                draggable: 'true'
            }).bindPopup(position).update();
            $("#latitude").val(position.lat);
            $("#longitude").val(position.lng).keyup();
        });

        $("#latitude, #longitude").change(function() {
            var position = [parseFloat($("#latitude").val()), parseFloat($("#longitude").val())];
            marker.setLatLng(position, {
                draggable: 'true'
            }).bindPopup(position).update();

            setTimeout(function() {
                map.setView(new L.LatLng(position[0], position[1]), 13, {
                    animation: true
                });
            }, 500);
        });

        setTimeout(function() {
            map.invalidateSize();
            map.addLayer(marker);
        }, 500);
    });
</script>