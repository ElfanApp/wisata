<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_wisata extends CI_Model {

	public function all()
	{
		return $this->db->query("SELECT * FROM wisata, kategori WHERE wisata.id_kategori = kategori.id_kategori");
	}	

	public function tambah($gambar)
	{
		$wis = array(
			'id_wisata' => $this->input->post('id_wisata'),
			'nama_wisata' => $this->input->post('nama_wisata'),
			'id_kategori' => $this->input->post('id_kategori'),
			'sekilas' => $this->input->post('sekilas'),
			'gambar' => $gambar
			);
		$this->db->insert('wisata', $wis);
	}

	public function edit($id_wisata)
	{
		return $this->db->query("SELECT * FROM wisata, kategori WHERE wisata.id_kategori = kategori.id_kategori AND wisata.id_wisata = '$id_wisata'");
	}

	public function edit_proses($id_wisata, $gambar)
	{
		$edt = array(
			'nama_wisata' => $this->input->post('nama_wisata'),
			'id_kategori' => $this->input->post('id_kategori'),
			'sekilas' => $this->input->post('sekilas'),
			'gambar' => $gambar
			);
		$this->db->where('id_wisata', $id_wisata);
		$this->db->update('wisata', $edt);
	}

	public function hapus($id_wisata)
	{
		$this->db->where('id_wisata', $id_wisata);
		$this->db->delete('wisata');
	}

	public function select($id_wisata)
	{
		$this->db->where('id_wisata', $id_wisata);
		return $this->db->get('wisata');
	}

	public function selectgb($id_wisata)
	{
		//fungsi select untuk menselect nama gambar dengan menghilangkan teks "_thumb"
		return $this->db->query("SELECT REPLACE(gambar, '_thumb', '') as 'gb2' FROM wisata WHERE id_wisata = '$id_wisata'");
	}
}

/* End of file M_wisata.php */
/* Location: ./application/models/M_wisata.php */