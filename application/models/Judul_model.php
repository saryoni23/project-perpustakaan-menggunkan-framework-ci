<?php defined('BASEPATH') or exit('No direct script access allowed');

class Judul_model extends MY_Model
{
    protected $perPage = 5;

    public function getValidationRules()
    {
        $validationRules = [
            [
                'field' => 'isbn',
                'label' => 'ISBN',
                'rules' => 'trim|required|min_length[10]|numeric|callback_isbn_unik'
            ],
            [
                'field' => 'judul_buku',
                'label' => 'Judul Buku',
                'rules' => 'trim|required|max_length[255]'
            ],
            [
                'field' => 'penulis',
                'label' => 'Penulis',
                'rules' => 'trim|required|max_length[255]'
            ],
            [
                'field' => 'penerbit',
                'label' => 'Penerbit',
                'rules' => 'trim|required|max_length[255]'
            ],
        ];

        return $validationRules;
    }

    public function getDefaultValues()
    {
        return [
            'isbn'       => '',
            'judul_buku' => '',
            'penulis'    => '',
            'penerbit'   => ''
        ];
    }

    public function getAllJudul($page = null)
    {
        $offset = $this->calculateRealOffset($page);

        $sql = "SELECT judul.id_judul,
                       judul.judul_buku,
                       judul.isbn,
                       judul.penulis,
                       judul.penerbit,
                       judul.cover,
                       /* ----------- jumlah total ------------*/
                       IFNULL((SELECT COUNT(buku.id_buku)
                       FROM buku
                       WHERE buku.id_judul = judul.id_judul
                       GROUP BY buku.id_judul), 0) AS jumlah_total,

                       /* ----------- jumlah ada ------------*/
                       IFNULL((SELECT COUNT(buku.id_buku)
                       FROM buku
                       WHERE buku.id_judul = judul.id_judul
                       AND buku.is_ada = 'y'
                       GROUP BY buku.id_judul), 0) AS jumlah_ada,

                       /* ----------- jumlah keluar ------------*/
                       IFNULL((SELECT COUNT(buku.id_buku)
                       FROM buku
                       WHERE buku.id_judul = judul.id_judul
                       AND buku.is_ada = 'n'
                       GROUP BY buku.id_judul), 0) AS jumlah_dipinjam

                FROM judul
                GROUP BY judul.id_judul
                ORDER BY judul.id_judul DESC
                LIMIT $this->perPage
                OFFSET $offset";

        return $this->db->query($sql)->result();
    }

    public function getAllJudulCount()
    {
        $sql = "SELECT COUNT(judul.id_judul) AS jumlah FROM judul";
        return $this->db->query($sql)->row();
    }

    public function uploadCover($fieldname, $filename)
    {
        $config = [
            'upload_path'      => './cover/',
            'file_name'        => $filename,
            'allowed_types'    => 'jpg',    // Hanya *.jpg saja
            'max_size'         => 1024,     // 1MB
            'max_width'        => 0,
            'max_height'       => 0,
            'overwrite'        => true,
            'file_ext_tolower' => true,
        ];

        $this->load->library('upload', $config);
        if ($this->upload->do_upload($fieldname)) {
            // Upload OK, return uploaded file info.
            return $this->upload->data();
        } else {
            // Add error to $_error_array
            $this->form_validation->add_to_error_array($fieldname, $this->upload->display_errors('', ''));
            return false;
        }
    }


    public function coverResize($fieldname, $source_path, $width, $height)
    {
        $config = [
            'image_library'  => 'gd2',
            'source_image'   => $source_path,
            'maintain_ratio' => true,
            'width'          => $width,
            'height'         => $height,
        ];

        $this->load->library('image_lib', $config);

        if ($this->image_lib->resize()) {
            return true;
        } else {
            $this->form_validation->add_to_error_array($fieldname, $this->image_lib->display_errors('', ''));
            return false;
        }
    }

    public function deleteCover($imgFile)
    {
        if (file_exists("./cover/$imgFile")) {
            unlink("./cover/$imgFile");
        }
    }

    public function searchJudul($keywords, $page = null)
    {
        $offset = $this->calculateRealOffset($page);

        $sql = "SELECT judul.id_judul,
                       judul.judul_buku,
                       judul.isbn,
                       judul.penulis,
                       judul.penerbit,
                       judul.cover,
                       /* ----------- jumlah total ------------*/
                       IFNULL((SELECT COUNT(buku.id_buku)
                       FROM buku
                       WHERE buku.id_judul = judul.id_judul
                       GROUP BY buku.id_judul), 0) AS jumlah_total,

                       /* ----------- jumlah ada ------------*/
                       IFNULL((SELECT COUNT(buku.id_buku)
                       FROM buku
                       WHERE buku.id_judul = judul.id_judul
                       AND buku.is_ada = 'y'
                       GROUP BY buku.id_judul), 0) AS jumlah_ada,

                       /* ----------- jumlah keluar ------------*/
                       IFNULL((SELECT COUNT(buku.id_buku)
                       FROM buku
                       WHERE buku.id_judul = judul.id_judul
                       AND buku.is_ada = 'n'
                       GROUP BY buku.id_judul), 0) AS jumlah_dipinjam

                FROM     judul
                WHERE    judul.isbn          =  '$keywords'
                OR       judul.judul_buku LIKE  '%$keywords%'
                OR       judul.penulis    LIKE  '%$keywords%'
                GROUP BY judul.id_judul
                ORDER BY judul.id_judul DESC
                LIMIT    $this->perPage
                OFFSET   $offset";

        return $this->db->query($sql)->result();
    }

    public function searchJudulCount($keywords)
    {
        return $this->judul->select('id_judul')
                           ->where('isbn', $keywords)
                           ->orLike('judul_buku', $keywords)
                           ->orLike('penulis', $keywords)
                           ->getAll();
    }
}
