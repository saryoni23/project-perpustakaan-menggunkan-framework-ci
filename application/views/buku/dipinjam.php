<?php $i = 0 ?>
<!-- Page heading -->
<div class="row">
    <div class="col-10">
        <h2>Buku (Dipinjam)</h2>
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
                        <th scope="col">Kode Buku</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Peminjam</th>
                        <th scope="col">Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bukus as $buku): ?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i ?></td>
                        <td><?= $buku->kode_buku ?></td>
                        <td><?= $buku->judul_buku ?></td>
                        <td><?= $buku->penulis ?></td>
                        <td><?= $buku->penerbit ?></td>
                        <td><?= $buku->peminjam ?></td>
                        <td><?= $buku->nama_kelas ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada data buku.</p>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <!-- Button create -->
    <div class="col-5">
        <?= anchor("judul", '<< Kembali', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
