<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Espacoaluno extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_config");
		$this->load->model("m_eventos");
		$this->load->model("m_inscricoes");
		$this->load->model("m_usuarios");
		$this->load->library("Parserlib");
		$this->load->library("Scripts_loader", "", "sl");
	}

	function index()
	{
		if (!$this->m_usuarios->isLoggedSite()) {
			return redirect("site/espacoaluno/login");
		}

		$loads = $this->m_config->getLoads(1);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB = array();
		$hoje = date('Y-m-d', time());
		// $date = new DateTime($hoje);
		// $date->add(new DateInterval('P3M'));
		// $date = (string) $date->format('Y-m-d');

		$ids_turmas = $this->m_inscricoes->getTurmasInscritas($this->session->idusuario);

		if (count($ids_turmas)) {
			$infoB['agenda'] = $this->m_eventos->getAgenda(array(
				"cwhere" => "eventos.`idturma` IN (".implode("," ,$ids_turmas).") AND dias_eventos.`inicio` >= '{$hoje}'"
			));
		}

		$this->load->view("site/common/topo_login.php", $infoH);
		$this->load->view("site/home_alunos.php", $infoB);
		$this->load->view("site/common/fim.php");
	}

	function login()
	{
		if ($this->m_usuarios->isLoggedSite()) {
			return redirect("site/espacoaluno");
		}

		$loads = $this->m_config->getLoads(1);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$this->load->view("site/common/topo_login.php", $infoH);
		$this->load->view("site/login.php");
		$this->load->view("site/common/fim.php");
	}

	function logar()
	{
		if ($this->m_usuarios->isLoggedSite()) {
			return redirect("site/espacoaluno");
		}

		if (!isset($_POST['login']) || !isset($_POST['senha'])) {
			$this->session->set_flashdata("errors", "<p class='error'>Preencha CPF/E-mail e Senha para acessar o Espaço Aluno.</p>");
			return redirect("site/espacoaluno/login");
		}

		if (!$this->m_usuarios->logUser($_POST['login'], $_POST['senha'], 0)) {
			$this->session->set_flashdata("errors", "<p class='error'>E-mail/CPF ou Senha incorretos.</p>");
			return redirect("site/espacoaluno/login");
		}

		return redirect("site/espacoaluno");
	}
}