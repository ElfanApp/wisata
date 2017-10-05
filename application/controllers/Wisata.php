<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wisata extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('M_wisata');
		$this->load->model('M_kategori');
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

		$data['judul'] = 'WISATA || ADMIN || WISATA BOJONEGORO';
		$data['drop'] = '';
		$data['aktif'] = 'ws';
		$data['all'] = $this->M_wisata->all()->result();
		$data['kategori'] = $this->M_kategori->all()->result();
		$this->load->view('admin/wisata/index',$data);
	}

	public function tambah()
	{
		if ($this->session->userdata('hak_akses') != 'admin') {
			redirect('home');
		}

		$data['judul'] = "WISATA || ADMIN || WISATA BOJONEGORO";
		$data['aktif'] = "ws";

		$this->form_validation->set_rules('nama_wisata', 'Nama', 'required|trim',
				array(
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> Nama Tidak Boleh Kosong.</div>'
					)
			);
		$this->form_validation->set_rules('id_wisata', 'ID Wisata', 'required|trim|is_unique[wisata.id_wisata]|integer',
				array(
					'is_unique' => '<div class="alert alert-danger"><strong>Error!</strong> Data Gagal Diinputkan. ID sudah ada</div>',
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> ID Tidak Boleh Kosong.</div>',
					'integer' => '<div class="alert alert-danger"><strong>Error!</strong> ID harus Angka.</div>'
					)
			);
		$this->form_validation->set_rules('id_kategori', 'Kategori', 'required|trim',
				array(
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> Kategori Tidak Boleh Kosong.</div>'
					)
			);
		$this->form_validation->set_rules('sekilas', 'Sekilas', 'required|trim',
				array(
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> Isikan sekilas tentang wisata tersebut</div>'
					)
			);

		//jika validasi gagal
		if ($this->form_validation->run()==FALSE) {
			$data['all'] = $this->M_wisata->all()->result();
			$data['kategori'] = $this->M_kategori->all()->result();
			$data['modal_show'] = "$('#myModal').modal('show');";
			$this->session->set_flashdata('errortambah','1');
			$this->load->view('admin/wisata/index', $data);
		//jika validasi berhasil
		}else{

			//setting config untuk library upload
			$config['upload_path'] 		= './assets/images/';
			$config['allowed_types'] 	= 'gif|jpg|png';
			$config['max_size']     	= 1000000000;
			$config['max_width'] 		= 10240;
			$config['max_height'] 		= 7680;

			//pemanggilan librabry upload
			$this->load->library('upload', $config);

			//jika upload gagal
			if ( ! $this->upload->do_upload('gambar'))
            {
                $data['all'] = $this->M_wisata->all()->result();
				$data['kategori'] = $this->M_kategori->all()->result();
				$data['modal_show'] = "$('#myModal').modal('show');";
				$this->session->set_flashdata('errortambah','1');
				$this->load->view('admin/wisata/index', $data);
			//jika upload berhasil
            }else{
            	$gambar = $this->upload->data();

            	//memanggil library image
				$this->load->library('image_lib');
				//setting konfigurasi image_lib
				$this->image_lib->initialize(array(
                    'image_library' => 'gd2',
                    'source_image' => './assets/images/'. $gambar['file_name'],
                    'maintain_ratio' => true,
                    'create_thumb' => true,
                    'quality' => '20%',
                    'width' => 240
                ));

				//jika fungsi resize image berhasil dijalankam
                if($this->image_lib->resize())
                {
                	//menyimpan kedalam database
                   	$this->M_wisata->tambah($gambar['raw_name'].'_thumb'.$gambar['file_ext']);
					$this->session->set_flashdata('suksestambah','1');
					redirect('wisata');

				//jika fung resize image gagal
                }else{
                    $data['error'] 		= $this->image_lib->display_errors();
					$data['all'] = $this->M_wisata->all()->result();
					$data['kategori'] = $this->M_kategori->all()->result();
					$data['modal_show'] = "$('#myModal').modal('show');";
					$this->session->set_flashdata('errortambah','1');
					$this->load->view('admin/wisata/index', $data);
                }
			}
		}
	}

	public function edit($id_wisata)
	{
		if ($this->session->userdata('hak_akses') != 'admin') {
			redirect('home');
		}

		$data['judul']		= "EDIT || WISATA || ADMIN || WISATA BOJONEGORO";
		$data['aktif']		= "ws";
		$data['wisata']		= $this->M_wisata->edit($id_wisata)->row_array();
		$data['kategori']	= $this->M_kategori->all()->result();
		$this->load->view('admin/wisata/edit', $data);
	}

	public function edit_proses($id_wisata)
	{
		if ($this->session->userdata('hak_akses') != 'admin') {
			redirect('home');
		}

		$this->form_validation->set_rules('nama_wisata', 'Nama', 'required|trim',
				array(
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> Nama Tidak Boleh Kosong.</div>'
					)
			);
		$this->form_validation->set_rules('id_kategori', 'ID Kategori', 'required|trim',
				array(
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> ID Kategori Tidak Boleh Kosong.</div>'
					)
			);
		$this->form_validation->set_rules('sekilas', 'Sekilas', 'required|trim',
				array(
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> Isikan Sekilas tentang Wisata Ini.</div>'
					)
			);

		//jika validai berhasil
		if ($this->form_validation->run()==TRUE) {
			//konfigurasi library upload
			$config['upload_path'] 		= './assets/images/';
			$config['allowed_types'] 	= 'gif|jpg|png';
			$config['max_size']     	= 1000000000;
			$config['max_width'] 		= 10240;
			$config['max_height'] 		= 7680;
			$this->load->library('upload', $config);

			//jika upload gagal
			if ( ! $this->upload->do_upload('gambar'))
            {
            	$data['error'] 		= $this->upload->display_errors();
            	$data['judul']		= "EDIT || WISATA || ADMIN || WISATA BOJONEGORO";
				$data['aktif']		= "ws";
				$data['wisata']		= $this->M_wisata->edit($id_wisata)->row_array();
				$data['kategori']	= $this->M_kategori->all()->result();
				$this->load->view('admin/wisata/edit', $data);

			//jika upload berhasil
			}else{
				$gambar 		= $this->upload->data();
				$gambar_lama 	= $this->input->post('gambar_lama');
				//select dari database untuk mengambil nama gambar thumb
				$gb 	= $this->M_wisata->select($id_wisata)->row_array();
				//select dari database untuk mengambil nama gambar asli
				$gb2	= $this->M_wisata->selectgb($id_wisata)->row_array();
				//direktori tempat gambar disimpan
				$dir 	= './assets/images/'.$gb['gambar'];
				$dir2 	= './assets/images/'.$gb2['gb2'];
				//menghapus gambar di direktori ketika update
				unlink($dir);
				unlink($dir2);
				//load library image
				$this->load->library('image_lib');
				//konfigurasi
				$this->image_lib->initialize(array(
                    'image_library' => 'gd2',
                    'source_image' => './assets/images/'.$gambar['file_name'],
                    'maintain_ratio' => true,
                    'create_thumb' => true,
                    'quality' => '20%',
                    'width' => 240
                ));

				//jika resize berhasil
                if($this->image_lib->resize())
                {
                   	$this->M_wisata->edit_proses($id_wisata, $gambar['raw_name'].'_thumb'.$gambar['file_ext']);
					$this->session->set_flashdata('suksesedit','1');
					redirect('wisata');
				//jika resize gagal
                }else{
                    $data['error'] 		= $this->image_lib->display_errors();
                    $data['judul']		= "EDIT || WISATA || ADMIN || WISATA BOJONEGORO";
					$data['aktif']		= "ws";
					$data['wisata']		= $this->M_wisata->edit($id_wisata)->row_array();
					$data['kategori']	= $this->M_kategori->all()->result();
					$this->load->view('admin/wisata/edit', $data);
                }
			}

		//jika validasi gagal
		}else{
			$data['judul']		= "EDIT || WISATA || ADMIN || WISATA BOJONEGORO";
			$data['aktif']		= "ws";
			$data['wisata']		= $this->M_wisata->edit($id_wisata)->row_array();
			$data['kategori']	= $this->M_kategori->all()->result();
			$this->load->view('admin/wisata/edit', $data);
		}
	}

	public function hapus($id_wisata)
	{
		if ($this->session->userdata('hak_akses') != 'admin') {
			redirect('home');
		}

		//select nama gambar thumb dari database
		$gb 	= $this->M_wisata->select($id_wisata)->row_array();
		//select nama gambar asli dari database
		$gb2	= $this->M_wisata->selectgb($id_wisata)->row_array();
		//direktori tempat menyimpan file
		$dir 	= './assets/images/'.$gb['gambar'];
		$dir2 	= './assets/images/'.$gb2['gb2'];
		//delete gambar pada direktori ketika mengahapus data
		unlink($dir);
		unlink($dir2);
		$this->M_wisata->hapus($id_wisata);
		$this->session->set_flashdata('sukseshapus', '1');
		redirect('wisata');
	}

	public function select($id_wisata)
	{
		$data['judul'] = 'WISATA || WISATA BOJONEGORO';
		$data['drop'] = 'wisata';
		$data['aktif'] = '';
		$data['k'] = $this->M_kategori->all()->result();
		$data['w'] = $this->M_wisata->all()->result();
		$data['wis']	= $this->M_wisata->select($id_wisata)->row_array();
		$data['gb2']	= $this->M_wisata->selectgb($id_wisata)->row_array();
		$this->load->view('wisata',$data);
	}

	public function data_server()
	{
		$this->load->library('Datatables');
		$this->datatables->select('wisata.id_wisata, wisata.nama_wisata, kategori.nama_kategori, wisata.gambar');
		$this->datatables->from('wisata, kategori');
		$this->datatables->where('wisata.id_kategori = kategori.id_kategori');
		echo $this->datatables->generate();
	}

}
/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
