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
	public function Last($limit)
	{
		$this->load->model('report_model');
		$data['report']=$this->report_model->gets($limit);
		
		$this->load->view('komponen/header');
		$this->load->view('report/index', $data);
		$this->load->view('komponen/footer');	
	}

	public function dbcheck()
	{
		$this->load->model('tagihan_model');
		if($this->tagihan_model->dbconnect('192.168.0.252','drdpdam.db', 'root', ''))
		{
			redirect('home','refresh');
		}
		else
		{
			redirect('homes','refresh');
		}
	}

	
	
}

/* End of file pelanggan.php */
/* Location: ./application/controllers/pelanggan.php */