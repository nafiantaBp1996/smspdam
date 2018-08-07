<?php

class Sms extends CI_Controller {

	var $API = "";

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->API="http://103.81.246.52:20003/sendsms?";
		$this->load->library('session');
		$this->load->library('curl');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('kontak_model');
		$this->load->model('tagihan_model');
	}

	function index()
	{
		$data['datakontak'] = json_decode($this->curl->simple_get($this->API.'/kontak'));
		$this->load->view('kontak/list', $data);
	}

	function create()
	{
		if (isset($_POST['submit'])) {
			$data = array(
			'id' => $this->input->post('id'),
			'nama' => $this->input->post('nama'),
			'nomor' => $this->input->post('nomor'), 
		);
		$insert = $this->curl->simple_post($this->API.'/kontak', $data, array(CURLOPT_BUFFERSIZE => 10));
			if ($insert) {
				$this->session->set_flashdata('hasil', 'Insert Data Berhasil');
			} else {
				$this->session->flashdata('hasil', 'Insert Data Gagal');
			}
			redirect('kontak');
		} else {
			$this->load->view('kontak/create');
		}		
	}

	function creates()
	{
		$fields_string="";
		if (isset($_POST['submit'])) {
			$data = array(
				'api_key' => urlencode("88e9bb77") ,
				'api_secret'=> urlencode("TBSHez8xS4lGk23C"),
				'to'=> $this->input->post('to'),
				'from'=> $this->input->post('from') ,
				'text'=> $this->input->post('text') 
			);
		$insert = $this->curl->simple_post("https://rest.nexmo.com/sms/json?", $data, array(CURLOPT_BUFFERSIZE => 10));
		var_dump($insert);
			if ($insert) {
				$this->session->set_flashdata('hasil', 'Insert Data Berhasil');
			} else {
				$this->session->flashdata('hasil', 'Insert Data Gagal');
			}
			$this->load->view('kontak/create');
		} else {
			$this->load->view('kontak/create');
		}		
	}

	function rupiah($angka){
  
  	$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  	return $hasil_rupiah;
 
		}
	function kirim(){
		$fields_string="";
		if (isset($_POST['submit'])) {
				$numbers=$this->input->post('numbers');
				$content=str_replace(" ", "%20", $this->input->post('content'));
		    	$fields_string ="account=eimspdamprob&password=123456&numbers=".$numbers."&content=".$content;
            	//echo 'http://103.81.246.52:20003/sendsms?'.$fields_string;
            	//echo $content."Success";
            	echo "<br>";
            	$insert=$this->curl->simple_post('http://103.81.246.52:20003/sendsms?'.$fields_string, array(CURLOPT_BUFFERSIZE => 10)); 
            	var_dump($insert);
            	//echo "<br>";
			$this->load->view('kontak/crat');
		}
		else {
			$this->load->view('kontak/crat');
		}		
	}

	function creat()
	{
		$fields_string="";
		if (isset($_POST['submit'])) {

		//$content=str_replace(" ", "%20", $this->input->post('content'));
		//$data=$this->kontak_model->loadData();
		$data=$this->tagihan_model->tagihanPelanggan('1');
		//echo $data[0]->nama;
		foreach($data as $key){
			if(strlen($key->nohp)>10 && strlen($key->nohp)<14)
			{
				$content = "Kpd Yth ".$key->nama." Tagihan PDAM anda selama ". $key->lmbr." bulan pada bulan ".$key->periodemin." - ". $key->periodemax ." sebesar ".$this->rupiah($key->total); 
            	//$fields_string ="account=eimspdamprob&password=123456&numbers=".$key->nomor."&content=".$content;
            	//echo 'http://103.81.246.52:20003/sendsms?'.$fields_string;
            	echo $content."Success"; echo date('H:i:s');
            	echo "<br>";
            	sleep(1);
            	//$insert=$this->curl->simple_post('http://103.81.246.52:20003/sendsms?'.$fields_string, array(CURLOPT_BUFFERSIZE => 10)); 
            	//var_dump($insert);
            	//echo "<br>";
            }
            else
            {
            	$content = "Kpd Yth ".$key->nama." Tagihan PDAM anda selama ". $key->lmbr." bulan pada bulan ".$key->periodemin." - ". $key->periodemax ." sebesar ".$this->rupiah($key->total);
            	echo $content."Gagal, Nomor tidak ada";echo date('H:i:s');
            	echo "<br>";
            }
        }
    }
    $this->load->view('kontak/creat');
}

        


}

/* End of file Kontak.php */
/* Location: ./application/controllers/Kontak.php */