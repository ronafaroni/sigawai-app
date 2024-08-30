@extends('template-user.index')

@section('content-user')

    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Historis Penggajian</h5>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Table daftar item -->
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
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
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
                                    <th>NIY</th>
                                    <th>Nama Pegawai</th>
                                    <th>Bulan Penggajian</th>
                                    <th>Total Diterima</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp

                                @foreach ($penggajian as $data)

                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->niy }}</td>
                                    <td>{{ $data->pegawai->nama_pegawai ?? ''}}</td>
                                    <td>{{ $data->bln_gaji }}, {{ $data->thn_gaji }}</td>
                                    <td>{{ 'Rp. '.number_format($data->total_gaji_diterima) }}</td>

                                    <td class="d-flex align-items-center">
                                        <a href="{{ route('user-detail-penggajian', $data->id_gaji) }}" class="btn btn-greys me-2"><i class="fa-regular fa-eye me-1"></i> Detail</a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table daftar item -->

     <!-- Standard modal content -->
     <div id="importPenggajian" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Status Pegawai</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('import-penggajian') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-block mb-3">
                            <label>Import Data</label>
                            <input type="file" name="import_file" class="form-control">
                        </div>                   
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-upload me-2" aria-hidden="true"></i>Import Data</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection()