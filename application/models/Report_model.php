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

	public function getSendDataLocal()
	{
		$query=$this->db->query("SELECT pelanggan.`nama`,`pelanggan`.`nohp`,senddata.* FROM senddata LEFT JOIN pelanggan ON senddata.nosamb=pelanggan.`nosamb` ORDER BY tglbayar DESC");
		return $query->result();
	}

	public function getSendDataCloud()
	{
		$dbcloud = $this->load->database('cloud',TRUE);
		$query=$dbcloud->query("SELECT * FROM senddata ORDER BY tglbayar DESC");
		return $query->result();
	}

	public function getReport($kode_pengiriman)
	{

		$query=$this->db->query("SELECT	kode_pengiriman,COUNT(IF(`status`= 0,1,NULL)) AS gagal ,COUNT(IF(`status`= 1,1,NULL)) AS berhasil,tgl_kirim FROM report_sms WHERE kode_pengiriman = '$kode_pengiriman'");
		return $query->result();
	}

	public function report_drd()
	{	
		$tgl=date('Ymd');
		$query=$this->db->query("SELECT COUNT(id) AS total, COUNT(IF(`status`= 4,1,NULL)) AS nonumber,COUNT(IF(`status`= 3,1,NULL)) AS gagal,COUNT(IF(`status`= 2,1,NULL)) AS sukses FROM report_sms WHERE DATE_FORMAT(tgl_kirim,'%Y%m%d')='$tgl'");
		return $query->result();
	}
	public function deleteDataLocal($id)
	{
		$this->db->where('kode', $id);
		$this->db->delete('senddata');
	}
	public function deleteDataCloud($id)
	{
		$dbcloud = $this->load->database('cloud',TRUE);
		$dbcloud->where('kode', $id);
		$dbcloud->delete('senddata');
	}

	public function insert($kode_pengiriman,$nosamb,$text,$status)
	{
		$data=array('kode_pengiriman' => $kode_pengiriman ,
					'nosamb' => $nosamb ,
					'status' => $status ,
					'text' => $text ,
					'tgl_kirim' => date('ymdhis'));
		$this->db->insert('report_sms', $data);
	}
	public function insertServerToLocal($data)
	{
		$this->db->insert('senddata', $data);
	}

}

/* End of file report_model.php */
/* Location: ./application/models/report_model.php */