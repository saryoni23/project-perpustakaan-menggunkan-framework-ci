<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends Operator_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->halaman = 'siswa';
    }

	public function index($page = null)
	{
        $siswas     = $this->siswa->join('kelas')->orderBy('kelas.id_kelas')->orderBy('nama_siswa')->paginate($page)->getAll();
        $jml        = $this->siswa->join('kelas')->orderBy('kelas.id_kelas')->orderBy('nama_siswa')->getAll();
        $jumlah     = count($jml);
        $halaman    = $this->halaman;
        $main_view  = 'siswa/index';
        $pagination = $this->siswa->makePagination(site_url('siswa'), 2, $jumlah);

		$this->load->view('template', compact('halaman', 'main_view', 'siswas', 'pagination', 'jumlah'));
	}

	public function create()
	{
        if (!$_POST) {
            $input = (object) $this->siswa->getDefaultValues();
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->siswa->validate()) {
            $halaman     = $this->halaman;
            $main_view   = 'siswa/form';
            $form_action = 'siswa/create';

            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->siswa->insert($input)) {
            $this->session->set_flashdata('success', 'Data siswa berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Data siswa gagal disimpan.');
        }

        redirect('siswa');
	}

	public function edit($id = null)
	{
        $siswa = $this->siswa->where('id_siswa', $id)->get();
        if (!$siswa) {
            $this->session->set_flashdata('warning', 'Data siswa tidak ada.');
            redirect('siswa');
        }

        if (!$_POST) {
            $input = (object) $siswa;
        } else {
            $input = (object) $this->input->post(null, true);
        }

        if (!$this->siswa->validate()) {
            $halaman     = $this->halaman;
            $main_view   = 'siswa/form';
            $form_action = "siswa/edit/$id";

            $this->load->view('template', compact('halaman', 'main_view', 'form_action', 'input'));
            return;
        }

        if ($this->siswa->where('id_siswa', $id)->update($input)) {
            $this->session->set_flashdata('success', 'Data siswa berhasil diupdate.');
        } else {
            $this->session->set_flashdata('error', 'Data siswa gagal diupdate.');
        }

        redirect('siswa');
	}

	public function delete($id = null)
	{
		$siswa = $this->siswa->where('id_siswa', $id)->get();
        if (!$siswa) {
            $this->session->set_flashdata('warning', 'Data siswa tidak ada.');
            redirect('siswa');
        }

        if ($this->siswa->where('id_siswa', $id)->delete()) {
			$this->session->set_flashdata('success', 'Data siswa berhasil dihapus.');
		} else {
            $this->session->set_flashdata('error', 'Data siswa gagal dihapus.');
        }

		redirect('siswa');
	}

    public function search($page = null)
    {
        $keywords   = $this->input->get('keywords', true);
        $siswas     = $this->siswa->where('nis', $keywords)
                                  ->orLike('nama_siswa', $keywords)
                                  ->join('kelas')
                                  ->orderBy('kelas.id_kelas')
                                  ->orderBy('nama_siswa')
                                  ->paginate($page)
                                  ->getAll();
        $jml        = $this->siswa->where('nis', $keywords)
                                  ->orLike('nama_siswa', $keywords)
                                  ->join('kelas')
                                  ->orderBy('kelas.id_kelas')
                                  ->orderBy('nama_siswa')
                                  ->getAll();
        $jumlah = count($jml);

        $pagination = $this->siswa->makePagination(site_url('siswa/search/'), 3, $jumlah);

        if (!$siswas) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan.');
            redirect('siswa');
        }

        $halaman    = $this->halaman;
        $main_view  = 'siswa/index';
        $this->load->view('template', compact('halaman', 'main_view', 'siswas', 'pagination', 'jumlah'));
    }

    /*
    |-----------------------------------------------------------------
    | Callback
    |-----------------------------------------------------------------
    */
    public function alpha_coma_dash_dot_space($str)
    {
        if ( !preg_match('/^[a-zA-Z .,\-]+$/i',$str) )
        {
            $this->form_validation->set_message('alpha_coma_dash_dot_space', 'Hanya boleh berisi huruf, spasi, tanda hubung(-), titik(.) dan koma(,).');
            return false;
        }
    }

    public function nis_unik()
    {
        $nis      = $this->input->post('nis');
        $id_siswa = $this->input->post('id_siswa');

        $this->siswa->where('nis', $nis);
        !$id_siswa || $this->siswa->where('id_siswa !=', $id_siswa);
        $siswa = $this->siswa->get();

        if (count($siswa)) {
            $this->form_validation->set_message('nis_unik', '%s sudah digunakan.');
            return false;
        }
        return true;
    }
}
