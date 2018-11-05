<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("M_config");
		$this->load->model("M_usuarios");
		if (!$this->M_usuarios->isLogged()) {
			return redirect("sistema/login");
		}
	}

	function index()
	{
		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/home.php");
		$this->load->view("sistema/common/fim.php");
	}

}