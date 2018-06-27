<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian_model extends MY_Model
{
    protected $table        = 'peminjaman';
    protected $maxLama      = 7;    // Lama maksimum peminjaman.
    protected $dendaPerHari = 1000; // Denda perhari.

    public function search($keywords)
    {
        $currentDate = (string) date('Y-m-d');

        $sql = "SELECT      id_pinjam,
                            tanggal_pinjam,
                            nis,
                            nama_siswa,
                            nama_kelas,
                            kode_buku,
                            judul_buku,
                            IF (
                                DATEDIFF('$currentDate', tanggal_pinjam) > $this->maxLama,
                                (DATEDIFF('$currentDate', tanggal_pinjam) - $this->maxLama) * $this->dendaPerHari,
                                0
                            ) AS denda
                FROM        peminjaman
                INNER JOIN  siswa
                ON          (peminjaman.id_siswa = siswa.id_siswa)
                INNER JOIN  kelas
                ON          (siswa.id_kelas = kelas.id_kelas)
                INNER JOIN  buku
                ON          (buku.id_buku = peminjaman.id_buku)
                INNER JOIN  judul
                ON          (buku.id_judul = judul.id_judul)
                AND         (peminjaman.id_buku = buku.id_buku)
                WHERE       (siswa.nis = '$keywords' OR siswa.nama_siswa LIKE '%$keywords%')
                AND         (is_kembali = 'n')";

        return $this->db->query($sql)->result();
    }

    public function kembalikan($id_pinjam, $denda)
    {
        // Insert denda.
        if ((int) $denda > 0) {
            $this->db->insert('denda', [
                'id_pinjam'          => $id_pinjam,
                'jumlah'             => $denda,
                'tanggal_pembayaran' => date('Y-m-d'),
                'is_dibayar'         => 'y'
            ]);
        }

        // Set pengembalian.
        $data = [
            'is_kembali'      => 'y',
            'tanggal_kembali' => date('Y-m-d')
        ];
        return $this->db->where('id_pinjam', $id_pinjam)->update($this->table, $data);
    }

    public function ubahStatusBuku($id_buku)
    {
        return $this->db->where('id_buku', $id_buku)
                        ->update('buku', ['is_ada' => 'y']);
    }
}
