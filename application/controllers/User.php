<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
		$this->load->model('M_login');
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
		$data['all'] 	= $this->M_user->all()->result();
		$data['aktif']		= "user";
		$data['judul']		= "WISATA || ADMIN || USER";
		$this->load->view('admin/user/index', $data);
	}

	public function tambah()
	{
		$data['judul'] = "WISATA || ADMIN || USER";
		$data['aktif'] = "user";

		$this->form_validation->set_rules('nama_user', 'Nama', 'trim|required',
		array(
			'required' => '<div class="alert alert-danger"><strong>Error!</strong> Nama Tidak Boleh Kosong.</div>'
			)
		);
		$this->form_validation->set_rules('username', 'Username', 'trim|required',
		array(
			'required' => '<div class="alert alert-danger"><strong>Error!</strong> Username Tidak Boleh Kosong.</div>'
			)
		);
		$this->form_validation->set_rules('password', 'Password', 'trim|required',
		array(
			'required' => '<div class="alert alert-danger"><strong>Error!</strong> Password Tidak Boleh Kosong.</div>'
			)
		);
		$this->form_validation->set_rules('password2', 'Password', 'trim|matches[password]',
		array(
			'matches' => '<div class="alert alert-danger"><strong>Error!</strong> Konfirmasi Password tidak sama.</div>'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			$data['all'] 	= $this->M_user->all()->result();
			$data['modal_show'] = "$('#myModal').modal('show');";
			$data['aktif']		= "user";
			$data['judul']		= "WISATA || ADMIN || USER";
			$this->load->view('admin/user/index', $data);
		}else{
			$user = $this->input->post('username');
			$pass = $this->input->post('password');
			$cek = $this->M_login->cek($user, md5($pass))->num_rows();
			if ($cek > 0) {
				$this->session->set_flashdata('errortambah', '1');
				$data['modal_show'] = "$('#myModal').modal('show');";
				redirect('user');
			}else{
				$this->M_user->tambah();
				$this->session->set_flashdata('suksestambah', '1');
				redirect('user');
			}
		}
	}

	public function edit($id_user)
	{
		$data['judul']		= "EDIT || USER || ADMIN || WISATA BOJONEGORO";
		$data['aktif']		= "user";
		$data['user']		= $this->M_user->edit($id_user)->row_array();
		$this->load->view('admin/user/edit', $data);
	}

	public function edit_proses($id_user)
	{
		$this->form_validation->set_rules('nama_user', 'Nama', 'trim|required',
		array(
			'required' => '<div class="alert alert-danger"><strong>Error!</strong> Nama Tidak Boleh Kosong.</div>'
			)
		);
		$this->form_validation->set_rules('username', 'Username', 'trim|required',
		array(
			'required' => '<div class="alert alert-danger"><strong>Error!</strong> Username Tidak Boleh Kosong.</div>'
			)
		);
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'trim');
		$this->form_validation->set_rules('password_baru2', 'Konfirmasi Password', 'trim|matches[password_baru]',
		array(
			'matches' => '<div class="alert alert-danger"><strong>Error!</strong> Konfirmasi Password tidak sama.</div>'
			)
		);

		if ($this->form_validation->run() == FALSE) {
			$data['judul']		= "EDIT || USER || ADMIN || WISATA BOJONEGORO";
			$data['aktif']		= "user";
			$data['user']		= $this->M_user->edit($id_user)->row_array();
			$this->load->view('admin/user/edit', $data);
		}else{
			$nama_user = $this->input->post('nama_user');
			$user = $this->input->post('username');
			$pass = $this->input->post('password');
			$pass_baru = $this->input->post('password_baru');
			if ($pass_baru == "") {
				$edit = array(
					'nama_user' => $nama_user
				);
				$this->db->where('id_user', $id_user);
				$this->db->update('user', $edit);
				$this->session->set_flashdata('errorkosong', '1');
				redirect('user');
			}else{
				$this->M_user->edit_proses($id_user);
				$this->session->set_flashdata('suksesedit', '1');
				redirect('user');
			}
		}
	}

	public function hapus($id_user)
	{
		$this->M_user->hapus($id_user);
		$this->session->set_flashdata('sukseshapus', '1');
		redirect('user');
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
