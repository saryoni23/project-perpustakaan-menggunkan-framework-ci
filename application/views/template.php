<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Aplikasi Perpustakaan SMP Putih Biru</title>
    <link href="<?= base_url('asset/reset.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('asset/ciperpus.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('asset/jquery-ui-1.11.3/jquery-ui.min.css'); ?>" rel="stylesheet">
</head>
<body id="<?= $halaman ?>">
    <div id="main-wrapper">
        <div id="header">
            <a href="<?= base_url() ?>" title="Home"><h1>Aplikasi Perpustakaan SMP Putih Biru</h1></a>
        </div>
        <div id="sidebar-content-wrapper">
            <div id="sidebar">
                <?php $this->load->view('sidebar') ?>
            </div>
            <div id="content">
                <?php $this->load->view($main_view) ?>
            </div>
        </div>
    </div>
    <div id="footer-wrapper">
        <div id="footer">
            <?php $this->load->view('footer') ?>
        </div>
    </div>
    <script type="text/javascript" src="<?= base_url('asset/jquery-1.11.2.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('asset/jquery-ui-1.11.3/jquery-ui.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('asset/ciperpus.js'); ?>"></script>
</body>
</html>