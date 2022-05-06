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

class Rcs_Approve_Controller extends MainController {

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
	* @output แสดงรายการอนุมัติแบบฟอร์มขอพนักงาน (ยกเว้นผู้ดูแลระบบ)
	*/
	function index(){
		$this->load->model('M_rcs_form','frm');
		$this->load->model('M_rcs_dbmc','dbmc');
		$data['departments'] = $this->dbmc->get_all_department()->result(); //รายกาข้อมูลแผนก
		
		$form_data = $this->frm->get_all()->result();	//ข้อมูลรายการแบบฟอร์ม
		$temp_form_data = [];

		foreach($form_data as $index => $row){
			if($_SESSION['UsEmp_ID'] == $row->apr_checker_emp_id && $row->apr_state == 2){	//checker
				array_push($temp_form_data, $row);
			}
			else if($_SESSION['UsEmp_ID'] == $row->apr_approver_emp_id && $row->apr_state == 3){	//approver
				array_push($temp_form_data, $row);
			}
			else if($_SESSION['UsEmp_ID'] == $row->apr_approver_md_emp_id && $row->apr_state == 4){	//approver MD
				array_push($temp_form_data, $row);
			}
			
		}
		$data['form_info'] = $temp_form_data;	//ข้อมูลรายการแบบฟอร์ม
		$this->output('/consent/form_approve_list',$data);
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
		$form_data = $this->frm->search_by_key_approve_admin()->result(); //ข้อมูลการค้นหาแบบฟอร์ม
		$temp_form_data = [];

		foreach($form_data as $index => $row){
			if($_SESSION['UsEmp_ID'] == $row->apr_checker_emp_id && $row->apr_state == 2){
				array_push($temp_form_data, $row);
			}
			else if($_SESSION['UsEmp_ID'] == $row->apr_approver_emp_id && $row->apr_state == 3){
				array_push($temp_form_data, $row);
			}
			else if($_SESSION['UsEmp_ID'] == $row->apr_approver_md_emp_id && $row->apr_state == 4){
				array_push($temp_form_data, $row);
			}
			
		}
		$data = $temp_form_data; //ข้อมูลการค้นหาแบบฟอร์ม
		echo json_encode($data);
	}
	
	/*
	* form_approve()
	* @input  form_id
	* @output แสดงแก้ไขแบบฟอร์มขอพนักงาน (ยกเว้นผู้ดูแลระบบ)
	*/
	function form_approve($form_id){
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
		$this->output('/consent/form_approve_edit',$data);
	}

	/*
	* save_data()
	* @input  ข้อมูลพนักงานที่ทดแทน และ form_id
	* @output บันทึกข้อมูล
	*/
	function save_data(){
		$this->load->model('M_rcs_approve','apr');
		$this->load->model('M_rcs_form','frm');
		$form_status = $this->input->post('form_status'); //1: approve, 2: reject
		$form_id = $this->input->post('form_id');
		$note = $this->input->post('note');
		$this->apr->apr_frm_id = $form_id;
		$this->frm->frm_id = $form_id;
		$approve_info = $this->apr->get_by_key()->result();	//ข้อมูลรายการผู้อนุมัติ
		$form_info = $this->frm->get_form_by_approve()->result(); //ข้อมูลแบบฟอร์ม (ผ่าน หรือ ไม่ผ่านประธาน)

		foreach($form_info as $index => $row){
			if($row->ctg_internal_type == 3 || $row->ctg_employment_type == 2){
				$state_to_president = "yes";
			}//ผ่านประธาน
			else{
				$state_to_president = "no";
			}//ไม่ผ่านประธาน
			
		}
		
		foreach($approve_info as $index => $row){
			$current_state = $row->apr_state;	//ขั้นตอนปัจจุบัน
			$next_state = 0;	//ขั้นตอนถัดไป

			if($form_status == 1){	//approve
				
				if($row->apr_state != 3){
					if($row->apr_state == 7){
						$next_state = $current_state;
					}
					else{
						$next_state = $current_state+1;
					}
				}
				else{
					if($state_to_president == "yes"){
						$next_state = $current_state+1;
					}
					else{
						$next_state = $current_state+2;
					}
				}
	
			}else {	//reject
				if($row->apr_state != 2){
					if($state_to_president == "no" && $current_state == 5){
						$next_state = $current_state-2;
					}
					else{
						$next_state = $current_state-1;
					}
				}
				else{
					$next_state = $current_state;
				}
			}

			//set approver
			$this->apr->apr_checker_emp_id = $row->apr_checker_emp_id;
			$this->apr->apr_checker_date = $row->apr_checker_date;
			$this->apr->apr_checker_status = $row->apr_checker_status;

			$this->apr->apr_approver_emp_id = $row->apr_approver_emp_id;
			$this->apr->apr_approver_date = $row->apr_approver_date;
			$this->apr->apr_approver_status = $row->apr_approver_status;
		
			$this->apr->apr_approver_md_emp_id = $row->apr_approver_md_emp_id;
			$this->apr->apr_approver_md_date = $row->apr_approver_md_date;
			$this->apr->apr_approver_md_status = $row->apr_approver_md_status;
		
			$this->apr->apr_receiver_admin_emp_id = $row->apr_receiver_admin_emp_id;
			$this->apr->apr_receiver_admin_date = $row->apr_receiver_admin_date;
			$this->apr->apr_receiver_admin_status = $row->apr_receiver_admin_status;
		
			$this->apr->apr_checker_admin_emp_id = $row->apr_checker_admin_emp_id;
			$this->apr->apr_checker_admin_date = $row->apr_checker_admin_date;
			$this->apr->apr_checker_admin_status = $row->apr_checker_admin_status;
		
			$this->apr->apr_approver_admin_emp_id = $row->apr_approver_admin_emp_id;
			$this->apr->apr_approver_admin_date = $row->apr_approver_admin_date;
			$this->apr->apr_approver_admin_status = $row->apr_approver_admin_status;
			
			if($current_state == 2){		//checker
				$this->apr->apr_checker_date = date("Y-m-d");
				if($form_status == 1){
					$this->apr->apr_checker_status = 1;
				}else{
					$this->apr->apr_checker_status = 2;
				}
			}
			else if($current_state == 3){	//approver
				$this->apr->apr_approver_date = date("Y-m-d");
				if($form_status == 1){
					$this->apr->apr_approver_status = 1;
				}else{
					$this->apr->apr_approver_status = 2;
				}
			}
			else if($current_state == 4){	//approver md
				$this->apr->apr_approver_md_date = date("Y-m-d");
				if($form_status == 1){
					$this->apr->apr_approver_md_status = 1;
				}else{
					$this->apr->apr_approver_md_status = 2;
				}
			}
			else if($current_state == 5){	//receiver admin
				$this->apr->apr_receiver_admin_date = date("Y-m-d");
				if($form_status == 1){
					$this->apr->apr_receiver_admin_status = 1;
				}else{
					$this->apr->apr_receiver_admin_status = 2;
				}
			}
			else if($current_state == 6){	//checker admin
				$this->apr->apr_checker_admin_date = date("Y-m-d");
				if($form_status == 1){
					$this->apr->apr_checker_admin_status = 1;
				}else{
					$this->apr->apr_checker_admin_status = 2;
				}
			}
			else if($current_state == 7){	//approver admin
				$this->apr->apr_approver_admin_date = date("Y-m-d");
				if($form_status == 1){
					$this->apr->apr_approver_admin_status = 1;
				}else{
					$this->apr->apr_approver_admin_status = 2;
				}
			}

			$form_data = $this->frm->get_by_key()->result();
			foreach($form_data as $index => $row_frm){
				$this->frm->frm_ref_id = $row_frm->frm_ref_id;
				$this->frm->frm_addition = $row_frm->frm_addition;
				$this->frm->frm_qlf_id = $row_frm->frm_qlf_id;
				$this->frm->frm_ctg_id = $row_frm->frm_ctg_id;
				$this->frm->frm_hcc_id = $row_frm->frm_hcc_id;

				if($next_state == 7 && $current_state == 7){ //approved
					$this->frm->frm_status = 3;
				}
				else if($form_status == 2){	//reject
					$this->frm->frm_status = 2;
				}
				else{
					$this->frm->frm_status = 1;
				}
				$this->frm->update();
			}

			$this->apr->apr_state = $next_state;
			$this->apr->apr_frm_id = $row->apr_frm_id;
			$this->apr->apr_preparer_emp_id = $row->apr_preparer_emp_id;
			$this->apr->apr_preparer_date = $row->apr_preparer_date;
			$this->apr->apr_id = $row->apr_id;
			$this->apr->apr_note = $note;
			$this->apr->update();
		
		}
		$data = 'success';
		echo json_encode($data);
	}
	
}