<?php
/**
 * Created by PhpStorm.
 * User: ALOLA
 * Date: 9/9/2018
 * Time: 5:55 PM
 */

class Bank_model extends CI_Model
{
	function __construct() {
		parent::__construct();
	}

	function get_all_bank() {
		$this->db->select('*');
		$this->db->from('bank');
		$query = $this->db->get();

		return $query->result();
	}
}
