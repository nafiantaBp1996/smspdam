<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller {

	public function index()
	{
		$this->load->view('komponen/header');
		$this->load->view('tagihan/index');
		$this->load->view('komponen/footer');
	}

}

/* End of file Tagihan.php */
/* Location: ./application/controllers/Tagihan.php */