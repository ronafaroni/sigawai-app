@extends('template-user.index')

@section('content-user')
    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Absensi Pegawai</h5>
            <div class="list-btn">
                <ul class="filter-list">
                    <li>
                        <a id="openModalBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dataAbsensiPegawai"><span><i class="fe fe-camera me-2"></i>Absensi Pegawai</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
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

    <div class="modal fade" id="dataAbsensiPegawai" tabindex="-1" role="dialog" aria-labelledby="dataInformasiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataInformasiLabel">Absensi Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                        <button id="capture" class="btn btn-primary"><i class="fas fa-camera"></i> Simpan Kehadiran</button>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <canvas id="canvas" width="440" height="280" style="display: none;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const openModalBtn = document.getElementById('openModalBtn');
    const captureBtn = document.getElementById('capture');
    const modal = new bootstrap.Modal(document.getElementById('dataAbsensiPegawai'), { keyboard: false });

    // Predefined coordinates (update as needed)
    const targetLatitude = -6.5768435;
    const targetLongitude = 110.6768409;
    let isWithinArea = false;

    function getDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius of the Earth in kilometers
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = 
            0.5 - Math.cos(dLat)/2 + 
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * 
            (1 - Math.cos(dLon))/2;

        return R * 2 * Math.asin(Math.sqrt(a));
    }

    function checkLocationAndOpenModal() {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const userLatitude = position.coords.latitude;
                const userLongitude = position.coords.longitude;
                const distance = getDistance(userLatitude, userLongitude, targetLatitude, targetLongitude);

                if (distance <= 0.4) {
                    isWithinArea = true;
                    modal.show(); // Show the modal
                    navigator.mediaDevices.getUserMedia({ video: true })
                        .then(stream => {
                            video.srcObject = stream;
                            document.getElementById('camera-section').style.display = 'block';
                        })
                        .catch(err => {
                            console.error("Error accessing camera: ", err);
                        });
                } else {
                    isWithinArea = false;
                    alert('Anda berada di luar area yang diizinkan untuk melakukan absensi.');
                }
            },
            (error) => {
                console.error('Error getting geolocation: ', error);
                alert('Tidak dapat mengakses lokasi Anda.');
            }
        );
    }

    openModalBtn.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent default action
        checkLocationAndOpenModal();
    });

    // Capture image and save
    captureBtn.addEventListener('click', (event) => {
    event.preventDefault();

    if (isWithinArea) {
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        const dataURL = canvas.toDataURL('image/png');

        // Get current coordinates
        navigator.geolocation.getCurrentPosition((position) => {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            // Send image and coordinates to the server
            fetch('/rekam-wajah', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    image: dataURL,
                    latitude: latitude,
                    longitude: longitude,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Wajah berhasil direkam dan disimpan!');
                    modal.hide();
                    reloadTableData();
                } else {
                    alert('Gagal menyimpan gambar: ' + data.error);
                }
            })
            .catch(error => console.error('Error saving image:', error));
        });
    } else {
        alert('Anda berada di luar area yang diizinkan. Data tidak akan disimpan.');
    }
});


    function reloadTableData() {
        fetch('/kehadiran-table')
            .then(response => response.text())
            .then(html => {
                document.querySelector('tbody').innerHTML = html;
            })
            .catch(error => console.error('Error reloading table:', error));
    }
});

</script>
    
@endsection
