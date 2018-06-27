<?php $i = 0 ?>

<!-- Page heading -->
<div class="row">
    <div class="col-10">
        <h2>Kelas</h2>
    </div>
</div>

<!-- Flash message -->
<?php $this->load->view('_partial/flash_message') ?>

<!-- Table -->
<div class="row">
    <div class="col-6">
        <?php if ($kelass):?>
            <table class="awn-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($kelass as $kelas): ?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i ?></td>
                        <td><?= $kelas->nama_kelas ?></td>
                        <td><?= anchor("kelas/edit/$kelas->id_kelas", 'Edit', ['class' => 'btn btn-warning']) ?></td>
                        <td>
                            <?= form_open("kelas/delete/$kelas->id_kelas") ?>
                                <?= form_hidden('id_kelas', $kelas->id_kelas) ?>
                                <?= form_button(['type' => 'submit', 'content' => 'Delete', 'class' => 'btn-danger']) ?>
                            <?= form_close() ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">Jumlah : <?= isset($jumlah) ? $jumlah : '' ?></td>
                    </tr>
                </tfoot>
            </table>
        <?php else: ?>
            <p>Tidak ada data kelas.</p>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <!-- Button create -->
    <div class="col-10">
        <?= anchor("kelas/create", 'Tambah', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
