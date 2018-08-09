<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chek_Drd extends CI_Controller {
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
		$this->load->model('tagihan_model');
		$this->load->model('report_model');
	}

	public function start()
	{	
		$this->replypembayaran();
		sleep(2);
		$this->load->view('komponen/header_refresh');
		$this->load->view('tagihan/taskschedule');
		$this->load->view('komponen/footer');	
	}


    public function starts()
    {   
        try
        {
            $numb = $data=$this->report_model->getSendData()->error();
            if($numb<10)
            {
            throw new Exception ();
            }
            else
            {
                echo "data valid";
            }   
        }
        catch(Exception $e)
        {
            redirect('homes');
        }   
    }

	public function stop()
	{
		$this->load->view('komponen/header');
		$this->load->view('tagihan/taskschedule');
		$this->load->view('komponen/footer');
	}

	function replypembayaran(){
                
        $data=$this->report_model->getSendData();
        $fields_string="";
        $jmlData=count($data);
        if ($jmlData>0)
        {
            foreach($data as $key){
            if(strlen($key->nohp)>10 && strlen($key->nohp)<14)
            {
                $nama=str_replace("'", "",$key->nama);
                if (strlen($key->nama)>15) {
                    $nama = substr($key->nama, 0, 15);
                }
                $cont = "PDAM KOTA PROBOLINGGO: Yth ".$nama." Terima Kasih telah membayar sebesar Rp ".$key->total;
                $content=str_replace(" ", "%20", $cont);
                $fields_string ="account=eimspdamprob&password=pdamprob2018&numbers=".$this->hp($key->nohp)."&content=".$content;
                $insert=$this->curl->simple_post('http://103.81.246.52:20003/sendsms?'.$fields_string, array(CURLOPT_BUFFERSIZE => 10)); 
                $stts=json_decode($insert);
                 if ($stts->status=='0') {
                    $this->report_model->insert($key->nosamb,$insert,'1');
                    sleep(1);

                 }
                else
                {
                    $this->report_model->insert($key->nosamb,$insert,'0');
                }
            }
                else
                {
                    $insert='Nomor Tidak Ada';
                    $this->report_model->insert($key->nosamb,$insert,'0');
                }
                $this->report_model->truncateSenddata();
            }

        }
        
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


}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */