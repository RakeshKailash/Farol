<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		// $this->load->library("Authhandler", "auth");
		$this->load->model("m_config");
		$this->load->model("m_usuarios");
	}

	function index()
	{
		if ($this->m_usuarios->isLogged()) {
			return redirect("sistema");
		}
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$this->load->view("sistema/login/topo.php", $infoH);
		$this->load->view("sistema/login/logar.php");
		$this->load->view("sistema/common/fim.php");
	}

	function login()
	{
		if ($this->m_usuarios->isLogged()) {
			return redirect("sistema");
		}

		if (!isset($_POST['login']) || !isset($_POST['senha'])) {
			$this->session->set_flashdata("errors", "<p class='error'>Preencha Login e Senha para acessar o sistema.</p>");
			return redirect("sistema/login");
		}

		if (!$this->m_usuarios->logUser($_POST['login'], $_POST['senha'])) {
			$this->session->set_flashdata("errors", "<p class='error'>Login ou Senha incorretos.</p>");
			return redirect("sistema/login");
		}

		return redirect("sistema");
	}

	function logout()
	{
		$this->m_usuarios->logout();
		return redirect("sistema/login");
	}

}