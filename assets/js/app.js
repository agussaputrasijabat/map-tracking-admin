function AddMarker(lat, lon, icon) {
    var size = new OpenLayers.Size(40, 40);
    var offset = new OpenLayers.Pixel(-(size.w / 2), -size.h);

    var location = new OpenLayers.LonLat(lon, lat).transform(
        new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
        map.getProjectionObject() // to Spherical Mercator Projection
    );

    markers.addMarker(new OpenLayers.Marker(location,
        new OpenLayers.Icon('assets/img/marker_' + icon + '.png', size, offset)
    ));
}

function RenderMarkers(device_id) {
    $.get('modules/live/getData.php?device_id=' + device_id, function (res) {
        markers.clearMarkers();

        while (map.popups.length) {
            map.removePopup(map.popups[0]);
        }

        res.locations.forEach(location => {
            AddMarker(location.latitude, location.longitude, (location.location_id == res.device.location_id ? 'red' : 'road'));
        });
    });
}