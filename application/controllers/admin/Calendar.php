<?php
class Calendar extends Customer_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		//update to pending
		$this->db->where('status', 'pending');
		$schedules = $this->db->get('schedules')->result();
		foreach($schedules as $schedule) {
			$plus4days =  date('d-m-Y', strtotime($schedule->event_date. ' + 4 days'));
			$today = date('d-m-Y');
			if($today > $plus4days) {
				$data = array(
					'status' => 'archived'
				);
				$this->db->where('id', $schedule->id);
				$this->db->update('schedules', $data);
			}
		}

		// //send email when event date is finished
		// $where = "status = 'accepted' AND event_date <= CURDATE()";
		// // $where = "status = 'accepted' AND DATE_FORMAT(event_date,'%Y/%m/%d') <= CURDATE()";
		// $this->db->where($where);
		// $sched = $this->db->get('schedules')->result();
		// if($sched) {
		// 	foreach($sched as $schedule) {
		// 	$this->db->where('user_id', $schedule->user_id);
		// 	$usr = $this->db->get('user_details')->row();
		// 	//Send on email
		// 	$this->load->library('email');
		// 	//SMTP & mail configuration
		// 	$config = array(
		// 	    'protocol'  => 'smtp',
		// 	    'smtp_host' => 'ssl://smtp.googlemail.com',
		// 	    'smtp_port' => 465,
		// 	    'smtp_user' => 'edgardoscatering31@gmail.com',
		// 	    'smtp_pass' => 'angpagpasasathesis ',
		// 	    'mailtype'  => 'html',
		// 	    'charset'   => 'utf-8'
		// 	);
		// 	$this->email->initialize($config);
		// 	$this->email->set_mailtype("html");
		// 	$this->email->set_newline("\r\n");

		// 	//Email content
		// 	$htmlContent = '<p>Dear Valuable Customer, </p>';
		// 	$htmlContent .= "<p>We truly hope that your event was a success. The Edgardo's catering provide the best service to our customers and we hope that you enjoyed your experience with our Catering Services. We really need your helpful comments or feedback about our services. We want to let you know that we were able to use your feedback to develop an amazing new change. We really appreciate the time you took to give feedback to help us to improve . thanks for being amazing customer! best wishes, edgardos catering</p>";
		// 	$htmlContent = '<p>Best Wishes, </p>';
		// 	$htmlContent = "<p>Edgardo's Catering</p>";

		// 	$this->email->to($user->email);
		// 	$this->email->from('edgardoscatering31@gmail.com','Edgardos Catering - Thank you message');
		// 	$this->email->subject('Thank you message');
		// 	$this->email->message($htmlContent);
			
		// 	//Send email
		// 	if($this->email->send()){
		// 	}else{
		// 		echo "<script>alert('There is an error occured. Please try again.');</script>";
		// 	}
		// 	}
		// }

		$this->data['subview'] = 'admin/calendar';
		$this->load->view('admin/main_layout', $this->data);
	}

}
?>