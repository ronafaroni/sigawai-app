<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public function generate()
    {
        // Misalnya kita menggunakan kode unik yang dikenal sistem, misalnya "scan-this-code"
        $code = 'scan-this-code';

        $qrCode = QrCode::size(300)->generate($code);

        return view('qr-code', ['qrCode' => $qrCode]);
    }
}
