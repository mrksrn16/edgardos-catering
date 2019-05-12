<?php
class Packages extends Admin_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['packages'] = $this->M_Packages->get_all();
		$this->data['subview'] = 'admin/packages/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function search() {
		$keyword = $this->input->post('keyword');
		$this->data['packages'] = $this->M_Packages->search($keyword);
		$this->data['subview'] = 'admin/packages/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function add() {
		$this->data['foods'] = $this->M_Foods->get_all();
		if($this->input->post('submit')){
			// Image upload
		    $config = array();
		    $config['upload_path'] = './uploads/packages/';
		    $config['allowed_types'] = 'gif|jpg|png|jpeg';
		    $this->load->library('upload', $config, 'imageupload');  // Create custom object for catalog upload
		    $this->imageupload->initialize($config);
		    $upload_picture = $this->imageupload->do_upload('picture');
		    $upload_picture_data = $this->imageupload->data();
		    $picture = $upload_picture_data['file_name'];


			$data = array(
					'name' => $this->input->post('name'),
					'price' => $this->input->post('price'),
					'foods' => implode(',', $this->input->post('foods')),
					'details' => nl2br($this->input->post('details')),
					'image' => $picture,
					'date_created' => date('Y-m-d'),
					'created_by' => $this->session->userdata('id')
				);
			if($this->db->insert('packages', $data)) {
				redirect('admin/packages');
			}
		}
		$this->data['subview'] = 'admin/packages/add';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function edit($id) {
		$this->data['foods'] = $this->M_Foods->get_all();
		$this->data['package'] = $this->M_Packages->get_by_id($id);
		if($this->input->post('submit')){

			$picture;
			if($_FILES["picture"]["name"]){
				$config = array();
			    $config['upload_path'] = './uploads/packages/';
		    	$config['allowed_types'] = 'gif|jpg|png|jpeg';
			    $this->load->library('upload', $config, 'imageupload');  // Create custom object for catalog upload
			    $this->imageupload->initialize($config);
			    $upload_picture = $this->imageupload->do_upload('picture');
			    $upload_picture_data = $this->imageupload->data();
			    $picture = $upload_picture_data['file_name'];
			}else{
				$res = $this->M_Packages->get_by_id($id);
				$picture = $res->image;
			}

			$data = array(
					'name' => $this->input->post('name'),
					'price' => $this->input->post('price'),
					'details' => nl2br($this->input->post('details')),
					'foods' => implode(',', $this->input->post('foods')),
					'image' => $picture
				);
			$this->db->where('id', $id);
			if($this->db->update('packages', $data)) {
				redirect('admin/packages');
			}
		}
		$this->data['subview'] = 'admin/packages/edit';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function view($id) {
		$this->data['package'] = $this->M_Packages->get_by_id($id);
		$this->data['subview'] = 'admin/packages/view';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('packages');

		redirect('admin/packages');
	}

}

?>