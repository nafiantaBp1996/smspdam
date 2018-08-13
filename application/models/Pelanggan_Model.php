<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_Model extends CI_Model {
		

	public function daftarpelanggan()
	{
		$result=$this->db->query("select * from pelanggan limit 1000");
		return $result->result();
	}

	

}


/* End of file pelanggan_Model.php */
/* Location: ./application/models/pelanggan_Model.php */
?>