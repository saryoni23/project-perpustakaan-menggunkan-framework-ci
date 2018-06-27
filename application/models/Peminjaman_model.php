<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends MY_Model
{
    protected $perPage = 10;
    protected $maxItem = 2; // Jumlah maksimum buku.


    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'tanggal_pinjam',
                'label' => 'Tanggal_pinjam',
                'rules' => 'trim|required|callback_is_format_tanggal_valid'
            ],
            [   // Fake input, just for live search
                'field' => 'search_siswa',
                'label' => 'Siswa',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'id_siswa',
                'label' => 'ID Siswa',
                'rules' => 'trim|required'
            ],
            [   // Fake input, just for live search
                'field' => 'search_buku',
                'label' => 'Buku',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'id_buku',
                'label' => 'ID Buku',
                'rules' => 'trim|required'
            ],

        ];

        return $validationRules;
    }

    public function getDefaultValues()
    {
        return [
            'tanggal_pinjam' => '',
            'id_siswa'       => '',
            'id_buku'        => '',
            'search_siswa'   => '', // Fake, just for search
            'search_buku'    => '', // Fake, just for search
        ];
    }

    public function ubahStatusBuku($id_buku, $status)
    {
        $this->db->where('id_buku', $id_buku);
        $this->db->update('buku', ['is_ada' => $status]);
    }

    public function getAllPeminjaman($page = null)
    {
        $offset = $this->calculateRealOffset($page);

        $sql = "    SELECT id_pinjam,
                           tanggal_pinjam,
                           nis,
                           nama_siswa,
                           nama_kelas,
                           kode_buku,
                           judul_buku,
                           is_kembali
                      FROM peminjaman
                INNER JOIN siswa
                        ON (peminjaman.id_siswa = siswa.id_siswa)
                INNER JOIN kelas
                        ON (siswa.id_kelas = kelas.id_kelas)
                INNER JOIN buku
                        ON (buku.id_buku = peminjaman.id_buku)
                INNER JOIN judul
                        ON (buku.id_judul = judul.id_judul)
                       AND (peminjaman.id_buku = buku.id_buku)
                  ORDER BY peminjaman.tanggal_pinjam DESC, peminjaman.id_pinjam DESC
                     LIMIT $this->perPage
                    OFFSET $offset   ";
        return $this->db->query($sql)->result();
    }

    public function getAllPeminjamanCount()
    {
        return $this->db->query('SELECT COUNT(peminjaman.id_pinjam) AS jumlah FROM peminjaman')->row();
    }

    public function liveSearchSiswa($keywords)
    {
        return $this->db->select('id_siswa, nis, nama_siswa')
                        ->like('nis', $keywords)
                        ->or_like('nama_siswa', $keywords)
                        ->limit(10)
                        ->get('siswa')
                        ->result();
    }

    public function liveSearchBuku($keywords)
    {
        $sql = "    SELECT id_buku, judul_buku
                      FROM buku
                INNER JOIN judul
                        ON (judul.id_judul = buku.id_judul)
                     WHERE is_ada = 'y'
                       AND judul_buku LIKE '%$keywords%'
                  GROUP BY judul.id_judul #Otomatis pilih satu dari yang is_ada = 'y'
                     LIMIT 10   ";
        return $this->db->query($sql)->result();
    }

    public function cekMaxItem($id_siswa)
    {
        $sql = "SELECT COUNT(id_pinjam) AS jumlah_item
                FROM peminjaman
                WHERE id_siswa = '$id_siswa'
                AND is_kembali = 'n'";
        $item = $this->db->query($sql)->row()->jumlah_item;

        if ($item < $this->maxItem) {
            return true;
        }

        return false;
    }
}
