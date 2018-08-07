<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('tagihan_model');

	}

	// List all your items
	public function lancar()
	{
		$this->load->model('tagihan_model');
		$data['dataPelanggan']=$this->tagihan_model->tagihanPelanggan('1');
		$data['title']="Pelanggan Lancar";
		//$data="";
		$this->load->view('komponen/header', $data);
		$this->load->view('tagihan/index',$data);
		$this->load->view('komponen/footer');
	}
	public function tidaklancar()
	{
		$this->load->model('tagihan_model');
		$data['dataPelanggan']=$this->tagihan_model->tagihanPelanggan('0');
		$data['title']="Pelanggan Tidak Lancar";
		//$data="";
		$this->load->view('komponen/header', $data);
		$this->load->view('tagihan/index',$data);
		$this->load->view('komponen/footer');
	}

	// Add a new item
	public function add()
	{

	}

	//Update one item
	public function update( $id = NULL )
	{

	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Tagihan.php */
/* Location: ./application/controllers/Tagihan.php */
