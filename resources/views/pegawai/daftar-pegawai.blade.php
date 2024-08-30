@extends('template-admin.index')

@section('content-admin')

    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Daftar Pegawai</h5>
            <div class="list-btn">
                <ul class="filter-list">
                    {{-- <li>
                        <a class="btn btn-import" href="{{ route('download-template') }}"><span><i class="fe fe-download-cloud me-2"></i>Download Template</span></a>
                    </li>
                    <li>
                        <a class="btn btn-import" href="{{ route('import-pegawai') }}"><span><i class="fe fe-file-plus me-2"></i>Import Data</span></a>
                    </li> --}}
                    <li>
                        <a class="btn btn-primary" href="{{ route('tambah-pegawai') }}"><span><i class="fe fe-user-plus me-2"></i>Tambah Pegawai</span></a>
                    </li>
                </ul>
            </div>
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
                                    <th>NIY</th>
                                    <th>Nama Pegawai</th>
                                    <th>Unit Kerja</th>
                                    <th>Tahun Kerja</th>
                                    <th>Status</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp

                                @foreach ($pegawai as $item)

                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->niy }}</td>
                                    <td><a href="{{ route('edit-pegawai', $item->id_pegawai) }}" data-bs-toggle="modal" data-bs-target="#dataPegawai{{ $item->id_pegawai }}"><i class="fe fe-eye me-2"></i> {{ $item->nama_pegawai }} </a></td>
                                    <td>{{ $item->unit_kerja }}</td>
                                    <td>{{ $item->thn_masuk }}</td>
                                    <td>{{ $item->status_kerja }}</td>
                              
                                    <td class="d-flex align-items-center"> 
                                        <form action="{{ route('delete-pegawai', $item->id_pegawai) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button {{ route('delete-pegawai', $item->id_pegawai) }} class="btn btn-import me-2" onclick="return confirm('Apakah anda yakin ingin menghapus data pegawai ?')"><i class="fa fa-trash me-1"></i></button>
                                        </form>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <ul>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('edit-pegawai', $item->niy) }}"><i class="far fa-edit me-2"></i>Edit</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
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

    @foreach ($pegawai as $data)

    <!-- Standard modal content -->
    <div id="dataPegawai{{ $data->id_pegawai }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Data Pegawai</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>{{ $data->nama_pegawai }}</h6>
                    <p>NIY. {{ $data->niy }}</p><p>
                    <hr>
                    <h6>Detail Data Pegawai : </h6>
                    <p>Tgl. Lahir : {{ $data->tgl_lahir }}</p>
                    <p>Alamat : {{ $data->alamat ?? '-'}}</p>
                    <p>No. Telp : {{ $data->no_telp ?? '-' }}</p>
                    <p>Jenis Kelamin : {{ $data->jenis_kelamin ?? '-' }}</p>
                    <p>Email : {{ $data->email ?? '-'}}</p>
                    <p>Pendidikan : {{ $data->pendidikan ?? '-' }}</p><p></p>
                    <p>Unit Kerja : {{ $data->unit_kerja }}</p>
                    <p>Tahun Masuk : {{ $data->thn_masuk }}</p>
                    <p>Status : {{ $data->status_pegawai }}</p>
                    <p>Status Kerja : {{ $data->status_kerja = 'Aktif' ?? '-' }}</p>
                    <p>Data Dibuat : {{ $data->created_at }}</p>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach

@endsection()