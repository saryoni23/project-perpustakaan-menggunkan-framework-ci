<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends Operator_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->halaman = 'kelas';
    }

	public function index($page = null)
	{
        $kelass     = $this->kelas->orderBy('nama_kelas')->getAll();
        $jumlah     = count($kelass);
        $halaman    = $this->halaman;
        $main_view  = 'kelas/index';
		$this->load->view('template', compact('halaman', 'main_view', 'kelass', 'jumlah'));
	}

	public function create()
	{
        if (!$_POST) {
            $input = (object) $this->kelas->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->kelas->validate()) {
            $halaman     = $this->halaman;
            $main_view   = 'kelas/form';
            $form_action = 'kelas/create';

            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->kelas->insert($input)) {
            $this->session->set_flashdata('success', 'Data kelas berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Data kelas gagal disimpan.');
        }

        redirect('kelas');
	}

	public function edit($id = null)
	{
        $kelas = $this->kelas->where('id_kelas', $id)->get();
        if (!$kelas) {
            $this->session->set_flashdata('warning', 'Data kelas tidak ada.');
            redirect('kelas');
        }

        if (!$_POST) {
            $input = (object) $kelas;
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->kelas->validate()) {
            $halaman     = $this->halaman;
            $main_view   = 'kelas/form';
            $form_action = "kelas/edit/$id";

            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->kelas->where('id_kelas', $id)->update($input)) {
            $this->session->set_flashdata('success', 'Data kelas berhasil diupdate.');
        } else {
            $this->session->set_flashdata('error', 'Data kelas gagal diupdate.');
        }

        redirect('kelas');
	}

	public function delete($id = null)
	{
		$kelas = $this->kelas->where('id_kelas', $id)->get();
        if (!$kelas) {
            $this->session->set_flashdata('warning', 'Data kelas tidak ada.');
            redirect('kelas');
        }

        if ($this->kelas->where('id_kelas', $id)->delete()) {
			$this->session->set_flashdata('success', 'Data kelas berhasil dihapus.');
		} else {
            $this->session->set_flashdata('error', 'Data kelas gagal dihapus.');
        }

		redirect('kelas');
	}


    /*
    |-----------------------------------------------------------------
    | Callback
    |-----------------------------------------------------------------
    */
    public function alpha_numeric_coma_dash_dot_space($str)
    {
        if ( !preg_match('/^[a-zA-Z0-9 .,\-]+$/i',$str) )
        {
            $this->form_validation->set_message('alpha_numeric_coma_dash_dot_space', 'Hanya boleh berisi huruf, spasi, tanda hubung(-), titik(.) dan koma(,).');
            return false;
        }
    }

    public function nama_kelas_unik()
    {
        $nama_kelas = $this->input->post('nama_kelas');
        $id_kelas   = $this->input->post('id_kelas');

        $this->kelas->where('nama_kelas', $nama_kelas);
        !$id_kelas || $this->kelas->where('id_kelas !=', $id_kelas);
        $kelas = $this->kelas->get();

        if (count($kelas)) {
            $this->form_validation->set_message('nama_kelas_unik', '%s sudah digunakan.');
            return false;
        }
        return true;
    }
}
