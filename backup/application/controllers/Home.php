<?php
class Home extends Customer_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['motifs'] = $this->M_Motifs->get_all();
		$this->data['services'] = $this->M_Services->get_all();
		$this->data['subview'] = 'customer/home';
		$this->load->view('customer/main_layout', $this->data);
	}

}

?>