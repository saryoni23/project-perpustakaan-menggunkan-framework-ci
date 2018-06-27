<?php $i = 0 ?>

<div class="row">
    <div class="col-10 no-margin">
        <h2>Laporan Buku</h2>
    </div>
</div>

<!-- Flash message -->
<?php $this->load->view('_partial/flash_message') ?>

<!-- Table -->
<div class="row">
    <div class="col-10">
        <?php if ($bukus):?>
            <table>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ISBN</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bukus as $buku): ?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i ?></td>
                        <td><?= $buku->isbn ?></td>
                        <td><?= $buku->judul_buku ?></td>
                        <td><?= $buku->penulis ?></td>
                        <td><?= $buku->penerbit ?></td>
                        <td><?= $buku->jumlah ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">Jumlah Total: <?= isset($jumlah_total) ? $jumlah_total : '' ?></td>
                    </tr>
                </tfoot>
            </table>
        <?php else: ?>
            <p>Tidak ada data buku.</p>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <div class="col-10">
        <?= anchor("cetak-laporan-buku", 'Cetak', ['class' => 'btn btn-success', 'target' => '_blank']) ?>
    </div>
</div>
