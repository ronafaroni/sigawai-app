@extends('template-admin.index')

@section('content-admin')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Tambah Data Pegawai</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('simpan-pegawai') }}" method="POST" enctype="multipart/form-data">
                    @csrf
       
                    <div class="input-block mb-4 row">
                        <label class="col-form-label col-md-2">NIY <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="number" name="niy" class="form-control" placeholder="Masukkan NIY Pegawai" autocomplete="off" value="{{ old('niy') }}">
                            @error('niy')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-4 row">
                        <label class="col-form-label col-md-2">Nama Pegawai <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" name="nama_pegawai" class="form-control" placeholder="Masukkan Nama Pegawai" autocomplete="off" value="{{ old('nama_pegawai') }}">
                            @error('nama_pegawai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Tanggal Lahir <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="date" name="tgl_lahir" class="form-control" placeholder="Masukkan Tanggal Lahir" value="{{ old('tgl_lahir') }}">
                            @error('tgl_lahir')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Unit Kerja <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select name="unit_kerja" class="form-control form-small" id="">
                                <option value="">Pilih Unit Kerja</option>
                                @foreach ($unit_kerja as $item)
                                    <option value="{{ $item->unit_kerja }}">{{ $item->unit_kerja }}</option>
                                @endforeach
                            </select>
                            @error('unit_kerja')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Status Pegawai <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select name="status_pegawai" class="form-control form-small" id="">
                                <option value="">Pilih Status Kerja</option>
                                @foreach ($status_pegawai as $item)
                                    <option value="{{ $item->status_pegawai }}">{{ $item->status_pegawai }}</option>
                                @endforeach
                            </select>
                            @error('status_pegawai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Tahun Masuk <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="date" name="thn_masuk" class="form-control" placeholder="Masukkan Tahun Masuk" value="{{ old('thn_masuk') }}">
                            @error('thn_masuk')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Status Kerja <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select name="status_kerja" class="form-control form-small" id="">
                                <option value="">Pilih Status Kerja</option>
                                @foreach ($status_kerja as $item)
                                    <option value="{{ $item->status_kerja }}">{{ $item->status_kerja }}</option>
                                @endforeach
                            </select>
                            @error('status_kerja')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Foto <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="file" name="foto" class="form-control" value="{{ old('foto') }}">
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> --}}

                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn" onclick="return confirm('Apakah anda yakin ingin menyimpan data ini ?')"><i class="fa fa-user-plus me-2" aria-hidden="true"></i>Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
