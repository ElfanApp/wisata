<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pegawai extends CI_Model {

	public function all()
	{
		return $this->db->get('pegawai');
	}	

	public function tambah($foto)
	{
		$peg = array(
			'nip' => $this->input->post('nip'),
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'tanggal' => $this->input->post('tanggal'),
			'alamat' => $this->input->post('alamat'),
			'foto' => $foto
			);
		$this->db->insert('pegawai', $peg);
	}

	public function edit($id_pegawai)
	{
		$this->db->where('id_pegawai', $id_pegawai);
		return $this->db->get('pegawai');
	}

	public function edit_proses($id_pegawai, $foto)
	{
		$edt = array(
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'tanggal' => $this->input->post('tanggal'),
			'alamat' => $this->input->post('alamat'),
			'foto' => $foto
			);
		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->update('pegawai', $edt);
	}

	public function hapus($id_pegawai)
	{
		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->delete('pegawai');
	}

	public function select($id_pegawai)
	{
		$this->db->where('id_pegawai', $id_pegawai);
		return $this->db->get('pegawai');
	}

	public function selectgb($id_pegawai)
	{
		//fungsi select untuk menselect nama foto dengan menghilangkan teks "_thumb"
		return $this->db->query("SELECT REPLACE(foto, '_thumb', '') as 'gb2' FROM pegawai WHERE id_pegawai = '$id_pegawai'");
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */