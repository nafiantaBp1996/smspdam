<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

	public function get()
	{
		$query=$this->db->query("SELECT * FROM report_sms ORDER BY id DESC");
		return $query->result();
	}

	public function gets($limit)
	{
		$query=$this->db->query("SELECT * FROM report_sms ORDER BY id DESC LIMIT $limit");
		return $query->result();
	}

	public function getSendData()
	{

		$query=$this->db->query("SELECT pelanggan.`nama`,`pelanggan`.`nohp`,senddata.* FROM senddata LEFT JOIN pelanggan ON senddata.nosamb=pelanggan.`nosamb` ORDER BY tglbayar DESC");
		return $query->result();
	}

	public function getReport($kode_pengiriman)
	{

		$query=$this->db->query("SELECT	kode_pengiriman,COUNT(IF(`status`= 0,1,NULL)) AS gagal ,COUNT(IF(`status`= 1,1,NULL)) AS berhasil,tgl_kirim FROM report_sms WHERE kode_pengiriman = '$kode_pengiriman'");
		return $query->result();
	}

	

	public function deleteData($id)
	{
		$this->db->where('kode', $id);
		$this->db->delete('senddata');
	}

	public function insert($kode_pengiriman,$nosamb,$text,$status)
	{
		$data=array('kode_pengiriman' => $kode_pengiriman ,
					'nosamb' => $nosamb ,
					'status' => $status ,
					'text' => $text ,
					'tgl_kirim' => date('Ymdhis'));
		$this->db->insert('report_sms', $data);
	}

}

/* End of file report_model.php */
/* Location: ./application/models/report_model.php */