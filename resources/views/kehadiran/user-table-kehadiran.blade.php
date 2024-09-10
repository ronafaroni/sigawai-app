<tbody id="kehadiran-table-body">
    @if($kehadiran->isEmpty())
    <tr id="empty-row">
        <td colspan="7" class="text-center">Data kehadiran tidak ditemukan atau kosong</td>
    </tr>
    @else
        @foreach ($kehadiran as $data)
        <tr id="kehadiran-{{ $data->id_kehadiran }}">
            <td>{{ $loop->iteration }}</td>
            <td>
                <h2 class="table-avatar">
                    <img class="avatar-img" width="40px" height="40px"
                        src="{{ asset('wajah/' . $data->image_path) }}" alt="Wajah Pegawai"
                        data-bs-toggle="modal" data-bs-target="#imageModal"
                        onclick="showImage('{{ asset('wajah/' . $data->image_path) }}')">
                </h2>                
            </td>
            <td>{{ $data->niy }}</td>
            <td>{{ $data->nama_pegawai }}</td>
            <td>{{ \Carbon\Carbon::parse($data->tanggal_masuk)->locale('id')->translatedFormat('d F Y') }}</td>
            <td>{{ $data->waktu_masuk }}</td>

            <td>
                @php
                    // Tentukan waktu toleransi
                    $toleransiBoarding = '16:15:00'; // Batas waktu untuk pegawai boarding
                    $toleransiSD = '07:00:00'; // Batas waktu untuk pegawai SD
            
                    // Ambil kategori pegawai
                    $kategoriPegawai = $data->pegawai->unit_kerja; // Misalkan ada atribut 'kategori' yang menentukan jenis pegawai
            
                    // Tentukan waktu batas berdasarkan kategori
                    $waktuBatas = ($kategoriPegawai == 'Boarding Bumi Kartini') ? $toleransiBoarding : $toleransiSD;
                @endphp
            
                @if ($data->waktu_masuk > $waktuBatas)
                    <span class="text-danger"><b>Terlambat</b></span>
                @else
                    <span class="text-success"><b>Tepat Waktu</b></span>
                @endif
            </td>
            
            <td class="d-flex align-items-center"> 
                <button data-id="{{ $data->id_kehadiran }}" class="btn btn-import me-2 delete-kehadiran"><i class="fa fa-trash me-1"></i></button>
            </td>
        </tr>
        @endforeach
    @endif
</tbody>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Gambar Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="User Image">
            </div>
        </div>
    </div>
</div>

<script>
    function showImage(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
    }
</script>

<script>
    document.addEventListener('click', function(event) {
    if (event.target.closest('.delete-kehadiran')) {
        if (confirm('Apakah anda yakin ingin menghapus data kehadiran ?')) {
            const button = event.target.closest('.delete-kehadiran');
            const id = button.getAttribute('data-id');

            fetch(`/kehadiran/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Hapus baris dari tabel
                    document.getElementById(`kehadiran-${id}`).remove();

                    // Cek apakah ada baris yang tersisa di tabel
                    if (document.querySelectorAll('#kehadiran-table-body tr').length === 0) {
                        // Tambahkan baris data kosong
                        const emptyRow = document.createElement('tr');
                        emptyRow.id = 'empty-row';
                        emptyRow.innerHTML = '<td colspan="7" class="text-center">Data kehadiran tidak ditemukan atau kosong</td>';
                        document.getElementById('kehadiran-table-body').appendChild(emptyRow);
                    }
                } else {
                    alert('Gagal menghapus data: ' + data.error);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }
});

</script>
