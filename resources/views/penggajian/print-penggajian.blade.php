@extends('template-admin.index')

@section('content-admin')

<!-- Table daftar item -->
<div id="print-area">
       <!-- Page Header -->
       <div class="page-header">
        <div class="content-page-header">
            <h5>Cetak Slip Penggajian : {{ $penggajian->bln_gaji }} {{ $penggajian->thn_gaji }}</h5>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-table">
                <div class="card-body">
                    {{-- Detail Informasi --}}
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="2"><h6>Data Pegawai</h6></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td width="30%">Nama Lengkap </td>
                                    <td>: {{ $penggajian->pegawai->nama_pegawai }}</td>
                                </tr>
                                <tr>
                                    <td width="20%">NIY. </td>
                                    <td>: {{ $penggajian->pegawai->niy }}</td>
                                </tr>
                                <tr>
                                    <td width="20%">Unit Kerja </td>
                                    <td>: {{ $penggajian->pegawai->unit_kerja }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{-- Detail Gaji Utama --}}
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2"><h6>Gaji Utama</h6></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td width="30%">Gaji Pokok </td>
                                    <td>: Rp. {{ number_format($penggajian->gaji_pokok) }}</td>
                                </tr>
                                <tr>
                                    <td width="20%">Tunjangan Struktural </td>
                                    <td>: Rp. {{ number_format($penggajian->tunjangan_struktural) }}</td>
                                </tr>
                                <tr>
                                    <td width="20%">Tunjangan Pengabdian </td>
                                    <td>: Rp. {{ number_format($penggajian->tunjangan_pengabdian) }}</td>
                                </tr>
                                <tr>
                                    <td width="20%">Tunjangan Keluarga </td>
                                    <td>: Rp. {{ number_format($penggajian->tunjangan_keluarga) }}</td>
                                </tr>
                                <tr>
                                    <td width="20%">Tunjangan Anak </td>
                                    <td>: Rp. {{ number_format($penggajian->tunjangan_anak) }}</td>
                                </tr>
                                <tr>
                                    <td width="20%">Tunjangan Kinerja </td>
                                    <td>: Rp. {{ number_format($penggajian->tunjangan_kinerja) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{-- Detail Transportasi --}}
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2"><h6>Transportasi</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="30%"> Besaran Transport</td>
                                    <td>: {{ number_format($penggajian->harian_transport) }} Hari</td>
                                </tr>
                                <tr>
                                    <td width="20%"> Satuan Transport</td>
                                    <td>: Rp. {{ number_format($penggajian->besaran_transport) }} </td>
                                </tr>
                                <tr>
                                    <td width="20%">Jumlah Transport </td>
                                    <td>: Rp. {{ number_format($penggajian->jumlah_transport) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{-- Detail Tambahan --}}
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2"><h6>Data Tambahan</h6></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td width="30%">Tambahan Jam </td>
                                    <td>: Rp. {{ number_format($penggajian->tambahan_jam) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{-- Jumlah Gaji --}}
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <td width="30%"><h6><b>JUMLAH GAJI</b></h6></td>
                                    <td><b>: Rp. {{ number_format($penggajian->jumlah_gaji) }}</h6></b></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <br>
                    {{-- Detail Tambahan --}}
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2"><h6>Tambahan Lain</h6></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td width="30%">Tambahan Fungsi </td>
                                    <td>: Rp. {{ number_format($penggajian->tambahan_fungsi) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{-- Detail Jam Mengajar --}}
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2"><h6>Data Jam Mengajar</h6></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td width="30%">Satuan Jam Mengajar </td>
                                    <td>: {{ number_format($penggajian->satuan_jam_mengajar) }} Hari</td>
                                </tr>
                                <tr>
                                    <td width="20%">Besaran Jam Mengajar </td>
                                    <td>: Rp. {{ number_format($penggajian->besaran_jam_mengajar) }}</td>
                                </tr>
                                <tr>
                                    <td width="20%">Jumlah Jam Mengajar </td>
                                    <td>: Rp. {{ number_format($penggajian->jumlah_jam_mengajar) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{-- Detail Jam Mengajar --}}
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2"><h6>Data Jam Mengaji</h6></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td width="30%">Satuan Jam Mengaji </td>
                                    <td>: {{ number_format($penggajian->satuan_jam_mengajar) }} Hari</td>
                                </tr>
                                <tr>
                                    <td width="20%">Besaran Jam Mengaji </td>
                                    <td>: Rp. {{ number_format($penggajian->besaran_jam_mengajar) }}</td>
                                </tr>
                                <tr>
                                    <td width="20%">Jumlah Jam Mengaji </td>
                                    <td>: Rp. {{ number_format($penggajian->jumlah_jam_mengajar) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{-- Detail Tunjangan Hari Raya --}}
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2"><h6>Data Tunjangan</h6></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td width="30%">Tunjangan Hari Raya </td>
                                    <td>: Rp. {{ number_format($penggajian->tunjangan_hari_raya) }} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{-- Total Tambahan --}}  
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <td width="30%"><h6><b>TOTAL TAMBAHAN</b></h6></td>
                                    <td><h6><b>: Rp. {{ number_format($penggajian->total_tambahan) }}</b></h6></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <br>
                     {{-- Detail Potongan Transportasi --}}
                     <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2"><h6>Potongan Transportasi</h6></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="30%"> Besaran Potongan Transport</td>
                                    <td>: {{ number_format($penggajian->harian_potongan_transport) }} Hari</td>
                                </tr>
                                <tr>
                                    <td width="20%"> Satuan Potongan Transport</td>
                                    <td>: Rp. {{ number_format($penggajian->besaran_potongan_transport) }} </td>
                                </tr>
                                <tr>
                                    <td width="20%">Jumlah Potongan Transport </td>
                                    <td>: Rp. {{ number_format($penggajian->jumlah_potongan_transport) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{-- Detail Potongan Jam Mengajar --}}
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2"><h6>Potongan Jam Mengajar</h6></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td width="30%">Satuan Potongan Jam Mengajar </td>
                                    <td>: {{ number_format($penggajian->satuan_potongan_jam_mengajar) }} Hari</td>
                                </tr>
                                <tr>
                                    <td width="20%">Besaran Potongan Jam Mengajar </td>
                                    <td>: Rp. {{ number_format($penggajian->besaran_potongan_jam_mengajar) }}</td>
                                </tr>
                                <tr>
                                    <td width="20%">Jumlah Potongan Jam Mengajar </td>
                                    <td>: Rp. {{ number_format($penggajian->jumlah_potongan_jam_mengajar) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{-- Detail Potongan Jam Mengajar --}}
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th colspan="2"><h6>Potongan Jam Mengaji</h6></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td width="30%">Satuan Potongan Jam Mengaji </td>
                                    <td>: {{ number_format($penggajian->satuan_potongan_jam_mengajar) }} Hari</td>
                                </tr>
                                <tr>
                                    <td width="20%">Besaran Potongan Jam Mengaji </td>
                                    <td>: Rp. {{ number_format($penggajian->besaran_potongan_jam_mengajar) }}</td>
                                </tr>
                                <tr>
                                    <td width="20%">Jumlah Potongan Jam Mengaji </td>
                                    <td>: Rp. {{ number_format($penggajian->jumlah_potongan_jam_mengajar) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    {{-- Total Potongan --}}  
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <td width="30%"><h6><b>TOTAL POTONGAN</b></h6></td>
                                    <td><h6><b>: Rp. {{ number_format($penggajian->total_potongan) }}</b></h6></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <br>
                    {{-- Total Seluruh Gaji --}}  
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <td width="30%"><h6><b>TOTAL SELURUH GAJI</b></h6></td>
                                    <td><h6><b>: Rp. {{ number_format($penggajian->total_seluruh_gaji) }}</b></h6></td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <br>
                    {{-- Detail Potongan Lainya --}}
                    <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th colspan="2"><h6>Potongan Lain</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%"> Potongan Dana Pensiun</td>
                                <td>: Rp. {{ number_format($penggajian->potongan_dana_pensiun) }}</td>
                            </tr>
                            <tr>
                                <td width="20%"> Potongan Dana Kredit</td>
                                <td>: Rp. {{ number_format($penggajian->potongan_dana_kredit) }} </td>
                            </tr>
                            <tr>
                                <td width="20%">Potongan Dana Sosial </td>
                                <td>: Rp. {{ number_format($penggajian->potongan_dana_sosial) }}</td>
                            </tr>
                            <tr>
                                <td width="20%">Potongan BPJS</td>
                                <td>: Rp. {{ number_format($penggajian->potongan_bpjs) }}</td>
                            </tr>
                            <tr>
                                <td width="20%">Potongan Arisan </td>
                                <td>: Rp. {{ number_format($penggajian->potongan_arisan) }}</td>
                            </tr>
                            <tr>
                                <td width="20%">Potongan lainya </td>
                                <td>: Rp. {{ number_format($penggajian->potongan_lain) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <br>
                    {{-- Total Gaji Diterima --}}  
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <td width="30%"><h6><b>TOTAL GAJI DITERIMA</b></h6></td>
                                    <td><h6><b>: Rp. {{ number_format($penggajian->total_gaji_diterima) }}</b></h6></td>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Table daftar item -->
</div>
    <br>

    <button class="btn btn-primary" onclick="printArea('print-area')"><i class="fa fa-print me-2" aria-hidden="true"></i>Cetak Data</button>

    <script>
        function printArea(areaId) {
            // Menyimpan konten asli halaman
            var originalContent = document.body.innerHTML;
        
            // Mengambil konten dari area yang akan dicetak
            var printContent = document.getElementById(areaId).innerHTML;
        
            // Menimpa konten halaman dengan area yang akan dicetak
            document.body.innerHTML = printContent;
        
            // Melakukan perintah cetak
            window.print();
        
            // Mengembalikan konten halaman ke kondisi semula
            document.body.innerHTML = originalContent;
        }
        </script>
        
@endsection()