<?php
class Schedules extends Customer_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['subview'] = 'customer/schedules';
		$this->load->view('customer/main_layout', $this->data);
	}

	public function event($event) {
		if($event == 'Wedding') {
			$date = date('Y-m-d', strtotime('+5 months'));
		} else {
			$date = date('Y-m-d', strtotime('+2 months'));
		}
		$this->data['goTodate'] = $date;
		$this->data['subview'] = 'customer/schedules';
		$this->load->view('customer/main_layout', $this->data);
	}

}
?>