<?php

include_once("rcs_model.php");

/*
* M_rcs_dbmc
* @author Tanadon Tangjaimongkhon
* @Create Date 2565-02-21
*/ 
 
class M_rcs_dbmc extends rcs_model {		
	
	function __construct() {
		parent::__construct();
	
	}

	/*
	* get_all_position()
	* @input  -
	* @output ข้อมูลตำแหน่งงานทั้งหมด
	*/
    function get_all_position() {	
		$sql = "SELECT * 
				FROM dbmc.position
				WHERE position.Position_Level != 0
				ORDER BY position.Position_ID ASC";
		$query = $this->db->query($sql);
		return $query;
	}

	/*
	* get_all_department()
	* @input  -
	* @output ข้อมูลแผนกทั้งหมด
	*/
	function get_all_department() {	
		$sql = "SELECT * 
				FROM dbmc.master_mapping
				WHERE master_mapping.Department != ''
				GROUP BY master_mapping.Department
				ORDER BY master_mapping.Department ASC";
		$query = $this->db->query($sql);
		return $query;
	}

	/*
	* get_all_position()
	* @input  -
	* @output ข้อมูล section ที่อยู่ในแผนกที่ต้องการ (Department_id)
	*/
	function get_all_section_by_department() {	
		$sql = "SELECT * 
				FROM dbmc.master_mapping
				WHERE master_mapping.Section != '' AND master_mapping.Department_id = ?
				GROUP BY master_mapping.Section
				ORDER BY master_mapping.Section ASC";
		$query = $this->db->query($sql, array($this->Department_id));
		return $query;
	}

	/*
	* get_all_section_by_id()
	* @input  -
	* @output ข้อมูล section by id
	*/
	function get_all_section_by_id() {	
		$sql = "SELECT * 
				FROM dbmc.master_mapping
				WHERE master_mapping.Section_id = ?";
		$query = $this->db->query($sql, array($this->Section_id));
		return $query;
	}

	/*
	* get_emp_by_key()
	* @input  -
	* @output ข้อมูลพนักงานตามตำแหน่งงาน (Position_ID)
	*/
	function get_emp_by_key(){	
		$sql = "SELECT * 
                FROM dbmc.employee 
                WHERE employee.Position_ID = ? 
				GROUP BY employee.Empsurname_th
				ORDER BY employee.Empsurname_th ASC" ;
        $query = $this->db->query($sql,array($this->Position_ID));
        return $query;
	}

	/*
	* get_emp_by_id()
	* @input  -
	* @output ข้อมูลพนักงานตาม ID (Emp_ID)
	*/
	function get_emp_by_id(){	
		$sql = "SELECT * 
				FROM dbmc.employee AS emp
				INNER JOIN dbmc.position AS pos
				ON pos.Position_ID = emp.Position_ID
                WHERE emp.Emp_ID = ? ";
        $query = $this->db->query($sql,array($this->Emp_ID));
        return $query;
	}

	/*
	* get_department_by_id()
	* @input  -
	* @output ข้อมูลแผนกตาม ID (Department_id)
	*/
	function get_department_by_id(){	
		$sql = "SELECT * 
				FROM dbmc.master_mapping 
                WHERE master_mapping.Department_id = ?";
        $query = $this->db->query($sql,array($this->Department_id));
        return $query;
	}

	/*
	* get_all_emp()
	* @input  -
	* @output ข้อมูลพนักงานทั้งหมด
	*/
	function get_all_emp(){	
		$sql = "SELECT *
				FROM dbmc.employee
				GROUP BY employee.Emp_ID
				ORDER BY employee.Emp_ID ASC";
		$query = $this->db->query($sql);
		return $query;
	}

	/*
	* get_emp_id_replacement()
	* @input  -
	* @output ข้อมูลพนักงานทั้งหมดที่เป็นประเภทลาออก (1=ลาออก, 2=ทดแทน)
	*/
	function get_emp_id_replacement(){	
		$sql = "SELECT DISTINCT emp.Emp_ID,Empname_th,Empsurname_th,
		(select nlt.nlt_emp_id from rcs_database.rcs_name_list as nlt 
		where nlt.nlt_emp_id = emp.Emp_ID AND nlt.nlt_type = 1) as nlt_emp_id 
		from dbmc.employee as emp 
		GROUP BY emp.Emp_ID
		ORDER BY emp.Emp_ID ASC";
		$query = $this->db->query($sql);
		return $query;
	}

	/*
	* get_emp()
	* @input  -
	* @output ข้อมูลตำแหน่งงานตาม ID (Emp_ID)
	*/
	function get_emp(){	
		$sql = "SELECT *
				FROM dbmc.employee
				WHERE employee.Emp_ID = ? ";
		$query = $this->db->query($sql, array($this->Emp_ID));
		return $query->result();
	}

	/*
	* get_data_emp()
	* @input  -
	* @output ข้อมูลพนักงานและตำแหน่งงานตาม ID (Emp_ID)
	*/
	function get_data_emp(){	
		$sql = "SELECT * 
                FROM dbmc.employee AS emp
                INNER JOIN dbmc.position AS pos
                ON pos.Position_ID = emp.Position_ID
                WHERE emp.Emp_ID=? " ;
        $query = $this->db->query($sql,array($this->Emp_ID));
        return $query;
	}

	/*
	* get_emp_by_dpm()
	* @input  Department_ID, Section_ID, Sub_Section, Group, Line
	* @output ข้อมูลพนักงานทั้งหมดที่มีรายละเอียดครบถ้วน
	*/
	function get_emp_by_dpm($dp,$sc,$sb,$gr,$ln){	
		$sql = "SELECT DISTINCT * ,(select nlt.nlt_emp_id from rcs_database.rcs_name_list as nlt 
		where nlt.nlt_emp_id = emp.Emp_ID AND nlt.nlt_type = 1) as nlt_emp_id 
			FROM dbmc.employee AS emp
			INNER JOIN dbmc.position AS pos
			ON pos.Position_ID = emp.Position_ID
			WHERE emp.Sectioncode_ID = '".$dp."'
			OR emp.Sectioncode_ID = '".$sc."'
			OR emp.Sectioncode_ID = '".$sb."'
			OR emp.Sectioncode_ID = '".$gr."'
			OR emp.Sectioncode_ID = '".$ln."'";
        $query = $this->db->query($sql);
        return $query;
	}

	/*
	* get_approver_data()
	* @input  Employee_ID
	* @output ข้อมูลผู้อนุมัติตาม ID (emp_id)
	*/
	function get_approver_data($emp_id){
		$sql = "SELECT  *
			FROM dbmc.employee
			WHERE Emp_ID = '".$emp_id."' ";
        $query = $this->db->query($sql);
        return $query;

	}
	
}		 
?>