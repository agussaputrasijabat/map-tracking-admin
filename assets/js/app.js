function AddMarker(lat, lon, title) {

    var marker = L.marker([lat, lon], { icon: roadIcon }).addTo(map).bindPopup(title, { autoClose: false, closeOnClick: false }).openPopup();

    markers.addLayer(marker);
}

function RenderMarkers(device_id, set_center) {
    $.get('modules/live/getData.php?device_id=' + device_id, function (res) {
        if (JSON.stringify(tracking_data) != JSON.stringify(res)) {
            markers.clearLayers();

            res.locations.forEach(location => {
                var title = `<strong>${location.name}</strong>` + (location.location_id == res.device.location_id ? `<br/>
                Kendaraan: ${res.device.name}<br/>
                Tanggal: ${res.device.updated_at}<br/>
                Sisa Saldo: Rp.${res.device.balance}` : '');
                AddMarker(location.latitude, location.longitude, title);
            });

            map.setView(new L.LatLng(res.device.location.latitude, res.device.location.longitude), 13, { animation: true });
            console.log(`centering ${res.device.location.name}`);

            tracking_data = res;
        }
        else {
            if (set_center) {
                map.setView(new L.LatLng(tracking_data.device.location.latitude, tracking_data.device.location.longitude), 13, { animation: true });
            }
        }
    });
}