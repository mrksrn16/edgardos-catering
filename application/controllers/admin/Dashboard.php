<?php
class Dashboard extends Admin_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['subview'] = 'admin/dashboard';
		$this->load->view('admin/main_layout', $this->data);
	}


}

?>