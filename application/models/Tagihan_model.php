<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan_model extends CI_Model {

	public function tagihanPelanggan($id)
	{
		$query=$this->db->query("Call tagihanCust ('$id','100')");
		$que=$query->result();
		mysqli_next_result( $this->db->conn_id );
		$query->free_result(); 
		return $que;

	}

	public function tagihanPelangganId($id)
	{
		$query=$this->db->query("Call tagihanCustByNosamb ('$id')");
		$que=$query->result();
		mysqli_next_result( $this->db->conn_id );
		$query->free_result(); 
		return $que;

	}
	

}

/* End of file tagihan_model.php */
/* Location: ./application/models/tagihan_model.php */

?>