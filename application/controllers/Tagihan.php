<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller {

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

	}

	// List all your items
	public function lancar()
	{
		if($this->input->post('awal')==null || $this->input->post('akhir')==null)
		{
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

	public function filter()
	{
		if($this->input->post('nos')==null&&$this->input->post('tag')==null&&$this->input->post("chktotal")==null)
		{
			$data['dataPelanggan']=$this->FilterData();
			$data['title']="Filter Data";
			$data['nosamb']=null;
			$data['tagmin']=null;
			$data['tagmax']=null;
			$data['totmin']=null;
			$data['totmax']=null;
			$data['chknosamb']=null;
			$data['chktotal']=null;
			$data['chktagihan']=null;
			$this->load->view('komponen/header');
			$this->load->view('tagihan/filter',$data);
			$this->load->view('komponen/footer');	
		}
		else
		{
			$data['dataPelanggan']=$this->FilterData();
			$data['title']="Filter Data";
			$data['nosamb']=$this->input->post('nos');
			$data['tagmin']=$this->input->post('tag');
			$data['tagmax']=$this->input->post('tagmax');
			$data['totmin']=$this->input->post('totmin');
			$data['totmax']=$this->input->post('totmax');
			$data['chknosamb']=$this->input->post("chknosamb");
			$data['chktotal']=$this->input->post("chktotal");
			$data['chktagihan']=$this->input->post("chktagihan");
			$this->load->view('komponen/header');
			$this->load->view('tagihan/filter',$data);
			$this->load->view('komponen/footer');
		}
		
	}

	public function filterData()
	{
		$var="";
		$data=null;
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
		return $data;
	}

	function broadcastFilter()
	{	
		$fields_string="";
		$data=$this->filterData();
		$jmlData=count($data);
        $kode_pengiriman=$this->randomString(4);
		foreach($data as $key){
			if(strlen($key->nohp)>10 && strlen($key->nohp)<14)
			{
				$nama=$key->nama;
				if (strlen($key->nama)>15) {
					$nama = substr($key->nama, 0, 15);
				}
				$cont = "Plg.Yth ".$nama.", SA.".$key->nosamb." Tagihan Anda Saat ini ".$key->lmbr." bulan sebesar : ".$this->rupiah($key->total)." info:  bit.ly/pdamprob - abaikan sms ini jika sudah membayar";
				$content=str_replace(" ", "%20", $cont);
            	$fields_string ="account=eimspdamprob&password=pdamprob2018&numbers=".$this->hp($key->nohp)."&content=".$content;
            	$insert=$this->curl->simple_post('http://103.81.246.52:20003/sendsms?'.$fields_string, array(CURLOPT_BUFFERSIZE => 10));
                sleep(1); 
            	$stts=json_decode($insert);
            	 if ($stts->status=='0') {
            	 	$this->report_model->insert($kode_pengiriman,$key->nosamb,$insert."-".$cont,'1');

            	 }
            	else
            	{
            		$this->report_model->insert($kode_pengiriman,$key->nosamb,$insert."-".$cont,'0');
            	}
            }
            else
            {
            	$insert='Nomor Tidak Ada';
            	$this->report_model->insert($kode_pengiriman,$key->nosamb,$insert,'0');
            }
        }
         redirect("report/last/$kode_pengiriman");
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
     $hp='';
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
        $rand=$str.date('ymd');
        return $rand;
    }
 function rupiah($angka){
  
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;}   

}


/* End of file Tagihan.php */
/* Location: ./application/controllers/Tagihan.php */
