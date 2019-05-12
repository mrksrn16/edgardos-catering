<?php
class Calendar extends Customer_Controller
{
	function __construct(){
		parent::__construct();
	}
	public function get_events() {
     // Our Start and End Dates
     $start = $this->input->get("start");
     $end = $this->input->get("end");

     $startdt = new DateTime('now'); // setup a local datetime
     $startdt->setTimestamp($start); // Set the date based on timestamp
     $start_format = $startdt->format('Y-m-d H:i:s');

     $enddt = new DateTime('now'); // setup a local datetime
     $enddt->setTimestamp($end); // Set the date based on timestamp
     $end_format = $enddt->format('Y-m-d H:i:s');

    $events = $this->Calendar_Model->get_events($start_format, $end_format);

    // echo json_encode($events);
    $data_events = array();

     foreach($events->result() as $r) {

        $service = $this->M_Services->get_by_id($r->event_type);
        $eventColor = "";
        if($r->status == 'pending') {
            $eventColor = "#FF9800";
        } else {
            if($r->team == 'Team A') {
                $eventColor = "#e91e63";
            }
            if($r->team == 'Team B') {
                $eventColor = "#2196f3";
            }
            if($r->team == 'Team C') {
                $eventColor = "#ffeb3b";
            }
        }
        $usr = $this->M_User->get_details($r->user_id);
        $data_events[] = array(
             "id" => $r->id,
             "title" => "Name: " . $usr->firstname . ' ' . $usr->lastname . '    Event:' . $service->name,
             "description" => '$r->description',
             "end" => $r->event_date,
             "start" => $r->event_date,
             "color" => $eventColor,
             "textColor" => '#fff',
             "status" => $r->status
         );
     }

     echo json_encode(array("events" => $data_events));
     exit();
 	}

    public function check_date (){
        // echo json_encode(array("status" => true));
         $date = $this->input->get("date");

         $dt = new DateTime('now'); // setup a local datetime
         $dt->setTimestamp($date); // Set the date based on timestamp
         $date_format = $dt->format('Y-m-d');

         $this->db->where('event_date', $date_format);
         $res = $this->db->get('schedules')->result();
         echo json_encode(array("schedule_date_count" => count($res)));
    }

    public function get_schedule() {
        $date = $this->input->get("date");
        $this->db->where('event_date', $date);
        $res = $this->db->get('schedules')->result();
        echo json_encode(array("schedule_count" => count($res)));
    }

	// public function add_event($data)
	// {
	//     $this->db->insert("calendar_events", $data);
	// }

	// public function get_event($id)
	// {
	//     return $this->db->where("ID", $id)->get("calendar_events");
	// }

	// public function update_event($id, $data)
	// {
	//     $this->db->where("ID", $id)->update("calendar_events", $data);
	// }

	// public function delete_event($id)
	// {
	//     $this->db->where("ID", $id)->delete("calendar_events");
	// }


}

?>