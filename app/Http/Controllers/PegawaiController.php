<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\UnitKerja;
use App\Models\StatusPegawai;
use App\Models\User;
use App\Models\StatusKerja;
use Illuminate\Support\Facades\Hash;
use App\Imports\PegawaiImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;


class PegawaiController extends Controller
{
    public function daftarPegawai(Request $request)
    {
        $pegawai = Pegawai::all();
        return view('pegawai.daftar-pegawai', compact('pegawai'));
    }

    public function tambahPegawai()
    {
        $unit_kerja = UnitKerja::all();
        $status_pegawai = StatusPegawai::all();
        $status_kerja = StatusKerja::all();
        return view('pegawai.tambah-pegawai', compact('unit_kerja', 'status_pegawai', 'status_kerja'));
    }

    public function simpanPegawai(Request $request)
    {
        $request->validate([
            'niy' => 'required|unique:pegawai,niy',
            'nama_pegawai' => 'required',
            'tgl_lahir' => 'required',
            'thn_masuk' => 'required',
            'unit_kerja' => 'required',
            'status_pegawai' => 'required',
            'status_kerja' => 'required',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'niy.required' => 'NIY harus diisi',
            'niy.unique' => 'NIY sudah terdaftar',
            'nama_pegawai.required' => 'Nama Pegawai harus diisi',
            'tgl_lahir.required' => 'Tanggal Lahir harus diisi',
            'thn_masuk.required' => 'Tahun Masuk harus diisi',
            'unit_kerja.required' => 'Unit Kerja harus diisi',
            'status_pegawai.required' => 'Status Pegawai harus diisi',
            'status_kerja.required' => 'Status Kerja harus diisi',
            // 'foto.required' => 'Foto harus diisi',
            // 'foto.image' => 'File harus berupa gambar',
            // 'foto.mimes' => 'File harus berupa jpeg,png,jpg,gif,svg',
        ]);

        // Proses upload file
        // $file = $request->file('foto'); 
        // $nama_file = time().'_'.$request->input('niy') . '.' . $file->getClientOriginalExtension();
        // // Tujuan file diupload kemana
        // $tujuan_upload = '/uploads/pegawai/';
        // // Tempat file diupload
        // $file->move(public_path($tujuan_upload), $nama_file);

        $pegawai = new Pegawai;
        $pegawai->niy = $request->get('niy');
        $pegawai->nama_pegawai = $request->get('nama_pegawai');
        $pegawai->thn_masuk = $request->get('thn_masuk');
        $pegawai->tgl_lahir = $request->get('tgl_lahir');
        $pegawai->status_pegawai = $request->get('status_pegawai');
        $pegawai->unit_kerja = $request->get('unit_kerja');
        $pegawai->status_kerja = $request->get('status_kerja');
        // $pegawai->foto = $nama_file;
        $pegawai->save();

        $users = new User;
        $users->niy = $request->get('niy');
        $users->name = $request->get('nama_pegawai');
        $users->username = $request->get('niy');
        $users->password = hash::make($request->get('niy'));
        $users->role = 'pegawai';
        $users->save();
        
        session()->flash('success', 'Data Pegawai berhasil ditambahkan');

        $pegawai = Pegawai::all();

        return redirect()->route('daftar-pegawai', compact('pegawai')); 
    }

    public function editPegawai($niy)
    {
        $pegawai = Pegawai::find($niy);
        $unit_kerja = UnitKerja::all();
        $status_pegawai = StatusPegawai::all();
        $status_kerja = StatusKerja::all();
        return view('pegawai.edit-pegawai', compact('pegawai', 'unit_kerja', 'status_pegawai', 'status_kerja'));
    }

    public function updatePegawai(Request $request, $niy)
    {
        $request->validate([
            'niy' => ['required', 'string', Rule::unique('pegawai', 'niy')->ignore($niy, 'niy')],
            'nama_pegawai' => 'required',
            'thn_masuk' => 'required',
            'unit_kerja' => 'required',
            'status_pegawai' => 'required',
            'status_kerja' => 'required',
            // 'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'niy.required' => 'NIY harus diisi',
            'niy.unique' => 'NIY sudah terdaftar',
            'nama_pegawai.required' => 'Nama Pegawai harus diisi',
            'thn_masuk.required' => 'Tahun Masuk harus diisi',
            'unit_kerja.required' => 'Unit Kerja harus diisi',
            'status_pegawai.required' => 'Status Pegawai harus diisi',
            'status_kerja.required' => 'Status Kerja harus diisi',
            // 'foto.image' => 'File harus berupa gambar',
            // 'foto.mimes' => 'File harus berupa jpeg,png,jpg,gif,svg',
            // 'foto.max' => 'File tidak boleh lebih dari 2 MB',
        ]);

        // Proses upload file
        // $file = $request->file('foto'); 
        // $nama_file = time().'_'.$request->input('niy') . '.' . $file->getClientOriginalExtension();
        // // Tujuan file diupload kemana
        // $tujuan_upload = '/uploads/pegawai/';
        // // Tempat file diupload
        // $file->move(public_path($tujuan_upload), $nama_file);

        $pegawai = Pegawai::find($niy);
        $pegawai->niy = $request->get('niy');
        $pegawai->nama_pegawai = $request->get('nama_pegawai');
        $pegawai->thn_masuk = $request->get('thn_masuk');
        $pegawai->tgl_lahir = $request->get('tgl_lahir');
        $pegawai->status_pegawai = $request->get('status_pegawai');
        $pegawai->unit_kerja = $request->get('unit_kerja');
        $pegawai->status_kerja = $request->get('status_kerja');
        // $pegawai->foto = $nama_file;
        $pegawai->update();

        session()->flash('update', 'Data Pegawai berhasil diupdate.');
        return redirect()->route('daftar-pegawai');
    }

    public function deletePegawai($id_pegawai)
    {
        $pegawai = Pegawai::find($id_pegawai);
        $pegawai->delete();

        session()->flash('delete', 'Data Pegawai berhasil dihapus.');
        return redirect()->route('daftar-pegawai');
    }

    public function statusPegawai()
    {
        Carbon::setLocale('id'); // Mengatur lokal ke bahasa Indonesia

        $pegawai = Pegawai::all(); 
        $status_kerja = StatusKerja::all();
        return view('pegawai.status-pegawai', compact('pegawai', 'status_kerja'));
    }

    public function detailPegawai($id_pegawai)
    {
        $pegawai = Pegawai::find($id_pegawai);
        return view('pegawai.detail-pegawai', compact('pegawai'));
    }

    public function importPegawai(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = $file->getClientOriginalName();
        $file->move('file_pegawai', $nama_file);
        Excel::import(new PegawaiImport, public_path('/file_pegawai/'.$nama_file));
        return redirect()->route('daftar-pegawai');
    }

    public function exportPegawai()
    {
        return Excel::download(new PegawaiExport, 'data-pegawai.xlsx');
    }

    public function updateStatusPegawai(Request $request, $id_pegawai)
    {
        $pegawai = Pegawai::find($id_pegawai);
        $pegawai->status = $request->get('status');
        $pegawai->thn_keluar = $request->get('tgl_keluar');
        $pegawai->update_status = Carbon::now('Asia/Jakarta');
        
        if ($request->get('status') == 'Aktif') {
            $pegawai->alasan = null; // Kosongkan alasan jika status Aktif
        } else {
            $pegawai->alasan = $request->get('alasan');
        }
    
        $pegawai->update();

        session()->flash('update', 'Data Status Pegawai berhasil diupdate.');
        return redirect()->route('status-pegawai');
    }   

    public function userPegawai(){
        $user = Auth::guard('web')->user()->niy; 
        $user = Pegawai::where('niy', $user)->first();
        // Mengambil tanggal lahir dan memformatnya
        $tanggalLahir = Carbon::parse($user->tgl_lahir)->translatedFormat('l, d F Y');

        return view('pegawai.user-pegawai', compact('user', 'tanggalLahir'));
    }

    public function userUpdateDataPegawai(Request $request, $niy)
    {
        // Cari pegawai berdasarkan ID
        $pegawai = Pegawai::find($niy);
    
        // Cek apakah pegawai ditemukan
        if ($pegawai) {
            // Jika ditemukan, update data
            $pegawai->tgl_lahir = $request->get('tgl_lahir');
            $pegawai->alamat = $request->get('alamat');
            $pegawai->no_telp = $request->get('no_telp');
            $pegawai->jenis_kelamin = $request->get('jenis_kelamin');
            $pegawai->email = $request->get('email');
            $pegawai->pendidikan = $request->get('jenjang_pendidikan');
            $pegawai->update();
    
            session()->flash('update', 'Data Pegawai berhasil diupdate.');
        } else {
            // Jika tidak ditemukan, kembalikan pesan error
            session()->flash('error', 'Pegawai tidak ditemukan.');
        }
    
        // Redirect kembali ke halaman daftar pegawai
        return redirect()->route('user-pegawai');
    }

    public function userStatusPegawai(Request $request)
    {
        $user = Auth::guard('web')->user()->niy; 
        $pegawai = Pegawai::where('niy', $user)->first();
        return view('pegawai.user-status-pegawai', compact('pegawai'));
    }
    
}
