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
require('WriteHTML.php');

class Rcs_Form_Controller extends MainController {

	/*
	* form()
	* @input  
	* @output แสดงหน้ากรอกแบบฟอร์มขอพนักงาน
	*/
	function form(){
		$this->load->model('M_rcs_dbmc','dbmc');
		$data['position'] = $this->dbmc->get_all_position()->result();	//ข้อมูลรายการตำแหน่ง
		$data['department'] = $this->dbmc->get_all_department()->result();	//ข้อมูลรายการแผนก
		$this->output('/consent/form',$data);
	}

	/*
	* get_section_by_department_id()
	* @input  รหัสแผนก
	* @output ข้อมูลรายการ section by รหัสแผนก
	*/
	function get_section_by_department_id(){
		$department_id = $this->input->post('department_id');	//รหัสแผนก
		$this->load->model('M_rcs_dbmc','dbmc');
		$this->dbmc->Department_id = $department_id;
		$data = $this->dbmc->get_all_section_by_department()->result();	//ข้อมูลรายการ section by รหัสแผนก
		echo json_encode($data);
	}

	/*
	* get_section_by_id()
	* @input  section id
	* @output ข้อมูล section by section code
	*/
	function get_section_by_id(){
		$section_id = $this->input->post('section_id');
		$this->load->model('M_rcs_dbmc','dbmc');

		$this->dbmc->Section_id = $section_id;
		$data = $this->dbmc->get_all_section_by_id()->result(); //ข้อมูล section by section code
		echo json_encode($data);
	}

	/*
	* get_employee_by_key()
	* @input  department id
	* @output ข้อมูลพนักงาน by รหัสแผนก
	*/
	function get_employee_by_key(){
		$this->load->model('M_rcs_dbmc','dbmc');
		$department_id = $this->input->post('department_id');
		$this->dbmc->Department_id = $department_id;
		$data['dpm_temp'] = $this->dbmc->get_department_by_id()->result();	//ข้อมูลแผนก
		$emp_temp = [];
		$emp_check = [];
		$emp_info = [];

		foreach($data['dpm_temp'] as $index => $row){
			$count = $index;
			$dp = $row->Department_id;
			$sc = $row->Section_id;
			$sb = $row->SubSection_id;
			$gr = $row->Group_id;
			$ln = $row->Line_id;
			$emp = $this->dbmc->get_emp_by_dpm($dp,$sc,$sb,$gr,$ln)->result();
			
			foreach($emp as $index => $row){
				if($count == 0){
					array_push($emp_temp, $row);
					array_push($emp_check, $row->Emp_ID);
				}else if(!in_array($row->Emp_ID, $emp_check)){
					array_push($emp_temp, $row);
					array_push($emp_check, $row->Emp_ID);
				}
				
			}
		}
		foreach($emp_temp as $index => $row){
			if($row->Emp_ID != $row->nlt_emp_id){
				array_push($emp_info, $row);
			}
		}
		$data = $emp_info; //ข้อมูลพนักงาน by รหัสแผนก
		echo json_encode($data);
	}

	/*
	* get_employee_by_id()
	* @input  รหัสพนักงาน
	* @output ข้อมูลพนักงาน by id
	*/
	function get_employee_by_id(){
		$emp_id = $this->input->post('emp_id');
		$this->load->model('M_rcs_dbmc','dbmc');
		$this->dbmc->Emp_ID = $emp_id;
		$data = $this->dbmc->get_emp_by_id()->result();
		echo json_encode($data);
	}

	/*
	* insert_form_data()
	* @input  ข้อมูลแบบฟอร์ม
	* @output บันทึกข้อมูลการเพิ่มแบบฟอร์ม
	*/
	function insert_form_data(){
		$this->load->model('M_rcs_form','frm');
		$this->load->model('M_rcs_category','ctg');
		$this->load->model('M_rcs_name_list','nlt');
		$this->load->model('M_rcs_qualification','qlf');
		$this->load->model('M_rcs_headcount_control','hcc');
		$this->load->model('M_rcs_approve','apr');

		$selected_recruitment_type = $this->input->post('selected_recruitment_type');
		$position_id = $this->input->post('position_id');
		$department_id = $this->input->post('department_id');
		$section_code = $this->input->post('section_code');
		$section_type = $this->input->post('section_type');
		$req_number = $this->input->post('req_number');
		$external_type_val = $this->input->post('external_type_val');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$req_date = $this->input->post('req_date');
		$education_type_val = $this->input->post('education_type_val');
		$education_major_val = $this->input->post('education_major_val');
		$work_exp_year = $this->input->post('work_exp_year');
		$work_exp_field = $this->input->post('work_exp_field');
		$com_type_val = $this->input->post('com_type_val');
		$com_ect_val = $this->input->post('com_ect_val');
		$eng_type_val = $this->input->post('eng_type_val');
		$japan_type_val = $this->input->post('japan_type_val');
		$ect = $this->input->post('ect');
		$ref_jd = $this->input->post('ref_jd');
		$addition = $this->input->post('addition');
		$headcount_val = $this->input->post('headcount_val');
		$headcount_num1 = $this->input->post('headcount_num1');
		$headcount_num2 = $this->input->post('headcount_num2');
		$emp_obj = $this->input->post('emp_obj');

		
		//category
		if($selected_recruitment_type == "1"){ //internal
			$this->ctg->ctg_internal_type = $section_type;
			$this->ctg->ctg_external_type = 0;
			$this->ctg->ctg_req_num = $req_number;
			$this->ctg->ctg_employment_type = $selected_recruitment_type;
			$this->ctg->ctg_pos_id = $position_id;
			$this->ctg->ctg_dpm_id = $department_id;
			$this->ctg->ctg_sec_id = $section_code;
			$this->ctg->insert();		
		}
		else{ //external
			$this->ctg->ctg_internal_type = 0;
			$this->ctg->ctg_external_type = $external_type_val;
			$this->ctg->ctg_req_num = $req_number;
			$this->ctg->ctg_employment_type = $selected_recruitment_type;
			$this->ctg->ctg_start_date = $start_date;
			$this->ctg->ctg_end_date = $end_date;
			$this->ctg->ctg_req_date = $req_date;
			$this->ctg->ctg_pos_id = $position_id;
			$this->ctg->ctg_dpm_id = $department_id;
			$this->ctg->ctg_sec_id = $section_code;
			$this->ctg->insert();

		}
		
		
		//qualification
		$this->qlf->qlf_education_level = $education_type_val;
		$this->qlf->qlf_education_major = $education_major_val;
		$this->qlf->qlf_work_exp = $work_exp_year;
		$this->qlf->qlf_work_exp_field = $work_exp_field;
		$this->qlf->qlf_com = $com_type_val;
		$this->qlf->qlf_com_ect = $com_ect_val;
		$this->qlf->qlf_eng = $eng_type_val;
		$this->qlf->qlf_japan = $japan_type_val;
		$this->qlf->qlf_ect = $ect;
		$this->qlf->insert();

		$ctg_data = $this->ctg->get_last_index()->result();	
		$qlt_data = $this->qlf->get_last_index()->result();

		foreach($ctg_data as $index => $row){
			$ctg_id = $row->ctg_id;
		}
		foreach($qlt_data as $index => $row){
			$qlf_id = $row->qlf_id;
		}
		
		//headcount control
		if($headcount_val != "2"){
			$this->hcc->hcc_type = $headcount_val;
			$this->hcc->hcc_num1 = $headcount_num1;
			$this->hcc->hcc_num2 = $headcount_num2;
			$this->hcc->insert();
			
		}else{
			$this->hcc->hcc_type = $headcount_val;
			$this->hcc->hcc_num1 = $headcount_num1;
			$this->hcc->hcc_note = $headcount_num2;
			$this->hcc->insert();
		}
		$hcc_data = $this->hcc->get_last_index()->result();

		foreach($hcc_data as $index => $row){
			$hcc_id = $row->hcc_id;
		}

		//form
		$this->frm->frm_status = "1";
		$this->frm->frm_ref_id = $ref_jd;
		$this->frm->frm_addition = $addition;
		$this->frm->frm_qlf_id = $qlf_id;
		$this->frm->frm_ctg_id = $ctg_id;
		$this->frm->frm_hcc_id = $hcc_id;
		$this->frm->insert();
		$frm_data = $this->frm->get_last_index()->result();

		foreach($frm_data as $index => $row){
			$frm_id = $row->frm_id;
		}

		//name list
		if($headcount_val != "2"){
			foreach($emp_obj as $result){
				$this->nlt->nlt_emp_id = $result['emp_id'];
				$this->nlt->nlt_effective_date = $result["effective_date"];
				$this->nlt->nlt_type = 1;
				$this->nlt->nlt_frm_id = $frm_id;
				$this->nlt->insert();
			}
		}
		
		//approve
		$this->apr->apr_state = 2;
		$this->apr->apr_frm_id = $frm_id;

		// each department
		$this->apr->apr_preparer_emp_id = $_SESSION['UsEmp_ID']; // check emp_id for after login by account (create by emp_id)
		$this->apr->apr_preparer_date = date("Y-m-d");

		$this->apr->apr_checker_emp_id = "1013";			
		$this->apr->apr_approver_emp_id = "1024";
		$this->apr->apr_approver_md_emp_id = "1025";
		$this->apr->apr_receiver_admin_emp_id = "1032";			
		$this->apr->apr_checker_admin_emp_id = "1034";			
		$this->apr->apr_approver_admin_emp_id = "1035";
		$this->apr->insert();

		$data = 'success';
		echo json_encode($data);
	}

	/*
	* export_pdf()
	* @input  form_id
	* @output export PDF
	*/
	function export_pdf($form_id){
		$this->load->model('M_rcs_dbmc','dbmc');
		$this->load->model('M_rcs_form','frm');
		$this->load->model('M_rcs_name_list','nlt');
		$data['form_id'] = $form_id;
		$this->nlt->nlt_type = 2; //ประเภทพนักงานทดแทน
		$this->nlt->nlt_frm_id = $form_id;
		$this->frm->frm_id = $form_id;
		$form_info = $this->frm->get_form_by_approve()->result();
		$form_data = $this->frm->get_all_by_id()->result();
		$approver_info_temp = [];
		$approver_info = [];

		foreach($form_info as $index => $row){
			if($row->ctg_internal_type == 3 || $row->ctg_employment_type == 2){
				$state_to_president = "yes";
			}
			else{
				$state_to_president = "no";
			}
		}

		foreach($form_data as $index => $row){

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

		$state_to_president;
		$approver_info;
		$emp_info = $this->frm->get_emp_form()->result(); //ลาออก หรือ โอนย้าย
		$nlt_info = $this->nlt->get_by_key()->result();	//ทดแทน


		$pdf = new PDF_HTML();

		$pdf->AddFont('THSarabunNew','','THSarabunNew.php');
		$pdf->AddFont('THSarabunNew','B','THSarabunNew_b.php');
		$pdf->AddPage();
		$pdf->Rect(5, 5, 200, 287, 'D'); //For A4

		$pdf->SetFont('THSarabunNew','B',14);

		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', 'แบบฟอร์มขอพนักงาน (Personnel Requisition Form)'), 0, 1, 'C', 0);
		$pdf->SetFont('THSarabunNew','',12);
		
		if($form_data[0]->ctg_employment_type == 1){
			$pdf->Cell(0, 10,'Recruitment Type : Internal', 0, 1, '', 0);
		}
		else{
			$pdf->Cell(0, 10,'Recruitment Type : External', 0, 1, '', 0);
		}
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', 'ตำแหน่งที่ต้องการ (Required Position) : '.$form_data[0]->Position_name), 0, 0, '', 0);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', 'แผนก (Department) : '.$form_data[0]->Department), 0, 1, 'R', 0);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', 'หน่วยงาน (Section) : '.$form_data[0]->Section), 0, 0, '', 0);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', 'รหัสหน่วยงาน (Section Code) : '.$form_data[0]->Section_id), 0, 1, 'R', 0);
		if($form_data[0]->ctg_employment_type == 1){
			if($form_data[0]->ctg_internal_type == 1){
				$sectionType =  "Indirect to Direct";
			}else if($form_data[0]->ctg_internal_type == 2){
				$sectionType = "Indirect to Indirect";
			}
			else if($form_data[0]->ctg_internal_type == 3){
				$sectionType = "Direct to Indirect";
			}else{
				$sectionType = "Direct to Direct";
			}

			$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', 'ประเภทหน่วยงาน (Section Type) : '.$sectionType), 0, 0, '', 0);
			$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', 'จํานวนคนที่ต้องการ (Required Number) : '.$form_data[0]->ctg_req_num. " คน"), 0, 1, 'R', 0);
			$pdf->WriteHTML("<hr>");
		}
		else{
			$start_date = $this->DateThai($form_data[0]->ctg_start_date);
			$end_date = $this->DateThai($form_data[0]->ctg_end_date);
			$req_date = $this->DateThai($form_data[0]->ctg_req_date);
			$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', 'จํานวนคนที่ต้องการ (Required Number) : '.$form_data[0]->ctg_req_num. " คน"), 0, 1, '', 0);
			$pdf->SetFont('THSarabunNew','B',12);
			$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', 'ประเภทพนักงานและประเภทการจ้าง (Type of Employment)'), 0, 1, '', 0);
			$pdf->SetFont('THSarabunNew','',12);
			if($form_data[0]->ctg_external_type == 1){
				$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          พนักงานประจำ (Permanent Associate)'), 0, 1, '', 0);
			}
			else if($form_data[0]->ctg_external_type == 3 || $form_data[0]->ctg_external_type == 4){
				$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          พนักงานชั่วคราว (Temporary Associate)'), 0, 1, '', 0);
				if($form_data[0]->ctg_external_type == 3){
					$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '                    รายวัน (Daily)'), 0, 0, '', 0);
					$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', 'ระยะเวลาในการจ้างตั้งแต่ '.$start_date. " ถึง ".$end_date), 0, 1, 'R', 0);

				}else{
					$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '                    รายเดือน (Monthly)'), 0, 0, '', 0);
					$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', 'ระยะเวลาในการจ้างตั้งแต่ '.$start_date. " ถึง ".$end_date), 0, 1, 'R', 0);
				}
			}
			else{
				$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          ผู้ปฏิบัติงานรับเหมาช่วง / พนักงานซับคอนแทรค โดยจ้างแบบมีระยะจำกัด (Subcontractor by Limited Employment Contract)'), 0, 1, '', 0);
				$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          ระยะเวลาในการจ้างตั้งแต่ '.$start_date. " ถึง ".$end_date), 0, 1, '', 0);
			}
			$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          วันที่ต้องการให้เริ่มงาน '.$req_date), 0, 1, '', 0);
			$pdf->WriteHTML("<hr>");
		}
		if($form_data[0]->qlf_education_level == 1){
			$education = "วุฒิการศึกษา ม.3 (Secondary Education)";
		}
		else if($form_data[0]->qlf_education_level == 2){
			$education = "วุฒิการศึกษา ม.6 / ปวช. (Highschool Education / Vocational Certificate)";
		}else if($form_data[0]->qlf_education_level == 3){
			$education = "ปวส. (High Vocational Certificate)";
		}else if($form_data[0]->qlf_education_level == 4){
			$education = "ปริญญาตรี (Bachelor's Degree)";
		}else{
			$education = "ปริญญาโท (Master Degree)";
		}

		if($form_data[0]->qlf_com == 1){
			$com = "ไม่ต้องการ (Not Require)";
		}else if($form_data[0]->qlf_com == 2){
			$com = "Microsoft Office";
		}else {
			$com = $form_data[0]->qlf_com_ect;
		}

		if($form_data[0]->qlf_eng == 1){
			$eng = "ไม่ต้องการ (Not Require)";
		}else{
			$eng = "TOEIC มากกว่า 400 (TOEIC More than 400)";
		}
		
		if($form_data[0]->qlf_japan == 1){
			$japan = "ไม่ต้องการ (Not Require)"; 
		}else if($form_data[0]->qlf_japan == 2){
			$japan = "ระดับ N 3-4 (Level N 3-4)"; 
		}
		else if($form_data[0]->qlf_japan == 3){
			$japan = "ระดับ N 2 (Level N 2)"; 
		}
		else {
			$japan = "ระดับ N 1 (Level N 1)"; 
		}


		$pdf->SetFont('THSarabunNew','B',12);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', 'คุณสมบัติ (Qualification Required)'), 0, 1, '', 0);
		$pdf->SetFont('THSarabunNew','',12);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          1. ระดับการศึกษา (Education) : '.$education), 0, 0, '', 0);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          สาขา (Major) : '.$form_data[0]->qlf_education_major), 0, 1, 'R', 0);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          2. ประสบการณ์ (Work Experience) : '.$form_data[0]->qlf_work_exp. " ปี"), 0, 0, '', 0);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          ทางด้าน (Major) : '.$form_data[0]->qlf_work_exp_field), 0, 1, 'R', 0);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          3. ความสามารถด้านคอมพิวเตอร์ (Computer) : '.$com), 0, 1, '', 0);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          4. ความสามารถด้านภาษา (Language)'), 0, 1, '', 0);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '                    ภาษาอังกฤษ (English) : '.$eng), 0, 0, '', 0);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '                    ภาษาญี่ปุ่น (Japan) : '.$japan), 0, 1, 'R', 0);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          5. อื่น ๆ (Additional Requirement) : '.$form_data[0]->qlf_ect), 0, 1, '', 0);
		$pdf->WriteHTML("<hr>");
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          หน้าที่ความรับผิดชอบ (Duty & Responsibility) อ้างอิง JD หมายเลข (Reference JD No.) : '.$form_data[0]->frm_ref_id), 0, 1, '', 0);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          หน้าที่ความรับผิดชอบเพิ่มเติม (AdditionDuty & Responsibility) : '.$form_data[0]->frm_addition), 0, 1, '', 0);
		$pdf->WriteHTML("<hr>");
		$pdf->SetFont('THSarabunNew','B',12);
		$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', 'การควบคุมจำนวนพนักงาน (Headcount Control)'), 0, 1, '', 0);
		$pdf->SetFont('THSarabunNew','',12);

		if($form_data[0]->hcc_type == 1){ 
			$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          อัตราทดแทนพนักงานลาออก (Replacement of Resigned Member)'), 0, 1, '', 0);
			$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          จำนวนคนที่ลาออก (Number of Resigned) : '.$form_data[0]->hcc_num1), 0, 0, '', 0);
			$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          จำนวนคนที่ต้องการ (Required Number) : '.$form_data[0]->hcc_num2), 0, 1, 'R', 0);
	
		}
		else if($form_data[0]->hcc_type == 2){ 
			$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          อัตราเพิ่มจากแผนกำลังคน (Increment from Headcount)'), 0, 1, '', 0);
			$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          จำนวนคน (Number) : '.$form_data[0]->hcc_num1), 0, 0, '', 0);
			$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          เหตุผลที่ขอคนเพิ่มจากแผนกำลังคน (Reason) : '.$form_data[0]->hcc_note), 0, 1, 'R', 0);
		}else{
			$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          อัตราทดแทนพนักงานโอนย้าย (Replacement of Job Rotation)'), 0, 1, '', 0);
			$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          จำนวนคนที่โอนย้าย (Number of Transfer) : '.$form_data[0]->hcc_num1), 0, 0, '', 0);
			$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', '          จำนวนคนที่ต้องการ (Required Number) : '.$form_data[0]->hcc_num2), 0, 1, 'R', 0);
		}
		if($form_data[0]->hcc_type != 2){ 
			$pdf->SetFont('THSarabunNew','B',10);
			$pdf->Cell(190, 10, iconv('UTF-8', 'cp874', 'พนักงานลาออก (Name List of Resigned)'), 1, 0, 'C', 0);
			$pdf->Ln();
			$pdf->SetFont('THSarabunNew','',8);
			$pdf->Cell(30, 10, iconv('UTF-8', 'cp874', 'รหัสพนักงาน (Employee ID)'), 1, 0, 'C', 0);
			$pdf->Cell(30, 10, iconv('UTF-8', 'cp874', 'ชื่อ-นามสกุล (Name-Surname)'), 1, 0, 'C', 0);
			$pdf->Cell(30, 10, iconv('UTF-8', 'cp874', 'ตำแหน่ง (Position)'), 1, 0, 'C', 0);
			$pdf->Cell(35, 10, iconv('UTF-8', 'cp874', 'แผนก (Department)'), 1, 0, 'C', 0);
			$pdf->Cell(35, 10, iconv('UTF-8', 'cp874', 'รหัสแผนก (Section Code)'), 1, 0, 'C', 0);
			$pdf->Cell(30, 10, iconv('UTF-8', 'cp874', 'วันที่มีผล (Effective Date)'), 1, 0, 'C', 0);
			$pdf->Ln();	
			foreach($emp_info as $index => $row){
				$currentPageNo = $pdf->PageNo();
				$pdf->Cell(30, 10, iconv('UTF-8', 'cp874', $row->Emp_ID), 1, 0, 'C', 0);
				$pdf->Cell(30, 10, iconv('UTF-8', 'cp874', $row->Emp_nametitle.$row->Empname_th." ".$row->Empsurname_th), 1, 0, '', 0);
				$pdf->Cell(30, 10, iconv('UTF-8', 'cp874', $row->Position_name), 1, 0, 'C', 0);
				$pdf->Cell(35, 10, iconv('UTF-8', 'cp874', $form_data[0]->Department), 1, 0, 'C', 0);
				$pdf->Cell(35, 10, iconv('UTF-8', 'cp874', $row->Sectioncode_ID), 1, 0, 'C', 0);
				$pdf->Cell(30, 10, iconv('UTF-8', 'cp874', $this->DateThai($row->nlt_effective_date)), 1, 0, 'C', 0);
				$pdf->Ln();
				if($pdf->PageNo() != $currentPageNo){
					$pdf->AddPage();
				}
			}
			$pdf->Ln();
			$pdf->SetFont('THSarabunNew','B',10);
			$pdf->Cell(190, 10, iconv('UTF-8', 'cp874', 'พนักงานที่มาทดแทน (List of Replacement)'), 1, 0, 'C', 0);
			$pdf->Ln();
			$pdf->SetFont('THSarabunNew','',10);
			$pdf->Cell(30, 10, iconv('UTF-8', 'cp874', 'รหัสพนักงาน (Employee ID)'), 1, 0, 'C', 0);
			$pdf->Cell(100, 10, iconv('UTF-8', 'cp874', 'ชื่อ-นามสกุล (Name-Surname)'), 1, 0, 'C', 0);
			$pdf->Cell(60, 10, iconv('UTF-8', 'cp874', 'วันที่มาเริ่มงาน (Starting Date)'), 1, 0, 'C', 0);
			$pdf->Ln();	
			if(count($nlt_info) == 0){
				$pdf->Cell(0, 10, iconv('UTF-8', 'cp874', "- ไม่พบข้อมูล -"), 1, 0, 'C', 0);
				$pdf->Ln();
				$pdf->Ln();
			}else{
				foreach($nlt_info as $index => $row){
					$currentPageNo = $pdf->PageNo();
					$pdf->Cell(30, 10, iconv('UTF-8', 'cp874', $row->Emp_ID), 1, 0, 'C', 0);
					$pdf->Cell(100, 10, iconv('UTF-8', 'cp874', $row->Emp_nametitle.$row->Empname_th." ".$row->Empsurname_th), 1, 0, '', 0);
					$pdf->Cell(60, 10, iconv('UTF-8', 'cp874', $this->DateThai($row->nlt_start_date)), 1, 0, 'C', 0);
					$pdf->Ln();
					if($pdf->PageNo() != $currentPageNo){
						$pdf->AddPage();
						$pdf->Rect(5, 5, 200, 287, 'D'); //For A4
					}
				}
				$pdf->Ln();
				$pdf->Ln();
			}
		}
		if($pdf->PageNo() == 1){
			$pdf->AddPage();
			
		}
		$pdf->Rect(5, 5, 200, 287, 'D'); //For A4
		$pdf->SetFont('THSarabunNew','B',10);
		$pdf->Cell(108.56, 10, iconv('UTF-8', 'cp874', 'For Requester of Each Department'), 1, 0, 'C', 0);
		$pdf->Cell(81.44, 10, iconv('UTF-8', 'cp874', 'For HR Department HRD/Planning & Recruitment Section'), 1, 0, 'C', 0);
		$pdf->Ln();
		$pdf->SetFont('THSarabunNew','',10);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'Prepared by'), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'Checked by'), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'Approved by'), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'Approved by'), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'Received by'), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'Checked by'), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'Approved by'), 1, 0, 'C', 0);
		$pdf->Ln();
		$pdf->SetFont('THSarabunNew','',8);
		foreach($approver_info as $index => $row){
			$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', $row->Emp_nametitle.$row->Empname_th."   ".$row->Empsurname_th), 1, 0, 'C', 0);
			
		}
		$pdf->Ln();
		$pdf->SetFont('THSarabunNew','',10);
		for($i=0 ;$i<7 ; $i++){
			if($i == 0){
				$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', '-'), 1, 0, 'C', 0);
			}
			else if($state_to_president == "no" && $i == 3){
				$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', '-'), 1, 0, 'C', 0);
			}
			else{
				$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'อนุมัติ'), 1, 0, 'C', 0);
			}

		}
		$pdf->Ln();
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'Staff (T7) above'), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'HoS. above'), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'HoDiv. above'), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'President/MD'), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'Sr. Staff (T6) above'), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'HoS. above'), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', 'HoDiv. above'), 1, 0, 'C', 0);
		$pdf->Ln();
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', $this->DateThai($form_data[0]->apr_preparer_date)), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', $this->DateThai($form_data[0]->apr_checker_date)), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', $this->DateThai($form_data[0]->apr_approver_date)), 1, 0, 'C', 0);
		if($state_to_president == "yes"){
			$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', $this->DateThai($form_data[0]->apr_approver_md_date)), 1, 0, 'C', 0);
		}
		else{
			$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', '-'), 1, 0, 'C', 0);
		}
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', $this->DateThai($form_data[0]->apr_receiver_admin_date)), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', $this->DateThai($form_data[0]->apr_checker_admin_date)), 1, 0, 'C', 0);
		$pdf->Cell(27.14, 10, iconv('UTF-8', 'cp874', $this->DateThai($form_data[0]->apr_approver_admin_date)), 1, 0, 'C', 0);
		

		$pdf->Output('Personal_Requisition.pdf' , 'D' );
	}

	/*
	* DateThai()
	* @input  (string)DateTime
	* @output Date thai
	*/
	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
	
}
?>