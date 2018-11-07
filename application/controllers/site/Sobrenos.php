<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sobrenos extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("M_config");
		$this->load->model("M_professores");
		$this->load->library("Parserlib");
		$this->load->library("Scripts_loader", "", "sl");
	}

	function index()
	{
		
	}

	function missao()
	{
		$loads = $this->M_config->getLoads(1);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$this->load->view("site/common/topo.php", $infoH);
		$this->load->view("site/missao.php");
		$this->load->view("site/common/fim.php");
	}

	function equipe()
	{
		$loads = $this->M_config->getLoads(1);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$equipe = $this->M_professores->getProfessores(array('cwhere' => 'equipe = 1'));
		$infoB['equipe'] = $equipe;

		$this->load->view("site/common/topo.php", $infoH);
		$this->load->view("site/equipe.php", $infoB);
		$this->load->view("site/common/fim.php");
	}
}