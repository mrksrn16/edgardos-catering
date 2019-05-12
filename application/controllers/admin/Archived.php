<?php
class Archived extends Admin_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$this->data['events'] = $this->M_Services->get_all();
		$this->data['schedules'] = $this->M_Schedules->get_archived();
		$this->data['subview'] = 'admin/archived/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function make_pending($id) {
		$data = array(
			'status' => 'pending'
			);
		$this->db->where('id', $id);
		if($this->db->update('schedules', $data)) {
			redirect('admin/requests/view/'. $id);
		}
	}

	public function filter_events() {
		$event_id = $this->input->post('event_id');
		$this->db->where('event_type', $event_id);
		$this->data['schedules'] = $this->db->get('schedules')->result();
		$this->data['events'] = $this->M_Services->get_all();
		$this->data['subview'] = 'admin/archived/index';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function view($id) {
		$this->data['packages'] = $this->M_Packages->get_all();
		$this->data['schedule'] = $this->M_Schedules->get_by_id($id);
		$this->data['subview'] = 'admin/archived/view';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function edit($id) {

		if($this->input->post('submit')) {
			$tiffany_chair_p = 100;
			$sounds_light_projector = 5000;
			$photobooth = 2000;
			$emcee = 2000;
			$photo_video = 1500;
			$motif = 500;

			$event_type = $this->input->post('event_type');

			$no_guests = $this->input->post('no_guests');
			// $additionals = implode(',',  $this->input->post('additionals'));
			$package = $this->input->post('package');
			$pckg = $this->M_Packages->get_by_id($package);
			$pck_price = $pckg->price;
			$additionals_post = $this->input->post('additionals');

			$additionals = array();
			$additional_total = 0;
			foreach ($additionals_post as $additional) {
				$additionals[] = $additional;
			}
			if(in_array("Sounds and light with projector", $additionals)) {
				$additional_total += $sounds_light_projector;
			}
			if(in_array("Photoboth for 2 hRs", $additionals)) {
				$additional_total += $photobooth;
			}
			if(in_array("Photo and video", $additionals)) {
				$additional_total += $photo_video;
			}
			if(in_array("Tiffany chair", $additionals)) {
				$additional_total += $tiffany_chair_p;
			}
			if(in_array("Emcee", $additionals)) {
				$additional_total += $emcee;
			}
			if(in_array("Motif", $additionals)) {
				$additional_total += $motif;
			}

			$total = ($pck_price * $no_guests) + $additional_total;

			$data = array(
					'venue' => $this->input->post('venue'),
					'event_date' => $this->input->post('event_date'),
					'event_time' => $this->input->post('event_time'),
					'motif' => $this->input->post('motif'),
					'occasion' => $this->input->post('occasion'),
					'no_guests' => $no_guests,
					'package' => $package,
					'additionals' => implode(',',  $this->input->post('additionals')),
					'event_type' => $event_type,
					'service_style' => implode(',',  $this->input->post('service_style')),
					'team' => $this->input->post('team'),
					'total' => $total
				);
			$this->db->where('id', $id);
			if($this->db->update('schedules', $data)) {
				redirect('admin/archived');
			}
		}

		$this->data['services'] = $this->M_Services->get_all();
		$this->data['packages'] = $this->M_Packages->get_all();
		$this->data['schedule'] = $this->M_Schedules->get_by_id($id);
		$this->data['subview'] = 'admin/archived/edit';
		$this->load->view('admin/main_layout', $this->data);
	}

	public function reject($id) {
		$schedule_details = $this->M_Schedules->get_by_id($id);
		$usr_details = $this->M_User->get_details($schedule_details->user_id);
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
		$htmlContent = "<p>Good day,</p><p style='margin-left: 10px;'>Your reservation has been rejected for some reasons. Please contact us for more information. Thank you!.</p><p><i>-Edgardos Catering</i></p>";
		// $htmlContent .= '<p>'. $new_pass . '</p>';

		$this->email->to($usr_details->email);
		$this->email->from('edgardoscatering31@gmail.com','Edgardos Catering - Reservation Details');
		$this->email->subject('Reservation Details');
		$this->email->message($htmlContent);

		//Send email
		if($this->email->send()){
			$data = array(
			'status' => 'rejected'
			);
			$this->db->where('id', $id);
			if($this->db->update('schedules', $data)) {
				redirect('admin/schedules');
			}
		}else{
			echo "<script>alert('There is an error occured. Please try again.');</script>";
		}
	}

	public function accept($id) {
		$schedule_details = $this->M_Schedules->get_by_id($id);
		$event_type_details = $this->M_Services->get_by_id($schedule_details->event_type);
		$package_details = $this->M_Packages->get_by_id($schedule_details->package);
		$usr_details = $this->M_User->get_details($schedule_details->user_id);

		$adds = explode(',',$schedule_details->additionals);
		$chk_adds = array();
		foreach($adds as $add) {
			$chk_adds[] = $add;
		}

		$addditionalHtml = "";

		if(in_array("Sounds and light with projector", $chk_adds)) {
			$addditionalHtml.= '<p>Sounds and light with projector -<i>5000</i></p>';
		}
		if(in_array("Photoboth for 2 hRs", $chk_adds)) {
			$addditionalHtml.= '<p>Photoboth for 2 hRs -<i>2000</i></p>';
		}
		if(in_array("Emcee", $chk_adds)) {
			$addditionalHtml.= '<p>Emcee -<i>2000</i></p>';
		}
		if(in_array("Photo and video", $chk_adds)) {
			$addditionalHtml.= '<p>Photo and video -<i>1500</i></p>';
		}
		if(in_array("Motif", $chk_adds)) {
			$addditionalHtml.= '<p>Motif -<i>500</i></p>';
		}

		$additional_foods_html = "";
		$add_foods = explode(',',$schedule_details->additional_foods);
		foreach($add_foods as $food) {
			$this->db->where('id', $food);
			$food_details = $this->db->get('foods')->row();
			$additional_foods_html .= '<p>'.$food_details->name . ' - <i>' . $food_details->price. '</i><p>';
		}

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
		$htmlContent = "<p>
		Good day mam/sir , we already reserved you reservation. Your reservation number is ". str_pad($schedule_details->id, 5, "0", STR_PAD_LEFT) .". We hope that you will enjoy our service . Thank you.
		</p>";		
		$htmlContent .= "
			<table>
			<tr>
				<td colspan='2' style='text-align: center;color:#fff;font-weight: bold;background: #e5b701;'>Reservation Details
				</td>
			</tr>
			<tr>
				<td>
					<b>Address:</b>
				</td>
				<td>". $schedule_details->venue."</td>
			</tr>
			<tr>
				<td><b>Event Type:</b></td>
				<td>". $event_type_details->name ."</td>
			</tr>
			<tr>
				<td><b>Event Date:</b></td>
				<td>".date('M d Y', strtotime($schedule_details->event_date))."</td>
			</tr>
			<tr>
				<td><b>Event Time:</b></td>
				<td>". date('h:i: a', strtotime($schedule_details->event_time)) ."</td>
			</tr>
			<tr>
				<td><b>Motif:</b></td>
				<td>". $schedule_details->motif ."</td>
			</tr>
			<tr>
				<td><b>Occasion:</b></td>
				<td>". $schedule_details->occasion ."</td>
			</tr>
			<tr>
				<td><b>No of Guests:</b></td>
				<td>". $schedule_details->no_guests ."</td>
			</tr>
			<tr>
				<td><b>Package:</b></td>
				<td>". $package_details->name ."</td>
			</tr>
			<tr>
				<td><b>Additionals:</b></td>
				<td>" . $schedule_details->additionals ."</td>
			</tr>
			<tr>
				<td><b>Service Style:</b></td>
				<td>" . $schedule_details->service_style . "</td>
			</tr>
			<tr>
				<td><b>Assign Team:</b></td>
				<td>". $schedule_details->team ."</td>
			</tr>
			</table>
			<table>
			<tr>
				<td colspan='2' style='text-align: center;color:#fff;font-weight: bold;background: #e5b701;'>
					Cutomer Information
				</td>
			</tr>
			<tr>
				<td><b>Name:</b></td>
				<td>". $usr_details->firstname . ' ' . $usr_details->lastname ."</td>
			</tr>
			<tr>
				<td><b>Email:</b></td>
				<td>" . $usr_details->email ."</td>
			</tr>
			<tr>
				<td><b>Address:</b></td>
				<td>". $usr_details->address ."</td>
			</tr>
			<tr>
				<td><b>Contact:</b></td>
				<td>". $usr_details->contact ."</td>
			</tr>
			</table>
			<table>
			<tr>
				<td colspan='2' style='text-align: center;color:#fff;font-weight: bold;background: #e5b701;'>
					Computation
				</td>
			</tr>
			<tr>
				<td colspan='2'>
					<p><b>Package:</b></p>
					<p>". $package_details->name ." - <i>(" . $package_details->price ." * " . $schedule_details->no_guests.") = ". $package_details->price * $schedule_details->no_guests."</i></p>
					<p><b>Additional Foods:</b></p>".$additional_foods_html."
					<p><b>Additionals:</b></p>".$addditionalHtml."</td>
			</tr>
			<tr style='background: #eee;'>
				<td><b>Total:</b></td>
				<td><b>". $schedule_details->total ."</b></td>
			</tr>
			</table>
			<p>These are the terms and conditions:</p>
			<ul><li>Slot  reservation 5,000.00</li><li>50% down payment 2 weeks before the event</li><li>50% fill payment at least 3 days before the event</li><li>Our service is up to 5 hours only. If you want to extend the occasion you must pay an additional fee.</li><li>Service of waiter up to 5 hours only, in any excess there will be a charge of P100.00 per hour per waiter including the Driver.</li><li>Charge of P100.00/floor per waiter if the event is held in a building without service elevator.</li><li>Additional charge of P100/waiter if the loading area is 50mts. away from the venue.</li><li>Venue will be only Inside the Camanava Area only.</li><li>Additional P100/waiter for out of town venue including the Driver.</li><li>Any losses, breakages, gate entrance fee, toll fee and caterer’s bond are shouldered by the client.</li><li>LEFTOVERS: In accordance with appropriate Health Codes, CATERER reserves the right to discard any leftover food items, after the agreed upon event timetable, where there is a reasonable risk for food borne illness to occur.</li><li>Cancellation by Acts of God and/or Failure to Provide Service: EDGARDO’S Catering and Events shall have no responsibility or liability for failure to supply any services when prevented from doing so by strikes, accidents, power failure, Acts of God (i.e flood, fire, etc.), or any other.</li><li>Lechon Corkage ( 500/pieces )</li><li>Additional: Main Dish 50/head, Pasta and Vegetable 40/head, Soup 20/head</li><li>Prices are subject to change without prior notice.</li></ul>
			";

		$this->email->to($usr_details->email);
		$this->email->from('edgardoscatering31@gmail.com','Edgardos Catering - Reservation Details');
		$this->email->subject('Reservation Details');
		$this->email->message($htmlContent);

		//Send email
		if($this->email->send()){
			$data = array(
			'status' => 'accepted'
			);
			$this->db->where('id', $id);
			if($this->db->update('schedules', $data)) {
				redirect('admin/schedules');
			}
		}else{
			echo "<script>alert('There is an error occured. Please try again.');</script>";
		}
	}

	public function sendmail($id) {
		$this->db->where('id', $id);
		$sched = $this->db->get('schedules')->row();
		$this->db->where('user_id', $sched->user_id);
		$user = $this->db->get('user_details')->row();
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
		$htmlContent = "<p>Good day, your request is go beyond the limit date or near to its due date.</p><p>Kindly follow our terms and conditions or you can contact or email us for more questions. Thank you!</p><p>Regards,</p><b><i>Edgardo's Catering</i></b>";

		$this->email->to($user->email);
		$this->email->from('edgardoscatering31@gmail.com','Edgardos Catering - Follow up message');
		$this->email->subject('Follow up message');
		$this->email->message($htmlContent);

		//Send email
		if($this->email->send()){
			$this->session->set_flashdata('message', 'Email Sent.');
			redirect('admin/archived/view/' . $id);

		}else{
			$this->session->set_flashdata('message', 'There is an error occured. Please try again.');
			redirect('admin/archived/view/' . $id);
		}
	}
}

?>