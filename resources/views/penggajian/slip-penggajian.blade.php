@extends('template-admin.index')

@section('content-admin')

    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Slip Penggajian</h5>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Table daftar item -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-body">
                <form action="{{ route('hasil-cari-slip') }}" method="GET" enctype="multipart/form-data">
                    @csrf

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Tahun Penggajian <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select name="thn_gaji" class="form-control form-small" id="tahun">
                                <option value="">Pilih Tahun Penggajian</option>
                                @foreach ($thn_gaji as $item)
                                    <option value="{{ $item->thn_gaji }}">Tahun {{ $item->thn_gaji }}</option>
                                @endforeach
                            </select>
                            @error('thn_gaji')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Bulan Penggajian <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select name="bln_gaji" class="form-control form-small" id="bulan">
                                <option value="">Pilih Bulan Penggajian</option>
                            </select>
                            @error('bln_gaji')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="input-block mb-3 row">
                        <label class="col-form-label col-md-2">Nama Pegawai <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select name="nama_pegawai" class="form-control form-small" id="nama">
                                <option value="">Pilih Nama Pegawai</option>
                            </select>
                            @error('nama_pegawai')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search me-2" aria-hidden="true"></i>Pencarian Data</button>
                    </div>
                </form>
            </div>
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
                                    <th>Total Penggajian</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp

                                @foreach ($pencarian as $data)

                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->niy }}</td>
                                    <td>{{ $data->pegawai->nama_pegawai ?? ''}}</td>
                                    <td>{{ $data->bln_gaji }}, {{ $data->thn_gaji }}</td>
                                    <td>{{ 'Rp. '.number_format($data->total_gaji_diterima) }}</td>

                                    <td class="d-flex align-items-center">
                                        <a href="{{ route('print-penggajian', $data->id_gaji) }}" class="btn btn-greys me-2"><i class="fe fe-printer me-1"></i></a>
                                        <a href="{{ route('pdf-penggajian', $data->id_gaji) }}" class="btn btn-greys me-2"><i class="far fa-file-pdf me-1"></i></a>
                                        {{-- <a href="#" class="btn btn-greys me-2"><i class="far fa-file-excel me-1"></i></a> --}}
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


<!-- Script untuk melakukan pencarian dan menampilkan hasil -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script type="text/javascript">
    $(document).ready(function() {
        $('#tahun').on('change', function() {
            var year = $(this).val();
            if(year) {
                $.ajax({
                    url: '{{ url("/get-months/") }}/' + year,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#bulan').empty();
                        $('#bulan').append('<option value="">Pilih Bulan Penggajian</option>');
                        $.each(data, function(key, value) {
                            $('#bulan').append('<option value="'+ value +'">Bulan '+ value +'</option>');
                        });
                    }
                });
            } else {
                $('#bulan').empty();
                $('#bulan').append('<option value="">Pilih Bulan Penggajian</option>');
            }
        });

    });
</script> --}}

<script>
$(document).ready(function() {
    // Mengambil data bulan berdasarkan tahun
    $('#tahun').on('change', function() {
        var year = $(this).val();
        if(year) {
            $.ajax({
                url: '{{ url("/get-months/") }}/' + year,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log(data); // Debugging: periksa data yang diterima
                    $('#bulan').empty();
                    $('#bulan').append('<option value="">Pilih Bulan Penggajian</option>');
                    if(data.length > 0) {
                        $.each(data, function(key, value) {
                            $('#bulan').append('<option value="'+ value +'">Bulan '+ value +'</option>');
                        });
                    } else {
                        $('#bulan').append('<option value="">Bulan Tidak Ditemukan</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Debugging: periksa error
                }
            });
        } else {
            $('#bulan').empty();
            $('#bulan').append('<option value="">Pilih Bulan Penggajian</option>');
        }
    });

    // Mengambil data nama pegawai berdasarkan tahun dan bulan
    $('#bulan').on('change', function() {
        var year = $('#tahun').val();
        var month = $(this).val();
        if(year && month) {
            $.ajax({
                url: '{{ url("/get-employees/") }}/' + year + '/' + month,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    console.log(data); // Debugging: periksa data yang diterima
                    $('#nama').empty();
                    $('#nama').append('<option value="">Pilih Nama Pegawai</option>');
                    if(data.length > 0) {
                        $.each(data, function(key, value) {
                            $('#nama').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                    } else {
                        $('#nama').append('<option value="">Nama Pegawai Tidak Ditemukan</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Debugging: periksa error
                }
            });
        } else {
            $('#nama').empty();
            $('#nama').append('<option value="">Pilih Nama Pegawai</option>');
        }
    });
});


</script>

@endsection()