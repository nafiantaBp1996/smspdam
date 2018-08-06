<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_Model extends CI_Model {
		

	private $db2;

	public function __construct()
	{
		parent::__construct();
		$this->db2 = $this->load->database('server', TRUE);
	}

	public function get_db1()
	{
		return $this->db->get('pelanggan');
	}

	public function get_db2()
	{
		return $this->db2->get('pelanggan');
	}


}


/* End of file pelanggan_Model.php */
/* Location: ./application/models/pelanggan_Model.php */