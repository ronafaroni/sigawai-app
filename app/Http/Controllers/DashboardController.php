<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Penggajian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('template-admin.index');
    }

    public function dashboard()
    {
        $pegawai = Pegawai::count();
        $unit_kerja = Pegawai::select('unit_kerja')->distinct()->count('unit_kerja');
        $tetap = Pegawai::where('status_kerja', 'Pegawai Tetap')->count();
        $tidak_tetap = Pegawai::where('status_kerja', 'Pegawai Tidak Tetap')->count();
        return view('dashboard.admin-dashboard', compact('pegawai','unit_kerja','tetap','tidak_tetap'));
    }

    public function userDashboard()
{
    $penggajian = Penggajian::where('niy', Auth::guard('web')->user()->niy)
        ->orderBy('created_at', 'desc')
        ->first();

    // Retrieve and aggregate attendance data by month
    $attendanceData = Penggajian::where('niy', Auth::guard('web')->user()->niy)
        ->select('bln_gaji', 'satuan_potongan_transport')
        ->orderBy('bln_gaji', 'asc')
        ->get();

    // Format data for ApexCharts
    $labels = $attendanceData->pluck('bln_gaji');
    $data = $attendanceData->pluck('satuan_potongan_transport');

    return view('dashboard.user-dashboard', compact('penggajian', 'labels', 'data'));
}


}
