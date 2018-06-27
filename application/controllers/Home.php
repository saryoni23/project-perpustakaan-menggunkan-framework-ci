<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->halaman = 'home';
    }

	public function index($page = null)
	{
        $halaman    = $this->halaman;
        $main_view  = 'home/index';
		$this->load->view('template', compact('halaman', 'main_view'));
	}
}
