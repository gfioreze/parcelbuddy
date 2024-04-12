document.addEventListener("DOMContentLoaded", function() {

    const baseUrl = window.location.origin + "/css/parcelbuddy/";
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
});