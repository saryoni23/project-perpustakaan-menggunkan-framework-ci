<?php $i = 0 ?>

<!-- Page heading -->
<div class="row">
    <div class="col-10">
        <h2>User</h2>
    </div>
</div>

<!-- Flash message -->
<?php $this->load->view('_partial/flash_message') ?>

<!-- Table -->
<div class="row">
    <div class="col-10">
        <?php if ($users):?>
            <table class="awn-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Level</th>
                        <th scope="col">Diblokir?</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                    <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
                        <td><?= ++$i ?></td>
                        <td><?= $user->nama_user ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= $user->level ?></td>
                        <td><?= $user->is_blokir == 'n' ? 'Tidak' : 'Ya' ?></td>
                        <td><?= anchor("user/edit/$user->id_user", 'Edit', ['class' => 'btn btn-warning']) ?></td>
                        <td>
                            <?= form_open("user/delete/$user->id_user") ?>
                                <?= form_hidden('id_user', $user->id_user) ?>
                                <?= form_button(['type' => 'submit', 'content' => 'Delete', 'class' => 'btn-danger']) ?>
                            <?= form_close() ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada data user.</p>
        <?php endif ?>
    </div>
</div>

<div class="row">
    <!-- Button create -->
    <div class="col-10">
        <?= anchor("user/create", 'Tambah', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
