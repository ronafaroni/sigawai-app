<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Kehadiran;
use App\Models\Pegawai;

class KehadiranController extends Controller
{
    public function catatanKehadiran()
    {
        $kehadiran = Kehadiran::where('niy', Auth::guard('web')->user()->niy)->get();
        return view('kehadiran.user-catatan-kehadiran', compact('kehadiran'));
    }
// opsi untuk upload server
//     public function store(Request $request)
// {
//     $data = $request->validate([
//         'image' => 'required|string',
//     ]);

//     try {
//         // Decode base64 image
//         $imageData = $data['image'];
//         $imageData = str_replace('data:image/png;base64,', '', $imageData);
//         $imageData = str_replace(' ', '+', $imageData);
//         $imageName = 'wajah_' . time() . '.png';

//         // Define the path where the image will be stored
//         // Ensure that the path points to the public directory directly on the server
//         $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/wajah';
//         $imagePath = $destinationPath . '/' . $imageName;

//         // Ensure the directory exists
//         if (!file_exists($destinationPath)) {
//             mkdir($destinationPath, 0755, true);
//         }

//         // Save the image to the specified directory
//         file_put_contents($imagePath, base64_decode($imageData));

//         // Save the image information to the database
//         $kehadiran = Kehadiran::create([
//             'niy' => Auth::guard('web')->user()->niy,
//             'nama_pegawai' => Auth::guard('web')->user()->name,
//             'tanggal_masuk' => now(),
//             'waktu_masuk' => \Carbon\Carbon::now()->format('H:i:s'),
//             'image_path' => $imageName
//         ]);

//         return response()->json(['success' => true, 'message' => 'Wajah berhasil disimpan', 'data' => $kehadiran]);
//     } catch (\Exception $e) {
//         return response()->json(['success' => false, 'error' => 'Gagal menyimpan gambar: ' . $e->getMessage()]);
//     }
// }

    // public function absensiKehadiran(Request $request)
    // {
    //     // Validasi data yang diterima
    //     $validated = $request->validate([
    //         'niy' => 'required|string',
    //         'tanggal_masuk' => 'required|date',
    //     ]);

    //     // Temukan pegawai berdasarkan NIY
    //     $pegawai = Pegawai::where('niy', $validated['niy'])->first();

    //     if (!$pegawai) {
    //         return response()->json(['message' => 'Pegawai tidak ditemukan.'], 404);
    //     }

    //     // Simpan data ke database
    //     $kehadiran = Kehadiran::create([
    //         'niy' => $validated['niy'],
    //         'nama_pegawai' => $pegawai->nama_pegawai,
    //         'tanggal_masuk' => $validated['tanggal_masuk'],
    //     ]);

    //     return response()->json(['message' => 'Absensi berhasil disimpan!', 'data' => $kehadiran], 201);
    // }

    public function store(Request $request)
    {
        // Validasi input
        $data = $request->validate([
            'image' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric', 
        ]);
    
        try {
            // Mendekode gambar base64
            $imageData = $data['image'];
            
            // Menghilangkan header base64 jika ada (sesuaikan dengan format yang dikirimkan)
            if (strpos($imageData, 'data:image/jpeg;base64,') !== false) {
                $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
            } elseif (strpos($imageData, 'data:image/png;base64,') !== false) {
                $imageData = str_replace('data:image/png;base64,', '', $imageData);
            }
            
            $imageData = str_replace(' ', '+', $imageData); // Mengatasi spasi dalam data base64
            $imageName = 'wajah_' . time() . '.jpg'; // Ubah format nama file
            
            // Tentukan path tujuan
            $destinationPath = public_path('wajah');
            $imagePath = $destinationPath . '/' . $imageName;
    
            // Buat direktori jika belum ada
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
    
            // Simpan gambar ke path yang telah ditentukan
            file_put_contents($imagePath, base64_decode($imageData));
    
            // Simpan data kehadiran ke database
            $kehadiran = Kehadiran::create([
                'niy' => Auth::guard('web')->user()->niy,
                'nama_pegawai' => Auth::guard('web')->user()->name,
                'tanggal_masuk' => now(),
                'waktu_masuk' => now()->format('H:i:s'),
                'image_path' => $imageName,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
    
            // Kembalikan response berhasil
            return response()->json(['success' => true, 'message' => 'Wajah berhasil disimpan', 'data' => $kehadiran]);
    
        } catch (\Exception $e) {
            // Kembalikan response error jika terjadi kesalahan
            return response()->json(['success' => false, 'error' => 'Gagal menyimpan gambar: ' . $e->getMessage()]);
        }
    }
    
    
    public function deleteKehadiran($id_kehadiran)
    {
        try {
            $kehadiran = Kehadiran::findOrFail($id_kehadiran);
            $kehadiran->delete();
    
            return response()->json(['success' => true, 'message' => 'Data kehadiran berhasil dihapus!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Gagal menghapus data kehadiran: ' . $e->getMessage()]);
        }
    }
    

    public function getTableData()
    {
        $pegawai = Pegawai::where('niy', Auth::guard('web')->user()->niy)->first();
        $kehadiran = Kehadiran::where('niy', $pegawai)->get();

        return view('kehadiran.user-table-kehadiran', compact('kehadiran'))->render();
    }

    public function userAbsensiPegawai()
    {
        $kehadiran = Kehadiran::with('pegawai')->where('niy', Auth::guard('web')->user()->niy)
            ->orderBy('tanggal_masuk', 'desc')->get();
        return view('kehadiran.user-absensi-pegawai', compact('kehadiran'));
    }

    public function rekapKehadiran()
    {
        $kehadiran = Kehadiran::with('pegawai')
        ->orderBy('tanggal_masuk', 'desc') // Mengurutkan berdasarkan waktu_masuk dalam urutan menurun
        ->get(); // Mengambil semua data
        return view('kehadiran.rekap-kehadiran', compact('kehadiran'));
    }
    public function kehadiranUpdate(Request $request, $id_kehadiran)
    {
        \Log::info('Updating kehadiran with ID:', ['id' => $id_kehadiran]);
    
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'waktu_masuk' => 'required',
        ]);
    
        $hadir = Kehadiran::find($id_kehadiran);
    
        if (!$hadir) {
            return redirect()->back()->withErrors(['msg' => 'Data tidak ditemukan.']);
        }
    
        $hadir->update([
            'tanggal_masuk' => $request->tanggal_masuk,
            'waktu_masuk' => $request->waktu_masuk,
        ]);
        
        session()->flash('update', 'Data Kehadiran Berhasil diperbarui');
        return redirect('/rekap-kehadiran');
    }    

}

