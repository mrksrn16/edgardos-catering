<?php 
class Calendar_Model extends MY_Model
{
public function get_events($start, $end)
{
    return $this->db->where("event_date >=", $start)->where("event_date <=", $end)->get("schedules");
}

public function add_event($data)
{
    $this->db->insert("calendar_events", $data);
}

public function get_event($id)
{
    return $this->db->where("ID", $id)->get("calendar_events");
}

public function update_event($id, $data)
{
    $this->db->where("ID", $id)->update("calendar_events", $data);
}

public function delete_event($id)
{
    $this->db->where("ID", $id)->delete("calendar_events");
}

}