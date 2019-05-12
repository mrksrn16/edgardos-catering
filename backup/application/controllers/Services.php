<?php
class Services extends Customer_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['subview'] = 'customer/services';
		$this->load->view('customer/main_layout', $this->data);
	}

	public function view($id) {
		$this->db->where('id', $id);
		$this->data['service'] = $this->db->get('services')->row();
		$this->data['subview'] = 'customer/services/view';
		$this->load->view('customer/main_layout', $this->data);
	}

}
?>