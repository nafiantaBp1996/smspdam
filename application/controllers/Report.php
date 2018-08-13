<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function index()
	{
		$this->load->model('report_model');
		$data['report']=$this->report_model->get();

		$this->load->view('komponen/header');
		$this->load->view('report/index', $data);
		$this->load->view('komponen/footer');
	}
	public function Last($kode_pengiriman)
	{
		$this->load->model('report_model');
		$data['report']=$this->report_model->getReport($kode_pengiriman);
		$this->load->view('komponen/header');
		$this->load->view('report/last', $data);
		$this->load->view('komponen/footer');	
	}	
	
}

/* End of file pelanggan.php */
/* Location: ./application/controllers/pelanggan.php */