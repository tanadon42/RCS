<?php

include_once("rcs_model.php");

/*
* M_rcs_qualification
* @author Tanadon Tangjaimongkhon
* @Create Date 2565-02-21
*/ 
 
class M_rcs_qualification extends rcs_model {		
	
	public $qlf_id; //
	public $qlf_education_level; //
	public $qlf_education_major; //
	public $qlf_work_exp; //
	public $qlf_work_exp_field; //
	public $qlf_com; //
	public $qlf_com_ect; //
	public $qlf_eng; //
	public $qlf_japan; //
	public $qlf_ect; //
	

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
	 
	 	$sql = "INSERT INTO rcs_database.rcs_qualification (qlf_education_level ,qlf_education_major ,qlf_work_exp ,qlf_work_exp_field ,qlf_com ,qlf_com_ect ,qlf_eng ,qlf_japan ,qlf_ect)
	 	VALUES(?, ? ,? ,? ,? ,? ,? ,? ,?)";
	 	$this->db->query($sql, array($this->qlf_education_level ,$this->qlf_education_major ,$this->qlf_work_exp ,$this->qlf_work_exp_field ,$this->qlf_com ,$this->qlf_com_ect ,$this->qlf_eng ,$this->qlf_japan ,$this->qlf_ect));
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
				FROM rcs_database.rcs_qualification
				WHERE qlf_id=?";
		$query = $this->db->query($sql, array($this->qlf_id));
		return $query;
	}

	function get_last_index() {	
		$sql = "SELECT * 
				FROM rcs_database.rcs_qualification
				ORDER BY qlf_id DESC LIMIT 1";
		$query = $this->db->query($sql);
		return $query;
	}

}		 
?>