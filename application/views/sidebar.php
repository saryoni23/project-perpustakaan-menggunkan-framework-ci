<?php
    $is_login = $this->session->userdata('is_login');
    $level    = $this->session->userdata('level');
?>

<?php if ($is_login): ?>
    <div class="row">
        <div class="col-2">
            <h3>Menu</h3>
            <div class="sidebar-box">
                <ul>
                    <li id="menu-home"><?= anchor(base_url(), 'Home') ?></li>
                    <li id="menu-logout"><?= anchor('logout', 'Logout') ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-2">
            <h3>Master</h3>
            <div class="sidebar-box">
                <ul>
                    <li id="menu-kelas"><?= anchor('kelas', 'Kelas') ?></li>
                    <li id="menu-siswa"><?= anchor('siswa', 'Siswa') ?></li>
                    <li id="menu-buku"><?= anchor('judul', 'Buku') ?></li>
                    <?php if ($level === 'admin'): ?>
                        <li id="menu-user"><?= anchor('user', 'User') ?></li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-2">
            <h3>Transaksi</h3>
            <div class="sidebar-box">
                <ul>
                    <li id="menu-peminjaman"><?= anchor('peminjaman', 'Peminjaman');?></li>
                    <li id="menu-pengembalian"><?= anchor('pengembalian', 'Pengembalian'); ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-2">
            <h3>Laporan</h3>
            <div class="sidebar-box">
                <ul>
                    <li id="menu-lap-buku"><?= anchor('laporan-buku', 'Buku'); ?></li>
                    <li id="menu-lap-peminjaman"><?= anchor('laporan-peminjaman', 'Peminjaman'); ?></li>
                    <li id="menu-lap-pengembalian"><?= anchor('laporan-pengembalian', 'Pengembalian'); ?></li>
                    <li id="menu-lap-denda"><?= anchor('laporan-denda', 'Denda'); ?></li>
                </ul>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-2">
            <h3>Menu</h3>
            <div class="sidebar-box">
                <ul>
                    <li id="menu-home"><?= anchor(base_url(), 'Home') ?></li>
                    <li id="menu-buku"><?= anchor('judul', 'Buku') ?></li>
                </ul>
            </div>
        </div>
    </div>
<?php endif ?>