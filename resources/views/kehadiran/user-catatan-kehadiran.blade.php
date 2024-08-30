@extends('template-user.index')

@section('content-user')
<meta name="csrf-token" content="{{ csrf_token() }}">

<h2 class="text-center">Rekam Wajah untuk Absensi</h2><br>

<!-- Video element for camera -->
<div class="d-flex justify-content-center" id="camera-section" style="display: none;">
    <video id="video" class="responsive-video" autoplay style="border: 1px solid black;"></video>
</div>

<style>
    .responsive-video {
        width: 100%;
        height: auto;
        max-width: 100%;
        object-fit: cover; /* This ensures the video fills the container while maintaining aspect ratio */
    }

    @media (orientation: portrait) {
        .responsive-video {
            max-height: 70vh; /* Adjust the max height to 70% of the viewport height in portrait mode */
        }
    }

    @media (orientation: landscape) {
        .responsive-video {
            max-height: 70vh; /* Adjust the max height to 50% of the viewport height in landscape mode */
        }
    }
</style>

<br>

<div class="d-flex justify-content-center">
    <button id="capture" class="btn btn-primary"><i class="fas fa-camera"></i> Tangkap Gambar</button>
</div>
<br>
<div class="d-flex justify-content-center">
    <canvas id="canvas" width="440" height="280" style="display: none;"></canvas>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card-table">
            <div class="card-body">

                
            @if(session('success'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Selamat! </strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('update'))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Selamat! </strong> {{ session('update') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Selamat! </strong> {{ session('delete') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

                <div class="table-responsive">
                    <table class="table table-center table-hover datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>NIY</th>
                                <th>Nama Pegawai</th>
                                <th>Tgl. Masuk</th>       
                                <th>Waktu</th>
                                <th class="no-sort">Action</th>
                            </tr>
                        </thead>
                        
                            @include('kehadiran.user-table-kehadiran')
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');

// Predefined coordinates (e.g., latitude and longitude of a specific location)
const targetLatitude = -6.576633; // RUMAH : -6.5767342  SDUT : -6.576633
const targetLongitude = 110.6771983; // RUMAH : 110.6797996  SDUT : 110.6771983

// Function to calculate the distance between two coordinates
function getDistance(lat1, lon1, lat2, lon2) {
    const R = 6371; // Radius of the earth in km
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    const a = 
        0.5 - Math.cos(dLat)/2 + 
        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * 
        (1 - Math.cos(dLon))/2;

    return R * 2 * Math.asin(Math.sqrt(a));
}

// Get the user's current location
navigator.geolocation.getCurrentPosition(
    (position) => {
        const userLatitude = position.coords.latitude;
        const userLongitude = position.coords.longitude;
        console.log('User Latitude:', userLatitude, 'User Longitude:', userLongitude);

        // Calculate the distance to the target coordinates
        const distance = getDistance(userLatitude, userLongitude, targetLatitude, targetLongitude);
        console.log('Distance to Target:', distance);

        // Allow a small margin of error in meters
        if (distance <= 0.3) { // Adjust the distance threshold as needed (0.1 km = 100 meters)
            // User is within the acceptable range, enable the camera
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.srcObject = stream;
                })
                .catch(err => {
                    console.error("Error accessing camera: ", err);
                });
        } else {
            // User is outside the acceptable range, disable the camera
            alert('Anda berada di luar area yang diizinkan untuk melakukan absensi.');
        }
    },
    (error) => {
        console.error('Error getting geolocation: ', error);
        alert('Tidak dapat mengakses lokasi Anda.');
    }
);


// Capture image when the button is pressed
document.getElementById('capture').addEventListener('click', () => {
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    const dataURL = canvas.toDataURL('image/png');

    // Send the image to the server
    fetch('/rekam-wajah', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({
            image: dataURL
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Wajah berhasil direkam dan disimpan!');
            // Reload the table content via AJAX
            reloadTableData();
        } else {
            alert('Gagal menyimpan gambar: ' + data.error);
        }
    })
    .catch(error => console.error('Error saving image:', error));
});

function reloadTableData() {
    fetch('/kehadiran-table')
        .then(response => response.text())
        .then(html => {
            document.querySelector('tbody').innerHTML = html;
        })
        .catch(error => console.error('Error reloading table:', error));
}

</script>

@endsection

