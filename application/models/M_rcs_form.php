<?php

include_once("rcs_model.php");

/*
* M_rcs_form
* @author Tanadon Tangjaimongkhon
* @Create Date 2565-02-21
*/ 
 
class M_rcs_form extends rcs_model {		
	
	public $frm_id; //
	public $frm_status; //
	public $frm_ref_id; //
	public $frm_addition; //
	public $frm_qlf_id; //
	public $frm_ctg_id; //
	public $frm_hcc_id; //

	function __construct() {
		parent::__construct();
	
	}

	/*
	* insert
	* Insert  to database
	* @input 
	* @output -
	*/
	
	function insert() {
	 
	 	$sql = "INSERT INTO rcs_database.rcs_form (frm_status ,frm_ref_id ,frm_addition ,frm_qlf_id ,frm_ctg_id, frm_hcc_id)
	 	VALUES(?, ? ,? ,? ,? ,?)";
	 	$this->db->query($sql, array($this->frm_status ,$this->frm_ref_id ,$this->frm_addition ,$this->frm_qlf_id ,$this->frm_ctg_id ,$this->frm_hcc_id));
	 }

	/*
	* update
	* update  to database
	* @input 
	* @output -
	*/
	
	function update() {
		$sql = "UPDATE rcs_database.rcs_form 
				SET	frm_status = ?, frm_ref_id = ?, frm_addition = ?, frm_qlf_id = ?, frm_ctg_id = ?, frm_hcc_id = ?
				WHERE frm_id = ? ";
	    $this->db->query($sql, array($this->frm_status, $this->frm_ref_id, $this->frm_addition, $this->frm_qlf_id, $this->frm_ctg_id, $this->frm_hcc_id, $this->frm_id));
	}     

	/*
	* get_by_key
	* Get  from database
	* @input 
	* @output -
	*/
	function get_by_key() {	
		$sql = "SELECT * 
				FROM rcs_database.rcs_form
				WHERE frm_id=?";
		$query = $this->db->query($sql, array($this->frm_id));
		return $query;
	}

	/*
	* get_last_index()
	* @input  
	* @output ข้อมูลฟอร์มคอลัมน์สุดท้าย
	*/
	function get_last_index() {	
		$sql = "SELECT * 
				FROM rcs_database.rcs_form
				ORDER BY frm_id DESC LIMIT 1";
		$query = $this->db->query($sql);
		return $query;
	}

	/*
	* get_all_by_userid()
	* @input  
	* @output ข้อมูลรายการแบบฟอร์มขอพนักงานตามผู้ที่เข้ามาล็อคอิน
	*/
	function get_all_by_userid() {	// for user_id
		$sql = "SELECT * 
				FROM rcs_database.rcs_form as frm
				INNER JOIN rcs_database.rcs_category as ctg
				ON frm.frm_ctg_id = ctg.ctg_id
				INNER JOIN rcs_database.rcs_qualification as qlf
				ON frm.frm_qlf_id = qlf.qlf_id
				INNER JOIN rcs_database.rcs_headcount_control as hcc
				ON frm.frm_hcc_id = hcc.hcc_id
				INNER JOIN rcs_database.rcs_approve as apr
				ON frm.frm_id = apr.apr_frm_id
				INNER JOIN dbmc.master_mapping as mtp
                ON ctg.ctg_sec_id = mtp.Section_id   
				WHERE apr_preparer_emp_id = '".$_SESSION['UsEmp_ID']."'         
                GROUP BY frm.frm_id  
				ORDER BY apr.apr_preparer_date DESC";
		$query = $this->db->query($sql);
		return $query;
	}

	/*
	* get_all_by_approve_admin()
	* @input  
	* @output ข้อมูลรายการแบบฟอร์มขอพนักงานของผู้ดูแลระบบและผู้อนุมัติแบบฟอร์ม
	*/
	function get_all_by_approve_admin() {	//for admin approve
		$sql = "SELECT * 
				FROM rcs_database.rcs_form as frm
				INNER JOIN rcs_database.rcs_category as ctg
				ON frm.frm_ctg_id = ctg.ctg_id
				INNER JOIN rcs_database.rcs_qualification as qlf
				ON frm.frm_qlf_id = qlf.qlf_id
				INNER JOIN rcs_database.rcs_headcount_control as hcc
				ON frm.frm_hcc_id = hcc.hcc_id
				INNER JOIN rcs_database.rcs_approve as apr
				ON frm.frm_id = apr.apr_frm_id
				INNER JOIN dbmc.master_mapping as mtp
                ON ctg.ctg_sec_id = mtp.Section_id     
				WHERE frm.frm_status != 3     
                GROUP BY frm.frm_id  
				ORDER BY apr.apr_preparer_date DESC";
		$query = $this->db->query($sql);
		return $query;
	}

	/*
	* get_all()
	* @input  
	* @output ข้อมูลรายการแบบฟอร์มขอพนักงานของผู้ดูแลระบบสำหรับ
	*/
	function get_all() {	//for admin 
		$sql = "SELECT * 
				FROM rcs_database.rcs_form as frm
				INNER JOIN rcs_database.rcs_category as ctg
				ON frm.frm_ctg_id = ctg.ctg_id
				INNER JOIN rcs_database.rcs_qualification as qlf
				ON frm.frm_qlf_id = qlf.qlf_id
				INNER JOIN rcs_database.rcs_headcount_control as hcc
				ON frm.frm_hcc_id = hcc.hcc_id
				INNER JOIN rcs_database.rcs_approve as apr
				ON frm.frm_id = apr.apr_frm_id
				INNER JOIN dbmc.master_mapping as mtp
                ON ctg.ctg_sec_id = mtp.Section_id     
                GROUP BY frm.frm_id  
				ORDER BY apr.apr_preparer_date DESC";
		$query = $this->db->query($sql);
		return $query;
	}

	/*
	* search_by_key_approve_admin()
	* @input  
	* @output ข้อมูลแบบฟอร์มขอพนักงาน เพื่อให้ผู้ดูแลระบบและผู้อนุมัติแบบฟอร์มใช้สำหรับค้นหา
	*/
	function search_by_key_approve_admin() {	//for admin approve
		//key => ctg_ctg_employment_type , Department_id , apr_preparer_date, frm_status
		$sql = "SELECT * 
				FROM rcs_database.rcs_form as frm
				INNER JOIN rcs_database.rcs_category as ctg
				ON frm.frm_ctg_id = ctg.ctg_id
				INNER JOIN rcs_database.rcs_qualification as qlf
				ON frm.frm_qlf_id = qlf.qlf_id
				INNER JOIN rcs_database.rcs_headcount_control as hcc
				ON frm.frm_hcc_id = hcc.hcc_id
				INNER JOIN rcs_database.rcs_approve as apr
				ON frm.frm_id = apr.apr_frm_id
				INNER JOIN dbmc.master_mapping as mtp
				ON ctg.ctg_sec_id = mtp.Section_id     
				WHERE frm.frm_status != 3     
						AND (? IS NULL OR ctg.ctg_employment_type = ?)
	 					AND (? IS NULL OR mtp.Department_id = ?)
	 					AND (? IS NULL OR apr.apr_preparer_date = ?)
	 					AND (? IS NULL OR frm.frm_status = ?) 
				GROUP BY frm.frm_id  
				ORDER BY apr.apr_preparer_date DESC";
		$query = $this->db->query($sql, array($this->ctg_employment_type, $this->ctg_employment_type, $this->Department_id, $this->Department_id, $this->apr_preparer_date, $this->apr_preparer_date, $this->frm_status, $this->frm_status));
		return $query;
	}

	/*
	* search_by_key_dashboard()
	* @input  
	* @output ข้อมูลแบบฟอร์มขอพนักงาน เพื่อให้ผู้ที่เข้ามาล็อคอินใช้สำหรับค้นหา
	*/
	function search_by_key_dashboard() {	
		//key => ctg_ctg_employment_type , Department_id , apr_preparer_date, frm_status
		$sql = "SELECT * 
				FROM rcs_database.rcs_form as frm
				INNER JOIN rcs_database.rcs_category as ctg
				ON frm.frm_ctg_id = ctg.ctg_id
				INNER JOIN rcs_database.rcs_qualification as qlf
				ON frm.frm_qlf_id = qlf.qlf_id
				INNER JOIN rcs_database.rcs_headcount_control as hcc
				ON frm.frm_hcc_id = hcc.hcc_id
				INNER JOIN rcs_database.rcs_approve as apr
				ON frm.frm_id = apr.apr_frm_id
				INNER JOIN dbmc.master_mapping as mtp
                ON ctg.ctg_sec_id = mtp.Section_id             
                
				WHERE   apr.apr_preparer_emp_id = '".$_SESSION['UsEmp_ID']."'
						AND (? IS NULL OR ctg.ctg_employment_type = ?)
	 					AND (? IS NULL OR mtp.Department_id = ?)
	 					AND (? IS NULL OR apr.apr_preparer_date = ?)
	 					AND (? IS NULL OR frm.frm_status = ?) 

				GROUP BY frm.frm_id  
				ORDER BY apr.apr_preparer_date DESC";
		$query = $this->db->query($sql, array($this->ctg_employment_type, $this->ctg_employment_type, $this->Department_id, $this->Department_id, $this->apr_preparer_date, $this->apr_preparer_date, $this->frm_status, $this->frm_status));
		return $query;
	}

	/*
	* search_by_key_admin()
	* @input  
	* @output ข้อมูลแบบฟอร์มขอพนักงาน เพื่อให้ผู้ดูแลระบบใช้สำหรับค้นหา
	*/
	function search_by_key_admin() {	
		//key => ctg_ctg_employment_type , Department_id , apr_preparer_date, frm_status
		$sql = "SELECT * 
				FROM rcs_database.rcs_form as frm
				INNER JOIN rcs_database.rcs_category as ctg
				ON frm.frm_ctg_id = ctg.ctg_id
				INNER JOIN rcs_database.rcs_qualification as qlf
				ON frm.frm_qlf_id = qlf.qlf_id
				INNER JOIN rcs_database.rcs_headcount_control as hcc
				ON frm.frm_hcc_id = hcc.hcc_id
				INNER JOIN rcs_database.rcs_approve as apr
				ON frm.frm_id = apr.apr_frm_id
				INNER JOIN dbmc.master_mapping as mtp
                ON ctg.ctg_sec_id = mtp.Section_id             
                
				WHERE   (? IS NULL OR ctg.ctg_employment_type = ?)
	 					AND (? IS NULL OR mtp.Department_id = ?)
	 					AND (? IS NULL OR apr.apr_preparer_date = ?)
	 					AND (? IS NULL OR frm.frm_status = ?) 

				GROUP BY frm.frm_id  
				ORDER BY apr.apr_preparer_date DESC";
		$query = $this->db->query($sql, array($this->ctg_employment_type, $this->ctg_employment_type, $this->Department_id, $this->Department_id, $this->apr_preparer_date, $this->apr_preparer_date, $this->frm_status, $this->frm_status));
		return $query;
	}

	/*
	* get_all_by_id()
	* @input  
	* @output ข้อมูลแบบฟอร์มขอพนักงานตาม ID (frm_id)
	*/
	function get_all_by_id() {	
		$sql = "SELECT * 
				FROM rcs_database.rcs_form as frm
				INNER JOIN rcs_database.rcs_category as ctg
				ON frm.frm_ctg_id = ctg.ctg_id
				INNER JOIN rcs_database.rcs_qualification as qlf
				ON frm.frm_qlf_id = qlf.qlf_id
				INNER JOIN rcs_database.rcs_headcount_control as hcc
				ON frm.frm_hcc_id = hcc.hcc_id
				INNER JOIN rcs_database.rcs_approve as apr
				ON frm.frm_id = apr.apr_frm_id
				INNER JOIN dbmc.master_mapping as mtp
                ON ctg.ctg_sec_id = mtp.Section_id
				INNER JOIN dbmc.position as pos
				ON ctg.ctg_pos_id = pos.Position_ID
				WHERE frm.frm_id = ?  
				GROUP BY frm.frm_id  ";
		$query = $this->db->query($sql, array($this->frm_id));
		return $query;
	}

	/*
	* get_approver()
	* @input  
	* @output ข้อมูลผู้อนุมัติแบบฟอร์มขอพนักงานตาม ID (frm_id)
	*/
	function get_approver() {	
		$sql = "SELECT * 
				FROM rcs_database.rcs_form as frm
				INNER JOIN rcs_database.rcs_approve as apr
				ON frm.frm_id = apr.apr_frm_id
				INNER JOIN dbmc.employee as emp
                ON emp.Emp_id = apr.Section_id
				INNER JOIN dbmc.master_mapping as mtp
                ON ctg.ctg_sec_id = mtp.Department_id


				WHERE frm.frm_id = ?  
				 ";
		$query = $this->db->query($sql, array($this->frm_id));
		return $query;
	}

	/*
	* get_emp_form()
	* @input  
	* @output ข้อมูลแบบฟอร์มขอพนักงานตาม (พนักงานลาออก) และ ID (frm_id)
	*/
	function get_emp_form(){	
		$sql = "SELECT * 
			FROM dbmc.employee AS emp
			INNER JOIN rcs_database.rcs_name_list as nlt
			ON nlt.nlt_emp_id = emp.Emp_ID
			INNER JOIN rcs_database.rcs_form as frm
			ON frm.frm_id = nlt.nlt_frm_id
			INNER JOIN dbmc.position as pos
			ON emp.Position_ID = pos.Position_ID
			WHERE frm.frm_id = ? AND nlt_type = 1
			
			ORDER BY nlt.nlt_effective_date ASC";
        $query = $this->db->query($sql , array($this->frm_id));
        return $query;
	}

	/*
	* get_form_by_approve()
	* @input  
	* @output ข้อมูลแบบฟอร์มที่ใช้สำหรับเช็คว่า ผ่าน หรือ ไม่ผ่าน ประธาน ตาม ID (frm_id)
	*/
	function get_form_by_approve() {	
		$sql = "SELECT * 
				FROM rcs_database.rcs_form as frm
				INNER JOIN rcs_database.rcs_category as ctg
				ON frm.frm_ctg_id = ctg.ctg_id
				WHERE frm.frm_id = ?  ";
		$query = $this->db->query($sql , array($this->frm_id));
		return $query;
	}


}		 
?>