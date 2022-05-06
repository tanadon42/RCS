<?php

/*
* rcs_model
* -
* @author 	Tangjaimongkhon
* @Create Date 2565-02-22
*/

class rcs_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->rcs = $this->load->database('rcs', TRUE);
	}
}
?>