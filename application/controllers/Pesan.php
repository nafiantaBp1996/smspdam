<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('tagihan_model');
		$this->load->library('session');
		$this->load->library('curl');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('report_model');
		$this->load->model('pelanggan_model');

	}

	public function index()
	{
		$this->load->view('komponen/header');
		$this->load->view('kirimpesan/index');
		$this->load->view('komponen/footer');
	}

	public function templatePesan()
	{
		$data['pesan']=$this->pelanggan_model->daftarPesan();
		$this->load->view('komponen/header');
		$this->load->view('kirimpesan/templatePesan',$data);
		$this->load->view('komponen/footer');
	}

	public function getPesan($id){
        $data=$this->pelanggan_model->daftarPesanId($id);
        echo json_encode($data);
    }

    public function editpesan()
    {
    	$this->pelanggan_model->updatePesan();
    	sleep(1);
    	redirect('pesan/templatePesan','refresh');
    }

    public function addpesan()
    {
    	$this->pelanggan_model->insertPesan();
    	sleep(1);
    	redirect('pesan/templatePesan','refresh');
    }

    public function erasepesan($id)
    {
    	$this->pelanggan_model->erasePesan($id);
    	redirect('pesan/templatePesan','refresh');
    }

    public function kirim()
    {
    	$var='';
	    $data=$this->pelanggan_model->daftarpelangganfilter($this->input->post('query'));
	    foreach ($data as $key) {
	    	if(strlen($key->nohp)>10 && strlen($key->nohp)<14)
	    	{
	    		$var=$var.$this->hp($key->nohp).",";
	    	}
	    }
	    $kode_pengiriman=$this->randomString(2)."BRC".date('ymd');
	    $nohpsub=substr($var,0,-1);
	    if($nohpsub!="")
	    {
		    $content=str_replace(" ", "%20", $this->input->post('textpesan'));
	        $fields_string ="account=eimspdamprob&password=pdamprob2018&numbers=".$nohpsub."&content=".$content;
	        $insert=$this->curl->simple_post('http://103.81.246.52:20003/sendsms?'.$fields_string, array(CURLOPT_BUFFERSIZE => 10)); 
	        $stts=json_decode($insert);
	        if ($stts->status=='0')
	        {
	        	$this->report_model->insertBr($kode_pengiriman,"BRDCST",$content." - ".$insert,'1',$stts->success);
	        }
	        else
	        {
	            $this->report_model->insert($kode_pengiriman,"BRDCST",$content."-".$insert,'0');
	        }
	    }
	    else
	        {
	            $this->report_model->insert($kode_pengiriman,$key->nosamb,$insert,'0');
	        }
        redirect("report/last/$kode_pengiriman");
    }
	public function broadcast()
	{
		if($this->input->post("chknosamb")=='checked'||
		   $this->input->post("chkrayon")=='checked'||
		   $this->input->post("chkkelurahan")=='checked'||
		   $this->input->post("chkgolongan")=='checked')
		{
			$this->load->model('Pelanggan_Model');
			$data['daftarpelanggan']=$this->Filter()[0];
			$data['que']=$this->Filter()[1];
			$data['rayon']=$this->Pelanggan_Model->daftarrayon();
			$data['pesan']=$this->Pelanggan_Model->daftarPesan();
			$data['kelurahan']=$this->Pelanggan_Model->daftarkelurahan();
			$data['golongan']=$this->Pelanggan_Model->daftargolongan();
			$this->load->view('komponen/header');
			$this->load->view('kirimpesan/broadcast',$data);
			$this->load->view('komponen/footer');

		}
		else
		{
			$this->load->model('Pelanggan_Model');
			$data['daftarpelanggan']=array();
			$data['que']=null;
			$data['rayon']=$this->Pelanggan_Model->daftarrayon();
			$data['pesan']=$this->Pelanggan_Model->daftarPesan();
			$data['kelurahan']=$this->Pelanggan_Model->daftarkelurahan();
			$data['golongan']=$this->Pelanggan_Model->daftargolongan();
			$this->load->view('komponen/header');
			$this->load->view('kirimpesan/broadcast',$data);
			$this->load->view('komponen/footer');

		}
	}

	public function Filter()
	{
		$var="";
		$data=null;
		if($this->input->post("chknosamb")=='checked')
		{
			$nosamb=$this->input->post('nos');
			$var=$var." AND nosamb='$nosamb' ";

		}
		if($this->input->post("chkrayon")=='checked')
		{
			$rayon=$this->input->post('selrayon');
			$var=$var." AND koderayon='$rayon' ";

		}
		if($this->input->post("chkkelurahan")=='checked')
		{
			$kelurahan=$this->input->post('selkelurahan');
			$var=$var." AND kodekelurahan='$kelurahan' ";

		}
		if($this->input->post("chkgolongan")=='checked')
		{
			$golongan=$this->input->post('selgolongan');
			$var=$var." AND kodegol='$golongan' ";

		}
		$data=$this->pelanggan_model->daftarpelangganfilter($var);
		$dataarr=array($data,$var);
		return $dataarr;
	}

	function hp($nohp) {
     // kadang ada penulisan no hp 0811 239 345
     $nohp = str_replace(" ","",$nohp);
     // kadang ada penulisan no hp (0274) 778787
     $nohp = str_replace("(","",$nohp);
     // kadang ada penulisan no hp (0274) 778787
     $nohp = str_replace(")","",$nohp);
     // kadang ada penulisan no hp 0811.239.345
     $nohp = str_replace(".","",$nohp);
     $hp=$nohp;
     // cek apakah no hp mengandung karakter + dan 0-9
     if(!preg_match('/[^+0-9]/',trim($nohp))){
         // cek apakah no hp karakter 1-3 adalah +62
         if(substr(trim($nohp), 0, 3)=='62'){
             $hp = trim($nohp);
         }
         // cek apakah no hp karakter 1 adalah 0
         elseif(substr(trim($nohp), 0, 1)=='0'){
             $hp = '62'.substr(trim($nohp), 1);
         }
     }
     return $hp;
 }
 function randomString($length) 
    {
        $str = "";
        $characters = array_merge(range('A','Z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;   
	}
}

/* End of file Pesan.php */
/* Location: ./application/controllers/Pesan.php */