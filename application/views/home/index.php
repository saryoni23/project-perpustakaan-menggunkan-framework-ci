<div class="row">
    <div class="col-10">
        <h2>Home</h2>
    </div>
</div>

<?php
    $is_login = $this->session->userdata('is_login');
    $username = $this->session->userdata('username');
?>

<?php if ($is_login): ?>
    <div class="row">
        <div class="col-10">
        <p>Halo, <strong><?= $username ?></strong>!</p>
            <p>Selamat Bekerja.</p>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-10">
            <p>Selamat datang di perpustakaan SMP Putih Biru!</p>
            <p>Untuk melihat katalog buku, gunakan menu <strong>"Buku"</strong>.</p>
        </div>
    </div>
<?php endif ?>