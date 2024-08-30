@extends('template-admin.index')

@section('content-admin')

    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Daftar Akun Pegawai</h5>
            <div class="list-btn">
                <ul class="filter-list">
                    <li>
                        <a class="btn btn-primary" href="{{ route('tambah-akun-users') }}"><span><i class="fe fe-user-plus me-2"></i>Tambah Akun Pegawai</span></a>
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
                    @elseif(session('hapus'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Selamat! </strong> {{ session('hapus') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-center table-hover datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pegawai</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp

                                @foreach ($akun_users as $item)

                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td><a href="{{ route('edit-users', $item->id_users) }}"><i class="fe fe-edit me-2"></i> {{ $item->name }} </a></td>
                                    <td>{{ $item->username }}</td>
                                    {{-- <td>{{ str_repeat('*', strlen($item->password)) }}</td> --}}
                                    <td>{{ str_repeat('*', 8) }}</td>
                                    <td>{{ $item->role }}</td>
                              
                                    <td class="d-flex align-items-center"> 
                                        <form action="{{ route('delete-users', $item->id_users) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button {{ route('delete-users', $item->id_users) }} class="btn btn-import me-2" onclick="return confirm('Apakah anda yakin ingin menghapus data akun ?')"><i class="fa fa-trash me-1"></i></button>
                                        </form>
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

@endsection()