<?php
include 'asset.php';
// Pastikan parameter 'norek' dan 'jumlah' ada di URL
if (!isset($_GET['norek']) || !isset($_GET['bayar'])) {
    die('Nomor rekening atau jumlah saldo tidak tersedia.');
}

// Ambil nilai dari parameter GET
$norek = urlencode($_GET['norek']);
$pin = urlencode($_GET['pin']);
$nominal = urlencode($_GET['bayar']);
$keterangan = urlencode($_GET['keterangan']);


// URL API untuk menambah saldo
$url = "https://api.siunbin.com/api/v1/bank/transaksi/proses/$norek/$pin/10014123456/$nominal/$keterangan";

// Mengambil data dari API
$response = file_get_contents($url);

// Memeriksa jika ada respons yang diterima
if ($response === false) {
    die('Error fetching data from API');
}

// Mengonversi respons JSON menjadi array asosiatif PHP
$data = json_decode($response, true);
// Memeriksa jika penguraian JSON gagal
if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    die('Error decoding JSON: ' . json_last_error_msg());
}

// Menampilkan hasil dari API
// Memeriksa jika operasi berhasil dan menampilkan pesan yang sesuai
$result = isset($data['response']) && $data['response'] === 'Success' ? 'success' : 'error';
$message = $result === 'success' ? 'TAGIHAN BERHASIL DIBAYAR.' : 'Gagal menambah saldo: ' . (isset($data['message']) ? $data['message'] : 'Kesalahan tidak diketahui.');

// Redirect ke halaman hasil

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Bayar</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Modal Notifikasi -->
    <div class="modal fade" id="modalBayar" tabindex="-1" aria-labelledby="modalBayarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBayarLabel">Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo htmlspecialchars($message); ?>
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
        var myModal = new bootstrap.Modal(document.getElementById('modalBayar'), {
            keyboard: false
        });
        myModal.show();

        setTimeout(function() {
            window.location.href = 'index.php';
        }, 2000);
    </script>
</body>