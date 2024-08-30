@extends('template-user.index')

@section('content-user')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Pengaturan Akun</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('user-update-akun', $akun->id_users) }}" method="POST" enctype="multipart/form-data">
                    @csrf

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
                    @elseif(session('hapus'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Selamat! </strong> {{ session('hapus') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Username <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="{{ $akun->username }}" readonly>
                            @error('username')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Password Baru <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password Baru" value="{{ old('password') }}">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn" onclick="return confirm('Apakah anda yakin ingin mengubah data ini ?')"><i class="fa fa-refresh me-2" aria-hidden="true"></i>Perbarui Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
