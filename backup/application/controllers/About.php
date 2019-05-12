<?php
class About extends Customer_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['subview'] = 'customer/about';
		$this->load->view('customer/main_layout', $this->data);
	}

}
?>