<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library("Dbbackups");
	}

	function dbdump() {
		echo $this->dbbackups->dbdump();
	}

	function dbrestore() {

	}
}