<?php
    $perPage = 10;
    $keywords = $this->input->get('keywords');

    if (isset($keywords)) {
        $page = $this->uri->segment(3);
    } else {
        $page = $this->uri->segment(2);
    }

    // No urut data tabel.
    $i = isset($page) ? $page * $perPage - $perPage : 0;
?>

<!-- Page heading -->
<div class="row">
    <div class="col-10">
        <h2>Siswa</h2>
    </div>
</div>

<!-- Flash message -->
<?php $this->load->view('_partial/flash_message') ?>

<!--Searh form -->
<div class="row">
    <div class="col-5">
        &nbsp;
    </div>
    <div class="col-5 align-right">
    <?= form_open('siswa/search', ['method' => 'GET']) ?>
        <?= form_label('Cari', 'kata_kunci') ?>
        <?= form_input('keywords', $this->input->get('keywords'), ['placeholder' => 'Masukkan NIS atau Nama', 'class' => 'col-3']) ?>
        <?= form_button(['type' => 'submit', 'content' => 'Cari', 'class' => 'btn-default']) ?>
    <?= form_close() ?>
    </div>
</div>

<!-- Table -->
<div class="row">
    <div class="col-10">
        <?php if ($siswas):?>
            <table class="awn-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($siswas as $siswa): ?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i ?></td>
                        <td><?= $siswa->nis ?></td>
                        <td><?= $siswa->nama_siswa ?></td>
                        <td><?= $siswa->nama_kelas ?></td>
                        <td><?= anchor("siswa/edit/$siswa->id_siswa", 'Edit', ['class' => 'btn btn-warning']) ?></td>
                        <td>
                            <?= form_open("siswa/delete/$siswa->id_siswa") ?>
                                <?= form_hidden('id_siswa', $siswa->id_siswa) ?>
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
            <p>Tidak ada data siswa.</p>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <!-- Button create -->
    <div class="col-5">
        <?= anchor("siswa/create", 'Tambah', ['class' => 'btn btn-primary']) ?>
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
