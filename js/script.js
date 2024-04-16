document.addEventListener("DOMContentLoaded", function() {

    // localhost
    const baseUrl = window.location.origin + "/css/parcelbuddy/";
    // production
    //const baseUrl = window.location.origin + "/clientserver/";
    const qrElements = document.querySelectorAll('.qr-code');

    qrElements.forEach(function(qrElement) {

        const deliveryID = qrElement.id;
        const qrText = baseUrl + "parcel.php?id=" + deliveryID;

        new QRCode(qrElement, {
            text: qrText,
            width: 128,
            height: 128,
            correctLevel: QRCode.CorrectLevel.H
        });
    });

    let marker, circle, zoomed;

    let map = L.map('map');
    map.setView([53.41667000, -2.25000000], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    navigator.geolocation.watchPosition(success, error);

    function success(pos) {
        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;
        const accuracy = pos.coords.accuracy;

        if (marker) {
            map.removeLayer(marker);
            map.removeLayer(circle);
        }

        marker = L.marker([lat, lng]).addTo(map);
        circle = L.circle([lat, lng], { radius: accuracy }).addTo(map);

        if (!zoomed) {
            zoomed = map.fitBounds(circle.getBounds());
        }

        map.setView([lat, lng]);
    }

    function error(err) {
        if (err.code === 1) {
            alert("Please allow geolocation access");
        } else {
            alert("Cannot get current location");
        }
    }

    const api = baseUrl + "get.php";
    fetch(api)
        .then(response => response.json())
        .then(data => {
            data.forEach(item => {
                const { deliveryID, address1, address2, lat, long, postcode } = item;
                //console.log(lat, long);
                let marker = L.marker([lat, long]).addTo(map);
                marker.bindPopup(`<b>Parcel ID: </b>${ deliveryID }<br><b>Address:</b> ${ address1 } - <br> ${ address2 } <br><b>Postcode:</b> ${ postcode }`).openPopup();
                const qrElement = document.createElement('div');
                qrElement.id = deliveryID;
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});