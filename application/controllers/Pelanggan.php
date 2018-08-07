<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public function index()
	{
		$this->load->model('Pelanggan_Model');
		$data['daftarpelanggan']=$this->Pelanggan_Model->daftarpelanggan();

		$this->load->view('komponen/header');
		$this->load->view('dataplgn/index', $data);
		$this->load->view('komponen/footer');
	}

}

/* End of file pelanggan.php */
/* Location: ./application/controllers/pelanggan.php */