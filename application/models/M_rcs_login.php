<?php

include_once("rcs_model.php");

/*
* M_rcs_login
* @author Tanadon Tangjaimongkhon
* @Create Date 2565-02-21
*/ 
 
class M_rcs_login extends rcs_model {		
	
	public $log_id; 
	public $log_username; 
	public $log_password; 
	public $log_role; 



	function __construct() {
		parent::__construct();
	}

	
	/*
	* get_by_key
	* Get  from database
	* @input 
	* @output -
	* @author Tanadon Tangjaimongkhon
	* @Create Date 2565-02-22
	*/
	function check_login() {	
		$sql = "SELECT * 
				FROM rcs_database.rcs_login as logi
                INNER JOIN dbmc.employee AS emp
				ON emp.Emp_ID = logi.log_username
				WHERE logi.log_username=? AND logi.log_password =?";
		$query = $this->db->query($sql, array($this->log_username,$this->log_password));
		return $query;
	}

	

}		 
?>