@extends('template-admin.index')

@section('content-admin')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Edit Data Akun</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('update-akun', $akun->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Nama Akun <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Akun" value="{{ $akun->name}}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Username <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="{{ $akun->username }}">
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Password Baru <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password Baru">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn" onclick="return confirm('Apakah anda yakin ingin mengubah data ini ?')"><i class="fa fa-refresh me-2" aria-hidden="true"></i>Update Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
