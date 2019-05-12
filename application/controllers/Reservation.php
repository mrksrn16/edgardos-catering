<?php
class Reservation extends Customer_Controller
{
	function __construct(){
		parent::__construct();
	}

	public function index() {
		$user_id = $this->session->userdata('id');
		if($user_id) {
			$this->data['user_details'] = $this->M_User->get_details($user_id);
		} else {
			$this->data['user_details'] = NULL;
		}
		
		$this->data['subview'] = 'customer/reservation/index';
		$this->load->view('customer/main_layout', $this->data);
	}

	public function details($date=NULL) {

		if($date) {
			$this->data['date'] = $date;
		} else {
			$this->data['date'] = '';
		}
		$tiffany_chair_p = 100;
		$sounds_light_projector = 5000;
		$photobooth = 2000;
		$emcee = 2000;
		$photo_video = 1500;
		$motif = 500;

		if($this->input->post('submit')) {
			$event_type = $this->input->post('event_type');
			$event_date_post = $this->input->post('event_date');

			$this->db->where('name', 'Wedding');
			$res= $this->db->get('services')->row();

			//check if 3 dates
			$this->db->where('event_date', $event_date_post);
			$check_date = $this->db->get('schedules')->result();

			if(count($check_date) >= 3) {
				echo "<script>alert('Selected date is not available, three events only per day. Please select other date.');</script>";
			} else {
				if($event_type == $res->id) {
				$today = date('Y-m-d');
				$effectiveDate = date('Y-m-d', strtotime("+5 months", strtotime($today)));	
				if($event_date_post < $effectiveDate) {
					echo "<script>alert('Wedding event must be reserved atleast 5 months frow the date today.');</script>";
				} else {
					//ok
					$no_guests = $this->input->post('no_guests');
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

					//additional foods
					$additionals_foods_post = $this->input->post('foods');
					
					$additional_food_total = 0;
					foreach($additionals_foods_post as $add_food) {
						$this->db->where('id', $add_food);
						$food_details = $this->db->get('foods')->row();
						$additional_food_total += ($food_details->price * $no_guests);
					}

					$total = ($pck_price * $no_guests) + $additional_total + $additional_food_total;
				}
			} else {
				$no_guests = $this->input->post('no_guests');
				// $additionals = implode(',',  $this->input->post('additionals'));
				$package = $this->input->post('package');
				$pckg = $this->M_Packages->get_by_id($package);
				$pck_price = $pckg->price;
				$additionals_post = $this->input->post('additionals');
				$additionals = array();
				$additional_total = 0;
				if($additionals_post) {
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
				}
				//additional foods
				$additionals_foods_post = $this->input->post('foods');
				
				$additional_food_total = 0;
				foreach($additionals_foods_post as $add_food) {
					$this->db->where('id', $add_food);
					$food_details = $this->db->get('foods')->row();
					$additional_food_total += ($food_details->price * $no_guests);
				}

				$total = ($pck_price * $no_guests) + $additional_total + $additional_food_total;
				if($this->input->post('other_motif')) {
					$motifInput = $this->input->post('other_motif');
				} else {
					$motifInput = $this->input->post('motif');
				}
				$data = array(
						'user_id' => $this->session->userdata('id'),
						'venue' => $this->input->post('venue'),
						'event_date' => $this->input->post('event_date'),
						'event_time' => $this->input->post('event_time'),
						'motif' => $motifInput,
						'occasion' => $this->input->post('occasion'),
						'no_guests' => $no_guests,
						'package' => $package,
						'additionals' => implode(',',  $this->input->post('additionals')),
						'additional_foods' => implode(',',  $this->input->post('foods')),
						'additional_foods_total' => $additional_food_total,
						'event_type' => $event_type,
						'service_style' => implode(',',  $this->input->post('service_style')),
						// 'team' => $this->input->post('team'),
						'status' =>  'waiting',
						'total' => $total,
						'date' => date('Y-m-d')
					);
				if($this->db->insert('schedules', $data)) {
					redirect('reservation/successful/' . $this->db->insert_id());
				}

			}
			}
			
		}
		$this->data['services'] = $this->M_Services->get_all();
		$this->data['packages'] = $this->M_Packages->get_all();
		$this->data['subview'] = 'customer/reservation/details';
		$this->load->view('customer/main_layout', $this->data);
	}

	public function successful($schedule_id) {
		$this->data['showMessage'] = 'no';
		$this->db->where('id', $schedule_id);
		$this->data['schedule'] = $this->db->get('schedules')->row();
		$this->data['subview'] = 'customer/reservation/successful';
		$this->load->view('customer/main_layout', $this->data);
	}

	public function confirm($schedule_id) {
		$schedule_details = $this->M_Schedules->get_by_id($schedule_id);
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
		if($schedule_details->additional_foods) {
			$add_foods = explode(',',$schedule_details->additional_foods);
			foreach($add_foods as $food) {
				$this->db->where('id', $food);
				$food_details = $this->db->get('foods')->row();
				$additional_foods_html .= '<p>'.$food_details->name . ' - <i>' . $food_details->price. '/head</i><p>';
			}
		}
		
		$this->load->library('email');
		//SMTP & mail configuration Live
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

		//SMTP & mail configuration Localhost
		// $config = array(
		//     'protocol'  => 'smtp',
		//     'smtp_host' => 'ssl://smtp.googlemail.com',
		//     'smtp_port' => 465,
		//     'smtp_user' => 'edgardoscatering31@gmail.com',
		//     'smtp_pass' => 'angpagpasasathesis ',
		//     'mailtype'  => 'html',
		//     'charset'   => 'utf-8'
		// );
		// $this->email->initialize($config);
		// $this->email->set_mailtype("html");
		// $this->email->set_newline("\r\n");


		//Email content
		$htmlContent = "<p>Hello,</p><p>We received your reservation. You may deposit the payment thru Smart Padala Remittances with this Account No. 1234567. After the payment please send us the picture of the payment slip. Please pay within 3 days so that your reservation will be processed. Kindly check your reservation request and the terms and conditions. For more info you can call or email us. Thank you!<p>";		
		$htmlContent .= "
			<table>
			<tr>
				<td colspan='2' style='text-align: center;color:#fff;font-weight: bold;background: #e5b701;'>Reservation Details
				</td>
			</tr>
			<tr>
				<td>
					<b>Venue:</b>
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
				'status' => 'pending'
				);
			$this->db->where('id', $schedule_id);
			if($this->db->update('schedules', $data)) {
				$this->data['showMessage'] = 'yes';
				$this->db->where('id', $schedule_id);
				$this->data['schedule'] = $this->db->get('schedules')->row();
				$this->data['subview'] = 'customer/reservation/successful';
				$this->load->view('customer/main_layout', $this->data);	
			}
		}else{ 
			// return FALSE;
			echo "<script>alert('There is an error occured. Please try again.');</script>";
		}
	}


	public function edit($id) {

		$tiffany_chair_p = 100;
		$sounds_light_projector = 5000;
		$photobooth = 2000;
		$emcee = 2000;
		$photo_video = 1500;
		$motif = 500;

		if($this->input->post('submit')) {
			$event_type = $this->input->post('event_type');
			$event_date_post = $this->input->post('event_date');

			$this->db->where('name', 'Wedding');
			$res= $this->db->get('services')->row();

			//check if 3 dates
			$this->db->where('event_date', $event_date_post);
			$check_date = $this->db->get('schedules')->result();

			if(count($check_date) >= 3) {
				echo "<script>alert('Selected date is not available, three events only per day. Please select other date.');</script>";
			} else {
				if($event_type == $res->id) {
				$today = date('Y-m-d');
				$effectiveDate = date('Y-m-d', strtotime("+5 months", strtotime($today)));	
				if($event_date_post < $effectiveDate) {
					echo "<script>alert('Wedding event must be reserved atleast 5 months frow the date today.');</script>";
				} else {
					//ok
					$no_guests = $this->input->post('no_guests');
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

					//additional foods
					$additionals_foods_post = $this->input->post('foods');
					
					$additional_food_total = 0;
					foreach($additionals_foods_post as $add_food) {
						$this->db->where('id', $add_food);
						$food_details = $this->db->get('foods')->row();
						$additional_food_total += ($food_details->price * $no_guests);
					}

					$total = ($pck_price * $no_guests) + $additional_total + $additional_food_total;
				}
			} else {
				$no_guests = $this->input->post('no_guests');
				// $additionals = implode(',',  $this->input->post('additionals'));
				$package = $this->input->post('package');
				$pckg = $this->M_Packages->get_by_id($package);
				$pck_price = $pckg->price;
				$additionals_post = $this->input->post('additionals');
				$additionals = array();
				$additional_total = 0;
				if($additionals_post) {
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
				}
				//additional foods
				$additionals_foods_post = $this->input->post('foods');
				
				$additional_food_total = 0;
				foreach($additionals_foods_post as $add_food) {
					$this->db->where('id', $add_food);
					$food_details = $this->db->get('foods')->row();
					$additional_food_total += ($food_details->price * $no_guests);
				}

				$total = ($pck_price * $no_guests) + $additional_total + $additional_food_total;
				if($this->input->post('other_motif')) {
					$motifInput = $this->input->post('other_motif');
				} else {
					$motifInput = $this->input->post('motif');
				}
				$data = array(
						'user_id' => $this->session->userdata('id'),
						'venue' => $this->input->post('venue'),
						'event_date' => $this->input->post('event_date'),
						'event_time' => $this->input->post('event_time'),
						'motif' => $motifInput,
						'occasion' => $this->input->post('occasion'),
						'no_guests' => $no_guests,
						'package' => $package,
						'additionals' => implode(',',  $this->input->post('additionals')),
						'additional_foods' => implode(',',  $this->input->post('foods')),
						'additional_foods_total' => $additional_food_total,
						'event_type' => $event_type,
						'service_style' => implode(',',  $this->input->post('service_style')),
						// 'team' => $this->input->post('team'),
						'status' =>  'waiting',
						'total' => $total,
						'date' => date('Y-m-d')
					);
				$this->db->where('id', $id);
				if($this->db->update('schedules', $data)) {
					redirect('reservation/successful/' . $id);
				}

				}
			}
			
		}

		$this->db->where('id', $id);
		$this->data['schedule'] = $this->db->get('schedules')->row();
		$this->data['services'] = $this->M_Services->get_all();
		$this->data['packages'] = $this->M_Packages->get_all();
		$this->data['subview'] = 'customer/reservation/edit';
		$this->load->view('customer/main_layout', $this->data);
	}

}
?>