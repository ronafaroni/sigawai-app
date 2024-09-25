<?php

namespace App\Http\Controllers;

use App\Exports\ExportPenggajian;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Penggajian;
use App\Models\Pegawai;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportPenggajian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use PDF;

class PenggajianController extends Controller
{
    public function daftarPenggajian()
    {
        $penggajian = Penggajian::with('pegawai')->get();

        return view('penggajian.daftar-penggajian', compact('penggajian'));
    }

    public function importPenggajian(Request $request)
    {
        $request->validate(
            [
                'import_file' => 'required|mimes:xls,xlsx,csv',
            ],
            [
                'import_file.required' => 'File import harus diisi',
                'import_file.mimes' => 'File import harus berupa xls, xlsx atau csv',
            ]
        );

        Excel::import(new ImportPenggajian, $request->file('import_file'));

        session()->flash('success', 'Data penggajian berhasil diimport');
        return redirect()->route('daftar-penggajian');
    }

    public function downloadFilePenggajian()
    {
        // Tentukan path file
        $filePath = public_path('downloads/TEMPLATE_PENGGAJIAN_2024.xlsx');

        // Periksa apakah file ada
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // Mendownload file
        return response()->download($filePath);
    }

    public function deletePenggajian($id_gaji)
    {
        $penggajian = Penggajian::findOrFail($id_gaji);
        $penggajian->delete();

        session()->flash('delete', 'Data penggajian berhasil dihapus');
        return redirect()->route('daftar-penggajian');
    }

    public function getMonths($year)
    {
        $months = DB::table('penggajian')
            ->where('thn_gaji', $year)
            ->distinct()
            ->pluck('bln_gaji');

        Log::info($months); // Tambahkan logging untuk melihat output

        return response()->json($months);
    }

    public function getEmployees($year, $month)
    {
        // Pastikan bahwa 'pegawai' adalah nama relasi yang benar
        $employees = Penggajian::where('thn_gaji', $year)
            ->where('bln_gaji', $month)
            ->with('pegawai') // Relasi ke model Pegawai
            ->get();

        Log::info($employees); // Debugging: cek data yang didapat

        $employeeNames = $employees->pluck('pegawai.nama_pegawai')->unique();

        Log::info($employeeNames); // Debugging: cek nama pegawai yang diambil

        return response()->json($employeeNames);
    }


    public function hasilRekapPenggajian(Request $request)
    {
        $thn = $request->input('thn_gaji');
        $bln = $request->input('bln_gaji');

        $thn_gaji = Penggajian::select('thn_gaji')
            ->groupBy('thn_gaji')->get();

        $bln_gaji = Penggajian::select('bln_gaji')
            ->groupBy('bln_gaji')->get();

        $penggajian = Penggajian::with('pegawai')->where('thn_gaji', $thn)->where('bln_gaji', $bln)->get();

        return view('penggajian.hasil-pencarian-data', compact('penggajian', 'thn_gaji', 'bln_gaji'));
    }

    public function cariPencarian(Request $request)
    {
        $request->validate(
            [
                'thn_gaji' => 'required',
                'bln_gaji' => 'required',
            ],
            [
                'thn_gaji.required' => 'Tahun Gaji harus diisi',
                'bln_gaji.required' => 'Bulan Gaji harus diisi',
            ]
        );

        $thn_gaji = Penggajian::select('thn_gaji')
            ->groupBy('thn_gaji')->get();

        $bln_gaji = Penggajian::select('bln_gaji')
            ->groupBy('bln_gaji')->get();

        $penggajian = Penggajian::with('pegawai')->get();

        return view('penggajian.hasil-pencarian-data', compact('penggajian', 'thn_gaji', 'bln_gaji'));
    }

    public function hasilPencarianPenggajian(Request $request)
    {
        $thn = $request->input('thn_gaji');
        $bln = $request->input('bln_gaji');

        $thn_gaji = Penggajian::select('thn_gaji')
            ->groupBy('thn_gaji')->get();

        $bln_gaji = Penggajian::select('bln_gaji')
            ->groupBy('bln_gaji')->get();

        $penggajian = Penggajian::with('pegawai')->where('thn_gaji', $thn)->where('bln_gaji', $bln)->get();

        return view('penggajian.hasil-pencarian-data', compact('penggajian', 'thn_gaji', 'bln_gaji'));
    }

    public function rekapPenggajian()
    {
        $thn_gaji = Penggajian::select('thn_gaji')
            ->groupBy('thn_gaji')->get();

        $bln_gaji = Penggajian::select('bln_gaji')
            ->groupBy('bln_gaji')->get();

        return view('penggajian.rekap-penggajian', compact('thn_gaji', 'bln_gaji'));
    }

    public function slipPenggajian()
    {
        $penggajian = Penggajian::with('pegawai')->get();
        return view('penggajian.slip-penggajian', compact('penggajian'));
    }

    public function cariRekapPenggajian(Request $request)
    {
        $thn_gaji = $request->input('thn_gaji');
        $bln_gaji = $request->input('bln_gaji');

        $penggajian = DB::table('penggajian')
            ->where('thn_gaji', $thn_gaji)
            ->where('bln_gaji', $bln_gaji)
            ->get();

        return response()->json($penggajian);
    }

    public function detailPenggajian($id_gaji)
    {
        $id = Penggajian::findOrFail($id_gaji);
        $penggajian = Penggajian::with('pegawai')->where('id_gaji', $id_gaji)->first();
        return view('penggajian.detail-penggajian', compact('penggajian'));
    }

    public function cariSlipPenggajian(Request $request)
    {
        $thn_gaji = Penggajian::select('thn_gaji')
            ->groupBy('thn_gaji')->get();

        $bln_gaji = Penggajian::select('bln_gaji')
            ->groupBy('bln_gaji')->get();
        return view('penggajian.cari-slip-penggajian', compact('thn_gaji', 'bln_gaji'));
    }

    public function hasilCariSlip(Request $request)
    {
        $thn = $request->input('thn_gaji');
        $bln = $request->input('bln_gaji');
        $nama = $request->input('nama_pegawai');

        $thn_gaji = Penggajian::select('thn_gaji')
            ->groupBy('thn_gaji')->get();

        $bln_gaji = Penggajian::select('bln_gaji')
            ->groupBy('bln_gaji')->get();


        //opsi menggunakan eloquent
        $pencarian = Penggajian::join('pegawai', 'penggajian.niy', '=', 'pegawai.niy')
            ->where('penggajian.thn_gaji', $thn)
            ->where('penggajian.bln_gaji', $bln)
            ->where('pegawai.nama_pegawai', $nama)
            ->select('penggajian.*', 'pegawai.*') // Memilih kolom dari tabel 'penggajian' saja
            ->get();

        return view('penggajian.slip-penggajian', compact('pencarian', 'thn_gaji', 'bln_gaji'));
    }

    public function printPenggajian($id_gaji)
    {
        $id = Penggajian::findOrFail($id_gaji);
        $penggajian = Penggajian::with('pegawai')->where('id_gaji', $id_gaji)->first();
        return view('penggajian.print-penggajian', compact('penggajian'));
    }

    public function pdfPenggajian($id_gaji)
    {
        $id = Penggajian::findOrFail($id_gaji);
        $penggajian = Penggajian::with('pegawai')->where('id_gaji', $id_gaji)->first();
        $pdf = PDF::loadView('penggajian.pdf-penggajian', compact('penggajian'));

        return $pdf->download('laporan-penggajian.pdf');
    }

    public function userSlipPenggajian()
    {
        $thn_gaji = Penggajian::select('thn_gaji')
            ->groupBy('thn_gaji')->get();

        $bln_gaji = Penggajian::select('bln_gaji')
            ->groupBy('bln_gaji')->get();

        return view('penggajian.user-slip-penggajian', compact('thn_gaji', 'bln_gaji'));
    }

    public function getUserMonths($year)
    {
        // Ambil data bulan berdasarkan tahun
        $months = DB::table('penggajian')
            ->where('thn_gaji', $year)
            ->distinct()
            ->pluck('bln_gaji');

        return response()->json($months);
    }

    public function hasilCariUserSlipPenggajian(Request $request)
    {
        $thn = $request->input('thn_gaji');
        $bln = $request->input('bln_gaji');
        $niy = Auth::guard('web')->user()->niy;

        $thn_gaji = Penggajian::select('thn_gaji')
            ->groupBy('thn_gaji')->get();

        $bln_gaji = Penggajian::select('bln_gaji')
            ->groupBy('bln_gaji')->get();

        //opsi menggunakan eloquent
        $penggajian = Penggajian::join('pegawai', 'penggajian.niy', '=', 'pegawai.niy')
            ->where('penggajian.thn_gaji', $thn)
            ->where('penggajian.bln_gaji', $bln)
            ->where('pegawai.niy', $niy)
            ->select('penggajian.*', 'pegawai.*') // Memilih kolom dari tabel 'penggajian' saja
            ->first();

        return view('penggajian.user-hasil-cari-slip-penggajian', compact('penggajian', 'thn_gaji', 'bln_gaji'));
    }

    public function historisPenggajian()
    {
        $niy = Auth::guard('web')->user()->niy;
        $penggajian = Penggajian::with('pegawai')->where('niy', $niy)->get();
        return view('penggajian.historis-penggajian', compact('penggajian'));
    }

    public function userDetailPenggajian($id_gaji)
    {
        $id = Penggajian::findOrFail($id_gaji);
        $penggajian = Penggajian::with('pegawai')->where('id_gaji', $id_gaji)->first();
        return view('penggajian.user-detail-penggajian', compact('penggajian'));
    }

}
