<?php 
class M_Schedules extends MY_Model
{

	protected $_table_name = 'schedules';
	protected $_primary_key = 'id';
	function __construct()
	{
		parent::__construct();
	}

	public function get_all() {
		$this->db->like('status', 'accepted');
		$this->db->or_like('status', 'cancelled');
		$this->db->or_like('status', 'rejected');
		$this->db->order_by('id', 'desc');
		return $this->db->get($this->_table_name)->result();
	}
	public function get_by_id($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->_table_name)->row();
	}
	public function get_pending() {
		$this->db->where('status', 'pending');
		return $this->db->get($this->_table_name)->result();
	}
	public function get_pending_rejected() {
		$this->db->like('status', 'pending');
		$this->db->or_like('status', 'rejected');
		return $this->db->get($this->_table_name)->result();
	}
	public function get_archived() {
		$this->db->like('status', 'archived');
		return $this->db->get($this->_table_name)->result();
	}
	public function search($keyword) {
		// $this->db->like('venue', $keyword);
		// $this->db->or_like('event_date', $keyword);
		// $this->db->or_like('event_time', $keyword);
		// $this->db->or_like('motif', $keyword);
		// $this->db->or_like('occasion', $keyword);
		// $this->db->or_like('no_guests', $keyword);
		// $this->db->or_like('event_type', $keyword);
		// $this->db->or_like('additionals', $keyword);
		// $this->db->or_like('service_style', $keyword);
		// $this->db->or_like('team', $keyword);
  //    	$query = $this->db->get($this->_table_name);
  //    	$this->db->order_by('id', 'desc');
  //    	return $query->result();

		$this->db->select('*');
      	$this->db->from("schedules AS s");
      	$this->db->join("user_details AS ud", "s.user_id = ud.user_id");

		$this->db->like('s.venue', $keyword);
		$this->db->or_like('s.event_date', $keyword);
		$this->db->or_like('s.event_time', $keyword);
		$this->db->or_like('s.motif', $keyword);
		$this->db->or_like('s.occasion', $keyword);
		$this->db->or_like('s.no_guests', $keyword);
		$this->db->or_like('s.event_type', $keyword);
		$this->db->or_like('s.additionals', $keyword);
		$this->db->or_like('s.service_style', $keyword);
		$this->db->or_like('s.team', $keyword);
		$this->db->or_like('ud.firstname', $keyword);
		$this->db->or_like('ud.lastname', $keyword);
     	
     	$query = $this->db->get();
      	return $query->result();


	}
}

?>