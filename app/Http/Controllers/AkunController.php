<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{
    public function daftarAkun()
    {
        $akun = Akun::all();
        return view('akun.daftar-akun', compact('akun'));
    }

    public function daftarAkunUsers()
    {
        $akun_users = User::all();
        return view('akun.daftar-users', compact('akun_users'));
    }

    public function tambahAkun()
    {
        return view('akun.tambah-akun');
    }

    public function simpanAkun(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ],
        [
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        $akun = new Akun();
        $akun->name = $request->name;
        $akun->username = $request->username;
        $akun->password = Hash::make($request->password);
        $akun->role = 'admin';
        $akun->save();

        session()->flash('success', 'Akun Berhasil dibuat');
        return redirect()->route('daftar-akun');
    }

    public function deleteAkun($id)
    {
        $akun = Akun::find($id);
        $akun->delete();

        session()->flash('hapus', 'Akun Berhasil dihapus');
        return redirect()->route('daftar-akun');
    }

    public function deleteAkunUsers($id_users)
    {
        $akun_users = User::find($id_users);
        $akun_users->delete();

        session()->flash('hapus', 'Akun Berhasil dihapus');
        return redirect()->route('daftar-akun-users');
    }

    public function editAkun($id)
    {
        $akun = Akun::find($id);
        return view('akun.edit-akun', compact('akun'));
    }

    public function updateAkun(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
        ],
        [
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        $akun = Akun::find($id);
        $akun->name = $request->name;
        $akun->username = $request->username;
        $akun->password = Hash::make($request->password);
        $akun->update();

        session()->flash('update', 'Akun Berhasil diupdate');
        return redirect()->route('daftar-akun');
    }

    public function tambahAkunUsers(Request $request)
    {
        return view('akun.tambah-akun-users');
    }

    public function simpanAkunUsers(Request $request)
    {
        $request->validate([
            'niy' => 'required',
            'name' => 'required',
            'username' => 'required', 
            'password' => 'required',
        ],
        [
            'niy.required' => 'NIY harus diisi',
            'name.required' => 'Nama harus diisi',
            'username.required' => 'Username harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        $akun_users = new User();
        $akun_users->niy = $request->niy;
        $akun_users->name = $request->name;
        $akun_users->username = $request->username;
        $akun_users->password = Hash::make($request->password);
        $akun_users->role = 'pegawai';
        $akun_users->save();

        session()->flash('success', 'Akun Berhasil dibuat');
        return redirect()->route('daftar-akun-users');
    }

    public function editAkunUsers($id_users)
    {
        $akun_users = User::find($id_users);
        return view('akun.edit-users', compact('akun_users'));
    }

    public function updateAkunUsers(Request $request, $id_users)
    {
        $akun_users = User::find($id_users);
        $akun_users->niy = $request->niy;
        $akun_users->name = $request->name;
        $akun_users->username = $request->username;
        $akun_users->password = Hash::make($request->password);
        $akun_users->update();

        session()->flash('update', 'Akun Berhasil diupdate');
        return redirect()->route('daftar-akun-users');
    }

    public function userAkun()
    {
        $data = Auth::guard('web')->user()->id_users;
        $akun = User::find($data);
        return view('akun.user-akun', compact('akun'));
    }

    public function userUpdateAkun(Request $request, $id_users)
    {
        $akun_users = User::find($id_users);
        $akun_users->password = hash::make($request->password);
        $akun_users->update();

        session()->flash('update', 'Akun Berhasil diupdate');
        return redirect()->route('user-akun');
    }

}
