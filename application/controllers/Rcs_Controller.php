<?php
/*
* ---
* ---
* @input  -
* @output -
* @author 	Tanadon Tangjaimongkhon
* @Create Date 2565-01-31
*/

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__) . "/MainController.php");

class Rcs_Controller extends MainController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	/*
	* index()
	* @input  -
	* @output แสดงรายการแบบฟอร์มขอพนักงานสำหรับผู้ที่เข้ามาล็อคอิน
	*/
	function index(){
		$this->load->model('M_rcs_form','frm');
		$this->load->model('M_rcs_dbmc','dbmc');
		$data['departments'] = $this->dbmc->get_all_department()->result();	//	ข้อมูลรายการแผนก
		$data['form_info'] = $this->frm->get_all_by_userid()->result();	//ข้อมูลรายการแบบฟอร์ม
		$this->output('/consent/index',$data);
	}
	
	/*
	* search_data()
	* @input  ประเภทการรับสมัคร, แผนก, วันที่สร้างแบบฟอร์ม และสถานะ
	* @output แสดงข้อมูลการค้นหารายการแบบฟอร์มขอพนักงานสำหรับผู้ดูแลระบบ
	*/
	function search_data(){	
		$this->load->model('M_rcs_form','frm');
		$type = $this->input->post('type');	//ประเภทการรับสมัคร
		$department_id = $this->input->post('department_id');	//แผนก
		$create_date = $this->input->post('create_date');	//วันที่สร้างแบบฟอร์ม
		$status_form = $this->input->post('status_form');	//สถานะ

		if($type == null){
			$type = NULL;
		}
		if($department_id == null){
			$department_id = NULL;
		}
		if($create_date == null){
			$create_date = NULL;
		}
		if($status_form == null){
			$status_form = NULL;
		}
		$this->frm->ctg_employment_type = $type;
		$this->frm->Department_id = $department_id;
		$this->frm->apr_preparer_date = $create_date;
		$this->frm->frm_status = $status_form;
		$data = $this->frm->search_by_key_dashboard()->result(); //ข้อมูลการค้นหาแบบฟอร์มสำหรับผู้ที่เข้ามาล็อคอิน
		echo json_encode($data);
	}

	/*
	* form_detail()
	* @input  form_id
	* @output แสดงรายละเอียดแบบฟอร์มขอพนักงานสำหรับผู้ที่เข้ามาล็อคอิน
	*/
	function form_detail($form_id){
		$this->load->model('M_rcs_dbmc','dbmc');
		$this->load->model('M_rcs_form','frm');
		$this->load->model('M_rcs_name_list','nlt');
		$data['form_id'] = $form_id;
		$this->nlt->nlt_type = 2; //ประเภทพนักงานทดแทน (1=ลาออก, 2=ทดแทน)
		$this->nlt->nlt_frm_id = $form_id;
		$this->frm->frm_id = $form_id;
		$form_info = $this->frm->get_form_by_approve()->result(); //ข้อมูลแบบฟอร์ม (ผ่าน หรือ ไม่ผ่านประธาน)
		$data['form_data'] = $this->frm->get_all_by_id()->result(); //ข้อมูลแบบฟอร์มตามที่เลือกแก้ไข (id)
		$approver_info_temp = []; //temp ข้อมูลผู้อนุมัติ
		$approver_info = []; //ข้อมูลผู้อนุมัติ

		foreach($form_info as $index => $row){
			if($row->ctg_internal_type == 3 || $row->ctg_employment_type == 2){
				$state_to_president = "yes";
			}// ผ่านประธาน
			else{
				$state_to_president = "no";
			}// ไม่ผ่านประธาน
		}

		foreach($data['form_data'] as $index => $row){

			$approver_info_temp[0] = $row->apr_preparer_emp_id;
			$approver_info_temp[1] = $row->apr_checker_emp_id;
			$approver_info_temp[2] = $row->apr_approver_emp_id;
			$approver_info_temp[3] = $row->apr_approver_md_emp_id;
			$approver_info_temp[4] = $row->apr_receiver_admin_emp_id;
			$approver_info_temp[5] = $row->apr_checker_admin_emp_id;
			$approver_info_temp[6] = $row->apr_approver_admin_emp_id;

			for($i = 0; $i<7; $i++){

				$get_approver_info = $this->dbmc->get_approver_data($approver_info_temp[$i])->result();
				foreach($get_approver_info as $index => $row_get){
					array_push($approver_info, $row_get);
				}
			}
		}

		$data['state_to_president'] = $state_to_president;	//ผ่าน หรือ ไม่ผ่านประธาน
		$data['approver_info'] = $approver_info;	//ข้อมูลผู้อนุมัติ
		$data['emp_info'] = $this->frm->get_emp_form()->result(); //รายการพนักงานลาออก หรือ โอนย้าย
		$data['nlt_info'] = $this->nlt->get_by_key()->result();	//รายการพนักงานทดแทน
		$this->output('/consent/form_detail',$data);
	}

	/*
	* login()
	* @input  
	* @output แสดงหน้าล็อคอิน
	*/
	function login(){
		$this->load->view('/auth/login');

	}
	
}