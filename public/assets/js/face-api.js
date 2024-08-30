if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
        function (position) {
            const userLat = position.coords.latitude;
            const userLng = position.coords.longitude;

            // Koordinat area yang diizinkan
            const allowedLat = -6.2; // Contoh: koordintat latitude lokasi yang diizinkan
            const allowedLng = 106.816666; // Contoh: koordintat longitude lokasi yang diizinkan

            // Cek apakah pengguna berada dalam radius 10 meter
            if (
                isWithinRadius(
                    userLat,
                    userLng,
                    allowedLat,
                    allowedLng,
                    radiusInDegrees
                )
            ) {
                console.log("Anda berada dalam radius yang diizinkan.");

                // Mulai pemindaian barcode atau pengenalan wajah
                startBarcodeScanning();
            } else {
                console.log("Anda berada di luar radius yang diizinkan.");
                alert(
                    "Anda tidak berada dalam area yang diizinkan untuk melakukan scan."
                );
            }
        },
        function (error) {
            console.error("Error mendapatkan lokasi: ", error);
        }
    );
} else {
    console.error("Geolocation API tidak didukung di browser ini.");
}
