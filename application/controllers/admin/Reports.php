<?php
class Reports extends Admin_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['events'] = $this->M_Services->get_all();
		$this->data['schedules'] = $this->M_Schedules->get();
		$this->data['subview'] = 'admin/reports/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function search() {
		$keyword = $this->input->post('keyword');
		$this->data['schedules'] = $this->M_Schedules->search($keyword);
		$this->data['subview'] = 'admin/reports/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function filter_date() {
		$date = $this->input->post('date');
		$this->db->where('event_date', $date);
		$this->data['schedules'] = $this->db->get('schedules')->result();
		$this->data['subview'] = 'admin/reports/index';
		$this->load->view('admin/main_layout', $this->data);	
	}
}
?>