<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_login');
		$this->load->model('M_wisata');
		$this->load->model('M_kategori');
	}

	public function index()
	{
		$data['judul'] = 'HOME || WISATA BOJONEGORO';
		$data['aktif'] = 'home';
		$data['drop'] = 'home';
		$data['k'] = $this->M_kategori->all()->result();
		$data['w'] = $this->M_wisata->all()->result();
		$this->load->view('home',$data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
