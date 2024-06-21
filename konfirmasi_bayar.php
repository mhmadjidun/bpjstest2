<?php
include 'asset.php';
// Ambil data dari form
$norek = urlencode($_GET['norek']);
$pin = urlencode($_GET['pin']);
$nominal = urlencode($_GET['bayar']);
$keterangan = urlencode($_GET['keterangan']);
$tujuan = '10014123456';

// URL API untuk memeriksa saldo
$url = "https://api.siunbin.com/api/v1/bank/rekening/saldo/$norek";

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

// Memeriksa saldo
if ($data['data']['saldo'] >= $nominal) {
    // Saldo cukup, redirect ke proses pembayaran
    header("Location: proses_bayar.php?norek=$norek&pin=$pin&norek_tujuan=$tujuan&bayar=$nominal&keterangan=$keterangan");
    exit();
} else {
    // Saldo tidak cukup, tampilkan notifikasi
    $message = 'Saldo tidak cukup untuk melakukan pembayaran.';
}
?>

<body>
    <!-- Modal Notifikasi -->
    <div class="modal show" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Notifikasi</h5>
                    <a href="pembayaran.php" class="btn-close" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <?php echo htmlspecialchars($message); ?>
                    <br> Silahkan <a href="tambah.php">Isi Saldo</a> terlebih dahulu.
                </div>
                <div class="modal-footer">
                    <a href="bayar.php" class="btn btn-secondary">Tutup</a>
                </div>
            </div>
        </div>
    </div>
</body>