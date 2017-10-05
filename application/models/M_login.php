<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	public function cek($user, $pass)
	{
		$this->db->where('username', $user);
		$this->db->where('password', $pass);
		return $this->db->get('user');
	}

	public function register()
	{
		$regis = array(
		'nama_user'	=> $this->input->post('nama_user'),
		'username'	=> $this->input->post('username'),
		'email'	=> $this->input->post('email'),
		'password'	=> md5($this->input->post('password')),
		'hak_akses'	=> 'user'
	);
	$this->db->insert('user', $regis);
	}

	public function cek_mail($email)
	{
		$this->db->where('email', $email);
		return $this->db->get('user');
	}

	public function get_user($username)
	{
		$this->db->where('username', $username);
		return $this->db->get('user');
	}

	public function lupa($mail, $pass)
	{
		$edt = array(
			'password' 		=> md5($pass)
			);
		$this->db->where('email', $mail);
		$this->db->update('user', $edt);
	}

	public function atur_proses1($userlog, $nama_user, $email, $username, $password)
	{
		$edt = array(
			'nama_user' => $nama_user,
			'email' 		=> $email,
			'username' 	=> $username,
			'password' 	=> md5($password)
			);
		$this->db->where('username', $userlog);
		$this->db->update('user', $edt);
	}

	public function atur_proses2($userlog, $nama_user, $email, $username)
	{
		$edt = array(
			'nama_user' => $nama_user,
			'email' 		=> $email,
			'username' 	=> $username
			);
		$this->db->where('username', $userlog);
		$this->db->update('user', $edt);
	}
}

/* End of file M_login.php */
/* Location: ./application/models/M_login.php */
