@extends('template-user.index')

@section('content-user')

    <!-- Page Header -->
    <div class="page-header">
        <div class="content-page-header">
            <h5>Perizinan Pegawai</h5>
            <div class="list-btn">
                <ul class="filter-list">
                    <li>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#dataPengajuanIzin"><span><i class="fe fe-user-plus me-2"></i>Pengajuan Izin Cuti</span></a>
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
                                    <th>Jenis Pengajuan</th>
                                    <th>Tgl. Pengajuan</th>
                                    <th>Status Pengajuan</th>
                                    <th class="no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($izin as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->niy }}</td>
                                        <td>{{ $item->nama_pegawai }}</td>
                                        <td>{{ $item->jenis_izin }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            @if ($item->status_izin == '')
                                                <span class="badge bg-success" data-bs-trigger="hover" data-container="body" data-bs-placement="bottom" data-bs-toggle="popover" title="Proses Pengajuan" data-bs-content="Masih dalam proses pengajuan mohon menungu proses persetujuan."><i class="fa fa-refresh me-2"></i>Pengajuan {{ $item->status }}</span>
                                            @elseif ($item->status_izin == 'Diterima')
                                                <span class="badge bg-primary" data-bs-trigger="hover" data-container="body" data-bs-placement="bottom" data-bs-toggle="popover" title="Pengajuan Diterima" data-bs-content="Pengajuan diterima pada {{ $item->updated_at }}"><i class="fe fe-check me-2"></i>{{ $item->status_izin }}</span>
                                            @elseif ($item->status_izin == 'Direvisi')
                                                <span class="badge bg-info" data-bs-trigger="hover" data-container="body" data-bs-placement="bottom" data-bs-toggle="popover" title="Pengajuan Direvisi" data-bs-content="Pengajuan diterima dengan revisi pada {{ $item->updated_at }}"><i class="fe fe-x me-2"></i>{{ $item->status_izin }}</span>
                                            @elseif ($item->status_izin == 'Ditolak')
                                                <span class="badge bg-danger" data-bs-trigger="hover" data-container="body" data-bs-placement="bottom" data-bs-toggle="popover" title="Pengajuan Ditolak" data-bs-content="Pengajuan ditolak pada {{ $item->updated_at }}"><i class="fe fe-x me-2"></i>{{ $item->status_izin }}</span>
                                            @endif
                                        </td>
                                        <td class="d-flex align-items-center">
                                            @if ($item->status_izin > 0)
                                                <button class="btn btn-greys me-2" data-bs-toggle="modal" data-bs-target="#detailPengajuanIzin{{ $item->id_absensi }}">
                                                    <i class="fa fa-eye me-1"></i> Detail
                                                </button>                                            
                                            @elseif ($item->status_izin == null)
                                                <form action="{{ route('delete-pengajuan-izin-cuti', $item->id_absensi) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button {{ route('delete-pengajuan-izin-cuti', $item->id_absensi) }} class="btn btn-import me-2" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')"><i class="fa fa-trash me-1"></i></button>
                                                </form> 
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

    @php
        use Carbon\Carbon;
    @endphp

    <!-- /Table daftar item -->
    @foreach ($izin as $data)
        <div id="detailPengajuanIzin{{ $data->id_absensi }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="standard-modalLabel">Persejutuan Izin</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Status Pengajuan</p>
                        <h3 class="text-center text-primary"><b>Pengajuan {{ $data->status_izin }}</b></h3>
                        <hr>
                        <p class="text-center">NIY : {{ $data->niy }}</p>
                        <p class="text-center">Nama : {{ $data->nama_pegawai }}</p>
                        <p class="text-center">Jenis Perizinan : {{ $data->jenis_izin }}</p>
                        @if ($data->jenis_izin === 'Izin')
                            <p class="text-center">Alasan: {{ $data->alasan_izin }}</p>
                        @endif
                        <p class="text-center">Durasi : 
                            @php
                                        
                            $tglMulai = Carbon::parse($data->tgl_mulai_izin);
                            $tglSelesai = Carbon::parse($data->tgl_selesai_izin);
                        
                            // Hitung durasi antara dua tanggal dan tambahkan 1 untuk menyertakan hari terakhir
                            $durasi = $tglMulai->diffInDays($tglSelesai) + 1;
                        @endphp

                        @php
                        $tglMulai = Carbon::parse($data->tgl_mulai_izin)->translatedFormat('l, d F Y');
                        $tglSelesai = Carbon::parse($data->tgl_selesai_izin)->translatedFormat('l, d F Y');
                        @endphp
         
                        {{ $durasi }} Hari
                        </p>
                        <p class="text-center">
                            Mulai : {{ $tglMulai }} 
                        </p>
                        <p class="text-center">
                            Akhir : {{ $tglSelesai }}
                        </p>
                        <p class="text-center"><b>Masuk : 
                            @php
                                // Parse tanggal selesai izin
                                $tglMasukKembali = Carbon::parse($data->tgl_selesai_izin);
                        
                                // Tambah satu hari
                                $tglMasukKembali->addDay();
                        
                                // Format tanggal masuk kembali
                                $tglMasukKembali = $tglMasukKembali->translatedFormat('l, d F Y');
                            @endphp
                            {{ $tglMasukKembali }} </b>
                        </p>
                        
                        <hr>
                        <p class="text-center">Tgl. Pengajuan : {{ $data->created_at }}</p>
                        <p class="text-center">Tgl. Persetujuan : {{ $data->updated_at }}</p>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->  
    @endforeach
    
    <!-- Table daftar item -->
    <div id="dataPengajuanIzin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="standard-modalLabel">Form Pengajuan Izin</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user-simpan-pengajuan-izin-cuti') }}" method="POST">
                        @csrf
                        <div class="input-block mb-3">
                            <label>NIY</label>
                            <input type="text" name="niy" class="form-control" placeholder="Masukkan NIY" value="{{ $pegawai->niy }}" readonly>
                        </div>
                        <div class="input-block mb-3">
                            <label>Nama Pegawai</label>
                            <input type="text" name="nama_pegawai" class="form-control" placeholder="Masukkan Nama Pegawai" value="{{ $pegawai->nama_pegawai }}" readonly>
                        </div>
                        
                        <div class="input-block mb-3">
                            <label class="d-block">Keperluan Pengajuan</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_izin" id="ajuan_izin" value="Izin">
                                <label class="form-check-label" for="ajuan_izin">Izin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_izin" id="ajuan_sakit" value="Sakit">
                                <label class="form-check-label" for="ajuan_sakit">Sakit</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_izin" id="ajuan_cuti" value="Cuti">
                                <label class="form-check-label" for="ajuan_cuti">Cuti</label>
                            </div>
                        </div>
    
                        <div class="input-block mb-3" id="jenis_cuti_block" style="display: none;">
                            <label class="col-form-label">Jenis Cuti</label>
                            <div class="col-md-12">
                                <select name="jenis_cuti" class="form-control form-small" id="">
                                    <option value="">Masukkan Jenis Cuti</option>
                                    @foreach ($cuti as $item)
                                        <option value="{{ $item->nama_cuti }}">{{ $item->nama_cuti }}</option>
                                    @endforeach
                                </select>
                                @error('unit_kerja')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="input-block mb-3" id="tgl_mulai_block" style="display: none;">
                            <label>Tgl. Mulai</label>
                            <input type="date" name="tgl_mulai" class="form-control" placeholder="Masukkan Tgl. Mulai">
                        </div>
                        <div class="input-block mb-3" id="tgl_masuk_block" style="display: none;">
                            <label>Tgl. Akhir</label>
                            <input type="date" name="tgl_masuk" class="form-control" placeholder="Masukkan Tgl. Masuk">
                        </div>
                        <div class="input-block mb-3" id="alasan_block" style="display: none;">
                            <label>Alasan</label>
                            <textarea name="alasan" class="form-control" placeholder="Masukkan Alasan"></textarea>
                        </div>    

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save me-2" aria-hidden="true"></i>Ajukan Izin</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->        

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jenisIzin = document.querySelectorAll('input[name="jenis_izin"]');
            const tglMulaiBlock = document.getElementById('tgl_mulai_block');
            const tglMasukBlock = document.getElementById('tgl_masuk_block');
            const alasanBlock = document.getElementById('alasan_block');
            const jenisCutiBlock = document.getElementById('jenis_cuti_block');
        
            function toggleForm() {
                const selected = document.querySelector('input[name="jenis_izin"]:checked').value;
                
                // Reset all fields
                tglMulaiBlock.style.display = 'none';
                tglMasukBlock.style.display = 'none';
                alasanBlock.style.display = 'none';
                jenisCutiBlock.style.display = 'none';
                
                if (selected === 'Izin') {
                    tglMulaiBlock.style.display = 'block';
                    tglMasukBlock.style.display = 'block';
                    alasanBlock.style.display = 'block';
                } else if (selected === 'Sakit') {
                    tglMulaiBlock.style.display = 'block';
                    tglMasukBlock.style.display = 'block';
                } else if (selected === 'Cuti') {
                    jenisCutiBlock.style.display = 'block';
                    tglMulaiBlock.style.display = 'block';
                    tglMasukBlock.style.display = 'block';
                }
            }
        
            jenisIzin.forEach(radio => {
                radio.addEventListener('change', toggleForm);
            });
        });
    </script>

@endsection
