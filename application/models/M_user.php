<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function all()
	{
		return $this->db->get('user');
	}

	public function tambah()
	{
		$regis = array(
		'nama_user'	=> $this->input->post('nama_user'),
		'username'	=> $this->input->post('username'),
		'password'	=> md5($this->input->post('password')),
		'hak_akses'	=> $this->input->post('hak_akses')
	);
	$this->db->insert('user', $regis);
	}

	public function edit($id_user)
	{
		$this->db->where('id_user', $id_user);
		return $this->db->get('user');
	}

	public function edit_proses($id_user)
	{
		$edt = array(
			'nama_user' => $this->input->post('nama_user'),
			'password' => md5($this->input->post('password_baru'))
			);
		$this->db->where('id_user', $id_user);
		$this->db->update('user', $edt);
	}

	public function hapus($id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->delete('user');
	}
}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */
