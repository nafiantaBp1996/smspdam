<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function index()
	{
		// load siswa_model
		$this->load->model('pelanggan_model');
		// Database 1
		$data['data1'] = $this->pelanggan_model->get_db1();
		// Database 2
		$data['data2'] = $this->pelanggan_model->get_db2();

		$this->load->view('pelanggan', $data);
	}

}

/* End of file pelanggan.php */
/* Location: ./application/controllers/pelanggan.php */