<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','captcha'));
		$this->load->model('M_login');
		$this->load->model('M_wisata');
		$this->load->model('M_kategori');
	}

	public function index ()
	{
		if ($this->session->userdata('usernamed')) {
			if ($this->session->userdata('hak_akses') == 'admin') {
				redirect('admin');
			}else {
				redirect('home');
			}
		}else{
			$data['judul'] = 'LOGIN || WISATA BOJONEGORO';
			$data['drop'] = '';
			$data['aktif'] = 'login';
			$data['k'] = $this->M_kategori->all()->result();
			$data['w'] = $this->M_wisata->all()->result();
			$this->load->view('login',$data);
		}
	}

	public function login_proses()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = 'LOGIN || WISATA BOJONEGORO';
			$data['drop'] = '';
			$data['aktif'] = 'login';
			$data['k'] = $this->M_kategori->all()->result();
			$data['w'] = $this->M_wisata->all()->result();
			$this->load->view('login',$data);
		}else{
			$user = $this->input->post('username');
			$pass = $this->input->post('password');
			$cek = $this->M_login->cek($user, md5($pass))->num_rows();
			if ($cek > 0) {
				$login = $this->M_login->cek($user, md5($pass))->row_array();
				$user = $login['nama_user'];
				$akses = $login['hak_akses'];
				$username = $login['username'];
				$this->session->set_userdata('usernamed', $user);
				$this->session->set_userdata('hak_akses', $akses);
				$this->session->set_userdata('user_user', $username);
				if ($akses == "admin") {
					redirect('admin');
				}else{
					redirect('home');
				}
			}else{
				$this->session->set_flashdata('errorlogin', '1');
				redirect('login');
			}
		}
	}

	public function register()
	{
		$data['judul'] 	= 'REGISTER || WISATA BOJONEGORO';
		$data['drop'] 	= '';
		$data['aktif'] 	= 'login';
		//capcha
		$vals = array(
							'img_path'	 	=> './captcha/',
							'img_url'	 		=> base_url().'captcha/',
							'img_width'	 	=> 350,
							'img_height' 	=> 50
					);
		// membuat capcha
		$cap = create_captcha($vals);
		$this->session->set_userdata('mycaptcha', $cap['word']);
		$this->session->set_userdata('image', $cap['image']);

		$data['image'] = $cap['image'];
		$data['k'] = $this->M_kategori->all()->result();
		$data['w'] = $this->M_wisata->all()->result();
		$this->load->view('register',$data);
	}

	public function register_proses()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama_user', 'Nama', 'trim|required',
		array(
			'required' => '<div class="alert alert-danger"><strong>Error!</strong> Nama Tidak Boleh Kosong.</div>'
			)
		);
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|is_unique[user.email]|valid_email',
		array(
			'is_unique' => '<div class="alert alert-danger"><strong>Error!</strong> E-mail sudah terdaftar.</div>',
			'valid_email' => '<div class="alert alert-danger"><strong>Error!</strong> E-mail tidak valid.</div>'
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

		//kirim e-mail
		$this->load->library('email');
	  	$this->email->initialize(array(
	         'protocol' 	=> 'smtp',
	         'smtp_host' 	=> 'ssl://smtp.gmail.com',
	         'smtp_user' 	=> 'elfanrodhian@gmail.com',
	         'smtp_pass' 	=> 'Elfanrodhian123',
	         'smtp_port' 	=> 465,
	         'mailtype' 	=> 'html',
	         'newline' 		=> "\r\n" // kode yang harus di tulis pada konfigurasi controler email
	   	));

		$username 	= $this->input->post('username');
		$pass 			= $this->input->post('password');
		$from 	= 'elfanrodhian@gmail.com';
	   	$nama 	= 'Tugas Besar Framework Wisata';
	   	$to 		= $this->input->post('email');
	   	$subject = 'Sukses Register';
	   	$message = '<p>Terimakasih Sudah Mendaftar :), sekarang anda dapat melihat konten Website Wisata Bojonegoro, silahkan masuk dengan : <br> USERNAME	: <strong>'.$username.'</strong><br>PASSWORD	: <strong>'. $pass.'</strong></p>';

	   	$this->email->from($from, $nama )
	               ->to($to)
	               ->subject($subject)
	               ->message($message);

		if ($this->form_validation->run() == FALSE) {
			$data['image'] = $this->session->userdata('image');
			$data['judul'] = 'REGISTER || WISATA BOJONEGORO';
			$data['drop'] = '';
			$data['aktif'] = 'login';
			$data['k'] = $this->M_kategori->all()->result();
			$data['w'] = $this->M_wisata->all()->result();
			$this->load->view('register',$data);
		}else{
			$user = $this->input->post('username');
			$pass = $this->input->post('password');
			$capp = $this->input->post('captcha');
			$cek = $this->M_login->cek($user, md5($pass))->num_rows();
			if ($cek > 0) {
				$this->session->set_flashdata('errorregister', '1');
				redirect('login/register');
			}else{
				if ($capp != "" && $capp == $this->session->userdata('mycaptcha')) {
					if ($this->email->send()) {
						$this->M_login->register();
						$this->session->set_flashdata('suksesregister', '1');
						redirect('login');
					}
				}else{
					$this->session->set_flashdata('errorcap', '1');
					redirect('login/register');
				}
			}
		}
	}

	public function lupa()
	{
		$data['judul'] 	= 'LUPA || WISATA BOJONEGORO';
		$data['drop'] 	= '';
		$data['aktif'] 	= 'login';
		//capcha
		$vals = array(
							'img_path'	 	=> './captcha/',
							'img_url'	 		=> base_url().'captcha/',
							'img_width'	 	=> 350,
							'img_height' 	=> 50
					);
		// membuat capcha
		$cap = create_captcha($vals);
		$this->session->set_userdata('caplupa', $cap['word']);

		$data['image'] = $cap['image'];
		$data['k'] = $this->M_kategori->all()->result();
		$data['w'] = $this->M_wisata->all()->result();
		$this->load->view('lupa',$data);
	}

	public function lupa_proses()
	{
		$this->load->library('email');
	  $this->email->initialize(array(
	         'protocol' 	=> 'smtp',
	         'smtp_host' 	=> 'ssl://smtp.gmail.com',
	         'smtp_user' 	=> 'elfanrodhian@gmail.com',
	         'smtp_pass' 	=> 'Elfanrodhian123',
	         'smtp_port' 	=> 465,
	         'mailtype' 	=> 'html',
	         'newline' 		=> "\r\n" // kode yang harus di tulis pada konfigurasi controler email
	   ));
		 $cek 			= $this->M_login->cek_mail($this->input->post('email'))->row_array();
		 $username 	= $cek['username'];
		 $pass 			= $this->session->userdata('caplupa');
		 $from 	= 'elfanrodhian@gmail.com';
	   $nama 	= 'Tugas Besar Framework Wisata';
	   $to 		= $this->input->post('email');
	   $subject = 'Konfigurasi Password';
	   $message = '<p>Password anda telah berhasil diubah, silahkan masuk dengan : <br> USERNAME	: <strong>'.$username.'</strong><br>PASSWORD	: <strong>'. $pass.'</strong></p>';

	   $this->email->from($from, $nama )
	               ->to($to)
	               ->subject($subject)
	               ->message($message);

		$mail = $this->M_login->cek_mail($this->input->post('email'))->num_rows();
		if ($mail > 0) {
			if ($this->input->post('captcha') == $this->session->userdata('caplupa')) {
				if ($this->email->send()) {
					$this->session->set_flashdata('suksesemail', '1');
					$this->M_login->lupa($this->input->post('email'), $this->session->userdata('caplupa'));
					redirect('login');
				} else {
					show_error($this->email->print_debugger());
				}
			}else{
				$this->session->set_flashdata('errorcap', '1');
				redirect('login/lupa');
			}
		}else{
			$this->session->set_flashdata('errormail', '1');
			redirect('login/lupa');
		}
	}

	public function atur()
	{
		$data['judul'] = 'PENGATURAN AKUN || WISATA BOJONEGORO';
		$data['drop'] = '';
		$data['aktif'] = 'login';
		$data['k'] = $this->M_kategori->all()->result();
		$data['w'] = $this->M_wisata->all()->result();
		$usernamed = $this->session->userdata('user_user');
		$data['user'] = $this->M_login->get_user($usernamed)->row_array();
		$this->load->view('pengaturan',$data);
	}

	public function atur_edit()
	{
		$data['judul'] = 'PENGATURAN AKUN || WISATA BOJONEGORO';
		$data['drop'] = '';
		$data['aktif'] = 'login';
		$data['k'] = $this->M_kategori->all()->result();
		$data['w'] = $this->M_wisata->all()->result();
		$usernamed = $this->session->userdata('user_user');
		$data['user'] = $this->M_login->get_user($usernamed)->row_array();
		$this->load->view('edit_pengaturan',$data);
	}

	public function atur_proses()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama_user', 'Nama', 'trim|required',
		array(
			'required' => '<div class="alert alert-danger"><strong>Error!</strong> Nama Tidak Boleh Kosong.</div>'
			)
		);
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email',
		array(
			'valid_email' => '<div class="alert alert-danger"><strong>Error!</strong> E-mail tidak valid.</div>'
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

		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = 'PENGATURAN AKUN || WISATA BOJONEGORO';
			$data['drop'] = '';
			$data['aktif'] = 'login';
			$data['k'] = $this->M_kategori->all()->result();
			$data['w'] = $this->M_wisata->all()->result();
			$usernamed = $this->session->userdata('user_user');
			$data['user'] = $this->M_login->get_user($usernamed)->row_array();
			$this->load->view('edit_pengaturan',$data);
		}else{
			$userlog		= $this->session->userdata('user_user');
			$nama_user= $this->input->post('nama_user');
			$email		= $this->input->post('email');
			$username	= $this->input->post('username');
			$password	= $this->input->post('password');
			$password2	= $this->input->post('password2');
			$cek_pass 	= $this->M_login->cek($userlog, $password)->row_array();
			$cek_email	= $this->M_login->cek_mail($email)->row_array();
			if ($cek_email['username'] == $userlog) {
				if ($password2 != "" && $password2 == $password) {
					$this->M_login->atur_proses1($userlog, $nama_user, $email, $username, $password);
					$this->session->set_flashdata('suksesatur', '1');
					redirect('login/atur');
				}elseif ($password2 == "" && $password == $cek_pass['password']) {
					$this->M_login->atur_proses2($userlog, $nama_user, $email, $username);
					$this->session->set_flashdata('suksesatur', '1');
					redirect('login/atur');
				}else{
					$this->session->set_flashdata('errorpass', '1');
					redirect('login/atur_edit');
				}
			}else{
				$this->session->set_flashdata('errormail', '1');
				redirect('login/atur');
			}
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('usernamed');
		$this->session->unset_userdata('hak_akses');
		redirect('home');
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
