<?php
include 'asset.php'
?>

<div class="container mt-5">
    <h2>Cek Saldo Testing</h2>
    <form method="get" action="cek.php">
        <div class="mb-3">
            <label for="norek" class="form-label">Nomor Rekening</label>
            <input type="text" class="form-control" id="norek" name="norek" required>
        </div>
        <button type="submit" class="btn btn-primary">Cek Saldo</button>
    </form>
</div>