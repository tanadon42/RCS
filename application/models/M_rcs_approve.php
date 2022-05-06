<?php

include_once("rcs_model.php");

/*
* M_rcs_approve
* @author Tanadon Tangjaimongkhon
* @Create Date 2565-02-21
*/ 
 
class M_rcs_approve extends rcs_model {		
	
	public $apr_id; //
	public $apr_state; //
	public $apr_frm_id; //
	public $apr_preparer_emp_id; //
	public $apr_preparer_date; //
	public $apr_checker_emp_id; //
    public $apr_checker_date; //
    public $apr_approver_emp_id; //
	public $apr_approver_date; //
    public $apr_approver_md_emp_id; //
	public $apr_approver_md_date; //
	public $apr_receiver_admin_emp_id; //
	public $apr_receiver_admin_date; //
	public $apr_checker_admin_emp_id; //
    public $apr_checker_admin_date; //
    public $apr_approver_admin_emp_id; //
	public $apr_approver_admin_date; //

   	public $apr_checker_status; //
	public $apr_approver_status; //
	public $apr_approver_md_status; //
	public $apr_receiver_admin_status; //
    public $apr_checker_admin_status; //
	public $apr_approver_admin_status; //

	public $apr_note; //




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
	 
	 	$sql = "INSERT INTO rcs_database.rcs_approve (apr_state , apr_frm_id, apr_preparer_emp_id ,apr_preparer_date ,apr_checker_emp_id, apr_checker_date,
            apr_approver_emp_id, apr_approver_date, apr_approver_md_emp_id, apr_approver_md_date,
			apr_receiver_admin_emp_id, apr_receiver_admin_date, apr_checker_admin_emp_id, apr_checker_admin_date, 
			apr_approver_admin_emp_id, apr_approver_admin_date, apr_checker_status, apr_approver_status, apr_approver_md_status,
			apr_receiver_admin_status, apr_checker_admin_status, apr_approver_admin_status, apr_note)
	 	VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,? ,? ,? ,?, ?, ?, ?, ?, ?, ?, ?)";
	 	$this->db->query($sql, array($this->apr_state ,$this->apr_frm_id ,$this->apr_preparer_emp_id ,$this->apr_preparer_date ,$this->apr_checker_emp_id, $this->apr_checker_date,
		$this->apr_approver_emp_id, $this->apr_approver_date ,$this->apr_approver_md_emp_id ,$this->apr_approver_md_date, $this->apr_receiver_admin_emp_id, $this->apr_receiver_admin_date,
		$this->apr_checker_admin_emp_id, $this->apr_checker_admin_date, $this->apr_approver_admin_emp_id, $this->apr_approver_admin_date,
		$this->apr_checker_status, $this->apr_approver_status, $this->apr_approver_md_status, $this->apr_receiver_admin_status,$this->apr_checker_admin_status, $this->apr_approver_admin_status, $this->apr_note
		));
	 }

	/*
	* update
	* update  to database
	* @input 
	* @output -
	*/
	
	function update() {
		$sql = "UPDATE rcs_database.rcs_approve 
				SET	apr_state = ?, apr_frm_id = ?, apr_preparer_emp_id = ?, apr_preparer_date = ?, apr_checker_emp_id = ?, apr_checker_date = ?,
				apr_approver_emp_id = ?, apr_approver_date = ?, apr_approver_md_emp_id = ?, apr_approver_md_date = ?, apr_receiver_admin_emp_id = ?, apr_receiver_admin_date = ?,
				apr_checker_admin_emp_id = ?, apr_checker_admin_date = ?, apr_approver_admin_emp_id = ?, apr_approver_admin_date = ?,
				apr_checker_status = ?, apr_approver_status = ?, apr_approver_md_status = ?, 
				apr_receiver_admin_status = ?, apr_checker_admin_status = ?, apr_approver_admin_status = ?, apr_note = ?
				WHERE apr_id = ? ";
	    $this->db->query($sql, array($this->apr_state ,$this->apr_frm_id ,$this->apr_preparer_emp_id ,$this->apr_preparer_date ,$this->apr_checker_emp_id, $this->apr_checker_date,
		$this->apr_approver_emp_id, $this->apr_approver_date ,$this->apr_approver_md_emp_id ,$this->apr_approver_md_date, $this->apr_receiver_admin_emp_id, $this->apr_receiver_admin_date,
		$this->apr_checker_admin_emp_id, $this->apr_checker_admin_date, $this->apr_approver_admin_emp_id, $this->apr_approver_admin_date, $this->apr_checker_status,
		$this->apr_approver_status, $this->apr_approver_md_status, $this->apr_receiver_admin_status, $this->apr_checker_admin_status, $this->apr_approver_admin_status, $this->apr_note, $this->apr_id));
	} 

	/*
	* get_by_key
	* Get  from database
	* @input 
	* @output -
	*/
	function get_by_key() {	
		$sql = "SELECT * 
				FROM rcs_database.rcs_approve
				WHERE apr_frm_id = ?";
		$query = $this->db->query($sql, array($this->apr_frm_id));
		return $query;
	}
	
}		 
?>