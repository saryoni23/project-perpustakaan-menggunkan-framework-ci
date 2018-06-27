<?php defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->halaman = 'buku';
    }

    protected function isLogin()
    {
        $isLogin = $this->session->userdata('is_login');
        if (!$isLogin) {
            redirect(base_url());
        }
    }

    public function create()
    {
        $this->isLogin();

        $this->load->model('Judul_model', 'judul', true);

        $id_judul    = $this->input->post('id_judul');
        $judul       = $this->judul->where('id_judul', $id_judul)->get();
        $input       = (object) $this->input->post(null, true);
        $halaman     = $this->halaman;
        $main_view   = 'buku/form';
        $form_action = 'buku/create';
        $first_load  = $this->input->post('first_load');

        if ($first_load) {
            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input', 'judul'));
            return;
        }

        if (!$this->buku->validate()) {
            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input', 'judul'));
            return;
        }

        if ($this->buku->insert($input)) {
            $this->session->set_flashdata('success', 'Data buku berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Data buku gagal disimpan.');
        }

        redirect('judul');
    }

    public function ada($id_judul = null)
    {
        if (is_null($id_judul)) {
            redirect('judul');
        }

        $bukus      = $this->buku->ada($id_judul);
        $halaman    = $this->halaman;
        $main_view  = 'buku/ada';
        $this->load->view('template', compact('halaman', 'main_view', 'bukus'));
    }

    public function dipinjam($id_judul = null)
    {
        if (is_null($id_judul)) {
            redirect('judul');
        }

        $bukus      = $this->buku->dipinjam($id_judul);
        $halaman    = $this->halaman;
        $main_view  = 'buku/dipinjam';
        $this->load->view('template', compact('halaman', 'main_view', 'bukus'));
    }

    public function total($id_judul = null)
    {
        if (is_null($id_judul)) {
            redirect('judul');
        }

        $bukus      = $this->buku->total($id_judul);
        $halaman    = $this->halaman;
        $main_view  = 'buku/total';
        $this->load->view('template', compact('halaman', 'main_view', 'bukus'));
    }

    public function delete()
    {
        $this->isLogin();

        $id_buku = $this->input->post('id_buku');
        $buku    = $this->buku->where('id_buku', $id_buku)->get();

        if (!$buku) {
            $this->session->set_flashdata('warning', 'Data buku tidak ada.');
            redirect('judul');
        }

        if ($this->buku->where('id_buku', $id_buku)->delete()) {
            $this->session->set_flashdata('success', 'Data buku berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Data buku gagal dihapus.');
        }

        redirect('judul');
    }

    /*
    |-----------------------------------------------------------------
    | Callback
    |-----------------------------------------------------------------
    */
    public function alpha_numeric_coma_dash_dot_space($str)
    {
        if (!preg_match('/^[a-zA-Z0-9 .,\-]+$/i', $str)) {
            $this->form_validation->set_message('alpha_numeric_coma_dash_dot_space', 'Hanya boleh berisi huruf, spasi, tanda hubung(-), titik(.) dan koma(,).');
            return false;
        }
    }

    public function kode_buku_unik()
    {
        $kode_buku = $this->input->post('kode_buku', true);
        $id_buku   = $this->input->post('id_buku', true);

        $this->buku->where('kode_buku', $kode_buku);
        !$id_buku || $this->buku->where('id_buku !=', $id_buku);
        $buku = $this->buku->get();

        if (count($buku)) {
            $this->form_validation->set_message('kode_buku_unik', '%s sudah digunakan.');
            return false;
        }

        return true;
    }
}
