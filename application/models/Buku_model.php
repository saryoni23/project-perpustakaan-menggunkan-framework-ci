<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends MY_Model
{
    protected $table = 'buku';

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'kode_buku',
                'label' => 'Kode Buku',
                'rules' => "trim|required|min_length[1]|max_length[10]|callback_alpha_numeric_coma_dash_dot_space|callback_kode_buku_unik"
            ]
        ];

        return $validationRules;
    }

    public function getDefaultValues()
    {
        return [
            'kode_buku'   => ''
        ];
    }

    public function total($id_judul)
    {
        $sql = "    SELECT id_buku,
                           kode_buku,
                           judul_buku,
                           penulis,
                           penerbit,
                           is_ada
                      FROM buku
                INNER JOIN judul
                        ON (judul.id_judul = buku.id_judul)
                     WHERE buku.id_judul = $id_judul ";

        return $this->db->query($sql)->result();
    }

    public function ada($id_judul)
    {
        $sql = "    SELECT id_buku,
                           kode_buku,
                           judul_buku,
                           penulis,
                           penerbit
                      FROM buku
                INNER JOIN judul
                        ON (judul.id_judul = buku.id_judul)
                     WHERE buku.id_judul = $id_judul
                       AND is_ada = 'y'  ";

        return $this->db->query($sql)->result();
    }

    public function dipinjam($id_judul)
    {
        $sql = "    SELECT buku.id_buku,
                           kode_buku,
                           judul_buku,
                           penulis,
                           penerbit,
                           nama_siswa AS peminjam,
                           nama_kelas
                      FROM buku
                INNER JOIN judul
                        ON (judul.id_judul = buku.id_judul)
                INNER JOIN peminjaman
                        ON (peminjaman.id_buku = buku.id_buku)
                INNER JOIN siswa
                        ON (siswa.id_siswa = peminjaman.id_siswa)
                INNER JOIN kelas
                        ON (kelas.id_kelas = siswa.id_kelas)
                     WHERE buku.id_judul = $id_judul
                       AND is_ada = 'n'
                       AND peminjaman.is_kembali = 'n'   ";

        return $this->db->query($sql)->result();
    }
}
