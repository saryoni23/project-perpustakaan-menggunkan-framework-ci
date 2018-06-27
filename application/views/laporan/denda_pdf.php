<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Laporan Denda</title>
    <style type="text/css">
        h1 {
            text-align:center;
            font-size:18px;
        }

        table {
            font-size:10px;
            border-collapse: collapse;
        }
		.zebra {
            background-color:#CCCCCC;
        }
        th, td {
            padding: 4px 2px;
        }
        th, tfoot tr td {
            background-color: #999999;
        }
    </style>
</head>

<body>
<h1>Laporan Denda</h1>

<?php $i = 0 ?>
<table width="600" border="0">
    <thead>
        <tr>
            <th width="30">No</th>
            <th width="70">Tanggal</th>
            <th width="70">NIS</th>
            <th width="250">Nama Siswa</th>
            <th width="180">Jumlah</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($dendas as $denda): ?>
        <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
            <td width="30"><?= ++$i ?></td>
            <td width="70"><?= $denda->tanggal_pembayaran ?></td>
            <td width="70"><?= $denda->nis ?></td>
            <td width="250"><?= $denda->nama_siswa ?></td>
            <td width="180"><?= $denda->jumlah ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5"><strong>Jumlah Total : <?= $jumlah_total ?></strong></td>
        </tr>
    </tfoot>
</table>

</body>
</html>