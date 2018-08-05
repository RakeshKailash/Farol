<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_config");
		$this->load->model("m_usuarios");
		$this->load->model("m_cursos");
		if (!$this->m_usuarios->isLogged()) {
			return redirect("sistema/login");
		}
	}

	function visualizar ($id=null) {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$users = isset($id) && $id != null ? $this->m_cursos->getCurso($id) : $this->m_cursos->getCurso();

		// foreach ($users as &$value) {
		// 	$value->data_nascimento = $this->parserlib->formatDate($value->data_nascimento);
		// }

		$infoB['cursos'] = $users;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/cursos/visualizar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

}