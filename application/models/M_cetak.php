<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cetak extends CI_Model {

	public function all()
	{
		return $this->db->get('pegawai');
	}
}

/* End of file M_cetak.php */
/* Location: ./application/models/M_cetak.php */
