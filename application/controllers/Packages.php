<?php
class Packages extends Customer_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['packages'] = $this->M_Packages->get_all();
		$this->data['subview'] = 'customer/packages';
		$this->load->view('customer/main_layout', $this->data);
	}

	public function view($id) {
		$this->data['package'] = $this->M_Packages->get_by_id($id);
		$this->data['subview'] = 'customer/packages/view';
		$this->load->view('customer/main_layout', $this->data);
	}

}
?>