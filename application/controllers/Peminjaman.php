<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends Operator_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->halaman = 'peminjaman';
    }

    public function index($page = null)
    {
        $peminjaman = $this->peminjaman->getAllPeminjaman($page);
        $jumlah     = $this->peminjaman->getAllPeminjamanCount()->jumlah;

        $halaman    = $this->halaman;
        $main_view  = 'peminjaman/index';
        $pagination = $this->peminjaman->makePagination(site_url('peminjaman'), 2, $jumlah);
        $this->load->view('template', compact('halaman', 'main_view', 'peminjaman', 'pagination', 'jumlah'));
    }

    public function create()
    {
        if (!$_POST) {
            $input = (object) $this->peminjaman->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->peminjaman->validate()) {
            $halaman     = $this->halaman;
            $main_view   = 'peminjaman/form';
            $form_action = 'peminjaman/create';

            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input'));
            return;
        }

        // Cek, melebihi jumlah maksimum?
        $id_siswa = $this->input->post('id_siswa');
        if (!$this->peminjaman->cekMaxItem($id_siswa)) {
            $this->session->set_flashdata('error', 'Tidak boleh meminjam lebih dari 2 buku!');
            redirect('peminjaman');
            return;
        }

        // If validate, unset search_siswa and search_buku
        // We dont need these items to save to database
        unset($input->search_siswa);
        unset($input->search_buku);

        if ($this->peminjaman->insert($input)) {
            // Ubah status "is_ada" -> n
            $this->peminjaman->ubahStatusBuku($input->id_buku, 'n');

            $this->session->set_flashdata('success', 'Data peminjaman berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Data peminjaman gagal disimpan.');
        }

        redirect('peminjaman/index');
    }

    // Live search for siswa
    public function siswa_auto_complete()
    {
        $keywords = $this->input->post('keywords');
        $siswas = $this->peminjaman->liveSearchSiswa($keywords);

        foreach ($siswas as $siswa) {
            // Put in bold the written text.
            $nis        = str_replace($keywords, '<strong>'.$keywords.'</strong>', $siswa->nis);
            $nama_siswa = preg_replace("#($keywords)#i", "<strong>$1</strong>", $siswa->nama_siswa);

            // Add new option.
            $str  = '<li onclick="setItemSiswa(\''.$siswa->nama_siswa.'\'); makeHiddenIdSiswa(\''.$siswa->id_siswa.'\')">';
            $str .= "$nis - $nama_siswa";
            $str .= "</li>";

            echo $str;
        }
    }

    // Live search for buku
    public function buku_auto_complete()
    {
        $keywords = $this->input->post('keywords');
        $bukus = $this->peminjaman->liveSearchBuku($keywords);

        foreach ($bukus as $buku) {
            // Put in bold the written text.
            $judul_buku = preg_replace("#($keywords)#i", "<strong>$1</strong>", $buku->judul_buku);

            // Add new option.
            $str  = '<li onclick="setItemBuku(\''.$buku->judul_buku.'\'); makeHiddenIdBuku(\''.$buku->id_buku.'\')">';
            $str .= $judul_buku;
            $str .= '</li>';

            echo $str;
        }
    }

    /*
    |-----------------------------------------------------------------
    | Callback
    |-----------------------------------------------------------------
    */
    public function is_format_tanggal_valid($str)
    {
        if(!preg_match('/([0-9]{4})-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/', $str)) {
            $this->form_validation->set_message('is_format_tanggal_valid', 'Format tanggal tidak valid. (yyyy-mm-dd)');
            return FALSE;
        }

        return TRUE;
    }
}
