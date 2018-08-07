<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_Model extends CI_Model {
		

	public function daftarpelanggan()
	{
		
		return $this->db->get('pelanggan')->result();
	}

	

}


/* End of file pelanggan_Model.php */
/* Location: ./application/models/pelanggan_Model.php */
?>