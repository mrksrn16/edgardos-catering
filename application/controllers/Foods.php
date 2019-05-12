<?php
class Foods extends Customer_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['foods'] = $this->db->get('foods')->result();
		$this->data['subview'] = 'customer/foods';
		$this->load->view('customer/main_layout', $this->data);
	}

}
?>