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
		$query=$this->db->query("SELECT COUNT(senddata.nosamb) AS bulan,pelanggan.`nama`,`pelanggan`.`nohp`,senddata.nosamb,`senddata`.`tglbayar`,senddata.`loketbayar`,SUM(senddata.total) as total FROM senddata LEFT JOIN pelanggan ON senddata.nosamb=pelanggan.`nosamb` GROUP BY nosamb ORDER BY tglbayar DESC ");
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

	public function getReportDrd($kode_pengiriman,$status)
	{

		$query=$this->db->query("SELECT	* FROM report_sms WHERE kode_pengiriman = '$kode_pengiriman' and status='$status'");
		return $query->result();
	}

	public function report_drd()
	{	
		$tgl=date('Ymd');
		$query=$this->db->query("SELECT COUNT(id) AS total, COUNT(IF(`status`= 4,1,NULL)) AS nonumber,COUNT(IF(`status`= 3,1,NULL)) AS gagal,COUNT(IF(`status`= 2,1,NULL)) AS sukses FROM report_sms WHERE DATE_FORMAT(tgl_kirim,'%Y%m%d')='$tgl' And status between 2 and 4");
		return $query->result();
	}
	public function deleteDataLocal($id)
	{
		$this->db->where('nosamb', $id);
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
					'total' => $status ,
					'tgl_kirim' => date('ymdhis'));
		$this->db->insert('report_sms', $data);
	}

	public function insertBr($kode_pengiriman,$nosamb,$text,$status,$total)
	{
		$data=array('kode_pengiriman' => $kode_pengiriman ,
					'nosamb' => $nosamb ,
					'status' => $status ,
					'text' => $text ,
					'total' => $total ,
					'tgl_kirim' => date('ymdhis'));
		$this->db->insert('report_sms', $data);
	}

	public function insertServerToLocal($data)
	{
		$this->db->insert('senddata', $data);
	}

	public function loadchart()
	{
		$query=$this->db->query("SELECT DATE_FORMAT(tgl_kirim,'%M%Y') AS tgl,SUM(total) AS sukses, COUNT(IF(`status`= 4,1,NULL)) AS nonumber,COUNT(IF(`status`= 3,1,NULL)) AS gagal FROM report_sms WHERE YEAR(tgl_kirim)= YEAR(NOW())  GROUP BY DATE_FORMAT(tgl_kirim,'%Y%m%d')");
		return $query->result();
	}

}

/* End of file report_model.php */
/* Location: ./application/models/report_model.php */