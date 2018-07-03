<?php

class Customer_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$a_base_url = explode("/", base_url());
		if(!in_array("customer-pea", $a_base_url)){
			$this->base_url = base_url() . 'customer-pea/';
		} else {
			$this->base_url = base_url();
		}
	}

	function get_debt_customer($trsg, $a_status, $startrange, $endrange){
		// Subquery
		$selectsub = "ca, trsg, ";
		$selectmain = "customer_test.ca, customer_test.customer_name, customer_test.tel, ";
		// $selectmain = "customer.ca, customer.customer_name, customer.tel, ";
		$conditionjoin = "data.ca = customer_test.ca AND data.trsg = customer_test.trsg AND (";
		// $conditionjoin = "data.ca = customer.ca AND data.trsg = customer.trsg AND (";
		foreach ($a_status as $key => $status) {
			$statusnameinquery = "status" . ($key+1); // mean status1 status2 status3 status4 not ผ่อนผันครั้งที่ 1 ผ่อนผันครั้งที่ 2 ปลดสาย ถอดมิเตอร์
			$selectsub = $selectsub . "SUM(CASE status WHEN '" . $status ."' THEN 1 ELSE 0 END) AS " . $statusnameinquery . ", ";
			$selectmain = $selectmain . "data." . $statusnameinquery . " AS " . $status . ", ";
			$conditionjoin = $conditionjoin . "data." . $statusnameinquery . " != 0 ";
			if($key != count($a_status) - 1){
				$conditionjoin = $conditionjoin . " OR ";
			} else {
				$conditionjoin = $conditionjoin . ")";
			}
		}
		$selectmain = $selectmain . "CONCAT('" . $this->base_url ."search/user?id=', customer_test.id) AS detail";
		// $selectmain = $selectmain . "CONCAT('" . $this->base_url ."search/user?id=', customer.id) AS detail";


		$this->db->select($selectsub);
		$this->db->where('trsg', $trsg);
		$this->db->where('start_date >=', $startrange);
		$this->db->where('start_date <=', $endrange);
		$this->db->group_by("ca");
		$this->db->order_by('ca', 'ASC');
		$subquery = $this->db->get_compiled_select('customer_report', FALSE);
		$this->db->reset_query();

		//Main Query
		$this->db->select($selectmain);
		$this->db->from('customer_test');
		// $this->db->from('customer');
		$this->db->join(' (' . $subquery . ') data', $conditionjoin);
		$this->db->order_by('ca', 'ASC');
		$result = $this->db->get()->result_array();
		return $result;

	}

	function get_debt_customer_for_excel($trsg, $a_status, $startrange, $endrange){
		// Subquery
		$selectsub = "ca, trsg, ";
		$selectmain = "customer_test.ca, customer_test.customer_name, customer_test.tel, ";
		// $selectmain = "customer.ca, customer.customer_name, customer.tel, ";
		$conditionjoin = "data.ca = customer_test.ca AND data.trsg = customer_test.trsg AND (";
		// $conditionjoin = "data.ca = customer.ca AND data.trsg = customer.trsg AND (";
		foreach ($a_status as $key => $status) {
			$statusnameinquery = "status" . ($key+1); // mean status1 status2 status3 status4 not ผ่อนผันครั้งที่ 1 ผ่อนผันครั้งที่ 2 ปลดสาย ถอดมิเตอร์
			$selectsub = $selectsub . "SUM(CASE status WHEN '" . $status ."' THEN 1 ELSE 0 END) AS " . $statusnameinquery . ", ";
			$selectmain = $selectmain . "data." . $statusnameinquery . " AS " . $status . ", ";
			$conditionjoin = $conditionjoin . "data." . $statusnameinquery . " != 0 ";
			if($key != count($a_status) - 1){
				$conditionjoin = $conditionjoin . " OR ";
			} else {
				$conditionjoin = $conditionjoin . ")";
			}
		}
		$selectmain = $selectmain . "CONCAT('" . $this->base_url ."search/user?id=', customer_test.id) AS detail";
		// $selectmain = $selectmain . "CONCAT('" . $this->base_url ."search/user?id=', customer.id) AS detail";


		$this->db->select($selectsub);
		$this->db->where('trsg', $trsg);
		$this->db->where('start_date >=', $startrange);
		$this->db->where('start_date <=', $endrange);
		$this->db->group_by("ca");
		$this->db->order_by('ca', 'ASC');
		$subquery = $this->db->get_compiled_select('customer_report', FALSE);
		$this->db->reset_query();

		//Main Query
		$this->db->select($selectmain);
		$this->db->from('customer_test');
		// $this->db->from('customer');
		$this->db->join(' (' . $subquery . ') data', $conditionjoin);
		$this->db->order_by('ca', 'ASC');
		$result = $this->db->get()->result_array();
		return $result;

	}

	function get_customer_by_id($id){
		// $this->db->select('customer.id, customer.ca, customer.customer_name, customer.address, customer.trsg, customer.mru, customer_tel.tel');
		// $this->db->join('customer_tel', 'customer.ca = customer_tel.ca AND customer.trsg = customer_tel.trsg', 'left outer');
		// $this->db->where('customer.id', $id);
		// return $this->db->get('customer')->row_array();

		$this->db->select('customer_test.id, customer_test.ca, customer_test.customer_name, customer_test.address, customer_test.trsg, customer_test.mru, customer_test.tel');
		$this->db->where('customer_test.id', $id);
		return $this->db->get('customer_test')->row_array();
	}

	function get_debt_trsg_all($a_status, $startrange, $endrange){
		// Subquery
		$selectsub = "trsg, ";
		$selectmain = "trsg.trsg_id, trsg.trsg_name, ";
		$conditionjoin = "data.trsg = trsg.trsg_id";
		foreach ($a_status as $key => $status) {
			$statusnameinquery = "status" . ($key+1); // mean status1 status2 status3 status4 not ผ่อนผันครั้งที่ 1 ผ่อนผันครั้งที่ 2 ปลดสาย ถอดมิเตอร์
			$selectsub = $selectsub . "SUM(CASE status WHEN '" . $status ."' THEN 1 ELSE 0 END) AS " . $statusnameinquery . ", ";
			$selectmain = $selectmain . "data." . $statusnameinquery . " AS " . $status . ", ";
		}

		$this->db->select($selectsub);
		$this->db->where('start_date >=', $startrange);
		$this->db->where('start_date <=', $endrange);
		$this->db->group_by("trsg");
		$this->db->order_by('trsg', 'ASC');
		$subquery = $this->db->get_compiled_select('customer_report', FALSE);
		$this->db->reset_query();

		//Main Query
		$this->db->select($selectmain);
		$this->db->from('trsg');
		$this->db->join(' (' . $subquery . ') data', $conditionjoin);
		$this->db->where('trsg.hidden', 0);
		$this->db->order_by('trsg', 'ASC');
		$result = $this->db->get()->result_array();
		return $result;
	}

	function get_debt_info_by_customer($ca,$trsg,$startrange,$endrange){
		$this->db->select('status, DATE_FORMAT(start_date, "%m-%Y") AS start_date');
		$this->db->where('ca', $ca);
		$this->db->where('trsg', $trsg);
		$this->db->where('start_date >=', $startrange);
		$this->db->where('start_date <=', $endrange);
		$this->db->order_by('start_date', 'DESC');
		return $this->db->get('customer_report')->result_array();
	}

}
?>