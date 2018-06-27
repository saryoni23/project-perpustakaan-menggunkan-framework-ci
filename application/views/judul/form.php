<div class="row">
    <div class="col-10 no-margin">
        <h2>Buku</h2>
    </div>
</div>

<?= form_open_multipart($form_action) ?>

    <?= isset($input->id_judul) ? form_hidden('id_judul', $input->id_judul) : '' ?>

    <!-- isbn -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('ISBN', 'isbn', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('isbn', $input->isbn) ?>
        </div>
        <div class="col-4">
            <?= form_error('isbn') ?>
        </div>
    </div>

    <!-- judul_buku -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Judul', 'judul_buku', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('judul_buku', $input->judul_buku) ?>
        </div>
        <div class="col-4">
            <?= form_error('judul_buku') ?>
        </div>
    </div>

    <!-- penulis -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Penulis', 'penulis', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('penulis', $input->penulis) ?>
        </div>
        <div class="col-4">
            <?= form_error('penulis') ?>
        </div>
    </div>

    <!-- penerbit -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Penerbit', 'penerbit', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('penerbit', $input->penerbit) ?>
        </div>
        <div class="col-4">
            <?= form_error('penerbit') ?>
        </div>
    </div>

    <!-- cover -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Cover', 'cover', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_upload('cover') ?>
        </div>
        <div class="col-4">
            <?= fileFormError('cover', '<p class="form-error">', '</p>'); ?>
        </div>
    </div>

    <!-- Gambar cover preview -->
    <?php if (!empty($input->cover)): ?>
        <div class="row form-group">
            <div class="col-2">&nbsp;</div>
            <div class="col-4">
                <img src="<?= site_url("/cover/$input->cover") ?>" alt="<?= $input->judul_buku ?>">
            </div>
            <div class="col-4">&nbsp;</div>
        </div>
    <?php endif ?>

    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Simpan', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
