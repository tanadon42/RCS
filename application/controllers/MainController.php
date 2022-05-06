<?php
/*
* MainCcontroller
* -
* @input  -
* @output -
* @author Kunanya Singmee
* @Update Date 2563-09-1
*/

defined('BASEPATH') or exit('No direct script access allowed');

class MainController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function header()
	{
		$this->load->view('includes/template/header');
	}

	public function javascript()
	{
		$this->load->view('includes/template/javascript');
	}

	public function footer()
	{
		$this->load->view('includes/template/footer');
	}

	public function topbar()
	{
		$this->load->view('includes/template/topbar');
	}

	public function sidebar()
	{
		$this->load->view('includes/template/sidebar');
	}

	public function output($body, $data = '')
	{
		$this->header();
		$this->sidebar();
		$this->topbar();
		$this->load->view($body, $data);
		$this->javascript();
		$this->footer();
	}

}
?>