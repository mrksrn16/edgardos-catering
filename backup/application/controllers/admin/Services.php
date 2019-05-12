<?php
class Services extends Admin_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['services'] = $this->M_Services->get_all();
		$this->data['subview'] = 'admin/services/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function search() {
		$keyword = $this->input->post('keyword');
		$this->data['services'] = $this->M_Services->search($keyword);
		$this->data['subview'] = 'admin/services/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function add() {
		if($this->input->post('submit')){
			// Image upload
		    $config = array();
		    $config['upload_path'] = './uploads/services/';
		    $config['allowed_types'] = 'gif|jpg|png|jpeg';
		    $this->load->library('upload', $config, 'imageupload');  // Create custom object for catalog upload
		    $this->imageupload->initialize($config);
		    $upload_picture = $this->imageupload->do_upload('picture');
		    $upload_picture_data = $this->imageupload->data();
		    $picture = $upload_picture_data['file_name'];


			$data = array(
					'name' => $this->input->post('name'),
					'description' => $this->input->post('description'),
					'image' => $picture
				);
			if($this->db->insert('services', $data)) {
				redirect('admin/services');
			}
		}
		$this->data['subview'] = 'admin/services/add';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function edit($id) {
		$this->data['service'] = $this->M_Services->get_by_id($id);
		if($this->input->post('submit')){

			$picture;
			if($_FILES["picture"]["name"]){
				$config = array();
			    $config['upload_path'] = './uploads/services/';
		    	$config['allowed_types'] = 'gif|jpg|png|jpeg';
			    $this->load->library('upload', $config, 'imageupload');  // Create custom object for catalog upload
			    $this->imageupload->initialize($config);
			    $upload_picture = $this->imageupload->do_upload('picture');
			    $upload_picture_data = $this->imageupload->data();
			    $picture = $upload_picture_data['file_name'];
			}else{
				$service = $this->M_Services->get_by_id($id);
				$picture = $service->image;
			}

			$data = array(
					'name' => $this->input->post('name'),
					'description' => $this->input->post('description'),
					'image' => $picture
				);
			$this->db->where('id', $id);
			if($this->db->update('services', $data)) {
				redirect('admin/services');
			}
		}
		$this->data['subview'] = 'admin/services/edit';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function view($id) {
		$this->data['service'] = $this->M_Services->get_by_id($id);
		$this->data['subview'] = 'admin/services/view';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('services');

		redirect('admin/services');
	}

	public function remove_image($id, $service_id) {
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('services_gallery');
		redirect('admin/services/view/'. $service_id);
	}

	public function add_gallery() {
		$service_id = $this->input->post('service_id');

	    $config = array();
	    $config['upload_path'] = './uploads/services/';
	    $config['allowed_types'] = 'gif|jpg|png|jpeg';
	    $this->load->library('upload', $config, 'imageupload');  // Create custom object for catalog upload
	    $this->imageupload->initialize($config);
	    $upload_picture = $this->imageupload->do_upload('photo');
	    $upload_picture_data = $this->imageupload->data();
	    $picture = $upload_picture_data['file_name'];


		$data = array(
				'service_id' => $service_id,
				'image' => $picture,
				'date' => date('Y-m-d')
			);
		if($this->db->insert('services_gallery', $data)) {
			redirect('admin/services/view/' . $service_id);
		}
	}

}
?>