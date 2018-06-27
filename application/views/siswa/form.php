<div class="row">
    <div class="col-10 no-margin">
        <h2>Siswa</h2>
    </div>
</div>

<?= form_open($form_action) ?>

    <?= isset($input->id_siswa) ? form_hidden('id_siswa', $input->id_siswa) : '' ?>

    <!-- nis -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('NIS', 'nis', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('nis', $input->nis) ?>
        </div>
        <div class="col-4">
            <?= form_error('nis') ?>
        </div>
    </div>

    <!-- nama_siswa -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Nama', 'nama_siswa', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('nama_siswa', $input->nama_siswa) ?>
        </div>
        <div class="col-4">
            <?= form_error('nama_siswa') ?>
        </div>
    </div>

    <!-- jenis_kelamin -->
    <div class="row form-group">
        <div class="col-2">
            <p class="label">Jenis Kelamin</p>
        </div>
        <div class="col-4">
            <label class="block-label">
                <?= form_radio('jenis_kelamin', 'L',
                    isset($input->jenis_kelamin) && ($input->jenis_kelamin == 'L') ? true : false)
                ?> Laki-laki
            </label>
            <label class="block-label">
                <?= form_radio('jenis_kelamin', 'P',
                    isset($input->jenis_kelamin) && ($input->jenis_kelamin == 'P') ? true : false)
                ?> Perempuan
            </label>
        </div>
        <div class="col-4">
            <?= form_error('jenis_kelamin') ?>
        </div>
    </div>

    <!-- id_kelas -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Kelas', 'id_kelas', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_dropdown('id_kelas', getDropdownList('kelas', ['id_kelas', 'nama_kelas']), $input->id_kelas, 'id="kelas"') ?>
        </div>
        <div class="col-4">
            <?= form_error('id_kelas') ?>
        </div>
    </div>

    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Simpan', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
