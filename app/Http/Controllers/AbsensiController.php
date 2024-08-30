<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function pengajuanIzinCuti()
    {
        $cuti = Cuti::all();
        $izin = Absensi::all();
        return view('absensi.pengajuan-izin-cuti', compact('cuti', 'izin'));
    }

    public function simpanPengajuanIzinCuti(Request $request)
    {
        $data = new Absensi;
        $data->niy = $request->get('niy');
        $data->nama_pegawai = $request->get('nama_pegawai');
        $data->jenis_izin = $request->get('jenis_izin');
        $data->keterangan_cuti = $request->get('jenis_cuti');
        $data->tgl_mulai_izin = $request->get('tgl_mulai');
        $data->tgl_selesai_izin = $request->get('tgl_masuk');
        $data->alasan_izin = $request->get('alasan');
        $data->save();

        session()->flash('success', 'Pengajuan Izin Cuti Berhasil dibuat. ');
        return redirect()->route('pengajuan-izin-cuti');
    }

    public function updatePengajuanIzinCuti(Request $request, $id_absensi)
    {
        $data = Absensi::findOrFail($id_absensi);
        $data->niy = $request->get('niy');
        $data->nama_pegawai = $request->get('nama_pegawai');
        $data->keterangan_cuti = $request->get('jenis_cuti');
        $data->tgl_mulai_izin = $request->get('tgl_mulai');
        $data->tgl_selesai_izin = $request->get('tgl_masuk');
        $data->alasan_izin = $request->get('alasan');
        $data->status_izin = $request->get('status_izin');
        $data->update();

        session()->flash('update', 'Pengajuan Izin Cuti Berhasil perbarui. ');
        return redirect()->route('pengajuan-izin-cuti');
    }

    public function userPengajuanIzinCuti()
    {
        $niy = Auth::guard('web')->user()->niy;
        $pegawai = Pegawai::where('niy', $niy)->first();
        $cuti = Cuti::all();
        $izin = Absensi::where('niy', $niy)->get();
        return view('absensi.user-pengajuan-izin-cuti', compact('cuti', 'izin', 'pegawai'));
    }

    public function userSimpanPengajuanIzinCuti(Request $request)
    {
        $data = new Absensi;
        $data->niy = $request->get('niy');
        $data->nama_pegawai = $request->get('nama_pegawai');
        $data->jenis_izin = $request->get('jenis_izin');
        $data->keterangan_cuti = $request->get('jenis_cuti');
        $data->tgl_mulai_izin = $request->get('tgl_mulai');
        $data->tgl_selesai_izin = $request->get('tgl_masuk');
        $data->alasan_izin = $request->get('alasan');
        $data->save();

        session()->flash('success', 'Pengajuan Izin Cuti Berhasil dibuat. ');
        return redirect()->route('user-pengajuan-izin-cuti');
    }

    public function deletePengajuanIzinCuti($id_absensi)
    {
        $data = Absensi::findOrFail($id_absensi);
        $data->delete();
        session()->flash('delete', 'Pengajuan Izin Cuti Berhasil dihapus. ');
        return redirect()->route('user-pengajuan-izin-cuti');
    }

}
