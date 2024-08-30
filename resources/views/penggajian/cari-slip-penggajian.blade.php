@extends('template-admin.index')

@section('content-admin')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Slip Penggajian</h5>
            </div>

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
        </div>
    </div>
</div>

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

@endsection
