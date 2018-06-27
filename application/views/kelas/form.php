<div class="row">
    <div class="col-10 no-margin">
        <h2>Kelas</h2>
    </div>
</div>

<?= form_open($form_action) ?>

    <?= isset($input->id_kelas) ? form_hidden('id_kelas', $input->id_kelas) : '' ?>

    <!-- nama_kelas -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Nama Kelas', 'nama_kelas', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('nama_kelas', $input->nama_kelas) ?>
        </div>
        <div class="col-4">
            <?= form_error('nama_kelas') ?>
        </div>
    </div>

    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Simpan', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
