<?php
    $perPage = 10;
    $page = $this->uri->segment(2);

    // No urut data tabel.
    $i = isset($page) ? $page * $perPage - $perPage : 0;
?>

<!-- Page heading -->
<div class="row">
    <div class="col-10">
        <h2>Peminjaman</h2>
    </div>
</div>

<!-- Flash message -->
<?php $this->load->view('_partial/flash_message') ?>

<!-- Table -->
<div class="row">
    <div class="col-10">
        <?php if ($peminjaman):?>
            <table class="awn-table">
                <thead>
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Kode Buku</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Kembali ?</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($peminjaman as $pinjam): ?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <?php ++$i ?>
                        <td><?= $pinjam->tanggal_pinjam ?></td>
                        <td><?= $pinjam->nis ?></td>
                        <td><?= $pinjam->nama_siswa ?></td>
                        <td><?= $pinjam->nama_kelas ?></td>
                        <td><?= $pinjam->kode_buku ?></td>
                        <td><?= $pinjam->judul_buku ?></td>
                        <td><?= $pinjam->is_kembali == 'n' ? '<span class="dipinjam">Belum</span>' : 'Sudah' ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">Jumlah : <?= isset($jumlah) ? $jumlah : '' ?></td>
                    </tr>
                </tfoot>
            </table>
        <?php else: ?>
            <p>Tidak ada data peminjaman.</p>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <!-- Button create -->
    <div class="col-5">
        <?= anchor("peminjaman/create", 'Tambah', ['class' => 'btn btn-primary']) ?>
    </div>

    <!-- Pagination -->
    <div class="col-5">
    <?php if ($pagination): ?>
        <div id="pagination"  class="float-right">
            <?= $pagination ?>
        </div>
    <?php else: ?>
        &nbsp;
    <?php endif ?>
    </div>
</div>
