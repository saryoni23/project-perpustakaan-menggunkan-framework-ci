<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends MY_Model
{
    public function laporanBuku()
    {
        $sql = "SELECT  judul.id_judul,
                        judul.judul_buku,
                        judul.isbn,
                        judul.penulis,
                        judul.penerbit,
                        judul.cover,
                        IFNULL((SELECT COUNT(buku.id_buku)
                                FROM buku
                                WHERE buku.id_judul = judul.id_judul
                                GROUP BY buku.id_judul), 0) AS jumlah
                   FROM judul
               GROUP BY judul.id_judul
               ORDER BY judul.judul_buku";

        return $this->db->query($sql)->result();
    }

    public function laporanPeminjaman($tanggal_awal, $tanggal_akhir)
    {
        $sql = "   SELECT peminjaman.tanggal_pinjam,
                          siswa.nis,
                          siswa.nama_siswa,
                          buku.kode_buku,
                          judul.judul_buku,
                          peminjaman.id_pinjam
                     FROM peminjaman
               INNER JOIN buku
                       ON (peminjaman.id_buku = buku.id_buku)
               INNER JOIN judul
                       ON (buku.id_judul = judul.id_judul)
               INNER JOIN siswa
                       ON (peminjaman.id_siswa = siswa.id_siswa)
                    WHERE (peminjaman.tanggal_pinjam BETWEEN '$tanggal_awal' AND '$tanggal_akhir')
                 ORDER BY peminjaman.id_pinjam ASC";

        return $this->db->query($sql)->result();
    }

    public function laporanPengembalian($tanggal_awal, $tanggal_akhir)
    {
      $sql = "   SELECT peminjaman.tanggal_kembali,
                        siswa.nis,
                        siswa.nama_siswa,
                        buku.kode_buku,
                        judul.judul_buku,
                        peminjaman.id_pinjam
                   FROM peminjaman
             INNER JOIN buku
                     ON (peminjaman.id_buku = buku.id_buku)
             INNER JOIN judul
                     ON (buku.id_judul = judul.id_judul)
             INNER JOIN siswa
                     ON (peminjaman.id_siswa = siswa.id_siswa)
                  WHERE (peminjaman.tanggal_kembali BETWEEN '$tanggal_awal' AND '$tanggal_akhir')
                    AND peminjaman.is_kembali = 'y'
               ORDER BY peminjaman.id_pinjam ASC";

      return $this->db->query($sql)->result();
    }

    public function laporanDenda($tanggal_awal, $tanggal_akhir)
    {
        $sql = " SELECT nis,
                        nama_siswa,
                        jumlah,
                        tanggal_pembayaran
                   FROM siswa
             INNER JOIN peminjaman
                     ON (peminjaman.id_siswa = siswa.id_siswa)
             INNER JOIN denda
                     ON (denda.id_pinjam = peminjaman.id_pinjam)
                  WHERE denda.tanggal_pembayaran BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                    AND denda.is_dibayar = 'y'
               ORDER BY denda.id_pinjam ASC  ";

        return $this->db->query($sql)->result();
    }

    public function laporanDendaTotal($tanggal_awal, $tanggal_akhir)
    {
        $sql = "   SELECT SUM(jumlah) AS jumlah_total
                     FROM denda
                    WHERE denda.tanggal_pembayaran BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                      AND is_dibayar = 'y' ";
        return $this->db->query($sql)->row();
    }
}
