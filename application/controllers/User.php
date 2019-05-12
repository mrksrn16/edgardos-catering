<?php
class User extends Customer_Controller
{
	function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->login();
	}
	public function login(){
		$dashboard = 'reservation';

		$this->M_User->loggedin() == FALSE || redirect($dashboard);
		if(isset($_POST['submit'])){
			if($this->M_User->login() === TRUE) {
				redirect('reservation');
			}
			if($this->session->userdata('logged_in') == FALSE) {
				echo '<script>alert("Username/Password didn`t exists.");</script>';
			}
			else {
				$this->session->set_flashdata('error', 'Username and Password dont exists');
				redirect('user/login' , 'refresh');
			}
		}
		$this->data['subview'] = 'customer/login';
		$this->load->view('customer/main_layout', $this->data);
	}

	public function register(){
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
				$htmlContent = '<h3>Your password is : </h3> <p>'. $pass .'</p><h3>Thank you for registering in Edgardos Catering!</h3>';
				$htmlContent .= '<p>These are the terms and conditions:</p>';
				$htmlContent .= '<ul><li>Slot  reservation 5,000.00</li><li>50% down payment 2 weeks before the event</li><li>50% fill payment at least 3 days before the event</li><li>Our service is up to 5 hours only. If you want to extend the occasion you must pay an additional fee.</li><li>Service of waiter up to 5 hours only, in any excess there will be a charge of P100.00 per hour per waiter including the Driver.</li><li>Charge of P100.00/floor per waiter if the event is held in a building without service elevator.</li><li>Additional charge of P100/waiter if the loading area is 50mts. away from the venue.</li><li>Venue will be only Inside the Camanava Area only.</li><li>Additional P100/waiter for out of town venue including the Driver.</li><li>Any losses, breakages, gate entrance fee, toll fee and caterer’s bond are shouldered by the client.</li><li>LEFTOVERS: In accordance with appropriate Health Codes, CATERER reserves the right to discard any leftover food items, after the agreed upon event timetable, where there is a reasonable risk for food borne illness to occur.</li><li>Cancellation by Acts of God and/or Failure to Provide Service: EDGARDO’S Catering and Events shall have no responsibility or liability for failure to supply any services when prevented from doing so by strikes, accidents, power failure, Acts of God (i.e flood, fire, etc.), or any other.</li><li>Lechon Corkage ( 500/pieces )</li><li>Additional: Main Dish 50/head, Pasta and Vegetable 40/head, Soup 20/head</li><li>Prices are subject to change without prior notice.</li></ul>';

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
							'role' => 'customer'
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
		$this->data['subview'] = 'customer/register';
		$this->load->view('customer/main_layout', $this->data);
	}

	public function forgot_password(){
		if(isset($_POST['submit'])){
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
		$this->data['subview'] = 'customer/forgot_password';
		$this->load->view('customer/main_layout', $this->data);
	}
	public function terms_condition() {
		$this->data['subview'] = 'customer/terms_condition';
		$this->load->view('customer/main_layout', $this->data);
	}


	public function activate($id){
		$data = array(
			'isActive' => 1
		);
		$this->db->where('id', $id);
		if($this->db->update('user_accounts', $data)){
			redirect('admin/employees');
		}

	}
	public function deactivate($id){
		$data = array(
			'isActive' => 0
		);
		$this->db->where('id', $id);
		if($this->db->update('user_accounts', $data)){
			redirect('admin/employees');
		}
	}
	
	public function logout(){
		$this->M_User->logout();
		redirect('user/login');
	}
	public function check_pass(){
		
	}

	public function profile(){
		$id = $this->session->userdata('id');
		if($this->input->post('submit')) {
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
						redirect('user/profile');
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
					redirect('user/profile');
				}
			}
		}
		$this->data['user_details'] = $this->M_User->get_details($id);
		$this->data['subview'] = 'customer/profile';
		$this->load->view('customer/main_layout', $this->data);
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
