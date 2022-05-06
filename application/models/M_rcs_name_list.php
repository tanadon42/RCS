<?php

include_once("rcs_model.php");

/*
* M_rcs_name_list
* @author Tanadon Tangjaimongkhon
* @Create Date 2565-02-21
*/ 
 
class M_rcs_name_list extends rcs_model {		
	
	public $nlt_id; //
	public $nlt_start_date; //
	public $nlt_effective_date; //
	public $nlt_emp_id; //
	public $nlt_type; //
	public $nlt_frm_id; //

	function __construct() {
		parent::__construct();
	
	}

	/*
	* insert
	* Insert  to database
	* @input 
	* @output -
	* @author Tanadon Tangjaimongkhon
	* @Create Date 2565-02-22
	*/
	
	function insert() {
	 
	 	$sql = "INSERT INTO rcs_database.rcs_name_list (nlt_start_date ,nlt_effective_date ,nlt_emp_id , nlt_frm_id, nlt_type)
	 	VALUES(?, ? ,? ,? ,?)";
	 	$this->db->query($sql, array($this->nlt_start_date ,$this->nlt_effective_date ,$this->nlt_emp_id ,$this->nlt_frm_id ,$this->nlt_type));
	 }

	 /*
	* update
	* update  to database
	* @input 
	* @output -
	* @author Tanadon Tangjaimongkhon
	* @Create Date 2565-02-24
	*/
	
	function update() {
		$sql = "UPDATE rcs_database.rcs_name_list 
				SET	nlt_start_date = ?, nlt_effective_date = ?, nlt_emp_id = ?, nlt_frm_id = ?, nlt_type = ?
				WHERE nlt_id = ? ";
	    $this->db->query($sql, array($this->nlt_start_date, $this->nlt_effective_date, $this->nlt_emp_id, $this->nlt_frm_id, $this->nlt_type, $this->nlt_id));
	}     
	 

	/*
	* get_by_key
	* Get  from database
	* @input 
	* @output -
	* @author Tanadon Tangjaimongkhon
	* @Create Date 2565-02-22
	*/
	function get_by_id() {	
		$sql = "SELECT * 
				FROM rcs_database.rcs_name_list
				WHERE nlt_id=?";
		$query = $this->db->query($sql, array($this->nlt_id));
		return $query;
	}
	function get_by_key() {	
		$sql = "SELECT * 
				FROM rcs_database.rcs_name_list as nlt
				INNER JOIN dbmc.employee AS emp
				ON emp.Emp_ID = nlt.nlt_emp_id
				WHERE nlt.nlt_frm_id = ? AND nlt.nlt_type = ?";
		$query = $this->db->query($sql, array($this->nlt_frm_id, $this->nlt_type));
		return $query;
	}
}		 
?>