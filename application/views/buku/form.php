<div class="row">
    <div class="col-10 no-margin">
        <h2>Buku</h2>
    </div>
</div>

<div class="row">
    <div class="col-7 no-padding">
    <div class="col-7"><strong>Anda akan menambahkan buku:</strong></div>
        <div class="col-2">ISBN</div>
        <div class="col-4"><?= $judul->isbn ?></div>
        <div class="col-2">Judul</div>
        <div class="col-4"><?= $judul->judul_buku ?></div>
        <div class="col-2">Penulis</div>
        <div class="col-4"><?= $judul->penulis ?></div>
        <div class="col-2">Penerbit</div>
        <div class="col-4"><?= $judul->penerbit ?></div>
    </div>
    <div class="col-3 cover">
        <?php if (!empty($judul->cover)): ?>
            <img src="<?= site_url("cover/$judul->cover") ?>" alt="<?= $judul->judul_buku ?>">
        <?php else: ?>
            <img src="<?= site_url("cover/no_cover.jpg") ?>" alt="<?= $judul->judul_buku ?>">
        <?php endif?>

    </div>
</div>

<?= form_open($form_action) ?>
    <?= isset($input->id_judul) ? form_hidden('id_judul', $input->id_judul) : '' ?>

    <!-- kode_buku -->
    <div class="row form-group">
        <hr class="hr-row">
        <div class="col-2">
            <?= form_label('Masukkan Kode Buku', 'kode_buku', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('kode_buku', isset($input->kode_buku) ? $input->kode_buku : '') ?>
        </div>
        <div class="col-4">
            <?= form_error('kode_buku') ?>
        </div>
    </div>

    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-1">
            <?= form_button(['type' => 'submit', 'content' => 'Simpan', 'class' => 'btn-primary']) ?>
        </div>
        <div class="col-2">
            <?= anchor("judul", 'Batal', ['class' => 'btn btn-default']) ?>
        </div>
    </div>
 <?= form_close() ?>
