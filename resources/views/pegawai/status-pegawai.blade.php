@extends('template-admin.index')

@section('content-admin')

    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Status Pegawai</h5>
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
                                    <th>Unit Kerja</th>
                                    <th>Masa Kerja</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp

                                @foreach ($pegawai as $item)

                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->niy }}</td>
                                    <td><a href="{{ route('status-pegawai', $item->id_pegawai) }}" data-bs-toggle="modal" data-bs-target="#dataPegawai{{ $item->id_pegawai }}"><i class="fe fe-edit me-2"></i> {{ $item->nama_pegawai }} </a></td>
                                    <td>{{ $item->unit_kerja }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->thn_masuk)->diffForHumans(['parts' => 2, 'join' => true, 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]) }}</td>
                                    <td>
                                        @if ($item->status == 'Aktif')
                                            <span class="badge bg-success" data-bs-trigger="hover" data-container="body" data-bs-placement="bottom" data-bs-toggle="popover" title="Sudah Aktif" data-bs-content="Data sudah aktif pada {{ $item->update_status }}"><i class="fe fe-check me-2"></i>Sudah {{ $item->status }}</span>
                                        @elseif ($item->status == 'Tidak Aktif')
                                            <span class="badge bg-danger" data-bs-trigger="hover" data-container="body" data-bs-placement="bottom" data-bs-toggle="popover" title="Tidak Aktif" data-bs-content="Data tidak aktif pada {{ $item->update_status }} karena {{ $item->alasan }}"><i class="fe fe-x me-2"></i>{{ $item->status }}</span>
                                        @elseif ($item->status == '')
                                            <span class="badge bg-warning" data-bs-trigger="hover" data-container="body" data-bs-placement="bottom" data-bs-toggle="popover" title="Belum Aktif" data-bs-content="Segera lakukan aktivasi data terlebih dahulu."><i class="fe fe-clock me-2"></i>Belum Aktif<span>
                                        @endif
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
    
    @foreach ($pegawai as $data)
    <!-- Standard modal content -->
    <div id="dataPegawai{{ $data->id_pegawai }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Status Pegawai</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update-status-pegawai', $data->id_pegawai) }}" method="POST">
                        @csrf
                        <div class="input-block mb-3">
                            <label>NIY</label>
                            <input type="text" name="niy" class="form-control" value="{{ $data->niy }}" disabled>
                        </div>
                        <div class="input-block mb-3">
                            <label>Nama Pegawai</label>
                            <input type="text" name="nama_pegawai" class="form-control" value="{{ $data->nama_pegawai }}" disabled>
                        </div>
                        
                        <div class="input-block mb-3">
                            <label class="d-block">Status Pegawai</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_aktif{{ $data->id_pegawai }}" value="Aktif">
                                <label class="form-check-label" for="status_aktif{{ $data->id_pegawai }}">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_tidak_aktif{{ $data->id_pegawai }}" value="Tidak Aktif">
                                <label class="form-check-label" for="status_tidak_aktif{{ $data->id_pegawai }}">Tidak Aktif</label>
                            </div>
                        </div>
                        <div class="input-block mb-3" id="tgl_keluar_block{{ $data->id_pegawai }}" style="display: none;">
                            <label>Tgl. Keluar</label>
                            <input type="date" name="tgl_keluar" class="form-control" placeholder="Masukkan Tgl. Keluar">
                        </div>
                        <div class="input-block mb-3" id="alasan_block{{ $data->id_pegawai }}" style="display: none;">
                            <label>Alasan</label>
                            <textarea name="alasan" class="form-control"></textarea>
                        </div>                    
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save me-2" aria-hidden="true"></i>Simpan Status</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach
    

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach ($pegawai as $data)
            const statusAktif{{ $data->id_pegawai }} = document.getElementById('status_aktif{{ $data->id_pegawai }}');
            const statusTidakAktif{{ $data->id_pegawai }} = document.getElementById('status_tidak_aktif{{ $data->id_pegawai }}');
            const alasanBlock{{ $data->id_pegawai }} = document.getElementById('alasan_block{{ $data->id_pegawai }}');
            const tglKeluarBlock{{ $data->id_pegawai }} = document.getElementById('tgl_keluar_block{{ $data->id_pegawai }}');
    
            function toggleAlasan{{ $data->id_pegawai }}() {
                if (statusTidakAktif{{ $data->id_pegawai }}.checked) {
                    alasanBlock{{ $data->id_pegawai }}.style.display = 'block';
                    tglKeluarBlock{{ $data->id_pegawai }}.style.display = 'block';
                } else {
                    alasanBlock{{ $data->id_pegawai }}.style.display = 'none';
                    tglKeluarBlock{{ $data->id_pegawai }}.style.display = 'none';
                }
            }
    
            statusAktif{{ $data->id_pegawai }}.addEventListener('change', toggleAlasan{{ $data->id_pegawai }});
            statusTidakAktif{{ $data->id_pegawai }}.addEventListener('change', toggleAlasan{{ $data->id_pegawai }});
        @endforeach
    });
    </script>

    {{-- Menggunakan Javascript --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusAktif = document.getElementById('status_aktif');
            const statusTidakAktif = document.getElementById('status_tidak_aktif');
            const alasanBlock = document.getElementById('alasan_block');
            const tglKeluarBlock = document.getElementById('tgl_keluar_block');
        
            function toggleAlasan() {
                if (statusTidakAktif.checked) {
                    alasanBlock.style.display = 'block';
                    tglKeluarBlock.style.display = 'block';
                } else {
                    alasanBlock.style.display = 'none';
                    tglKeluarBlock.style.display = 'none';
                }
            }
        
            statusAktif.addEventListener('change', toggleAlasan);
            statusTidakAktif.addEventListener('change', toggleAlasan);
        });
        </script> --}}

    
    {{-- Menggunakan Jquery --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('input[name="status"]').change(function() {
            if ($('#status_tidak_aktif').is(':checked')) {
                $('#tglKeluarBlock').show();
                $('#alasan_block').show();

            } else {
                $('#alasan_block').hide();
            }
        });
    });
    </script> --}}


@endsection()