<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_pegawai');

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
		$data['all'] 	= $this->M_pegawai->all()->result();
		$data['aktif']		= "pegawai";
		$data['judul']		= "WISATA || ADMIN || PEGAWAI";
		$this->load->view('admin/pegawai/index', $data);
	}

	public function tambah()
	{
		$data['judul'] = "WISATA || ADMIN || PEGAWAI";
		$data['aktif'] = "pegawai";

		$this->form_validation->set_rules('nama_pegawai', 'Nama', 'required|trim',
				array(
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> Nama Tidak Boleh Kosong.</div>'
					)
			);
		$this->form_validation->set_rules('nip', 'NIP', 'required|trim|is_unique[pegawai.nip]|integer',
				array(
					'is_unique' => '<div class="alert alert-danger"><strong>Error!</strong> Data Gagal Diinputkan. NIP sudah ada</div>',
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> NIP Tidak Boleh Kosong.</div>',
					'integer' => '<div class="alert alert-danger"><strong>Error!</strong> NIP harus Angka.</div>'
					)
			);
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim',
				array(
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> Tanggal Tidak Boleh Kosong.</div>'
					)
			);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim',
				array(
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> Isikan Aamat Pegawai</div>'
					)
			);

		//jika validasi gagal
		if ($this->form_validation->run()==FALSE) {
			$data['all'] = $this->M_pegawai->all()->result();
			$data['modal_show'] = "$('#myModal').modal('show');";
			$this->session->set_flashdata('errortambah','1');
			$this->load->view('admin/pegawai/index', $data);
		//jika validasi berhasil
		}else{

			//setting config untuk library upload
			$config['upload_path'] 		= './assets/images/pegawai/';
			$config['allowed_types'] 	= 'gif|jpg|png';
			$config['max_size']     	= 1000000000;
			$config['max_width'] 		= 10240;
			$config['max_height'] 		= 7680;

			//pemanggilan librabry upload
			$this->load->library('upload', $config);

			//jika upload gagal
			if ( ! $this->upload->do_upload('foto'))
            {
                $data['all'] = $this->M_pegawai->all()->result();
				$data['modal_show'] = "$('#myModal').modal('show');";
				$this->session->set_flashdata('errortambah','1');
				$this->load->view('admin/pegawai/index', $data);
			//jika upload berhasil
            }else{
            	$foto = $this->upload->data();

            	//memanggil library image
				$this->load->library('image_lib');
				//setting konfigurasi image_lib
				$this->image_lib->initialize(array(
                    'image_library' => 'gd2',
                    'source_image' => './assets/images/pegawai/'. $foto['file_name'],
                    'maintain_ratio' => true,
                    'create_thumb' => true,
                    'quality' => '20%',
                    'width' => 240
                ));

				//jika fungsi resize image berhasil dijalankam
                if($this->image_lib->resize())
                {
                	//menyimpan kedalam database
                   	$this->M_pegawai->tambah($foto['raw_name'].'_thumb'.$foto['file_ext']);
					$this->session->set_flashdata('suksestambah','1');
					redirect('pegawai');

				//jika fung resize image gagal
                }else{
                    $data['error'] 		= $this->image_lib->display_errors();
					$data['all'] = $this->M_pegawai->all()->result();
					$data['modal_show'] = "$('#myModal').modal('show');";
					$this->session->set_flashdata('errortambah','1');
					$this->load->view('admin/pegawai/index', $data);
                }
			}
		}
	}

	public function edit($id_pegawai)
	{
		$data['judul']		= "EDIT || PEGAWAI || ADMIN || WISATA BOJONEGORO";
		$data['aktif']		= "pegawai";
		$data['pegawai']		= $this->M_pegawai->edit($id_pegawai)->row_array();
		$this->load->view('admin/pegawai/edit', $data);
	}

	public function edit_proses($id_pegawai)
	{
		$this->form_validation->set_rules('nama_pegawai', 'Nama', 'required|trim',
				array(
					'required' => '<div class="alert alert-danger"><strong>Error!</strong> Nama Tidak Boleh Kosong.</div>'
					)
			);
		$this->form_validation->set_rules('tanggal', 'Tanggal Lahir', 'required|trim',
				array(
					'required' => '<div class="alert alert-danger"><strong>Error!</strong>Tanggal Lahir Tidak Boleh Kosong.</div>'
					)
			);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim',
				array(
					'required' => '<div class="alert alert-danger"><strong>Error!</strong>Alamat Tidak Boleh Kosong.</div>'
					)
			);

		//jika validai berhasil
		if ($this->form_validation->run()==TRUE) {
			//konfigurasi library upload
			$config['upload_path'] 		= './assets/images/pegawai/';
			$config['allowed_types'] 	= 'gif|jpg|png';
			$config['max_size']     	= 1000000000;
			$config['max_width'] 		= 102400;
			$config['max_height'] 		= 76800;
			$this->load->library('upload', $config);

			//jika upload gagal
			if ( ! $this->upload->do_upload('foto'))
            {
            	$data['error'] 		= $this->upload->display_errors();
            	$data['judul']		= "EDIT || PEGAWAI || ADMIN || WISATA BOJONEGORO";
				$data['aktif']		= "pegawai";
				$data['pegawai']	= $this->M_pegawai->edit($id_pegawai)->row_array();
				$this->load->view('admin/pegawai/edit', $data);

			//jika upload berhasil
			}else{
				$foto 		= $this->upload->data();
				$foto_lama 	= $this->input->post('foto_lama');
				//select dari database untuk mengambil nama foto thumb
				$gb 	= $this->M_pegawai->select($id_pegawai)->row_array();
				//select dari database untuk mengambil nama foto asli
				$gb2	= $this->M_pegawai->selectgb($id_pegawai)->row_array();
				//direktori tempat foto disimpan
				$dir 	= './assets/images/pegawai/'.$gb['foto'];
				$dir2 	= './assets/images/pegawai/'.$gb2['gb2'];
				//menghapus foto di direktori ketika update
				unlink($dir);
				unlink($dir2);
				//load library image
				$this->load->library('image_lib');
				//konfigurasi
				$this->image_lib->initialize(array(
                    'image_library' => 'gd2',
                    'source_image' => './assets/images/pegawai/'.$foto['file_name'],
                    'maintain_ratio' => true,
                    'create_thumb' => true,
                    'quality' => '20%',
                    'width' => 240
                ));

				//jika resize berhasil
                if($this->image_lib->resize())
                {
                   	$this->M_pegawai->edit_proses($id_pegawai, $foto['raw_name'].'_thumb'.$foto['file_ext']);
					$this->session->set_flashdata('suksesedit','1');
					redirect('pegawai');
				//jika resize gagal
                }else{
                    $data['error'] 		= $this->image_lib->display_errors();
                    $data['judul']		= "EDIT || PEGAWAI || ADMIN || WISATA BOJONEGORO";
					$data['aktif']		= "pegawai";
					$data['pegawai']	= $this->M_pegawai->edit($id_pegawai)->row_array();
					$this->load->view('admin/pegawai/edit', $data);
                }
			}

		//jika validasi gagal
		}else{
			$data['judul']		= "EDIT || PEGAWAI || ADMIN || WISATA BOJONEGORO";
			$data['aktif']		= "pegawai";
			$data['pegawai']		= $this->M_pegawai->edit($id_pegawai)->row_array();
			$this->load->view('admin/pegawai/edit', $data);
		}
	}

	public function hapus($id_pegawai)
	{
		//select nama gambar thumb dari database
		$gb 	= $this->M_pegawai->select($id_pegawai)->row_array();
		//select nama gambar asli dari database
		$gb2	= $this->M_pegawai->selectgb($id_pegawai)->row_array();
		//direktori tempat menyimpan file
		$dir 	= './assets/images/'.$gb['gambar'];
		$dir2 	= './assets/images/'.$gb2['gb2'];
		//delete gambar pada direktori ketika mengahapus data
		unlink($dir);
		unlink($dir2);
		$this->M_pegawai->hapus($id_pegawai);
		$this->session->set_flashdata('sukseshapus', '1');
		redirect('pegawai');
	}

	public function cetakPDF()
	{
		$this->load->model('M_cetak'); //me load model M_cetak
		$this->load->library('dompdf_gen'); //me load ibrary dompdf_gen yang telah di copy kan
		$data['pegawai']	= $this->M_cetak->all()->result(); //mengabil data dari M_cetak
		$this->load->view('admin/pegawai/print', $data); //me load view admin/pegawai/print

		$dompdf 			= new DOMPDF(); //membuat objek baru bernama $dompdf

		$paper_size		= 'A4'; //membuat variabel untuk menampung data settingan paper_size
		$orientation	= 'landscape'; //membuat variabel untuk menampung data settingan orientation
		$this->dompdf->set_paper($paper_size, $orientation); //mengeksekusi fungsi set_paper

		$html 				= $this->output->get_output();
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream('laporan_pegawai.pdf', array('Attachment' => 0)); //fungsi untuk mencetak
		unset($html);
		unset($dompdf);
	}

}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */
