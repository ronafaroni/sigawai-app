@extends('template-admin.index')

@section('content-admin')

    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Rekap Penggajian</h5>    
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

                    <form action="{{ route('hasil-rekap-penggajian') }}" method="GET" enctype="multipart/form-data">
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
    
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search me-2" aria-hidden="true"></i>Pencarian Data</button>
                        </div>
                    </form>

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

                                @foreach ($penggajian as $data)

                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->niy }}</td>
                                    <td>{{ $data->pegawai->nama_pegawai ?? ''}}</td>
                                    <td>{{ $data->bln_gaji }}, {{ $data->thn_gaji }}</td>
                                    <td>{{ 'Rp. '.number_format($data->total_gaji_diterima) }}</td>
                                    <td class="d-flex align-items-center">
                                        <a href="{{ route('detail-penggajian', $data->id_gaji) }}" class="btn btn-greys me-2"><i
                                            class="fa-regular fa-eye me-1"></i> Detail</a>  
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

<!-- Script untuk melakukan pencarian dan menampilkan hasil -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
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
</script>


@endsection()