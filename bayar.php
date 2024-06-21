<?php
include 'asset.php'
?>

<div class="container mt-5">
    <h2>Bayar Tagihan</h2>
    <form method="get" id="form_bayar" action="konfirmasi_bayar.php">
        <div class="mb-3">
            <label for="norek" class="form-label">Nomor Rekening</label>
            <input type="text" class="form-control" id="norek" name="norek" required>
        </div>
        <div class="mb-3">
            <label for="pin" class="form-label">PIN</label>
            <input type="password" class="form-control" id="pin" name="pin" required>
        </div>
        <div class="mb-3">
            <label for="bayar" class="form-label">Jumlah Bayar</label>
            <input type="number" class="form-control" id="bayar" name="bayar" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
        </div>
        <button type="submit" class="btn btn-primary">Bayar</button>
    </form>
</div>