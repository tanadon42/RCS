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

class Rcs_Admin_Controller extends MainController {

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
	* @output แสดงรายการแบบฟอร์มขอพนักงานสำหรับผู้ดูแลระบบ
	*/
	function index(){
		$this->load->model('M_rcs_form','frm');
		$this->load->model('M_rcs_dbmc','dbmc');
		$data['form_info'] = $this->frm->get_all()->result();	//ข้อมูลรายการแบบฟอร์ม
		$data['departments'] = $this->dbmc->get_all_department()->result();	//ข้อมูลแผนก
		$this->output('/consent/admin_index',$data);
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
		$form_data = $this->frm->search_by_key_approve_admin()->result();	//ข้อมูลการค้นหาแบบฟอร์ม
		$temp_form_data = [];

		foreach($form_data as $index => $row){
			if($_SESSION['UsEmp_ID'] == $row->apr_receiver_admin_emp_id && $row->apr_state == 5){	//receiver
				array_push($temp_form_data, $row);
			}
			else if($_SESSION['UsEmp_ID'] == $row->apr_checker_admin_emp_id && $row->apr_state == 6){	//checker
				array_push($temp_form_data, $row);
			}
			else if($_SESSION['UsEmp_ID'] == $row->apr_approver_admin_emp_id && $row->apr_state == 7){	//approver
				array_push($temp_form_data, $row);
			}
		}
		$data = $temp_form_data; //ข้อมูลการค้นหาแบบฟอร์ม
		echo json_encode($data);
	}

	/*
	* form_edit()
	* @input  form_id
	* @output แสดงแก้ไขแบบฟอร์มขอพนักงานสำหรับผู้ดูแลระบบ
	*/
	function form_edit($form_id){
		$this->load->model('M_rcs_dbmc','dbmc');
		$this->load->model('M_rcs_form','frm');
		$this->load->model('M_rcs_name_list','nlt');
		$this->nlt->nlt_frm_id = $form_id;
		$this->nlt->nlt_type = 2; //ประเภทพนักงานทดแทน (1=ลาออก, 2=ทดแทน)
		$this->frm->frm_id = $form_id;
		
		$form_info = $this->frm->get_form_by_approve()->result();	//ข้อมูลรายการแบบฟอร์มสำหรับผู้ดูแลระบบ
		$data['form_data'] = $this->frm->get_all_by_id()->result();	//ข้อมูลแบบฟอร์มตามที่เลือกแก้ไข (id)
		$data['form_id'] = $form_id;
		$approver_info_temp = [];	//temp ข้อมูลผู้อนุมัติ
		$approver_info = [];	//ข้อมูลผู้อนุมัติ
		$emp_replacement_info = [];	//รายชื่อพนักงานที่ทดแทน

		foreach($form_info as $index => $row){
			if($row->ctg_internal_type == 3 || $row->ctg_employment_type == 2){
				$state_to_president = "yes";
			}// ผ่านประธาน
			else{
				$state_to_president = "no";
			}// ไม่ผ่านประธาน
		}
		
		$data['temp_emp_info'] = $this->dbmc->get_emp_id_replacement()->result();	// ข้อมูลรายการพนักงานทั้งหมด

		foreach($data['temp_emp_info'] as $index => $row){
			if($row->Emp_ID != $row->nlt_emp_id){
				array_push($emp_replacement_info, $row);
			}

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

		$data['state_to_president'] = $state_to_president;	// ผ่าน หรือ ไม่ผ่าน ประธาน
		$data['approver_info'] = $approver_info;	//ข้อมูลผู้อนุมัติ
		$data['emp_info'] = $this->frm->get_emp_form()->result(); //ลาออก หรือ โอนย้าย
		$data['nlt_info'] = $this->nlt->get_by_key()->result();	//ทดแทน
		$data['form_id'] = $form_id;
		$this->frm->frm_id = $form_id;
		$data['emp_replacement_info'] = $emp_replacement_info; 	// ข้อมูลพนักงานที่ทดแทน
		$data['form_data'] = $this->frm->get_all_by_id()->result();	//ข้อมูลแบบฟอร์มตามที่เลือกแก้ไข (id)
		$this->output('/consent/admin_form_edit',$data); 
	}

	/*
	* save_emp_form()
	* @input  ข้อมูลพนักงานที่ทดแทน และ form_id
	* @output บันทึกข้อมูล
	*/
	function save_emp_form(){
		$this->load->model('M_rcs_name_list','nlt');
		$emp_obj = $this->input->post('emp_obj');	//ข้อมูลพนักงานที่ทดแทน
		$form_id = $this->input->post('form_id');	
		$this->nlt->nlt_frm_id = $form_id;
		$this->nlt->nlt_type = 2; //ประเภทพนักงานทดแทน (1=ลาออก, 2=ทดแทน)
		$data['replacement_info'] = $this->nlt->get_by_key()->result(); //รายชื่อพนักงานที่ทดแทน

		if(count($data['replacement_info']) == 0 ){ //insert
			foreach($emp_obj as $result){
				$this->nlt->nlt_emp_id = $result['emp_id'];
				$this->nlt->nlt_start_date = $result["start_date"];
				$this->nlt->nlt_type = 2;
				$this->nlt->nlt_frm_id = $form_id;
				$this->nlt->insert();
			}
		}
		else{	//update
			foreach($emp_obj as $result){
				$this->nlt->nlt_id = $data['replacement_info'][0]->nlt_id;
				$this->nlt->nlt_emp_id = $result['emp_id'];
				$this->nlt->nlt_start_date = $result["start_date"];
				$this->nlt->nlt_type = 2;
				$this->nlt->nlt_frm_id = $form_id;
				$this->nlt->update();
			}
		}
		$data = 'success';
		echo json_encode($data);
	}

	/*
	* approve()
	* @input  
	* @output แสดงหน้ารายการอนุมัติแบบฟอร์มสำหรับผู้ดูแลระบบ
	*/
	function approve(){
		$this->load->model('M_rcs_form','frm');
		$this->load->model('M_rcs_dbmc','dbmc');
		$data['departments'] = $this->dbmc->get_all_department()->result();	//ข้อมูลรายการแผนก
		$form_data = $this->frm->get_all_by_approve_admin()->result(); //ข้อมูลรายการแบบฟอร์มขอพนักงานสำหรับผู้ดูแลระบบ
		$temp_form_data = [];

		foreach($form_data as $index => $row){
			if($_SESSION['UsEmp_ID'] == $row->apr_receiver_admin_emp_id && $row->apr_state == 5){	//receiver
				array_push($temp_form_data, $row);
			}
			else if($_SESSION['UsEmp_ID'] == $row->apr_checker_admin_emp_id && $row->apr_state == 6){	//checker
				array_push($temp_form_data, $row);
			}
			else if($_SESSION['UsEmp_ID'] == $row->apr_approver_admin_emp_id && $row->apr_state == 7){	//approver
				array_push($temp_form_data, $row);
			}
		}
		$data['form_info'] = $temp_form_data; //ข้อมูลรายการแบบฟอร์มขอพนักงานสำหรับผู้ดูแลระบบ
		$this->output('/consent/admin_form_approve_list',$data);
	}
	
	/*
	* form_approve()
	* @input  
	* @output แสดงหน้าอนุมัติแบบฟอร์มขอพนักงานสำหรับผู้ดูแลระบบ
	*/
	function form_approve($form_id){
		$this->load->model('M_rcs_dbmc','dbmc');
		$this->load->model('M_rcs_form','frm');
		$this->load->model('M_rcs_name_list','nlt');
		$data['form_id'] = $form_id;
		$this->nlt->nlt_type = 2; //ประเภทพนักงานทดแทน (1=ลาออก, 2=ทดแทน)
		$this->nlt->nlt_frm_id = $form_id;
		$this->frm->frm_id = $form_id;
		$form_info = $this->frm->get_form_by_approve()->result();	//ข้อมูลแบบฟอร์ม (ผ่าน หรือ ไม่ผ่านประธาน)
		$data['form_data'] = $this->frm->get_all_by_id()->result();	//ข้อมูลแบบฟอร์มตามที่เลือกแก้ไข (id)
		$approver_info_temp = [];
		$approver_info = [];

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
		$this->output('/consent/admin_form_approve_edit',$data);

	}
	
}