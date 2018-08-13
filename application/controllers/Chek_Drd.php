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
	}

	public function start()
	{	
        if($this->dbconnect('192.168.0.252','drdpdam.db', 'root', ''))
        {
            $this->replypembayaran();
            sleep(2);
            $this->load->view('komponen/header_refresh');
            $this->load->view('tagihan/taskschedule');
            $this->load->view('komponen/footer');
        }
        else
        {
            redirect('chek_Drd/stop','refresh');
        }
			
	}

	public function stop()
	{
		$this->load->view('komponen/header');
		$this->load->view('tagihan/taskschedule');
		$this->load->view('komponen/footer');
	}

    public function dbconnect($servername,$database, $username, $password)
    {
        try {
            $conn = new PDO('mysql:host='.$servername.';dbname='.$database, $username, $password);  
        } catch (Exception $e) {
            return false;
            exit;
        }
        return true;
    }

	function replypembayaran(){
                
        $this->load->model('report_model');
        $data=$this->report_model->getSendData();
        $fields_string="";
        $jmlData=count($data);
        $kode_pengiriman=$this->randomString(4);
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
                    $this->report_model->insert($kode_pengiriman,$key->nosamb,$insert,'1');
                    $this->report_model->deleteData($key->kode);
                    sleep(1);

                 }
                else
                {
                    $this->report_model->insert($kode_pengiriman,$key->nosamb,$insert,'0');
                    $this->report_model->deleteData($key->kode);
                }
            }
                else
                {
                    $insert='Nomor Tidak Ada';
                    $this->report_model->insert($kode_pengiriman,$key->nosamb,$insert,'0');
                    $this->report_model->deleteData($key->kode);
                }
            }

        }
        
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