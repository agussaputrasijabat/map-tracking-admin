<?php
$devicesLocations = $conn->query("SELECT devices.device_id, devices.name AS device_name, locations.location_id, locations.name AS location_name FROM devices
    INNER JOIN locations ON devices.location_id=locations.location_id");

?>

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
                    <a href="#" class="list-group-item list-group-item-action device" data-id="<?= $devicelocation->device_id ?>"><?= $devicelocation->device_name ?></a>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="col-sm-10">
            <h5>&nbsp;</h5>
            <div id="mapdiv"></div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/lib/OpenLayers.js"></script>

    <script>
        map = new OpenLayers.Map("mapdiv");
        map.addLayer(new OpenLayers.Layer.OSM());

        var lonLat = new OpenLayers.LonLat(101.4522179, 0.4654061)
            .transform(
                new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
                map.getProjectionObject() // to Spherical Mercator Projection
            );

        var zoom = 13;

        var markers = new OpenLayers.Layer.Markers("Markers");
        map.addLayer(markers);

        map.setCenter(lonLat, zoom);

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

        setInterval(() => {
            RenderMarkers(selected_device);
        }, 2000);
    </script>
</main>