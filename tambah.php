<?php
include 'asset.php'
?>

<div class="container mt-5">
    <h2>Tambah Saldo</h2>
    <form method="get" action="tambah_saldo.php">
        <div class="mb-3">
            <label for="norek" class="form-label">Nomor Rekening</label>
            <input type="text" class="form-control" id="norek" name="norek" required>
        </div>
        <div class="mb-3">
            <label for="pin" class="form-label">PIN</label>
            <input type="password" class="form-control" id="pin" name="pin" required>
        </div>
        <div class="mb-3">
            <label for="nominal" class="form-label">Jumlah Saldo</label>
            <input type="number" class="form-control" id="nominal" name="nominal" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Saldo</button>
    </form>
</div>