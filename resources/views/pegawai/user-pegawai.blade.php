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
                            <th colspan="2"><h6>Detail Pegawai</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="20%">NIY. </td>
                            <td>: {{ $user->niy }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Nama Lengkap </td>
                            <td>: {{ $user->nama_pegawai }}</td>
                        </tr>
                        <tr>
                            <td width="20%">Tgl. Lahir </td>
                            <td>: {{ $tanggalLahir }}</td>
                        </tr>
                        <tr>
                            <td width="20%">Alamat </td>
                            <td>: {{ $user->alamat ?? '-'}}</td>
                        </tr>
                        <tr>
                            <td width="20%">No. Telp </td>
                            <td>: {{ $user->no_telp ?? '-'}}</td>
                        </tr>
                        <tr>
                            <td width="20%">Jenis Kelamin </td>
                            <td>: {{ $user->jenis_kelamin ?? '-'}}</td>
                        </tr>
                        <tr>
                            <td width="20%">Pendidikan Terakhir</td>
                            <td>: {{ $user->pendidikan ?? '-'}}</td>
                        </tr>
                        <tr>
                            <td width="20%">
                                <a class="btn btn-greys me-2" data-bs-toggle="modal" data-bs-target="#dataPegawai{{ $user->id_pegawai }}"><i class="fe fe-edit me-2"></i> Edit Data</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            </div>
        </div>
    </div>
</div>
<br>

    <!-- Table daftar item -->
<div id="dataPegawai{{ $user->id_pegawai }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel">Edit Data Pegawai</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user-update-data-pegawai', $user->niy) }}" method="POST">
                    @csrf
                    <div class="input-block mb-3">
                        <label>NIY</label>
                        <input type="text" name="niy" class="form-control" placeholder="Masukkan NIY" value="{{ $user->niy }}" readonly>
                    </div>
                    <div class="input-block mb-3">
                        <label>Nama Pegawai</label>
                        <input type="text" name="nama_pegawai" class="form-control" placeholder="Masukkan Nama Pegawai" value="{{ $user->nama_pegawai }}" readonly>
                    </div>
                    <div class="input-block mb-3">
                        <label>Tgl. Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir" value="{{ $user->tgl_lahir }}">
                    </div>
                    <div class="input-block mb-3">
                        <label>Alamat</label>
                        <textarea type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" value="{{ $user->alamat }}">{{ $user->alamat }}</textarea>
                    </div>
                    <div class="input-block mb-3">
                        <label>No. Telp.</label>
                        <input type="number" name="no_telp" class="form-control" placeholder="Masukkan No. Telp" value="{{ $user->no_telp }}">
                    </div>
                    <div class="input-block mb-3">
                        <label class="d-block">Jenis Kelamin</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Laki-laki">
                            <label class="form-check-label" for="jenis_kelamin">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan">
                            <label class="form-check-label" for="jenis_kelamin">Perempuan</label>
                        </div>
                    </div>

                    <div class="input-block mb-3">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Masukkan Nama Email" value="{{ $user->email }}">
                    </div>

                    <div class="input-block mb-3" id="jenis_cuti_block">
                        <label class="col-form-label">Jenjang Pendidikan</label>
                        <div class="col-md-12">
                            <select name="jenjang_pendidikan" class="form-control form-small" id="">
                                <option value="" selected>Masukkan Jenjang Pendidikan</option>
                                <option value="SD/MI">SD/MI</option>
                                <option value="SMP/MTs/SLTP">SMP/MTs/SLTP</option>
                                <option value="SMA/MA/SMK/SLTA">SMA/MA/SMK/SLTA</option>
                                <option value="Diploma D3/D4">Diploma D3/D4</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit me-2" aria-hidden="true"></i>Update Data</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

@endsection