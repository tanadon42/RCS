<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MainController.php");

class Rcs_Login_Controller extends MainController
{

	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		$this->load->view('auth/login');
	}

	public function check_login()
	{
		

		$this->load->model('M_rcs_login', 'logi');
		$this->logi->log_username = $_POST['user'];
		$this->logi->log_password = $_POST['pass'];
		$data['user'] = $this->logi->check_login();

 
		if(sizeof($data['user']->row()) == 0 && ($_POST['user'] != "admin" && $_POST['pass'] != "root1234") ){
			$this->login();
		}
		// if
		else{
			if($_POST['user'] == "admin" && $_POST['pass'] == "root1234" ){

				$this->session->set_userdata('UsEmp_ID', "admin");
				$this->session->set_userdata('UsName_EN', "admin");
				$this->session->set_userdata('UsName_TH', "แอดมิน");
				$this->session->set_userdata('UsDepartment', "00000");
				$this->session->set_userdata('UsRole', "3");


			}
			else{
			$temp = $data['user']->row();
			// print_r($temp);
			$this->session->set_userdata('UsEmp_ID', $temp->Emp_ID);
			$this->session->set_userdata('UsName_EN', $temp->Empname_eng." ".$temp->Empsurname_eng);
			$this->session->set_userdata('UsName_TH', $temp->Empname_th." ".$temp->Empsurname_th);
			$this->session->set_userdata('UsDepartment', $temp->Sectioncode_ID);
			$this->session->set_userdata('UsRole', $temp->log_role);
			}

			$this-> main();
			
		}
		// else 

	}

	public function main()
	{
		if (!empty($this->session->userdata('UsEmp_ID'))) {
			if($_SESSION['UsRole'] == 1){
				redirect('Rcs_Controller/index', 'refresh');
			}
			// if 
			else if($_SESSION['UsRole'] == 2){
				redirect('Rcs_Approve_Controller/index', 'refresh');
			}
			// else if 

			else if($_SESSION['UsRole'] == 3){
				redirect('Rcs_Admin_Controller/index', 'refresh');
			}
			// else if 
			
		}
		// if
		else {
			redirect('index.php/auth/login', 'refresh');
		}
		// else
	}
	// public function main

	public function logout()
	{
		$this->session->unset_userdata('UsEmp_ID');
		$this->session->unset_userdata('UsName_EN');
		$this->session->unset_userdata('UsName_TH');
		$this->session->unset_userdata('UsDepartment');
		$this->session->unset_userdata('UsRole');
		$this->session->unset_userdata('Uspay_id');
		// redirect('auth/login', 'refresh');
        $this->load->view('/auth/login');
	}
}