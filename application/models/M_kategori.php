<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategori extends CI_Model {

	public function all()
	{
		return $this->db->get('kategori');
	}	

	public function tambah()
	{
		$kateg = array(
			'id_kategori' => $this->input->post('id_kategori'),
			'nama_kategori' => $this->input->post('nama_kategori'),
			);
		$this->db->insert('kategori', $kateg);
	}

	public function edit($id_kategori)
	{
		$this->db->where('id_kategori', $id_kategori);
		return $this->db->get('kategori');
	}

	public function edit_proses($id_kategori)
	{
		$edt = array(
			'nama_kategori' 		=> $this->input->post('nama_kategori')
			);
		$this->db->where('id_kategori', $id_kategori);
		$this->db->update('kategori', $edt);
	}

	public function hapus($id_kategori)
	{
		$this->db->where('id_kategori', $id_kategori);
		$this->db->delete('kategori');

		$this->db->where('id_kategori', $id_kategori);
		$this->db->delete('wisata');
	}

	public function select($id_kategori)
	{
		return $this->db->query("SELECT * FROM wisata, kategori WHERE wisata.id_kategori = kategori.id_kategori 
			AND kategori.id_kategori = '$id_kategori'"); 
	}

	public function detail($id_kategori)
	{
		return $this->db->query("SELECT * FROM wisata, kategori WHERE wisata.id_kategori = '$id_kategori' AND wisata.id_kategori = kategori.id_kategori"); 
	}

}

/* End of file M_kategori.php */
/* Location: ./application/models/M_kategori.php */