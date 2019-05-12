<?php
class User extends Admin_Controller
{
	function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->login();
	}
	public function login(){
		// echo $this->M_User->hash('admin');
		if($this->session->userdata('role') != 'customer') {
			$dashboard = "admin/users";	
		} else {
			$data = array(
				'logged_in' => FALSE
				);
			$this->session->set_userdata($data);
			$dashboard = "admin/user/login";
		}
		$this->M_User->loggedin() == FALSE || redirect($dashboard);
		if(isset($_POST['submit'])){
			if($this->M_User->login() === TRUE) {
				redirect('admin/dashboard');
			}
			if($this->session->userdata('logged_in') == FALSE) {
				echo '<script>alert("Username/Password didn`t exists.");</script>';
			}
			else {
				$this->session->set_flashdata('error', 'Username and Password dont exists');
				redirect('admin/user/login' , 'refresh');
			}
		}
		$this->load->view('admin/login');
	}
	public function logout(){
		$this->M_User->logout();
		redirect('admin/user/login');
	}
	public function profile(){

		if($this->input->post('submit')) {
			$id = $this->session->userdata('id');
			$password = $this->input->post('password');
			if($password) {
				$data = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'address' => $this->input->post('address'),
					'contact' => $this->input->post('contact'),
				);
				$this->db->where('user_id', $id);
				if($this->db->update('user_details', $data)) {
					$accounts = array(
						'password' => $this->M_User->hash($password)
					);
					$this->db->where('id', $id);
					if($this->db->update('user_accounts', $accounts)) {
						redirect('admin/user/profile');
					}
				}
			} else {

				$data = array(
					'firstname' => $this->input->post('firstname'),
					'lastname' => $this->input->post('lastname'),
					'address' => $this->input->post('address'),
					'contact' => $this->input->post('contact')
				);
				$this->db->where('id', $id);
				if($this->db->update('user_details', $data)) {
					redirect('admin/user/profile');
				}
			}
		}


		$this->db->where('id', $this->session->userdata('id'));
		$this->data['user_details'] = $this->db->get('user_accounts')->row();
		$this->data['subview'] = 'admin/profile';
		$this->load->view('admin/main_layout', $this->data);
	}
	public function editprofile(){

		if(isset($_POST['submit'])){
				$picture;
				if($_FILES["picture"]["name"]){
					$config['upload_path']          = './uploads/images/admin/';
	                $config['allowed_types']        = 'gif|jpg|png';
	                $this->load->library('upload', $config);
	                if ( ! $this->upload->do_upload('picture')){
	                	$error = array('error' => $this->upload->display_errors());
	                	var_dump($error);
	                }else{
	                	$picture = $this->upload->data('file_name'); 
	                }
				}else{
					$this->db->where('id', 1);
					$admin_info = $this->db->get('tbl_admin')->row();
					$picture = $admin_info->picture;
				}
				$password;
				if($this->input->post('password')){
					$password = $this->M_User->hash($this->input->post('password'));
				}else{
					$this->db->where('id', 1);
					$admin = $this->db->get('tbl_admin')->row();
					$password  = $admin->password;
				}
				$admin = array(
					'username' => $this->input->post('username'),
					'name' => $this->input->post('name'),
					'contact' => $this->input->post('contact'),
					'email' => $this->input->post('email'),
					'address' => $this->input->post('address'),
					'position' => $this->input->post('position'),
					// 'picture' => $this->input->post('name')
					'picture' => $picture,
					'password' => $password,
				);
				$this->db->where('id', 1);
				if($this->db->update('tbl_admin', $admin)){
					redirect('user/profile');
				}
		}


		$this->db->where('id', 1);
		$this->data['admin'] = $this->db->get('tbl_admin')->row();
		$this->data['main'] = 'admin/edit';
		$this->load->view('main_layout', $this->data);
	}

	public function forgot_password() {
		if ($this->input->post('submit')) {
			$email = $this->input->post('email');
			$this->db->where('email', $email);
			$chk = $this->db->get('user_details')->row();
			if($chk){
				$new_pass = $this->randomPassword();
				//Send on email
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
				$htmlContent = '<h1>Your new password is : </h1>';
				$htmlContent .= '<p>'. $new_pass . '</p>';

				$this->email->to($email);
				$this->email->from('edgardoscatering31@gmail.com','Edgardos Catering - User Reset Password');
				$this->email->subject('Forgot password');
				$this->email->message($htmlContent);

				//Send email
				if($this->email->send()){
					$message = "Your new password is sent on your email.";
					//Update table
					$hash_new_pass = $this->M_User->hash($new_pass);
					$data = array(
							'password' => $hash_new_pass
						);
					$this->db->where('id', $chk->user_id);
					$this->db->update('user_accounts', $data);
					echo "<script>alert('New Password is sent.');</script>";
				}else{
					echo "<script>alert('There is an error occured. Please try again.');</script>";
				}
			}else{
				echo "<script>alert('Email dont exists.');</script>";
			}
		}
		$this->load->view('admin/reset_password');
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
