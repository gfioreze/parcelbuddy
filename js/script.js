/*
The code below is responsible for qr code generation and for displaying a map on the page.
The first part generates unique QR codes using the QRCcode.js library and puts these unique
QR codes in a div for every delivery point rendered by the server in the client.
The second part of the code initializes a Leaflet map. By using the geolocation api
we are able to  track the user's location and display it as a marker with the accuracy circle.
Next, Delivery point data are fetched from the get.php api via AJAX and displayed as markers
with popups containing relevant  parcel information.
*/

document.addEventListener("DOMContentLoaded", function() {

    // Base URL for the local server
    const baseUrl = window.location.origin + "/css/parcelbuddy/";
    // Base URL for the server in production
    //const baseUrl = window.location.origin + "/clientserver/";

    // Select all elements with .qr-code class applied to them
    const qrElements = document.querySelectorAll('.qr-code');

    // Create unique QR codes and append to the qrElement divs
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

    // Initialise global variables for marker, circle and zoom
    let marker, circle, zoomed;
    // Initialise a Leaflet map and set the view to the chosen coordinates and zoom level
    let map = L.map('map');
    map.setView([53.41667000, -2.25000000], 15);
    // Tile layer from OpenStreetMap
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Watch for changes in the user's geolocation
    navigator.geolocation.watchPosition(success, error);

    // Success callback function for the geolocation
    function success(pos) {
        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;
        const accuracy = pos.coords.accuracy;

        // Remove any existing markers and circle layers from the map
        if (marker) {
            map.removeLayer(marker);
            map.removeLayer(circle);
        }

        // Add a marker and circle representing the user's location
        marker = L.marker([lat, lng]).addTo(map);
        circle = L.circle([lat, lng], { radius: accuracy }).addTo(map);

        // Fit the map view to the circle's bounds
        if (!zoomed) {
            zoomed = map.fitBounds(circle.getBounds());
        }
        map.setView([lat, lng]);
    }

    // Error callback function for the geolocation
    function error(err) {
        if (err.code === 1) {
            alert("Please allow geolocation access");
        } else {
            alert("Cannot get current location");
        }
    }

    // Defines the API endpoint for fetching delivery point data information
    const api = baseUrl + "get.php";
    // Fetch the data from the api
    fetch(api)
        .then(response => response.json())
        .then(data => {
            data.forEach(item => {
                const { deliveryID, address1, address2, lat, long, postcode } = item;
                // Add markers for delivery points on the map
                let marker = L.marker([lat, long]).addTo(map);
                // Creates a popup with details to the marker
                marker.bindPopup(`<b>Parcel ID: </b>${ deliveryID }<br><b>Address:</b> ${ address1 } - <br> ${ address2 } <br><b>Postcode:</b> ${ postcode }`).openPopup();
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});