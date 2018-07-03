<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once FCPATH. 'asset/spout-2.7.3/src/Spout/Autoloader/autoload.php';
use Box\Spout\Common\Type;
use Box\Spout\Writer\Style\Border;
use Box\Spout\Writer\Style\BorderBuilder;
use Box\Spout\Writer\Style\Color;
use Box\Spout\Writer\Style\StyleBuilder;
use Box\Spout\Writer\WriterFactory;

class Search extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Electric_data_model');
		$this->load->model('Customer_model');
		$this->load->helper('url');
		$this->amount = array(
			"ผ่อนผันครั้งที่ 1" => 0,
			"ผ่อนผันครั้งที่ 2" => 0,
			"ปลดสาย" => 0,
			"ถอดมิเตอร์" => 0,
		);
		$this->a_th_month = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
	}
	
	public function index(){
		$this->load->view('header');
		$this->load->view('main');
		$this->load->view('footer');
	}
  
  public function searchbytrsg(){
		$trsg = $this->input->get('trsgform');
		$amountmonth = $this->input->get('amountmonthform');
		$status = $this->input->get('statusform');

		//Set Varaible
		if($trsg == "" && $amountmonth == "" && $status == ""){
			$trsg = "J01101";
			$amountmonth = 1;
			$status = 'all';
		}

		if($status == 'all'){
			$form_selected['status'] = 'all';
			$form_selected['status_name'] = "ทั้งหมด";
			$a_statusselected = array('ผ่อนผันครั้งที่ 1', 'ผ่อนผันครั้งที่ 2', 'ปลดสาย', 'ถอดมิเตอร์');
		} else {
			$form_selected['status'] = $status;
			$form_selected['status_name'] = $status;
			$a_statusselected = array($status);
		}
		
		$form_selected['a_status'] = $a_statusselected;
		$form_selected['trsg'] = $trsg;
		$form_selected['amount'] = $amountmonth;
		$form_selected['amountmonth_name'] = $amountmonth . " เดือน";
		$trsg_data = $this->Electric_data_model->get_trsg_name($trsg);
		$form_selected['trsg_name'] = $trsg_data['trsg_name'];
  	$a_trsg = $this->Electric_data_model->get_trsg_all();
		$a_status = $this->Electric_data_model->get_status_list_name();

		$rangedate = $this->_get_range($amountmonth);
		$startrange = $rangedate['startrange'];
		$endrange = $rangedate['endrange'];
		$dateoutput = array(
			"th_startmonth" => $rangedate['th_startmonth'], 
			"th_endmonth" => $rangedate['th_endmonth'], 
			'startyear' => $rangedate['startyear'],
			'endyear' => $rangedate['endyear']);
		$a_customer_query = $this->Customer_model->get_debt_customer($trsg, $a_statusselected, $startrange, $endrange);
		// echo $this->db->last_query();
		$count_a_customer_query = count($a_customer_query);
		$error_message = "เกิดความผิดพลาดในการเรียกข้อมูล";
		$a_data = array(
			'data' => $a_customer_query,
			'trsg' => $a_trsg,
			'status' => $a_status,
			'formselected' => $form_selected,
			'dateoutput' => $dateoutput);
		
		// print_r($a_data);
		$this->load->view('header');
    $this->load->view('searchbytrsg', $a_data);
		$this->load->view('footer');
	}

	public function user(){
		$id = $this->input->get('id');
		$customer = $this->Customer_model->get_customer_by_id($id);
		$ca = $customer['ca'];
		$trsg = $customer['trsg'];
		$rangedate = $this->_get_range(12);
		$startrange = $rangedate['startrange'];
		$endrange = $rangedate['endrange'];
		$dateoutput = array(
			"th_startmonth" => $rangedate['th_startmonth'], 
			"th_endmonth" => $rangedate['th_endmonth'], 
			'startyear' => $rangedate['startyear'],
			'endyear' => $rangedate['endyear']);
		$stat = $this->_get_range_stat($rangedate['startmonth'], $rangedate['endmonth'], $rangedate['startyear'], $rangedate['endyear']);
		$resultquery = $this->Customer_model->get_debt_info_by_customer($ca,$trsg,$startrange,$endrange);
		foreach ($resultquery as $index => $data) {
			$status = $data['status'];
			$start_datesplit = explode('-', $data['start_date']);
			$month =  intval($start_datesplit[0]);
			$year =  intval($start_datesplit[1]);
			$monthname = $this->a_th_month[$month];
			$stat[$year][$monthname][$status] += 1;
		}
		$data = array(
			"customer" => $customer,
			"stat" => $stat,
			'dateoutput' => $dateoutput);
		$this->load->view('header');
		$this->load->view('customer_info', $data);
		$this->load->view('footer');
	}

	public function trsgall(){
		$amountmonth = $this->input->get('amountmonthform');
		if($amountmonth == "") $amountmonth = 1;
		$rangedate = $this->_get_range($amountmonth);
		$startrange = $rangedate['startrange'];
		$endrange = $rangedate['endrange'];
		$dateoutput = array(
			"th_startmonth" => $rangedate['th_startmonth'], 
			"th_endmonth" => $rangedate['th_endmonth'], 
			'startyear' => $rangedate['startyear'],
			'endyear' => $rangedate['endyear']);
		$a_status = array('ผ่อนผันครั้งที่ 1', 'ผ่อนผันครั้งที่ 2', 'ปลดสาย', 'ถอดมิเตอร์');
		$result = $this->Customer_model->get_debt_trsg_all($a_status, $startrange, $endrange);
		$form_selected['amount'] = $amountmonth;
		$form_selected['amountmonth_name'] = $amountmonth . " เดือน";
		$form_selected['a_status'] = $a_status;
		$a_data = array(
			'formselected' => $form_selected,
			'stat' => $result,
			'dateoutput' => $dateoutput);
		// print_r($a_data);
		$this->load->view('header');
		$this->load->view('overview', $a_data);
		$this->load->view('footer');
	}

	public function ajax_export_searchbytrsg(){
		$trsg = $this->input->post('trsg');
		$status = $this->input->post('status');
		$amountmonth = $this->input->post('amount');

		//Set Varaible
		if($trsg == "" && $amountmonth == "" && $status == ""){
			$trsg = "J01101";
			$amountmonth = 1;
			$status = 'all';
		}

		if($status == 'all'){
			$a_statusselected = array('ผ่อนผันครั้งที่ 1', 'ผ่อนผันครั้งที่ 2', 'ปลดสาย', 'ถอดมิเตอร์');
		} else {
			$a_statusselected = array($status);
		}

		$rangedate = $this->_get_range($amountmonth);
		$startrange = $rangedate['startrange'];
		$endrange = $rangedate['endrange'];
		
		$a_customer_query = $this->Customer_model->get_debt_customer_for_excel($trsg, $a_statusselected, $startrange, $endrange);
		echo $this->db->last_query();
		// print_r($a_customer_query);
		$a_header = array_merge(array('ca', 'trsg', 'customer_name', 'address', 'tel', 'mru'), $a_statusselected);
		$filename = "export_" . $trsg . "_" . $status . "_" . $amountmonth . ".xlsx";
		$link = $this->_create_excel($filename, $a_customer_query, $a_header);

		echo $link;
	}

	public function ajax_export_overview(){
		$amountmonth = $this->input->post('amount');
		if($amountmonth == "") $amountmonth = 1;
		$rangedate = $this->_get_range($amountmonth);
		$startrange = $rangedate['startrange'];
		$endrange = $rangedate['endrange'];
		$a_status = array('ผ่อนผันครั้งที่ 1', 'ผ่อนผันครั้งที่ 2', 'ปลดสาย', 'ถอดมิเตอร์');
		$result = $this->Customer_model->get_debt_trsg_all($a_status, $startrange, $endrange);
		$form_selected['amount'] = $amountmonth;
		$form_selected['amountmonth_name'] = $amountmonth . " เดือน";
		$form_selected['a_status'] = $a_status;
		$a_header = array_merge(array('trsg', 'trsg_name'), $a_status);
		$filename = "export_overview_" . $amountmonth . ".xlsx";
		$link = $this->_create_excel($filename, $result, $a_header);

		echo $link;
	}

	public function check_base_url(){
		echo 'base_url : ', base_url(), '<br>';
	}

	private function _create_excel($filename, $a_customer_query, $a_header){
		// Check sheets folder in project
		if(!in_array("export", scandir(FCPATH))){
			mkdir(FCPATH. "export", 0755);
		}

		$filePath = FCPATH . 'export/' . $filename;
    $writer = WriterFactory::create(Type::XLSX); // for XLSX files
		$writer->openToFile($filePath); // write data to a file or to a PHP stream
		$sheet = $writer->getCurrentSheet();
		$sheet_no = 1;
		$sheet->setName('Page_' . $sheet_no);
		$writer->addRow($a_header);

		$rowdata = 0;
    foreach ($a_customer_query as $key => $data) {
      $writer->addRow($data);
      $rowdata++;
      if($rowdata % 10000 == 0){
        $sheet_no++;
        $sheet = $writer->addNewSheetAndMakeItCurrent();
        $sheet->setName('Page_' . $sheet_no);    
        $writer->addRow($header);
      }
		}
    $writer->close();

    $link = base_url() . 'export/' . $filename;

		return $link;
	}
	
	private function _get_range($amountmonth){
		// $nowaday = explode('-', date('Y-m-d', time()));
		$nowaday = explode('-', '2018-02-01');

    //Calc endrange
    $endmonth = $this->_manual_int_mod(intval($nowaday[1]) - 1, 12);
    if($endmonth == 0){
      $endmonth = 12;
      $endyear = intval($nowaday[0]) - 1;
    } else {
      $endyear = intval($nowaday[0]);
    }
		$enddate = cal_days_in_month(CAL_GREGORIAN,$endmonth,$endyear);
		$endrange = $endyear . '-' . $endmonth . '-' . $enddate;
    
		//Calc startrange
		$startmonth = $this->_manual_int_mod($endmonth - ($amountmonth - 1), 12);
		if($startmonth == 0){
      $startmonth = 12;
    }

    if($startmonth > $endmonth){
      $startyear = $endyear - 1;
    } else {
      $startyear = $endyear;
    }

		$startrange = $startyear . '-' . $startmonth . '-' . '01';

		$th_startmonth = $this->a_th_month[$startmonth];
		$th_endmonth = $this->a_th_month[$endmonth];

		$data = array(
			"startrange" => $startrange,
			"endrange" => $endrange,
			"startdate" => "01",
			"enddate" => "31",
			"startyear" => $startyear,
			"endyear" => $endyear,
			"startmonth" => $startmonth,
			"endmonth" => $endmonth,
			"th_startmonth" => $th_startmonth,
			"th_endmonth" => $th_endmonth,
		);

		return $data;
	}
	
	private function _get_range_stat($startmonth, $endmonth, $startyear, $endyear){
		$stat = array();
		if ($startyear == $endyear){
			for($i=$endmonth;$i>=$startmonth;$i--){
				$monthname = $this->a_th_month[$i];
				$stat[$endyear][$monthname] = $this->amount;
			}
		} else {
			for($i=$endmonth;$i>=1;$i--){
				$monthname = $this->a_th_month[$i];
				$stat[$endyear][$monthname] = $this->amount;
			}
			for($i=12;$i>=$startmonth;$i--){
				$monthname = $this->a_th_month[$i];
				$stat[$startyear][$monthname] = $this->amount;
			}
		}

		return $stat;
	}

  private function _manual_int_mod($num1, $num2){
    $result = $num1 % $num2;
    if($result < 0){
      $result += $num2;
    }
    return $result;
  }
	
}
