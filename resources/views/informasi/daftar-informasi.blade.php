@extends('template-admin.index')

@section('content-admin')
    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Notifikasi & Informasi</h5>
            <div class="list-btn">
                <ul class="filter-list">
                    <li>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dataInformasi"><span><i class="fe fe-file-plus me-2"></i>Tambah Informasi</span></a>
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
                                    <th>Jenis Informasi</th>
                                    <th>Nama Informasi</th>
                                    <th>Tgl. Upload</th>
                                    <th>File</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($informasi as $item)
                                    <tr>
                                        <td>
                                            @if ($item->status_informasi == '')
                                                {{ $no++ }}
                                            @elseif ($item->status_informasi == 'Penting')
                                                <i class="fe fe-star text-warning"></i>
                                            @endif
                                        </td>
                                        <td>{{ $item->jenis_informasi }}</td>
                                        <td>{{ $item->nama_informasi }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if ($item->jenis_informasi == 'File')
                                            <a href="{{ route('download-informasi', $item->file_informasi) }}" class="btn btn-greys me-2"><i><i class="fe fe-download me-2"></i></i> Download File</a>
                                            @elseif ($item->jenis_informasi == 'Link')
                                                <a href="{{ $item->link_informasi }}" class="btn btn-greys me-2" target="_blank"><i class="fe fe-link me-2"></i> Link Informasi</i></a>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('delete-informasi', $item->id_informasi) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button {{ route('delete-informasi', $item->id_informasi) }} class="btn btn-import me-2" onclick="return confirm('Apakah anda yakin ingin menghapus data informasi ?')"><i class="fa fa-trash me-1"></i></button>
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

    <div id="dataInformasi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Form Upload Informasi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('simpan-informasi') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-block mb-3">
                            <label>Nama Informasi</label>
                            <input type="text" name="nama_informasi" class="form-control" placeholder="Masukkan Informasi">
                            @error('nama_informasi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-block mb-3">
                            <label>Deskripsi</label>
                            <textarea rows="3" type="text" name="deskripsi" class="form-control" placeholder="Masukkan Deskripsi Informasi"></textarea>
                            @error('deskripsi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-block mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="status_informasi" value="Penting">
                                <label class="form-check-label" for="file">Informasi Penting</label>
                            </div>
                            @error('status_informasi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>    
                        <div class="input-block mb-3">
                            <label class="d-block">Jenis Informasi</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_informasi" id="file" value="File">
                                <label class="form-check-label" for="file">File</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_informasi" id="link" value="Link">
                                <label class="form-check-label" for="link">Link</label>
                            </div>
                        </div>
    
                        <div class="input-block mb-3" id="link_block" style="display: none;">
                            <label>Link Informasi</label>
                            <input type="url" name="link_informasi" class="form-control" placeholder="Masukkan URL">
                        </div>
                        <div class="input-block mb-3" id="file_block" style="display: none;">
                            <label>Upload File</label>
                            <input type="file" name="file_informasi" class="form-control">
                            @error('file_informasi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-upload me-2" aria-hidden="true"></i>Upload Informasi</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jenisInformasi = document.querySelectorAll('input[name="jenis_informasi"]');
            const linkBlock = document.getElementById('link_block');
            const fileBlock = document.getElementById('file_block');
        
            function toggleForm() {
                const selected = document.querySelector('input[name="jenis_informasi"]:checked').value;
                
                // Reset all fields
                linkBlock.style.display = 'none';
                fileBlock.style.display = 'none';
                
                if (selected === 'File') {
                    fileBlock.style.display = 'block';
                } else if (selected === 'Link') {
                    linkBlock.style.display = 'block';
                }
            }
        
            jenisInformasi.forEach(radio => {
                radio.addEventListener('change', toggleForm);
            });
        });
    </script>
@endsection
