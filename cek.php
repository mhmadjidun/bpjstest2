<?php
include 'asset.php';

error_reporting(0);

// URL API yang akan diambil datanya
$saldo = urlencode($_GET['norek']);
$url = "https://api.siunbin.com/api/v1/bank/rekening/saldo/$saldo";

// Mengambil data dari API
$response = file_get_contents($url);

// Menerima jika tidak ada data
if ($response === false) {
    echo "<script>alert('Data tidak ada');</script>";
    die();
}

// Mengonversi respons JSON menjadi array asosiatif PHP
$data = json_decode($response, true);

// Memeriksa jika penguraian JSON gagal
if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    die('Error decoding JSON: ' . json_last_error_msg());
}
// Memastikan bahwa data yang diperlukan ada di dalam array
if (!isset($data['data']['norek']) || !isset($data['data']['nama']) || !isset($data['data']['kode_bank']) || !isset($data['data']['nama_bank']) || !isset($data['data']['saldo'])) {
    die('Data tidak lengkap atau tidak ditemukan dalam respons API');
}
$accountData = [
    'norek' => $data['data']['norek'],
    'nama' => $data['data']['nama'],
    'kode_bank' => $data['data']['kode_bank'],
    'nama_bank' => $data['data']['nama_bank'],
    'saldo' => $data['data']['saldo']
];
?>

<body>
    <!-- Modal Notifikasi -->
    <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Saldo Anda Saat Ini</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <th>Nama</th>
                            <th>Nomor Rekening</th>
                            <th>Kode Bank</th>
                            <th>Nama Bank</th>
                            <th>Saldo</th>
                        </tr>
                        <tr>
                            <td><?php echo htmlspecialchars($data['data']['nama']); ?></td>
                            <td><?php echo htmlspecialchars($data['data']['norek']); ?></td>
                            <td><?php echo htmlspecialchars($data['data']['kode_bank']); ?></td>
                            <td><?php echo htmlspecialchars($data['data']['nama_bank']); ?></td>
                            <td><?php echo number_format($data['data']['saldo'], 0, ',', '.'); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->

    <script>
        // Menampilkan modal notifikasi setelah halaman dimuat
        var myModal = new bootstrap.Modal(document.getElementById('notificationModal'), {
            keyboard: false
        });
        myModal.show();

        setTimeout(function() {
            window.location.href = 'index.php';
        }, 5000);
    </script>
</body>


</html>