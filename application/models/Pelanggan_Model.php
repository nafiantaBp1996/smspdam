<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_Model extends CI_Model {
		

	public function daftarpelanggan()
	{
		$result=$this->db->query("select * from pelanggan limit 10");
		return $result->result();
	}

	public function daftarpelangganfilter($que)
	{
		$q="select nosamb,nama,nohp,alamat,status from pelanggan  WHERE ISNULL(nosamb) = FALSE".$que;
		$result=$this->db->query($q);
		return $result->result();
	}

	public function daftargolongan()
	{
		$result=$this->db->query('SELECT DISTINCT kodegol,golongan FROM golongan ORDER BY kodegol ASC');
		return $result->result();
	}
	public function daftarrayon()
	{
		$result=$this->db->query('SELECT koderayon,namarayon FROM rayon ORDER BY koderayon ASC');
		return $result->result();
	}
	public function daftarPesanId($id)
	{
		$result=$this->db->query("SELECT * FROM content where id = '$id'");
		return $result->result();
	}
	public function daftarPesan()
	{
		$result=$this->db->query("SELECT * FROM content");
		return $result->result();
	}
	public function daftarkelurahan()
	{
		$result=$this->db->query('SELECT kodekelurahan,kelurahan FROM kelurahan ORDER BY kodekelurahan ASC');
		return $result->result();
	}
	public function updatePesan()
	{
		$id = $this->input->post('id');    
	    $title = $this->input->post('title');
	    $isi = $this->input->post('isi');
	    $data = array(
	        'title' => $title,
	        'isi' => $isi
	     );
		$this->db->where('id', $id);
		$this->db->update('content', $data);

	}
	public function insertPesan()
	{ 
	    $title = $this->input->post('title');
	    $isi = $this->input->post('isi');
	    $data = array(
	        'title' => $title,
	        'isi' => $isi
	     );
		$this->db->insert('content', $data);

	}
	public function erasePesan($id)
	{ 
		$this->db->where('id', $id);
	    $this->db->delete('content');

	}
	
	

}


/* End of file pelanggan_Model.php */
/* Location: ./application/models/pelanggan_Model.php */
?>