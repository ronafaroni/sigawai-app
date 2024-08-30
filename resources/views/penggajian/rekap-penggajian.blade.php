@extends('template-admin.index')

@section('content-admin')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Rekap Penggajian</h5>
            </div>

            <div class="card-body">
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
            </div>
        </div>
    </div>
</div>

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

@endsection
