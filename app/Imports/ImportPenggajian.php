<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Penggajian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ImportPenggajian implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) 
        {
            Penggajian::create([
                'niy' => $row['niy'],
                'bln_gaji' => $row['bln_gaji'],
                'thn_gaji' => $row['thn_gaji'],
                'gaji_pokok' => $row['gaji_pokok'],
                'tunjangan_struktural' => $row['tunjangan_struktural'],
                'tunjangan_pengabdian' => $row['tunjangan_pengabdian'],
                'tunjangan_keluarga' => $row['tunjangan_keluarga'],
                'tunjangan_anak' => $row['tunjangan_anak'],
                'tunjangan_beras' => $row['tunjangan_beras'],
                'tunjangan_kinerja' => $row['tunjangan_kinerja'],
                'besaran_transport' => $row['besaran_transport'],
                'harian_transport' => $row['harian_transport'],
                'jumlah_transport' => $row['jumlah_transport'],
                'tambahan_jam' => $row['tambahan_jam'],
                'jumlah_gaji' => $row['jumlah_gaji'],
                'tambahan_fungsi' => $row['tambahan_fungsi'],
                'besaran_jam_mengajar' => $row['besaran_jam_mengajar'],
                'satuan_jam_mengajar' => $row['satuan_jam_mengajar'],
                'jumlah_jam_mengajar' => $row['jumlah_jam_mengajar'],
                'besaran_jam_mengaji' => $row['besaran_jam_mengaji'],
                'satuan_jam_mengaji' => $row['satuan_jam_mengaji'],
                'jumlah_jam_mengaji' => $row['jumlah_jam_mengaji'],
                'tunjangan_hari_raya' => $row['tunjangan_hari_raya'],
                'total_tambahan' => $row['total_tambahan'],
                'besaran_potongan_transport' => $row['besaran_potongan_transport'],
                'satuan_potongan_transport' => $row['satuan_potongan_transport'],
                'jumlah_potongan_transport' => $row['jumlah_potongan_transport'],
                'besaran_potongan_jam_mengajar' => $row['besaran_potongan_jam_mengajar'],
                'satuan_potongan_jam_mengajar' => $row['satuan_potongan_jam_mengajar'],
                'jumlah_potongan_jam_mengajar' => $row['jumlah_potongan_jam_mengajar'],
                'besaran_potongan_jam_mengaji' => $row['besaran_potongan_jam_mengaji'],
                'satuan_potongan_jam_mengaji' => $row['satuan_potongan_jam_mengaji'],
                'jumlah_potongan_jam_mengaji' => $row['jumlah_potongan_jam_mengaji'],
                'total_potongan' => $row['total_potongan'],
                'total_seluruh_gaji' => $row['total_seluruh_gaji'],
                'potongan_dana_pensiun' => $row['potongan_dana_pensiun'],
                'potongan_dana_kredit' => $row['potongan_dana_kredit'],
                'potongan_dana_sosial' => $row['potongan_dana_sosial'],
                'potongan_bpjs' => $row['potongan_bpjs'],
                'potongan_arisan' => $row['potongan_arisan'],
                'potongan_lain' => $row['potongan_lain'],
                'total_gaji_diterima' => $row['total_gaji_diterima'],
            ]);
        }
    }
}
