<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_config");
		$this->load->model("m_eventos");
		$this->load->library("Parserlib");
		$this->load->library("Scripts_loader", "", "sl");
	}

	function index() {
		$loads = $this->m_config->getLoads(1);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB['agenda'] = $this->m_eventos->getAgenda();

		$this->load->view("site/common/topo.php", $infoH);
		$this->load->view("site/agenda.php", $infoB);
		$this->load->view("site/common/fim.php");
	}
}