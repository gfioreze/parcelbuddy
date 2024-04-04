document.addEventListener("DOMContentLoaded", function() {

    const qrElements = document.querySelectorAll('.qr-code');

    qrElements.forEach(function(qrElement) {

        const deliveryID = qrElement.id;
        const qrText = "Parcel ID: " + deliveryID;

        new QRCode(qrElement, {
            text: qrText,
            width: 128,
            height: 128,
            correctLevel: QRCode.CorrectLevel.H
        });
    });
});