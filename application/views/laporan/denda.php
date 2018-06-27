<?php $i = 0 ?>

<div class="row">
    <div class="col-10 no-margin">
        <h2>Laporan Denda</h2>
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
        <?php if ($dendas):?>
            <table class="awn-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dendas as $denda): ?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i ?></td>
                        <td><?= $denda->tanggal_pembayaran ?></td>
                        <td><?= $denda->nis ?></td>
                        <td><?= $denda->nama_siswa ?></td>
                        <td>Rp. <?= number_format($denda->jumlah, 0, ',', '.') ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">Jumlah Total: Rp. <?= isset($jumlah_total) ? number_format($jumlah_total, 0, ',', '.') : '' ?></td>
                    </tr>
                </tfoot>
            </table>
        <?php else: ?>
            <p>Tidak ada data denda.</p>
        <?php endif ?>
    </div>
</div>
<?php endif ?>

<?php if ($dendas): ?>
    <div class="row">
        <div class="col-10">
            <?php
                $tanggal_awal = $this->input->post('tanggal_awal', true);
                $tanggal_akhir = $this->input->post('tanggal_akhir', true);
            ?>
            <?= anchor("cetak-laporan-denda/$tanggal_awal/$tanggal_akhir", 'Cetak', ['class' => 'btn btn-success', 'target' => '_blank']) ?>
        </div>
    </div>
<?php endif ?>