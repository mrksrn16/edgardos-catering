<?php
class Schedules extends Admin_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['events'] = $this->M_Services->get_all();
		$this->data['schedules'] = $this->M_Schedules->get_all();
		$this->data['subview'] = 'admin/schedules/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function view($id) {
		$this->data['packages'] = $this->M_Packages->get_all();
		$this->data['schedule'] = $this->M_Schedules->get_by_id($id);
		$this->data['subview'] = 'admin/schedules/view';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function search() {
		$keyword = $this->input->post('keyword');
		$this->data['events'] = $this->M_Services->get_all();
		$this->data['schedules'] = $this->M_Schedules->search($keyword);
		$this->data['subview'] = 'admin/schedules/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function filter_status() {
		$status = $this->input->post('status');
		$this->db->where('status', $status);
		$this->data['schedules'] = $this->db->get('schedules')->result();
		$this->data['events'] = $this->M_Services->get_all();
		$this->data['subview'] = 'admin/schedules/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function filter_events() {
		$event_id = $this->input->post('event_id');
		// $array = array('event_type' => $event_id, 'status !=' => '?pending', 'status !=' => 'rejected');
		$where = "event_type = $event_id AND status != 'pending' AND status != 'rejected'";
		$this->db->where($where);
		$this->data['schedules'] = $this->db->get('schedules')->result();
		$this->data['events'] = $this->M_Services->get_all();
		$this->data['subview'] = 'admin/schedules/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function cancelled($id) {
		$data = array(
			'status' => 'cancel'
		);
		$this->db->where('id', $id);
		if($this->db->update('schedules', $data)) {
			redirect('admin/schedules');
		}
	}

}

?>