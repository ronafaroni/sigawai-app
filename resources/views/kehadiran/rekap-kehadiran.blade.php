@extends('template-admin.index')

@section('content-admin')
        <!-- Page Header -->
        <div class="page-header">
            <div class="content-page-header">
                <h5>Rekap Kehadiran</h5>
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
                                        <th width="10%">Gambar</th>
                                        <th>NIY</th>
                                        <th>Nama Pegawai</th>     
                                        <th>Waktu</th>
                                        <th>Tgl. Masuk</th>
                                        <th>Titik Kordinat</th>  
                                        <th>Status Kehadiran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                @foreach ($kehadiran as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <h2 class="table-avatar">
                                            <img class="avatar-img" width="40px" height="40px"
                                                src="{{ asset('wajah/' . $item->image_path) }}"
                                                alt="User Image">
                                        </h2>
                                    </td>
                                    <td>{{ $item->niy }}</td>
                                    <td>{{ $item->nama_pegawai }}</td>
                                    <td>{{ $item->waktu_masuk }}</td>
                                    <td>{{ $item->tanggal_masuk }}</td>
                                    <td>
                                        <a href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}" target="_blank">
                                            {{ $item->latitude }}, {{ $item->longitude }}
                                        </a>
                                    </td>
                                    <td>
                                        @php
                                            // Tentukan waktu toleransi
                                            $toleransiBoarding = '16:15:00'; // Batas waktu untuk pegawai boarding
                                            $toleransiSD = '07:00:00'; // Batas waktu untuk pegawai SD
                                    
                                            // Ambil kategori pegawai
                                            $kategoriPegawai = $item->pegawai->unit_kerja; // Misalkan ada atribut 'kategori' yang menentukan jenis pegawai
                                    
                                            // Tentukan waktu batas berdasarkan kategori
                                            $waktuBatas = ($kategoriPegawai == 'Boarding Bumi Kartini') ? $toleransiBoarding : $toleransiSD;
                                        @endphp
                                    
                                        @if ($item->waktu_masuk > $waktuBatas)
                                            <span class="text-danger"><b>Terlambat</b></span>
                                        @else
                                            <span class="text-success"><b>Tepat Waktu</b></span>
                                        @endif
                                    </td>
                                    <td>
                                        <a data-bs-toggle="modal" 
                                            data-bs-target="#dataAbsensiPegawai" 
                                            class="btn btn-greys me-2"
                                            data-niy="{{ $item->niy }}"
                                            data-nama="{{ $item->nama_pegawai }}"
                                            data-tanggal="{{ $item->tanggal_masuk }}"
                                            data-waktu="{{ $item->waktu_masuk }}"
                                            data-id="{{ $item->id_kehadiran }}"> <!-- Tambahkan ID ke data attribute -->
                                            <i class="fe fe-edit me-2"></i> Edit
                                        </a>
                                     
                                    </td>
                                </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- Modal for Absensi -->
    <div class="modal fade" id="dataAbsensiPegawai" tabindex="-1" role="dialog" aria-labelledby="dataInformasiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataInformasiLabel">Edit Absensi Pegawai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kehadiran-update', $item->id_kehadiran) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Tambahkan ini untuk menggunakan PUT method -->
                        
                        <div class="input-block mb-3">
                            <label>NIY</label>
                            <input type="text" name="id" class="form-control" readonly>
                        </div>
                        <div class="input-block mb-3">
                            <label>NIY</label>
                            <input type="text" name="niy" class="form-control" readonly>
                        </div>
                        <div class="input-block mb-3">
                            <label>Nama Pegawai</label>
                            <input type="text" name="nama_pegawai" class="form-control" readonly>
                        </div> 
                        <div class="input-block mb-3">
                            <label>Tgl. Kehadiran</label>
                            <input type="date" name="tanggal_masuk" class="form-control">
                        </div>
                        <div class="input-block mb-3">
                            <label>Waktu Hadir</label>
                            <input type="time" name="waktu_masuk" class="form-control" id="waktu_masuk">
                        </div>             
                    
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fe fe-calendar me-2" aria-hidden="true"></i>Simpan Perubahan</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#dataAbsensiPegawai"]');
    
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const niy = button.getAttribute('data-niy');
            const nama = button.getAttribute('data-nama');
            const tanggal = button.getAttribute('data-tanggal');
            const waktu = button.getAttribute('data-waktu');
            const idKeberadaan = button.getAttribute('data-id'); // Ambil ID
            
            // Isi modal dengan data dari button
            document.querySelector('#dataAbsensiPegawai input[name="niy"]').value = niy;
            document.querySelector('#dataAbsensiPegawai input[name="nama_pegawai"]').value = nama;
            document.querySelector('#dataAbsensiPegawai input[name="tanggal_masuk"]').value = tanggal;
            document.querySelector('#dataAbsensiPegawai input[name="waktu_masuk"]').value = waktu;
            document.querySelector('#dataAbsensiPegawai form').action = `/kehadiran-update/${idKeberadaan}`; // Set action form
        });
    });
});

</script>

@endsection