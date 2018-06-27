<?php $i = 0 ?>

<div class="row">
    <div class="col-10 no-margin">
        <h2>Laporan Pengembalian</h2>
    </div>
</div>

<?= form_open($form_action) ?>
    <!--  -->
    <div class="row form-group">
        <div class="col-2 align-right">
            <?= form_label('Tanggal Awal', 'tanggal_awal', ['class' => 'label']) ?>
        </div>
        <div class="col-2">
            <?= form_input('tanggal_awal', $input->tanggal_awal, ['placeholder' => 'Tanggal Awal', 'class' => 'tanggal']) ?>
        </div>
        <div class="col-2 align-right">
            <?= form_label('Tanggal Akhir', 'tanggal_akhir', ['class' => 'label']) ?>
        </div>
        <div class="col-2">
            <?= form_input('tanggal_akhir', $input->tanggal_akhir, ['placeholder' => 'Tanggal Akhir', 'class' => 'tanggal']) ?>
        </div>
        <div class="col-2">
            <?= form_button(['type' => 'submit', 'content' => 'Cari', 'class' => 'btn-primary']) ?>
        </div>
    </div>
 <?= form_close() ?>

<!-- Flash message -->
<?php $this->load->view('_partial/flash_message') ?>

<?php if (!$first_load): ?>
<!-- Table -->
<div class="row">
    <div class="col-10">
        <?php if ($pengembalians):?>
            <table class="awn-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tgl. Kembali</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kode Buku</th>
                        <th scope="col">Judul Buku</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pengembalians as $kembali): ?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i ?></td>
                        <td><?= $kembali->tanggal_kembali ?></td>
                        <td><?= $kembali->nis ?></td>
                        <td><?= $kembali->nama_siswa ?></td>
                        <td><?= $kembali->kode_buku ?></td>
                        <td><?= $kembali->judul_buku ?></td>
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
            <p>Tidak ada data pengembalian.</p>
        <?php endif ?>
    </div>
</div>
<?php endif ?>

<?php if ($pengembalians): ?>
    <div class="row">
        <div class="col-10">
            <?php
                $tanggal_awal = $this->input->post('tanggal_awal', true);
                $tanggal_akhir = $this->input->post('tanggal_akhir', true);
            ?>
            <?= anchor("cetak-laporan-pengembalian/$tanggal_awal/$tanggal_akhir", 'Cetak', ['class' => 'btn btn-success', 'target' => '_blank']) ?>
        </div>
    </div>
<?php endif ?>