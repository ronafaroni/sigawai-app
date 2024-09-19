<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller 
{
    public function daftarInformasi()
    {
        $informasi = Informasi::orderByDesc('status_informasi')
        ->orderByDesc('created_at')
        ->get();

        return view('informasi.daftar-informasi', compact('informasi'));
    }

    public function simpanInformasi(Request $request)
    {
        $request->validate([
            'file_informasi' => 'max:20480',
        ],
        [
            'file_informasi.max' => 'File tidak boleh lebih dari 20 MB',
        ]);

        // Simpan informasi
        $informasi = new Informasi;
        $informasi->nama_informasi = $request->get('nama_informasi');
        $informasi->deskripsi = $request->get('deskripsi');
        $informasi->status_informasi = $request->get('status_informasi');
        $informasi->jenis_informasi = $request->get('jenis_informasi');
        $informasi->link_informasi = $request->get('link_informasi');
            // Cek jika jenis informasi adalah "File" dan file diupload
            if ($request->get('jenis_informasi') == 'File') {
                // Proses upload file
                $file = $request->file('file_informasi');
                $nama_file = time().'_'.$request->get('nama_informasi') . '.' . $file->getClientOriginalExtension();
                // Tujuan file diupload kemana
                $tujuan_upload = '/uploads/informasi/';
                // Tempat file diupload
                $file->move(public_path($tujuan_upload), $nama_file);

                // Simpan path file ke dalam database
                $informasi->file_informasi = $nama_file;
            } else {
                // Jika jenis informasi bukan file, kosongkan field file_informasi
                $informasi->file_informasi = null;
            }

        $informasi->save();

        session()->flash('success', 'Informasi Berhasil ditambahkan');
        return redirect()->route('daftar-informasi');
    }

    public function downloadInformasi($file_informasi)
    {
        // Tentukan path file
        $filePath = public_path('uploads/informasi/' . $file_informasi);

        // Periksa apakah file ada
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // Mendownload file
        return response()->download($filePath);
    }

    public function deleteInformasi($id_informasi)
    {
        $informasi = Informasi::find($id_informasi);
        $informasi->delete();
        session()->flash('delete', 'Informasi Berhasil dihapus');
        return redirect()->route('daftar-informasi');
    }

    public function userInformasi()
    {
        $penting = Informasi::where('status_informasi', 'Penting')
        ->orderByDesc('created_at')
        ->get();

        $informasi = Informasi::where('status_informasi', null)
        ->orderByDesc('created_at')
        ->get();

        return view('informasi.user-informasi', compact('penting', 'informasi'));
    }

    public function userDownloadInformasi($file_informasi)
    {
        // Tentukan path file
        $filePath = public_path('uploads/informasi/' . $file_informasi);

        // Periksa apakah file ada
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // Mendownload file
        return response()->download($filePath);
    }

    public function userOpenFile($file_informasi)
    {
        // Misalkan PDF yang ingin kamu tampilkan berasal dari resource atau memory.
        // Kamu bisa mendapatkan file dari sumber lain seperti storage, external API, dll.
        $filePath = file_get_contents('uploads/informasi/' . $file_informasi);
        // Mengambil PDF dari URL eksternal, bisa juga dari local storage atau hasil generate PDF.

        // Header untuk memastikan file di-stream langsung ke browser tanpa download
        return response($filePath)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="informasi.pdf"');

    }

}
