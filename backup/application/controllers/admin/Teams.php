<?php
class Teams extends Admin_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['teams'] = $this->M_Teams->get_all();
		$this->data['subview'] = 'admin/teams/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function search() {
		$keyword = $this->input->post('keyword');
		$this->data['teams'] = $this->M_Teams->search($keyword);
		$this->data['subview'] = 'admin/teams/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function add() {
		if($this->input->post('submit')){

			$data = array(
					'name' => $this->input->post('name'),
					'members' => nl2br($this->input->post('members')),
				);
			if($this->db->insert('teams', $data)) {
				redirect('admin/teams');
			}
		}
		$this->data['subview'] = 'admin/teams/add';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function edit($id) {
		$this->data['team'] = $this->M_Teams->get_by_id($id);
		if($this->input->post('submit')){

			$data = array(
					'name' => $this->input->post('name'),
					'members' => nl2br($this->input->post('members')),
				);
			$this->db->where('id', $id);
			if($this->db->update('teams', $data)) {
				redirect('admin/teams');
			}
		}
		$this->data['subview'] = 'admin/teams/edit';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function view($id) {
		$this->data['team'] = $this->M_Teams->get_by_id($id);
		$this->data['subview'] = 'admin/teams/view';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('teams');

		redirect('admin/teams');
	}

}
?>