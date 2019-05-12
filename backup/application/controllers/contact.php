<?php
class Contact extends Customer_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {

		if($this->input->post('submit')) {
			$this->load->library('email');
			//SMTP & mail configuration
			$name = $this->input->post('name');
			$subject = $this->input->post('subject');
			$email = $this->input->post('email');
			$message = $this->input->post('message');
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
			$this->email->to($email);

			$htmlContent .= "
				<p>Good day! You have a new message from <a href='".base_url()."' target='_blank'>".base_url()."</a></p>
				<table>
					<tr>
						<td>
							<b>Name</b>
						</td>
						<td>".
							$name
						."
						</td>
					</tr>
					<tr>
						<td>
							<b>Email</b>
						</td>
						<td>".
							$email
						."
						</td>
					</tr>
					<tr>
						<td>
							<b>Subject</b>
						</td>
						<td>".
							$subject
						."
						</td>
					</tr>
					<tr>
						<td>
							<b>Message</b>
						</td>
						<td>".
							$message
						."
						</td>
					</tr>
				</table>
			";



			$this->email->from('edgardoscatering31@gmail.com','Edgardos Catering - Message from Website');
			$this->email->subject('Message from Website');
			$this->email->message($htmlContent);

			//Send email
			if($this->email->send()){
				redirect('contact');
			}else{ 
				// return FALSE;
				echo "<script>alert('There is an error occured. Please try again.');</script>";
			}
		}
		$this->data['subview'] = 'customer/contact';
		$this->load->view('customer/main_layout', $this->data);
	}

}
?>