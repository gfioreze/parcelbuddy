document.addEventListener("DOMContentLoaded", function() {

    const qrElements = document.querySelectorAll('.qr-code');

    qrElements.forEach(function(qrElement) {

        const deliveryID = qrElement.id;
        const qrText = "Parcel ID: " + deliveryID;

        new QRCode(qrElement, {
            text: qrText,
            width: 168,
            height: 168,
            correctLevel: QRCode.CorrectLevel.H
        });
    });
});