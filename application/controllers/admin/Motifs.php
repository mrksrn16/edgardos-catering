<?php
class Motifs extends Admin_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['motifs'] = $this->M_Motifs->get_all();
		$this->data['subview'] = 'admin/motifs/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function search() {
		$keyword = $this->input->post('keyword');
		$this->data['motifs'] = $this->M_Motifs->search($keyword);
		$this->data['subview'] = 'admin/motifs/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function add() {
		if($this->input->post('submit')){
			// Image upload
		    $config = array();
		    $config['upload_path'] = './uploads/motifs/';
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
			if($this->db->insert('motifs', $data)) {
				redirect('admin/motifs');
			}
		}
		$this->data['subview'] = 'admin/motifs/add';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function edit($id) {
		$this->data['motif'] = $this->M_Motifs->get_by_id($id);
		if($this->input->post('submit')){

			$picture;
			if($_FILES["picture"]["name"]){
				$config = array();
			    $config['upload_path'] = './uploads/motifs/';
		    	$config['allowed_types'] = 'gif|jpg|png|jpeg';
			    $this->load->library('upload', $config, 'imageupload');  // Create custom object for catalog upload
			    $this->imageupload->initialize($config);
			    $upload_picture = $this->imageupload->do_upload('picture');
			    $upload_picture_data = $this->imageupload->data();
			    $picture = $upload_picture_data['file_name'];
			}else{
				$motif = $this->M_Motifs->get_by_id($id);
				$picture = $motif->image;
			}

			$data = array(
					'name' => $this->input->post('name'),
					'description' => $this->input->post('description'),
					'image' => $picture
				);
			$this->db->where('id', $id);
			if($this->db->update('motifs', $data)) {
				redirect('admin/motifs');
			}
		}
		$this->data['subview'] = 'admin/motifs/edit';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function view($id) {
		$this->data['motif'] = $this->M_Motifs->get_by_id($id);
		$this->data['subview'] = 'admin/motifs/view';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('motifs');

		redirect('admin/motifs');
	}

	
}
?>