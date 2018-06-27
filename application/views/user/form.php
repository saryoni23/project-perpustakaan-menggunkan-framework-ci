<div class="row">
    <div class="col-10 no-margin">
        <h2>User</h2>
    </div>
</div>

<?= form_open($form_action) ?>

    <?= isset($input->id_user) ? form_hidden('id_user', $input->id_user) : '' ?>

    <!-- nama_user -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Nama User', 'nama_user', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('nama_user', $input->nama_user) ?>
        </div>
        <div class="col-4">
            <?= form_error('nama_user') ?>
        </div>
    </div>

    <!-- username -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Username', 'username', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_input('username', $input->username) ?>
        </div>
        <div class="col-4">
            <?= form_error('username') ?>
        </div>
    </div>

    <!-- password -->
    <div class="row form-group">
        <div class="col-2">
            <?= form_label('Password', 'password', ['class' => 'label']) ?>
        </div>
        <div class="col-4">
            <?= form_password('password') ?>
        </div>
        <div class="col-4">
            <?= form_error('password') ?>
        </div>
    </div>

    <!-- level -->
    <div class="row form-group">
        <div class="col-2">
            <p class="label">Level</p>
        </div>
        <div class="col-4">
            <label class="block-label">
                <?= form_radio('level', 'operator',
                    isset($input->level) && ($input->level == 'operator') ? true : false)
                ?> Operator
            </label>
            <label class="block-label">
                <?= form_radio('level', 'admin',
                    isset($input->level) && ($input->level == 'admin') ? true : false)
                ?> Administrator
            </label>
        </div>
        <div class="col-4">
            <?= form_error('level') ?>
        </div>
    </div>

    <!-- is_blokir -->
    <div class="row form-group">
        <div class="col-2">
            <p class="label">Blokir?</p>
        </div>
        <div class="col-4">
            <label class="block-label">
                <?= form_radio('is_blokir', 'y',
                    isset($input->is_blokir) && ($input->is_blokir == 'y') ? true : false)
                ?> Ya
            </label>
            <label class="block-label">
                <?= form_radio('is_blokir', 'n',
                    isset($input->is_blokir) && ($input->is_blokir == 'n') ? true : false)
                ?> Tidak
            </label>
        </div>
        <div class="col-4">
            <?= form_error('is_blokir') ?>
        </div>
    </div>

    <!-- submit button -->
    <div class="row">
        <div class="col-2">&nbsp;</div>
        <div class="col-8"><?= form_button(['type' => 'submit', 'content' => 'Simpan', 'class' => 'btn-primary']) ?></div>
    </div>
 <?= form_close() ?>
