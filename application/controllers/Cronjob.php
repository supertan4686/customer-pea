<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Cronjob extends CI_Controller {
  public function __construct(){
    parent::__construct();
		$this->load->model('Electric_data_model');
		$this->load->model('Customer_model');
		$this->load->helper('url');
  }

  public function update_tel(){
    $a_trsg = $this->Electric_data_model->get_trsg_all();
    $count = 0;
    foreach ($a_trsg as $key => $trsg) {
      $a_phonenumber = $this->Customer_model->get_phone_number_all_by_trsg($trsg['trsg_id']);
      foreach ($a_phonenumber as $key => $info) {
        $count++;
        if($this->Customer_model->update_tel_customer($info['ca'], $info['trsg'], $info['tel'])){
          echo $count . ' | Add complete | ' . $info['tel'] . ' at ca : ' . $info['ca'] . ' | trsg : ' . $info['trsg'] . '<br>';
        } else {
          echo $count . ' | Add fail | ' . $info['tel'] . ' at ca : ' . $info['ca'] . ' | trsg : ' . $info['trsg'] . '<br>';
        }
      }
    }
  }
}

?>