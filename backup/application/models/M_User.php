<?php 
class M_User extends MY_Model
{

	protected $_table_name = 'user_accounts';
	protected $_primary_key = 'id';
	function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		$user = $this->get_by(array(
			'username' => $this->input->post('username'),
			'password' => $this->hash($this->input->post('password'))
			), TRUE);
		if(count($user))
		{
			$data = array(
				'username' => $user->username,
				'id' => $user->id,
				'role' => $user->role,
				'logged_in' => TRUE
				);
			$this->session->set_userdata($data);
		}
		else
		{
			$data = array(
				'logged_in' => FALSE
				);
			$this->session->set_userdata($data);
		}
	}
	public function loggedin()
	{
		return (bool)$this->session->userdata('logged_in');
	}
	public function logout()
	{
		$this->session->sess_destroy();
	}
	public function hash($string)
	{
		return hash('md5',$string);
	}
	public function generate_id($id){
		$id;
		if(strlen("$id") == 1){
			$id = "18-00" . $id;
		}else if(strlen("$id") == 2){
			$id = "18-0" . $id;
		}else if(strlen("$id") == 3){
			$id = "18-" . $id;
		}
		return $id;
	}
	public function get_login_user_details(){
		$id = $this->session->userdata('id');
		$this->db->where('account_id', $id);
		return $this->db->get('employees')->row();
	}
	public function get_login_user_accounts(){
		$id = $this->session->userdata('id');
		$this->db->where('id', $id);
		return $this->db->get('user_accounts')->row();
	}
	public function check_email($email) {
		$this->db->where('email', $email);
		$res = $this->db->get('user_details')->row();
		if($res) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function get_customers() {
		$this->db->where('role !=', 'superadmin');
		return $this->db->get($this->_table_name)->result();
	}
	public function get_accounts($id) {
		$this->db->where('id', $id);
		return $this->db->get($this->_table_name)->row();
	}
	public function get_details($user_id) {
		$this->db->where('user_id', $user_id);
		return $this->db->get('user_details')->row();
	}
	public function search($keyword) {
		$this->db->like('firstname', $keyword);
		$this->db->or_like('lastname', $keyword);
     	$this->db->or_like('address', $keyword);
     	$this->db->or_like('contact', $keyword);
     	$query = $this->db->get('user_details');
     	$this->db->order_by('id', 'desc');
     	return $query->result();
	}
	public function check_if_superadmin() {
		if($this->session->userdata('role') != 'superadmin') {
			redirect('admin/services');
		}
	}
}

?>