<?php
class Customer_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->data['meta_title'] = 'Edgardos Catering';
		//Loaded helpers,libraries,models
		$this->load->library('form_validation');
		$this->load->model('M_User');
		$this->load->model('M_Services');
		$this->load->model('M_Schedules');
		$this->load->model('M_Motifs');
		$this->load->model('M_Packages');
		$this->load->model('Calendar_Model');
	}
}
?>