<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Api_model');
		//Load Dependencies

	}

	// List all your items
	public function index()
	{
		$data = $this->Api_model->get('api');
		$data = array('data' => $data );
		$this->load->view('komponen/header');
		$this->load->view('api/index',$data);
		$this->load->view('komponen/footer');
	}

	// Add a new item
	public function add()
	{
		$data = array(
			'variable' => $this->input->post('variable')
			);
		$data = $this->Api_model->insert('api', $data);
		redirect('api/index','refresh');
	}

	//Update one item
	public function edit_data($id)
	{
		$curapi = $this->Api_model->GetWhere('api', array('id' => $id));
		$data['data'] = array(
			'id' => $curapi[0]['id'],
			'variable' => $curapi[0]['variable'],
			'value' => $curapi[0]['value']
			);
		$this->load->view('komponen/header');
		$this->load->view('api/edit',$data);
		$this->load->view('komponen/footer');
	}

	public function update_data()
	{	
	    $res = $this->Api_model->Update();
	    redirect('api/index','refresh');
	}

	//Delete one item
	public function delete($id)
	{
		$id = array('id' => $id );
		$this->Api_model->delete('api',$id);
		redirect('api/index','refresh');
	}
}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */
