<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobrenos extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_config");
		$this->load->library("Parserlib");
		$this->load->library("Scripts_loader", "", "sl");
	}

	function index()
	{
		
	}

	function missao()
	{
		$loads = $this->m_config->getLoads(1);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$this->load->view("site/common/topo.php", $infoH);
		$this->load->view("site/missao.php");
		$this->load->view("site/common/fim.php");
	}
}