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

	public function Filter()
	{
		$this->load->model('tagihan_model');
		$data['dataPelanggan']=$this->tagihan_model->Filter('');
		$data['title']="Filter Data";
		$data['status']=0;
		$data['awal']=0;
		$data['akhir']=100;
		$this->load->view('komponen/header');
		$this->load->view('tagihan/filter',$data);
		$this->load->view('komponen/footer');
	}

	public function FilterData()
	{
		$var="";
		$data=null;
		$this->load->model('tagihan_model');
		if($this->input->post("chknosamb")=='checked')
		{
			$nosamb=$this->input->post('nos');
			$var=$var." AND pelanggan.nosamb='$nosamb' ";

		}
		if($this->input->post("chktagihan")=='checked')
		{
			$tagihan=$this->input->post('tag');$tagmax=$this->input->post('tagmax');
			$var=$var." AND lmbr BETWEEN '$tagihan' AND '$tagmax'";
		}
		if($this->input->post("chktotal")=='checked')
		{
			$totmax=$this->input->post('totmax');$totmin=$this->input->post('totmin');
			$var=$var." AND total BETWEEN '$totmin' AND '$totmax' ";
		}

		$data=$this->tagihan_model->Filter($var);
		foreach ($data as $key){
				echo $key->nosamb."-".$key->total.'-'.$key->lmbr."<br>";	
			}
		echo $var;
		}

			
	}

/* End of file Tagihan.php */
/* Location: ./application/controllers/Tagihan.php */
