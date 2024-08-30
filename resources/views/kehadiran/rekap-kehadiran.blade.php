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
                                </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection