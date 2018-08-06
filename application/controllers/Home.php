<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('komponen/header');
		$this->load->view('kirimpesan/index');
		$this->load->view('komponen/footer');
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */