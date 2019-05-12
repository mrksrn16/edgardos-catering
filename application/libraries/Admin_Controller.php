<?php
class Admin_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->data['meta_title'] = 'Edgardos Catering';
		//Loaded helpers,libraries,models
		$this->load->library('form_validation');
		$this->load->model('M_User');
		$this->load->model('M_Services');
		$this->load->model('M_Motifs');
		$this->load->model('M_Foods');
		$this->load->model('M_Packages');
		$this->load->model('M_Schedules');
		$this->load->model('M_Teams');
		//Login Check
		$exception_uris = array(
			'admin/user/login',
			'admin/user/logout',
			'admin/user/forgot_password',
			);
		if(in_array(uri_string(), $exception_uris) == FALSE)
		{
			if($this->M_User->loggedin() == FALSE)
			{
				redirect('admin/user/login');
			}
		}


		// if($this->M_User->loggedin() == TRUE) {
			//send email when event date is finished
		$where = "status = 'accepted' AND event_date <= CURDATE() AND feedback IS NULL";
		// $where = "status = 'accepted' AND DATE_FORMAT(event_date,'%Y/%m/%d') <= CURDATE()";
		$this->db->where($where);
		$sched = $this->db->get('schedules')->result();
		if($sched) {
			
			foreach($sched as $schedule) {
			$this->db->where('user_id', $schedule->user_id);
			$usr = $this->db->get('user_details')->row();
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
			$htmlContent = '<p>Dear Valuable Customer, </p>';
			$htmlContent .= "<p>We truly hope that your event was a success. The Edgardo's catering provide the best service to our customers and we hope that you enjoyed your experience with our Catering Services. We really need your helpful comments or feedback about our services. We want to let you know that we were able to use your feedback to develop an amazing new change. We really appreciate the time you took to give feedback to help us to improve . thanks for being amazing customer! best wishes, edgardos catering</p>";
			$htmlContent .= '<p>Best Wishes, </p>';
			$htmlContent .= "<p>Edgardo's Catering</p>";

			$this->email->to($usr->email);
			$this->email->from('edgardoscatering31@gmail.com','Edgardos Catering - Thank you message');
			$this->email->subject('Thank you message');
			$this->email->message($htmlContent);
			
			//Send email
			if($this->email->send()){
				$data = array(
						'feedback' => 'yes'
					);
				$this->db->where('id', $schedule->id);
				$this->db->update('schedules', $data);
			}else{
				echo "<script>alert('There is an error occured. Please try again.');</script>";
			}
			}
		}
		// }

	}
}
?>