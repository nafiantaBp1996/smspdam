<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan_model extends CI_Model {

	

	public function tagihanPelanggan($id,$limit,$offset)
	{
		$query=$this->db->query("Call tagihanCust ('$id','$limit',$offset)");
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

	public function Filter($que)
	{
		$txt= "SELECT pelanggan.nama,pelanggan.`nohp`,dataTagihan.* FROM(SELECT lmbr,nosamb, lancar,DATE_FORMAT(DATE_ADD(STR_TO_DATE(CONCAT(periodemin,'01'),'%Y%m%d%h%i'), INTERVAL 1 MONTH),'%M,%Y') AS periodemin, DATE_FORMAT(DATE_ADD(STR_TO_DATE(CONCAT(periodemax,'01'),'%Y%m%d%h%i'), INTERVAL 1 MONTH),'%M,%Y') AS periodemax, total FROM
		(SELECT COUNT(nosamb) AS lmbr,nosamb,MIN(periode) AS periodemin,MAX(periode) AS periodemax,1 AS lancar,SUM(total) AS total FROM piutang GROUP BY nosamb HAVING lmbr<=2 AND periodemin >=201806
		UNION
		SELECT COUNT(nosamb) AS lmbr,nosamb,MIN(periode) AS periodemin,MAX(periode) AS periodemax,0 AS lancar,SUM(total) AS total FROM piutang GROUP BY nosamb HAVING periodemin <201806) AS tghan ) AS dataTagihan LEFT JOIN pelanggan ON dataTagihan.nosamb=pelanggan.nosamb WHERE ISNULL(pelanggan.nosamb) = FALSE ";

		if ($que==null) {
			$query=$this->db->query($txt." limit 100");
		}
		else
		{
			$query=$this->db->query($txt.$que);
		}
		
		return $query->result();

	}

	

}

/* End of file tagihan_model.php */
/* Location: ./application/models/tagihan_model.php */

?>