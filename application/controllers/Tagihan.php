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
		if($this->input->post('awal')==null || $this->input->post('akhir')==null)
		{
			$this->load->model('tagihan_model');
			$data['dataPelanggan']=$this->tagihan_model->tagihanPelanggan('1','100','0');
			$data['title']="Pelanggan Lancar";
			$data['status']=1;
			$data['awal']=0;
			$data['akhir']=100;
			//$data="";
			$this->load->view('komponen/header', $data);
			$this->load->view('tagihan/index',$data);
			$this->load->view('komponen/footer');
		}
		else
		{
			$limit=$this->input->post('akhir')-$this->input->post('awal');
			$this->load->model('tagihan_model');
			$data['dataPelanggan']=$this->tagihan_model->tagihanPelanggan('1',$limit,$this->input->post('awal'));
			$data['title']="Pelanggan Lancar";
			$data['status']=1;
			$data['awal']=$this->input->post('awal');
			$data['akhir']=$this->input->post('akhir');
			//$data="";
			$this->load->view('komponen/header', $data);
			$this->load->view('tagihan/index',$data);
			$this->load->view('komponen/footer');
		}
	}
	public function tidaklancar()
	{
		if($this->input->post('awal')==null || $this->input->post('akhir')==null)
		{
			$this->load->model('tagihan_model');
			$data['dataPelanggan']=$this->tagihan_model->tagihanPelanggan('0','100','0');
			$data['title']="Pelanggan Lancar";
			$data['status']=0;
			$data['awal']=0;
			$data['akhir']=100;
			//$data="";
			$this->load->view('komponen/header', $data);
			$this->load->view('tagihan/index',$data);
			$this->load->view('komponen/footer');
		}
		else
		{
			$limit=$this->input->post('akhir')-$this->input->post('awal');
			$this->load->model('tagihan_model');
			$data['dataPelanggan']=$this->tagihan_model->tagihanPelanggan('0',$limit,$this->input->post('awal'));
			$data['title']="Pelanggan Lancar";
			$data['status']=0;
			$data['awal']=$this->input->post('awal');
			$data['akhir']=$this->input->post('akhir');
			//$data="";
			$this->load->view('komponen/header', $data);
			$this->load->view('tagihan/index',$data);
			$this->load->view('komponen/footer');
		}
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
