<?php
class Calendar extends Customer_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['subview'] = 'admin/calendar';
		$this->load->view('admin/main_layout', $this->data);
	}

}
?>