<?php
class Foods extends Admin_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['foods'] = $this->M_Foods->get_all();
		$this->data['subview'] = 'admin/foods/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function search() {
		$keyword = $this->input->post('keyword');
		$this->data['foods'] = $this->M_Foods->search($keyword);
		$this->data['subview'] = 'admin/foods/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function add() {
		if($this->input->post('submit')){
			// Image upload
		    $config = array();
		    $config['upload_path'] = './uploads/foods/';
		    $config['allowed_types'] = 'gif|jpg|png|jpeg';
		    $this->load->library('upload', $config, 'imageupload');  // Create custom object for catalog upload
		    $this->imageupload->initialize($config);
		    $upload_picture = $this->imageupload->do_upload('picture');
		    $upload_picture_data = $this->imageupload->data();
		    $picture = $upload_picture_data['file_name'];


			$data = array(
					'name' => $this->input->post('name'),
					'price' => $this->input->post('price'),
					'category' => $this->input->post('category'),
					'description' => $this->input->post('description'),
					'image' => $picture
				);
			if($this->db->insert('foods', $data)) {
				redirect('admin/foods');
			}
		}
		$this->data['subview'] = 'admin/foods/add';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function edit($id) {
		$this->data['food'] = $this->M_Foods->get_by_id($id);
		if($this->input->post('submit')){

			$picture;
			if($_FILES["picture"]["name"]){
				$config = array();
			    $config['upload_path'] = './uploads/foods/';
		    	$config['allowed_types'] = 'gif|jpg|png|jpeg';
			    $this->load->library('upload', $config, 'imageupload');  // Create custom object for catalog upload
			    $this->imageupload->initialize($config);
			    $upload_picture = $this->imageupload->do_upload('picture');
			    $upload_picture_data = $this->imageupload->data();
			    $picture = $upload_picture_data['file_name'];
			}else{
				$food = $this->M_Foods->get_by_id($id);
				$picture = $food->image;
			}

			$data = array(
					'name' => $this->input->post('name'),
					'price' => $this->input->post('price'),
					'category' => $this->input->post('category'),
					'image' => $picture
				);
			$this->db->where('id', $id);
			if($this->db->update('foods', $data)) {
				redirect('admin/foods');
			}
		}
		$this->data['subview'] = 'admin/foods/edit';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function view($id) {
		$this->data['food'] = $this->M_Foods->get_by_id($id);
		$this->data['subview'] = 'admin/foods/view';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('foods');

		redirect('admin/foods');
	}

}
?>