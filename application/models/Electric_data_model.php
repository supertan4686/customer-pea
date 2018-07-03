<?php

class Electric_data_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_trsg_all(){
		$this->db->where('hidden', 0);
		return $this->db->get('trsg')->result_array();
	}
	

	function get_status_list_name(){
		return $this->db->get('status')->result_array();
	}

	function get_trsg_name($id){
		$this->db->where('trsg_id', $id);
		$this->db->order_by('id', 'ASC');
		return $this->db->get('trsg')->row_array();
	}

	function get_status_name($id){
		$this->db->where('status_id', $id);
		$this->db->order_by('status_id', 'ASC');
		return $this->db->get('status')->row_array();
	}

}
?>