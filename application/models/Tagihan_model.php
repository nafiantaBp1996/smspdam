<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan_model extends CI_Model {

	public function tagihanPelanggan($id)
	{
		$query=$this->db->query("Call tagihanCust ('$id','20000')");
		return $query->result();
	}
	

}

/* End of file tagihan_model.php */
/* Location: ./application/models/tagihan_model.php */

?>