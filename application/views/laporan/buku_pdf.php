<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Laporan buku</title>
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
<h1>Laporan Buku</h1>

<?php $i = 0 ?>
<table width="600" border="0">
    <thead>
        <tr>
            <th width="30">No</th>
            <th width="80">ISBN</th>
            <th width="240">Judul</th>
            <th width="100">Penulis</th>
            <th width="100">Penerbit</th>
            <th width="50">Jumlah</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($bukus as $buku): ?>
        <?= ($i & 1) ? '<tr class="zebra">' : '<tr>'; ?>
            <td width="30"><?= ++$i ?></td>
            <td width="80"><?= $buku->isbn ?></td>
            <td width="240"><?= $buku->judul_buku ?></td>
            <td width="100"><?= $buku->penulis ?></td>
            <td width="100"><?= $buku->penerbit ?></td>
            <td width="50"><?= $buku->jumlah ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6"><strong>Jumlah Total : <?= $jumlah_total ?></strong></td>
        </tr>
    </tfoot>
</table>

</body>
</html>