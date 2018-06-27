<?php $i = 0 ?>

<div class="row">
    <div class="col-10 no-margin">
        <h2>Pengembalian</h2>
    </div>
</div>

<!-- Flash message -->
<?php $this->load->view('_partial/flash_message') ?>

<?= form_open($form_action) ?>
    <!-- NIS / Nama siswa -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('NIS / Nama Siswa', 'keywords', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('keywords', $input->keywords, ['placeholder' => 'Masukkan NIS atau Nama Siswa']) ?>
        </div>
        <div class="col-4">
            <?= form_button(['type' => 'submit', 'content' => 'Cari', 'class' => 'btn-primary']) ?>
        </div>
    </div>
 <?= form_close() ?>

<!-- Tampilkan tabel hanya jika bukan first load -->
<?php if (!$first_load): ?>
    <!-- Table -->
    <div class="row">
        <div class="col-10">
            <?php if ($peminjaman):?>
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Denda</th>
                            <th scope="col">Kembalikan</th>
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
                            <td><?= $pinjam->judul_buku ?></td>
                            <td>Rp. <?= number_format($pinjam->denda, 0, ',', '.') ?></td>
                            <td>
                                <?= form_open("pengembalian/kembalikan") ?>
                                    <?= form_hidden('id_pinjam', $pinjam->id_pinjam) ?>
                                    <?= form_hidden('denda', $pinjam->denda) ?>
                                    <?= form_button(['type' => 'submit', 'content' => 'Kembalikan', 'class' => 'btn-warning', 'onclick' => "return confirm('Anda yakin akan mengembalikan buku?')"]) ?>
                                <?= form_close() ?>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Data peminjaman untuk siswa tersebut tidak ada, atau buku yang dipinjam sudah dikembalikan.</p>
            <?php endif ?>
        </div>
    </div>
<?php endif ?>