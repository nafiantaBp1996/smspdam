<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Controller {

	public function get()
	{
		return $this->db->get('api')->result();
	}

	public function GetWhere($table, $data)
	{
    	$res = $this->db->get_where($table, $data);
    	return $res->result_array();     	
	}

	public function insert($table,$data)
	{
		$res = $this->db->insert($table, $data);
		return $res;
	}

	public function update()
	{
		$id = $this->input->post('id');    
	    $variable = $this->input->post('variable');
	    $value = $this->input->post('value');
	    $data = array(
	        'variable' => $variable,
	        'value' => $value
	     );
		$this->db->where('id', $id);
		$this->db->update('api', $data);

	}

	public function delete($table,$where)
	{
		$res = $this->db->delete($table, $where);
		return $res;
	}
}

/* End of file Api_model.php */
/* Location: ./application/models/Api_model.php */
