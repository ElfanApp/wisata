<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_kategori');
		$this->load->model('M_wisata');
		if (!$this->session->userdata('usernamed')) {
			redirect('home');
		}

		if ($this->session->userdata('hak_akses') != 'admin') {
			$this->session->set_flashdata('errorakses', '1');
			redirect('home');
		}
	}

	public function index()
	{
		$data['judul'] = 'ADMIN || WISATA BOJONEGORO';
		$data['drop'] = '';
		$data['aktif'] = 'dashboard';
		$data['k'] = $this->M_kategori->all()->result();
		$data['w'] = $this->M_wisata->all()->result();
		$data['jum_k'] = $this->M_kategori->all()->num_rows();
		$data['jum_w'] = $this->M_wisata->all()->num_rows();
		$this->load->view('admin/index',$data);
	}
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
