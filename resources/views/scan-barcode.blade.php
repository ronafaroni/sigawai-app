<!-- resources/views/scan-barcode.blade.php -->
@extends('template-user.index')

@section('content-user')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container text-center">
    <h2>Scan Barcode</h2><br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <video id="preview" width="100%" height="auto" style="border: 1px solid black;"></video>
            <div id="result" class="mt-3">Hasil scan akan muncul di sini</div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@zxing/library@0.18.3/umd/index.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const codeReader = new ZXing.BrowserMultiFormatReader();
        const previewElem = document.getElementById('preview');
        const resultElem = document.getElementById('result');

        console.log('Memulai pemindaian...');

        // Mulai decoding dari video stream
        codeReader.decodeFromVideoDevice(null, previewElem, (result, error) => {
            if (result) {
                console.log('Hasil:', result.text);
                resultElem.textContent = `Hasil: ${result.text}`;

                // Kirim data ke server (misalnya untuk menyimpan hasil scan ke database)
                fetch('/absensi-kehadiran', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        niy: result.text, // Misalnya, result.text adalah NIY atau ID pegawai
                        tanggal_masuk: new Date().toISOString().split('T')[0] // Tanggal hari ini
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Data berhasil disimpan:', data);
                    resultElem.textContent = `Absensi berhasil disimpan untuk: ${data.data.niy}`;
                })
                .catch((error) => console.error('Error:', error));
            }
            if (error && !(error instanceof ZXing.NotFoundException)) {
                console.error('Error saat memindai:', error);
            }
        })
        .catch(err => console.error('Error menginisiasi pemindaian:', err));
    });
</script>
@endsection
