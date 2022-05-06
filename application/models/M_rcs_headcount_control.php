<?php

include_once("rcs_model.php");

/*
* M_rcs_headcount_control
* @author Tanadon Tangjaimongkhon
* @Create Date 2565-02-21
*/ 
 
class M_rcs_headcount_control extends rcs_model {		
	
	public $hcc_id; //
	public $hcc_type; //
	public $hcc_num1; //
	public $hcc_num2; //
	public $hcc_note; //

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
	 
	 	$sql = "INSERT INTO rcs_database.rcs_headcount_control (hcc_type ,hcc_num1 ,hcc_num2, hcc_note)
	 	VALUES(?, ? ,?, ?)";
	 	$this->db->query($sql, array($this->hcc_type ,$this->hcc_num1 ,$this->hcc_num2, $this->hcc_note));
	 }

	/*
	* get_by_key
	* Get  from database
	* @input 
	* @output -
	* @author Tanadon Tangjaimongkhon
	* @Create Date 2565-02-22
	*/
	function get_by_key() {	
		$sql = "SELECT * 
				FROM rcs_database.rcs_headcount_control
				WHERE hcc_id=?";
		$query = $this->db->query($sql, array($this->hcc_id));
		return $query;
	}
	function get_last_index() {	
		$sql = "SELECT * 
				FROM rcs_database.rcs_headcount_control
				ORDER BY hcc_id DESC LIMIT 1";
		$query = $this->db->query($sql);
		return $query;
	}
}		 
?>