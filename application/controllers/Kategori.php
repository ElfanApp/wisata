<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_kategori');
		$this->load->model('M_wisata');
		if (!$this->session->userdata('usernamed')) {
			$this->session->set_flashdata('erlog', '1');
			redirect('home');
		}
	}

	public function index()
	{
		if ($this->session->userdata('hak_akses') != 'admin') {
			$this->session->set_flashdata('errorakses', '1');
			redirect('home');
		}

		$data['judul'] = 'KATEGORI WISATA || ADMIN || WISATA BOJONEGORO';
		$data['drop'] = '';
		$data['aktif'] = 'kw';
		//$data['k'] = $this->M_kategori->all()->result();
		//$data['w'] = $this->M_wisata->all()->result();
		//$data['all'] = $this->M_kategori->all()->result();
		$this->load->view('admin/kategori/index',$data);
	}

	public function tambah()
	{
		if ($this->session->userdata('hak_akses') != 'admin') {
			redirect('home');
		}

		$data['judul'] = "KATEGORI WISATA || ADMIN || WISATA BOJONEGORO";
		$data['aktif'] = "kw";

		$this->form_validation->set_rules('nama_kategori', 'Nama', 'required|trim',
				array(
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> Nama Tidak Boleh Kosong.</div>'
					)
			);
		$this->form_validation->set_rules('id_kategori', 'ID Kategori', 'required|trim|is_unique[kategori.id_kategori]|integer',
				array(
					'is_unique' => '<div class="alert alert-danger"><strong>Error!</strong> Data Gagal Diinputkan. ID sudah ada</div>',
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> ID Tidak Boleh Kosong.</div>',
					'integer' => '<div class="alert alert-danger"><strong>Error!</strong> ID harus Angka.</div>'
					)
			);

		if ($this->form_validation->run()==FALSE) {
			$data['all'] = $this->M_kategori->all()->result();
			$data['modal_show'] = "$('#myModal').modal('show');";
			$this->session->set_flashdata('errortambah','1');
			$this->load->view('admin/kategori/index', $data);
		}else{
			$this->M_kategori->tambah();
			$this->session->set_flashdata('suksestambah','1');
			redirect('kategori');
		}
	}

	public function edit($id_kategori)
	{
		if ($this->session->userdata('hak_akses') != 'admin') {
			redirect('home');
		}

		$data['judul']		= "EDIT || KATEGORI WISATA || ADMIN || WISATA BOJONEGORO";
		$data['aktif']		= "kw";
		$data['kategori']	= $this->M_kategori->edit($id_kategori)->row_array();
		$this->load->view('admin/kategori/edit', $data);
	}

	public function edit_proses($id_kategori)
	{
		if ($this->session->userdata('hak_akses') != 'admin') {
			redirect('home');
		}

		$this->form_validation->set_rules('nama_kategori', 'Nama', 'required|trim',
				array(
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> Nama Tidak Boleh Kosong.</div>'
					)
			);

		if ($this->form_validation->run()==TRUE) {
			$this->M_kategori->edit_proses($id_kategori);
			$this->session->set_flashdata('suksesedit','1');
			redirect('kategori');
		}else{
			$data['judul']		= "EDIT || KATEGORI WISATA || ADMIN || WISATA BOJONEGORO";
			$data['aktif']		= "kw";
			$data['kategori']	= $this->M_kategori->edit($id_kategori)->row_array();
			$this->load->view('admin/kategori/edit', $data);
		}
	}

	public function hapus($id_kategori)
	{
		if ($this->session->userdata('hak_akses') != 'admin') {
			redirect('home');
		}

		$this->M_kategori->hapus($id_kategori);
		$this->session->set_flashdata('sukseshapus', '1');
		redirect('kategori');
	}

	public function select($id_kategori)
	{
		$data['judul'] = 'WISATA || WISATA BOJONEGORO';
		$data['drop'] = 'kategori';
		$data['aktif'] = '';
		$data['k'] = $this->M_kategori->all()->result();
		$data['w'] = $this->M_wisata->all()->result();
		$data['w_k']	= $this->M_kategori->select($id_kategori)->result();
		$this->load->view('kategori',$data);
	}

	public function detail($id_kategori)
	{
		$data['judul'] = 'DETAIL KATEGORI || WISATA BOJONEGORO';
		$data['drop'] = '';
		$data['aktif'] = 'kw';
		$data['k'] = $this->M_kategori->all()->result();
		$data['w'] = $this->M_wisata->all()->result();
		$data['detail'] = $this->M_kategori->detail($id_kategori)->result();
		$data['kategori'] = $this->M_kategori->edit($id_kategori)->row_array();
		$this->load->view('admin/kategori/detail',$data);
	}

	public function data_server()
	{
		$this->load->library('Datatables');
		$this->datatables->select('id_kategori, nama_kategori')->from('kategori');
		echo $this->datatables->generate();
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
