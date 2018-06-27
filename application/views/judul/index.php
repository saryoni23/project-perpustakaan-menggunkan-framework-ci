<?php
    // Login?
    $is_login = $this->session->userdata('is_login');

    $perPage = 5;
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
        <h2>Buku</h2>
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
    <?= form_open('judul/search', ['method' => 'GET']) ?>
        <?= form_label('Cari', 'kata_kunci') ?>
        <?= form_input('keywords', $this->input->get('keywords'), ['placeholder' => 'Judul, ISBN, Penulis', 'class' => 'col-3']) ?>
        <?= form_button(['type' => 'submit', 'content' => 'Cari', 'class' => 'btn-primary']) ?>
    <?= form_close() ?>
    </div>
</div>

<!-- Judul Buku -->
<?php if ($juduls): ?>
    <?php foreach($juduls as $judul): ?>
        <div class="row judul">
            <hr class="hr-row">
            <div class="col-7">
                <dl>
                    <dt>ISBN</dt>
                    <dd><?= $judul->isbn ?></dd>
                    <dt>Judul</dt>
                    <dd><?= $judul->judul_buku ?></dd>
                    <dt>Penulis</dt>
                    <dd><?= $judul->penulis ?></dd>
                    <dt>Penerbit</dt>
                    <dd><?= $judul->penerbit ?></dd>
                    <dt>Jumlah Copy</dt>
                    <dd>
                        Total:      <?= $judul->jumlah_total != 0 ? anchor("buku/total/$judul->id_judul", $judul->jumlah_total) : $judul->jumlah_total ?> &nbsp;&nbsp;&nbsp;&nbsp;
                        Ada:        <?= $judul->jumlah_ada != 0 ? anchor("buku/ada/$judul->id_judul", $judul->jumlah_ada) : $judul->jumlah_ada ?> &nbsp;&nbsp;&nbsp;&nbsp;
                        Dipinjam:   <?= $judul->jumlah_dipinjam != 0 ? anchor("buku/dipinjam/$judul->id_judul", $judul->jumlah_dipinjam) : $judul->jumlah_dipinjam ?>
                    </dd>
                </dl>
            </div>
            <div class="col-3 cover">
                <?php if (!empty($judul->cover)): ?>
                    <img src="<?= site_url("cover/$judul->cover") ?>" alt="<?= $judul->judul_buku ?>">
                <?php else: ?>
                    <img src="<?= site_url("cover/no_cover.jpg") ?>" alt="<?= $judul->judul_buku ?>">
                <?php endif?>

            </div>
        </div>

        <?php if ($is_login): ?>
        <div class="row">
            <div class="col-2">
                <?= form_open("buku/create") ?>
                    <?= form_hidden('id_judul', $judul->id_judul) ?>
                    <?= form_hidden('first_load', true) ?>
                    <?= form_button(['type' => 'submit', 'content' => 'Tambah Buku', 'class' => 'btn-success']) ?>
                <?= form_close() ?>
            </div>
            <div class="col-2">
                <?= anchor("judul/edit/$judul->id_judul", 'Edit Judul', ['class' => 'btn btn-warning']) ?>
            </div>
            <div class="col-6">
                <?= form_open("judul/delete/$judul->id_judul") ?>
                    <?= form_hidden('id_judul', $judul->id_judul) ?>
                    <?= form_button(['type' => 'submit', 'content' => 'Delete Judul', 'class' => 'btn-danger']) ?>
                <?= form_close() ?>
            </div>
        </div>
        <?php endif ?>
    <?php endforeach ?>
<?php else: ?>
    <div class="row">
        <div class="col-10">
            <p>Tidak ada data judul buku.</p>
        </div>
    </div>
<?php endif ?>

<div class="row">
    <hr class="hr-row">
    <div class="col-10">
        <?= "Jumlah judul: $jumlah " ?>
    </div>
</div>

<div class="row">
    <!-- Button create -->
    <div class="col-5">
        <?php if ($is_login): ?>
        <?= anchor("judul/create", 'Tambah Judul', ['class' => 'btn btn-primary']) ?>
        <?php else: ?>
            &nbsp;
        <?php endif ?>
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
