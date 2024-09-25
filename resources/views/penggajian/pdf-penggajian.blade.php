<!-- Table daftar item -->
<br>
<p class="text-center">Cetak Slip Penggajian : {{ $penggajian->bln_gaji }} {{ $penggajian->thn_gaji }}</p>

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
                                <p><b>Data Pegawai</b></p>
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
                                <p><b>Detail Gaji</b></p>
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
                                <p><b>Transportasi</b></p>
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
                                <p><b>Data Tambahan</b></p>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td width="30%"> Besaran Jam Mengajar</td>
                                <td>: {{ number_format($penggajian->besaran_tambahan) }} Hari</td>
                            </tr>
                            <tr>
                                <td width="20%"> Satuan Jam Mengajar</td>
                                <td>: Rp. {{ number_format($penggajian->satuan_tambahan) }} </td>
                            </tr>
                            <tr>
                                <td width="30%">Kelebihan Jam Mengajar </td>
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
                                <p><b>JUMLAH GAJI</b></p>
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
                                <p><b>Tambahan Lain</b></p>
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
                                <p><b>Data Jam Mengajar</b></p>
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
                                <p><b>Data Jam Mengaji</b></p>
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
                                <p><b>Data Tunjangan</b></p>
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
                                <p><b>TOTAL TAMBAHAN</b></p>
                                <td><b>: Rp. {{ number_format($penggajian->total_tambahan) }}</b></td>
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
                                <p><b>Potongan Transportasi</b></p>
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
                                <p><b>Potongan Jam Mengajar</b></p>
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
                                <p><b>Potongan Jam Mengaji</b></p>
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
                                <p><b>TOTAL POTONGAN</b></p>
                                <td><b>: Rp. {{ number_format($penggajian->total_potongan) }}</b< /td>
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
                                <p><b>TOTAL SELURUH GAJI</b></p>
                                <td><b>: Rp. {{ number_format($penggajian->total_seluruh_gaji) }}</b></td>
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
                                <p><b>Potongan Lainya</b></p>
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
                                <p><b>TOTAL GAJI DITERIMA</b></p>
                                <td><b>: Rp. {{ number_format($penggajian->total_gaji_diterima) }}</b></td>
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
