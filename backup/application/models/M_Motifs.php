<?php 
class M_Motifs extends MY_Model
{

	protected $_table_name = 'motifs';
	protected $_primary_key = 'id';
	function __construct()
	{
		parent::__construct();
	}

	public function get_all() {
		// $this->db->where('name!=', 'Occasion Motif');
		return $this->db->get($this->_table_name)->result();
	}
	
	public function get_by_id($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->_table_name)->row();
	}
	public function search($keyword) {
		$this->db->like('name', $keyword);
		$this->db->or_like('description', $keyword);
     	$query = $this->db->get($this->_table_name);
     	$this->db->order_by('id', 'desc');
     	return $query->result();
	}
}

?>