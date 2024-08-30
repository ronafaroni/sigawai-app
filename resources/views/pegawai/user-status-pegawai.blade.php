@extends('template-user.index')

@section('content-user')

<!-- Page Header -->
{{-- <div class="page-header">
    <div class="content-page-header">
        <h5>Data Pegawai</h5>
    </div>
</div> --}}
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
                @elseif(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong></strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

            {{-- Detail Informasi --}}
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="3"><h6>Status Pegawai</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="20%">NIY. </td>
                            <td>: <b> {{ $pegawai->niy }}</b></td>
                        </tr>
                        <tr>
                            <td width="30%">Nama Lengkap </td>
                            <td>: <b>{{ $pegawai->nama_pegawai }}</</b></td>
                        </tr>
                        <tr>
                            <td width="20%">Unit Kerja </td>
                            <td>: {{ $pegawai->unit_kerja }}<td>
                        </tr>
                        <tr>
                            <td width="20%">Status Kerja </td>
                            <td>: {{ $pegawai->status_kerja ?? '-'}}</td>
                        </tr>
                        <tr>
                            <td width="20%">Status Pegawai </td>
                            <td>: {{ $pegawai->status_pegawai ?? '-'}}</td>
                        </tr>
                        <tr>
                            <td width="20%">Masa Kerja </td>
                            <td>: {{ \Carbon\Carbon::parse($pegawai->thn_masuk)->diffForHumans(['parts' => 2, 'join' => true, 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            </div>
        </div>
    </div>
</div>
<br>

@endsection