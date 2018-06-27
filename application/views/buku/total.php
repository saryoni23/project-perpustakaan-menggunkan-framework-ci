<?php
    $i = 0;
    $is_login = $this->session->userdata('is_login');
?>
<!-- Page heading -->
<div class="row">
    <div class="col-10">
        <h2>Semua Buku (Total / Semua)</h2>
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
                        <th scope="col">Status</th>
                        <?php if ($is_login): ?>
                            <th scope="col">Delete</th>
                        <?php endif ?>
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
                        <td><?= $buku->is_ada == 'y' ? 'ada': '<span class="dipinjam">dipinjam</span>' ?></td>
                        <?php if ($is_login): ?>
                            <td>
                                <?= form_open("buku/delete") ?>
                                    <?= form_hidden('id_buku', $buku->id_buku) ?>
                                    <?= form_button(['type' => 'submit', 'content' => 'Delete', 'class' => 'btn-danger', 'onclick' => "return confirm('Anda yakin akan menghapus buku ini?')"]) ?>
                                <?= form_close() ?>
                            </td>
                        <?php endif ?>
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
