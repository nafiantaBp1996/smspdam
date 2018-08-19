<?php

class Curlsms extends CI_Controller {

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

    function rupiah($angka){
  
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;}

	function kirim(){
				$numbers=$_POST['nohp'];
				$content=str_replace(" ", "%20", $_POST['content']);
                if(strlen($numbers)>10 && strlen($numbers)<14){
    		    	$fields_string ="account=eimspdamprob&password=pdamprob2018&numbers=".$numbers."&content=".$content;
                	$insert=$this->curl->simple_post('http://103.81.246.52:20003/sendsms?'.$fields_string, array(CURLOPT_BUFFERSIZE => 10)); 
                    $stts=json_decode($insert);
                     if ($stts->status=='0') {
                        $this->report_model->insert("XXXXXXX",'--',$numbers.$insert,'1');

                     }
                    else
                    {
                        $this->report_model->insert("XXXXXXX",'--',$numbers.$insert,'0');
                    }
                }
                else
                {
                     $this->report_model->insert("XXXXXXX",'--','nomor salah','0');
                }         
	}

    function pesan($nosamb)
    {
        $fields_string=""; 
        $data=$this->tagihan_model->tagihanPelangganId($nosamb);
        $jmlData=count($data);
        $kode_pengiriman=$this->randomString(4);
        if(strlen($data[0]->nohp)>10 && strlen($data[0]->nohp)<14)
            {
                $nama=$data[0]->nama;
                if (strlen($data[0]->nama)>15) {
                    $nama = substr($data[0]->nama, 0, 15);
                }
                $cont = "PDAM KOTA PROBOLINGGO - Yth ".$nama.", SA.".$data[0]->nosamb." Tagihan Anda Saat ini ".$data[0]->lmbr." bulan sebesar : ".$this->rupiah($data[0]->total)." info lebih Lanjut :  bit.ly/pdamprob";
                $content=str_replace(" ", "%20", $cont);
                $fields_string ="account=eimspdamprob&password=pdamprob2018&numbers=".$this->hp($data[0]->nohp)."&content=".$content;
                $insert=$this->curl->simple_post('http://103.81.246.52:20003/sendsms?'.$fields_string, array(CURLOPT_BUFFERSIZE => 10)); 
                $stts=json_decode($insert);
                 if ($stts->status=='0') {
                    $this->report_model->insert($kode_pengiriman,$key->nosamb,$insert,'1');
                    sleep(3);

                 }
                else
                {
                    $this->report_model->insert($kode_pengiriman,$key->nosamb,$insert,'0');
                }
            }
            else
            {
                $insert='Nomor Tidak Ada';
                $this->report_model->insert($kode_pengiriman,$key->nosamb,$insert,'0');
            }
            redirect("report/last/$kode_pengiriman");
    }

	function broadcast()
	{
        $limit=$this->input->post('akhir')-$this->input->post('awal');
		$fields_string="";
		$data=$this->tagihan_model->tagihanPelanggan($this->input->post('status'),$limit,$this->input->post('awal'));
		$jmlData=count($data);
        $kode_pengiriman=$this->randomString(4);
		foreach($data as $key){
			if(strlen($key->nohp)>10 && strlen($key->nohp)<14)
			{
				$nama=$key->nama;
				if (strlen($key->nama)>=16) {
					$nama = substr($key->nama, 0, 15);
				}
				$cont = "Plg.Yth ".$nama.", SA.".$key->nosamb." Tagihan Anda Saat ini ".$key->lmbr." bulan sebesar : ".$this->rupiah($key->total)." info:  bit.ly/pdamprob - abaikan sms ini jika sudah membayar";
				$content=str_replace(" ", "%20", $cont);
            	$fields_string ="account=eimspdamprob&password=pdamprob2018&numbers=".$this->hp($key->nohp)."&content=".$content;
            	$insert=$this->curl->simple_post('http://103.81.246.52:20003/sendsms?'.$fields_string, array(CURLOPT_BUFFERSIZE => 10));
                sleep(1); 
            	$stts=json_decode($insert);
            	 //var_dump($insert);
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

}

/* End of file Kontak.php */
/* Location: ./application/controllers/Kontak.php */