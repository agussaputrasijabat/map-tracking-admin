function AddMarker(lat, lon, title) {

    var marker = L.marker([lat, lon]).addTo(map).bindPopup(title, { autoClose: false, closeOnClick: false }).openPopup();

    markers.addLayer(marker);
}

function RenderMarkers(device_id) {
    $.get('modules/live/getData.php?device_id=' + device_id, function (res) {
        if (JSON.stringify(tracking_data) != JSON.stringify(res)) {
            markers.clearLayers();

            res.locations.forEach(location => {
                var title = `Lokasi: ${location.name}` + (location.location_id == res.device.location_id ? `<br/>Kendaraan: ${res.device.name}<br/>Tanggal: ${res.device.updated_at}` : '');
                AddMarker(location.latitude, location.longitude, title);

                if (location.location_id == res.device.location_id) {
                    map.setView(new L.LatLng(location.latitude, location.longitude), 13);
                }
            });

            tracking_data = res;
        }
    });
}