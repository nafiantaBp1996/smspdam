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

	public function truncateSenddata()
	{
		$this->db->truncate('senddata');
	}

	public function insert($nosamb,$text,$status)
	{
		$data=array('nosamb' => $nosamb ,
					'status' => $status ,
					'text' => $text ,
					'tgl_kirim' => date('YmdHis'));
		$this->db->insert('report_sms', $data);
	}

}

/* End of file report_model.php */
/* Location: ./application/models/report_model.php */