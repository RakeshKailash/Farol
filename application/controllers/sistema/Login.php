<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		// $this->load->library("Authhandler", "auth");
		$this->load->model("M_config");
		$this->load->model("M_usuarios");
	}

	function index()
	{
		if ($this->M_usuarios->isLogged()) {
			return redirect("sistema");
		}
		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$this->load->view("sistema/login/topo.php", $infoH);
		$this->load->view("sistema/login/logar.php");
		$this->load->view("sistema/common/fim.php");
	}

	function login()
	{
		if ($this->M_usuarios->isLogged()) {
			return redirect("sistema");
		}

		if (!isset($_POST['login']) || !isset($_POST['senha'])) {
			$this->session->set_flashdata("errors", "<p class='error'>Preencha CPF/E-mail e Senha para acessar o sistema.</p>");
			return redirect("sistema/login");
		}

		if (!$this->M_usuarios->logUser($_POST['login'], $_POST['senha'])) {
			$this->session->set_flashdata("errors", "<p class='error'>E-mail/CPF ou Senha incorretos.</p>");
			return redirect("sistema/login");
		}

		if (!$this->M_permissoes->setSessionPermissoes()) {
			$this->session->set_flashdata("errors", "<p class='error'>Erro ao resgatar as permissões do usuário.</p>");
			return redirect("sistema/login");
		}

		return redirect("sistema");
	}

	function logout()
	{
		$this->M_usuarios->logout();
		return redirect("sistema/login");
	}

}