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
	}
}
?>