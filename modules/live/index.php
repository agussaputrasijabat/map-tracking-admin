<?php
$devicesLocations = $conn->query("SELECT devices.device_id, devices.name AS device_name, locations.location_id, locations.name AS location_name FROM devices
    INNER JOIN locations ON devices.location_id=locations.location_id");

?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js" integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og==" crossorigin=""></script>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Live Tracking</h1>
    </div>
    <br />


    <div class="row">
        <div class="col-sm-2">
            <h5>Kendaraan</h5>
            <div class="list-group">
                <?php while ($devicelocation = $devicesLocations->fetch_object()) : ?>
                    <a href="#" class="list-group-item list-group-item-action device device-<?= $devicelocation->device_id ?>" data-id="<?= $devicelocation->device_id ?>"><?= $devicelocation->device_name ?></a>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="col-sm-10">
            <h5>&nbsp;</h5>
            <div id="mapid"></div>
        </div>
    </div>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/lib/OpenLayers.js"></script> -->

    <script>
        var map = L.map('mapid').setView(new L.LatLng(0.4654061, 101.4522179), 13);
        var tracking_data = []; // Data nya akan di isi dari app.js. Lihat RenderMarkers();

        // var map = L.map('mapid').setView([101.4522179, 0.4654061], 13);

        // L.tileLayer('https://api.tiles.mapbox.com/v4/mapbox.streets/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        // }).addTo(map);

        L.tileLayer('https://mt1.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            attribution: '&copy; 5 Orang Pendekar Pelita Indonesia'
        }).addTo(map);

        L.icon = function(options) {
            return new L.Icon(options);
        };

        var roadIcon = L.icon({
            iconUrl: 'assets/img/marker_road.png',
            iconSize: [40, 40], // size of the icon
            shadowSize: [40, 40], // size of the shadow
            iconAnchor: [40, 40], // point of the icon which will correspond to marker's location
            popupAnchor: [-27, -40] // point from which the popup should open relative to the iconAnchor
        });

        var markers = L.layerGroup().addTo(map);

        // Device click
        var selected_device = 0;
        $('.device').on('click', function(e) {
            e.preventDefault();
            selected_device = $(this).data('id');
            RenderMarkers(selected_device);
            $('.device').removeClass('active');
            $(this).addClass('active');
        })

        $('.device:first').trigger('click');

        var warningPlayer = new Audio('assets/audio/Red Alert.mp3');

        setInterval(() => {
            RenderMarkers(selected_device);
            var hasWarning = false;
            if (tracking_data) {
                tracking_data.devices.forEach(device => {
                    if (device.route.location_from_id != null && device.route.location_to_id != null) {
                        if (device.location_id == device.route.location_from_id || device.location_id == device.route.location_to_id) {
                            $('.device-' + device.device_id).html(device.name);
                        } else {

                            var message = `Kendaraan ${device.name} telah keluar dari rute yang ditetapkan! Lokasi saat ini: ${device.location.name}`;
                            $('.device-' + device.device_id).html(`${device.name} <span class="badge badge-danger float-right blink" title="${message}" onclick="alert('${message}')">Peringatan!</span>`);

                            warningPlayer.play();
                            hasWarning = true;
                        }
                    }
                });

                if (!hasWarning) {
                    warningPlayer.pause();
                    warningPlayer.currentTime = 0;
                }
            }
        }, 2000);
    </script>
</main>