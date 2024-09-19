<?php

use App\Models\Absensi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\UserLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\QRCodeController;
use App\Models\Kehadiran;

// Route::get('/', function () {
//     return ['Laravel' => app()->version()];
// });

Route::get('/scan-barcode', function () {
    return view('scan-barcode');
});

Route::post('/absensi-kehadiran', [KehadiranController::class, 'absensiKehadiran'])->name('absensi-kehadiran')->middleware('auth:web');
Route::post('/rekam-wajah', [KehadiranController::class, 'store']);
Route::post('/check-location', [KehadiranController::class, 'checkLocation']);
Route::delete('/delete-kehadiran/{id_kehadiran}', [KehadiranController::class, 'deleteKehadiran'])->name('delete-kehadiran');
Route::put('/kehadiran-update/{id_kehadiran}', [KehadiranController::class, 'kehadiranUpdate'])->name('kehadiran-update');
Route::delete('/reset-kehadiran', [KehadiranController::class, 'resetKehadiran'])->name('reset-kehadiran');

// Route::get('/', [LoginController::class, 'index'])->name('home');
Route::get('/', [UserLoginController::class, 'userCreate'])->name('login');
Route::post('/', [UserLoginController::class, 'userStore']);
Route::get('/login', [UserLoginController::class, 'userCreate'])->name('login');
Route::post('/login', [UserLoginController::class, 'userStore']);

Route::post('/logout', [UserLoginController::class, 'userLogout'])->name('logout');

// Route::get('/user-login', [LoginController::class, 'userLogin'])->name('user-login');
// Route::post('/user-login', [LoginController::class, 'userAuthenticate'])->name('user-login');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth:admin');
Route::get('/daftar-pegawai', [PegawaiController::class, 'daftarPegawai'])->name('daftar-pegawai')->middleware('auth:admin');
Route::get('/detail-pegawai/{id_pegawai}', [PegawaiController::class, 'detailPegawai'])->name('detail-pegawai')->middleware('auth:admin');
Route::get('/tambah-pegawai', [PegawaiController::class, 'tambahPegawai'])->name('tambah-pegawai')->middleware('auth:admin');
Route::post('/simpan-pegawai', [PegawaiController::class, 'simpanPegawai'])->name('simpan-pegawai')->middleware('auth:admin');
Route::get('/edit-pegawai/{niy}', [PegawaiController::class, 'editPegawai'])->name('edit-pegawai')->middleware('auth:admin');
Route::delete('/delete-pegawai/{id_pegawai}', [PegawaiController::class, 'deletePegawai'])->name('delete-pegawai')->middleware('auth:admin');
Route::post('/update-pegawai/{id_pegawai}', [PegawaiController::class, 'updatePegawai'])->name('update-pegawai')->middleware('auth:admin');

Route::post('/update-status-pegawai/{id_pegawai}', [PegawaiController::class, 'updateStatusPegawai'])->name('update-status-pegawai')->middleware('auth:admin');
Route::get('/status-pegawai', [PegawaiController::class, 'statusPegawai'])->name('status-pegawai')->middleware('auth:admin')->middleware('auth:admin');
Route::get('/import-pegawai', [PegawaiController::class, 'importPegawai'])->name('import-pegawai')->middleware('auth:admin');
Route::get('/download-template', [PegawaiController::class, 'downloadTemplate'])->name('download-template')->middleware('auth:admin');
Route::get('/download-pegawai', [PegawaiController::class, 'downloadPegawai'])->name('donwload-pegawai')->middleware('auth:admin');

Route::get('download-template', [PegawaiController::class, 'downloadTemplate'])->name('download-template')->middleware('auth:admin');
Route::get('import-pegawai', [PegawaiController::class, 'importPegawai'])->name('import-pegawai')->middleware('auth:admin');

Route::get('/daftar-akun', [AkunController::class, 'daftarAkun'])->name('daftar-akun')->middleware('auth:admin');
Route::get('/tambah-akun', [AkunController::class, 'tambahAkun'])->name('tambah-akun')->middleware('auth:admin');
Route::post('/simpan-akun', [AkunController::class, 'simpanAkun'])->name('simpan-akun')->middleware('auth:admin');
Route::get('/edit-akun/{id_akun}', [AkunController::class, 'editAkun'])->name('edit-akun')->middleware('auth:admin');
Route::delete('/delete-akun/{id}', [AkunController::class, 'deleteAkun'])->name('delete-akun')->middleware('auth:admin');
Route::post('/update-akun/{id}', [AkunController::class, 'updateAkun'])->name('update-akun')->middleware('auth:admin');

Route::get('/daftar-akun-users', [AkunController::class, 'daftarAkunUsers'])->name('daftar-akun-users')->middleware('auth:admin');
Route::get('/detail-akun-users/{id_akun}', [AkunController::class, 'detailAkunUsers'])->name('detail-akun-users')->middleware('auth:admin');
Route::get('/tambah-akun-users', [AkunController::class, 'tambahAkunUsers'])->name('tambah-akun-users')->middleware('auth:admin');
Route::post('/simpan-akun-users', [AkunController::class, 'simpanAkunUsers'])->name('simpan-akun-users')->middleware('auth:admin');
Route::get('/edit-users/{id_users}', [AkunController::class, 'editAkunUsers'])->name('edit-users')->middleware('auth:admin');
Route::post('/update-users/{id_users}', [AkunController::class, 'updateAkunUsers'])->name('update-users')->middleware('auth:admin');
Route::delete('/delete-users/{id_users}', [AkunController::class, 'deleteAkunUsers'])->name('delete-users');

Route::get('/daftar-penggajian', [PenggajianController::class, 'daftarPenggajian'])->name('daftar-penggajian')->middleware('auth:admin');
Route::get('/edit-penggajian/{id_pegawai}', [PenggajianController::class, 'editPenggajian'])->name('edit-penggajian')->middleware('auth:admin');
Route::post('/update-penggajian/{id_pegawai}', [PenggajianController::class, 'updatePenggajian'])->name('update-penggajian')->middleware('auth:admin');
Route::post('/import-penggajian', [PenggajianController::class, 'importPenggajian'])->name('import-penggajian')->middleware('auth:admin');
Route::get('/download-template-penggajian', [PenggajianController::class, 'downloadTemplatePenggajian'])->name('download-template-penggajian')->middleware('auth:admin');

Route::delete('/delete-penggajian/{id_gaji}', [PenggajianController::class, 'deletePenggajian'])->name('delete-penggajian')->middleware('auth:admin');
Route::get('/slip-penggajian', [PenggajianController::class, 'slipPenggajian'])->name('slip-penggajian')->middleware('auth:admin');
Route::get('/rekap-penggajian', [PenggajianController::class, 'rekapPenggajian'])->name('rekap-penggajian')->middleware('auth:admin');
Route::get('/hasil-rekap-penggajian', [PenggajianController::class, 'hasilRekapPenggajian'])->name('hasil-rekap-penggajian')->middleware('auth:admin');
Route::get('/cari-rekap-penggajian', [PenggajianController::class, 'cariRekapPenggajian'])->name('cari-rekap-penggajian')->middleware('auth:admin');
Route::get('/get-months/{year}', [PenggajianController::class, 'getMonths'])->name('get-months')->middleware('auth:admin');
Route::get('/get-employees/{year}/{month}', [PenggajianController::class, 'getEmployees'])->name('get-employees')->middleware('auth:admin');
Route::get('hasil-cari-slip', [PenggajianController::class, 'hasilCariSlip'])->name('hasil-cari-slip')->middleware('auth:admin');

Route::get('/hasil-pencarian', [PenggajianController::class, 'hasilPencarian'])->name('hasil-pencarian')->middleware('auth:admin');
Route::get('/hasil-cari', [PenggajianController::class, 'cariPencarian'])->name('hasil-cari')->middleware('auth:admin');
Route::get('/detail-penggajian/{id_gaji}', [PenggajianController::class, 'detailPenggajian'])->name('detail-penggajian')->middleware('auth:admin');
Route::get('/cari-slip-penggajian', [PenggajianController::class, 'cariSlipPenggajian'])->name('cari-slip-penggajian')->middleware('auth:admin');

Route::get('/print-penggajian/{id_gaji}', [PenggajianController::class, 'printPenggajian'])->name('print-penggajian')->middleware('auth:admin');
Route::get('/pdf-penggajian/{id_gaji}', [PenggajianController::class, 'pdfPenggajian'])->name('pdf-penggajian')->middleware('auth:admin');

Route::get('/pengajuan-izin-cuti', [AbsensiController::class, 'pengajuanIzinCuti'])->name('pengajuan-izin-cuti')->middleware('auth:admin');
Route::get('/pengajuan-izin-cuti', [AbsensiController::class, 'PengajuanIzinCuti'])->name('pengajuan-izin-cuti')->middleware('auth:admin');
Route::post('/simpan-pengajuan-izin-cuti', [AbsensiController::class, 'simpanPengajuanIzinCuti'])->name('simpan-pengajuan-izin-cuti')->middleware('auth:admin');
Route::post('/update-pengajuan-izin-cuti/{id_absensi}', [AbsensiController::class, 'updatePengajuanIzinCuti'])->name('update-pengajuan-izin-cuti')->middleware('auth:admin');

Route::get('/daftar-informasi', [InformasiController::class, 'daftarInformasi'])->name('daftar-informasi')->middleware('auth:admin');
Route::post('/simpan-informasi', [InformasiController::class, 'simpanInformasi'])->name('simpan-informasi')->middleware('auth:admin');
Route::delete('/delete-informasi/{id_informasi}', [InformasiController::class, 'deleteInformasi'])->name('delete-informasi')->middleware('auth:admin');
Route::get('/download-informasi/{file_informasi}', [InformasiController::class, 'downloadInformasi'])->name('download-informasi')->middleware('auth:admin');

Route::get('/rekap-kehadiran',[KehadiranController::class, 'rekapKehadiran'])->name('rekap-kehadiran')->middleware('auth:admin');




Route::get('/user-dashboard', [DashboardController::class, 'userDashboard'])->name('user-dashboard')->middleware('auth:web');

Route::get('/user-informasi', [InformasiController::class, 'userInformasi'])->name('user-informasi')->middleware('auth:web');

Route::get('/user-pegawai', [PegawaiController::class, 'userPegawai'])->name('user-pegawai')->middleware('auth:web');
Route::post('/user-update-data-pegawai/{niy}', [PegawaiController::class, 'userUpdateDataPegawai'])->name('user-update-data-pegawai')->middleware('auth:web');
Route::get('/user-status-pegawai', [PegawaiController::class, 'userStatusPegawai'])->name('user-status-pegawai')->middleware('auth:web');

Route::get('/user-akun', [AkunController::class, 'userAkun'])->name('user-akun')->middleware('auth:web');
Route::post('/user-update-akun/{id_users}', [AkunController::class, 'userUpdateAkun'])->name('user-update-akun')->middleware('auth:web');
Route::get('/user-download-informasi/{file_informasi}', [InformasiController::class, 'userDownloadInformasi'])->name('user-download-informasi')->middleware('auth:web');
Route::get('user-open-file/{file_informasi}', [InformasiController::class, 'userOpenFile'])->name('user-open-file')->middleware('auth:web');

Route::get('/user-slip-penggajian', [PenggajianController::class, 'userSlipPenggajian'])->name('user-slip-penggajian')->middleware('auth:web');
Route::get('/get-user-months/{year}', [PenggajianController::class, 'getUserMonths']);
Route::get('/hasil-cari-user-slip-penggajian', [PenggajianController::class, 'hasilCariUserSlipPenggajian'])->name('hasil-cari-user-slip-penggajian')->middleware('auth:web');
Route::get('/historis-penggajian', [PenggajianController::class, 'historisPenggajian'])->name('historis-penggajian')->middleware('auth:web');

Route::get('/user-detail-penggajian/{id_gaji}', [PenggajianController::class, 'userDetailPenggajian'])->name('user-detail-penggajian')->middleware('auth:web');
Route::get('/user-pengajuan-izin-cuti', [AbsensiController::class, 'userPengajuanIzinCuti'])->name('user-pengajuan-izin-cuti')->middleware('auth:web');
Route::post('/user-simpan-pengajuan-izin-cuti', [AbsensiController::class, 'userSimpanPengajuanIzinCuti'])->name('user-simpan-pengajuan-izin-cuti')->middleware('auth:web');
Route::delete('/delete-pengajuan-izin-cuti/{id_absensi}', [AbsensiController::class, 'deletePengajuanIzinCuti'])->name('delete-pengajuan-izin-cuti')->middleware('auth:web');

Route::get('/user-catatan-kehadiran', [KehadiranController::class, 'catatanKehadiran'])->name('user-catatan-kehadiran')->middleware('auth:web');

Route::get('/kehadiran-table', function () {
    $kehadiran = Kehadiran::where('niy', Auth::guard('web')->user()->niy)->get();
    return view('kehadiran.user-table-kehadiran', compact('kehadiran'));
});

Route::delete('/kehadiran/{id_kehadiran}', [KehadiranController::class, 'deleteKehadiran'])->name('delete-kehadiran');
Route::get('/generate', [QRCodeController::class, 'generate'])->name('generate')->middleware('auth:web');
Route::get('user-absensi-pegawai', [KehadiranController::class, 'userAbsensiPegawai'])->name('user-absensi-pegawai')->middleware('auth:web');
Route::delete('/delete-kehadiran/{id_kehadiran}', [KehadiranController::class, 'deleteKehadiran'])->name('delete-kehadiran')->middleware('auth:web');



// require __DIR__.'/auth.php';
// require __DIR__.'/admin-auth.php';
