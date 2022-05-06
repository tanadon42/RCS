<?php

include_once("rcs_model.php");

/*
* M_rcs_category
* @author Tanadon Tangjaimongkhon
* @Create Date 2565-02-21
*/ 
 
class M_rcs_category extends rcs_model {		
	
	public $ctg_id; 
	public $ctg_external_type; 
	public $ctg_internal_type; 
	public $ctg_req_num; 
	public $ctg_employment_type; 
	public $ctg_start_date; 
	public $ctg_end_date; 
	public $ctg_req_date;
	public $ctg_pos_id; 
	public $ctg_dpm_id; 
	public $ctg_sec_id; 


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
	 
	 	$sql = "INSERT INTO rcs_database.rcs_category (ctg_internal_type, ctg_external_type ,ctg_req_num ,ctg_employment_type ,ctg_start_date ,ctg_end_date ,ctg_req_date ,ctg_pos_id ,ctg_dpm_id ,ctg_sec_id)
	 	VALUES(?, ? ,? ,? ,? ,? ,? ,? ,? ,?)";
	 	$this->db->query($sql, array($this->ctg_internal_type, $this->ctg_external_type ,$this->ctg_req_num ,$this->ctg_employment_type ,$this->ctg_start_date ,$this->ctg_end_date ,$this->ctg_req_date ,$this->ctg_pos_id ,$this->ctg_dpm_id ,$this->ctg_sec_id));
	 }

	/*
	* get_by_key
	* Get  from database
	* @input 
	* @output -
	*/
	function get_by_key() {	
		$sql = "SELECT * 
				FROM rcs_database.rcs_category
				WHERE ctg_id=?";
		$query = $this->db->query($sql, array($this->ctg_id));
		return $query;
	}

	/*
	* get_last_index()
	* @input  -
	* @output ข้อมูลชุดสุดท้าย
	*/
	function get_last_index() {	
		$sql = "SELECT * 
				FROM rcs_database.rcs_category
				ORDER BY ctg_id DESC LIMIT 1";
		$query = $this->db->query($sql);
		return $query;
	}

	

}		 
?>