<?php
class Users extends Admin_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['users'] = $this->M_User->get_customers();
		$this->data['subview'] = 'admin/users/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function search() {
		$keyword = $this->input->post('keyword');
		$this->data['users'] = $this->M_User->search($keyword);
		$this->data['subview'] = 'admin/users/search';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function add() {
		// VGtr5NDe
		$this->data['successMessage'] = FALSE;
		$email = $this->input->post('email');
		$chk = $this->M_User->check_email($email);
		if($this->input->post('submit')){
			if($chk == FALSE) {
				$pass = $this->randomPassword();
				$this->load->library('email');
				//SMTP & mail configuration
				$config = array(
				    'protocol'  => 'smtp',
				    'smtp_host' => 'ssl://smtp.googlemail.com',
				    'smtp_port' => 465,
				    'smtp_user' => 'edgardoscatering31@gmail.com',
				    'smtp_pass' => 'angpagpasasathesis ',
				    'mailtype'  => 'html',
				    'charset'   => 'utf-8'
				);
				$this->email->initialize($config);
				$this->email->set_mailtype("html");
				$this->email->set_newline("\r\n");

				//Email content
				$htmlContent = '<h1>Your password is : </h1>';
				$htmlContent .= '<p>'. $pass . '</p>';

				$this->email->to($email);
				$this->email->from('edgardoscatering31@gmail.com','Edgardos Catering - Password');
				$this->email->subject('Edgardos Catering - Password');
				$this->email->message($htmlContent);

				//Send email
				if($this->email->send()){
					$message = "Your password is sent on your email.";
					$accounts = array(
							'username' => $email,
							'password' => $this->M_User->hash($pass),
							'role' => $this->input->post('role')
						);
					$this->db->insert('user_accounts', $accounts);

					$details = array(
							'user_id' => $this->db->insert_id(),
							'firstname' => $this->input->post('firstname'),
							'lastname' => $this->input->post('lastname'),
							'email' => $email,
							'address' => $this->input->post('address'),
							'contact' => $this->input->post('contact'),
						);
					$this->db->insert('user_details', $details);
					$this->data['successMessage'] = TRUE;

				}else{
					echo "<script>alert('There is an error occured. Please try again.');</script>";
				}
				
			} else {
				echo "<script>alert('Email already exists.');</script>";
			}
		}
		$this->data['subview'] = 'admin/users/add';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function edit($id) {
		$this->data['user_account'] = $this->M_User->get_accounts($id);
		$this->data['user_details'] = $this->M_User->get_details($id);
		if($this->input->post('submit')){
			$details = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'address' => $this->input->post('address'),
					'contact' => $this->input->post('contact'),
				);
			$this->db->where('user_id', $id);
			if($this->db->update('user_details', $details)) {
				redirect('admin/users');
			}
		}
		$this->data['subview'] = 'admin/users/edit';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function view($id) {
		$this->data['user_account'] = $this->M_User->get_accounts($id);
		$this->data['user_details'] = $this->M_User->get_details($id);
		$this->data['subview'] = 'admin/users/view';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('user_accounts');

		$this->db->where('id', $user_id);
		$this->db->limit(1);
		$this->db->delete('user_details');

		redirect('admin/users');
	}

	public function activate($id) {
		$data = array(
				'status' => 1
			);		
		$this->db->where('id', $id);
		if($this->db->update('user_accounts', $data)) {
			redirect('admin/users');
		}
	}

	public function deactivate($id) {
		$data = array(
				'status' => 0
			);		
		$this->db->where('id', $id);
		if($this->db->update('user_accounts', $data)) {
			redirect('admin/users');
		}
	}

	public function randomPassword() {
	    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

}
?>