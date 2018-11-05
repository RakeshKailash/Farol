<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Espacoaluno extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("M_config");
		$this->load->model("M_eventos");
		$this->load->model("M_inscricoes");
		$this->load->model("M_usuarios");
		$this->load->model("M_investimentos");
		$this->load->model("M_cursos");
		$this->load->library("Parserlib");
		$this->load->library("Scripts_loader", "", "sl");
	}

	function index()
	{
		if (!$this->M_usuarios->isLoggedSite()) {
			return redirect("site/espacoaluno/login");
		}

		$loads = $this->M_config->getLoads(1);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$this->load->view("site/common/topo_aluno.php", $infoH);
		$this->load->view("site/home_alunos.php");
		$this->load->view("site/common/fim_aluno.php");
	}

	function login()
	{
		if ($this->M_usuarios->isLoggedSite()) {
			return redirect("site/espacoaluno");
		}

		$loads = $this->M_config->getLoads(1);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$this->load->view("site/common/topo_login.php", $infoH);
		$this->load->view("site/login.php");
		$this->load->view("site/common/fim.php");
	}

	function logar()
	{
		if ($this->M_usuarios->isLoggedSite()) {
			return redirect("site/espacoaluno");
		}

		if (!isset($_POST['login']) || !isset($_POST['senha'])) {
			$this->session->set_flashdata("errors", "<p class='error'>Preencha CPF/E-mail e Senha para acessar o Espaço Aluno.</p>");
			return redirect("site/espacoaluno/login");
		}

		if (!$this->M_usuarios->logUser($_POST['login'], $_POST['senha'], 0)) {
			$this->session->set_flashdata("errors", "<p class='error'>E-mail/CPF ou Senha incorretos.</p>");
			return redirect("site/espacoaluno/login");
		}

		return redirect("site/espacoaluno");
	}

	function logarLocal()
	{
		$retorno = array();

		if ($this->M_usuarios->isLoggedSite()) {
			$retorno['status'] = 2;
			$retorno['msg'] = "Você já está logado";
			echo json_encode($retorno);
			return;
		}

		if (!isset($_POST['login']) || !isset($_POST['senha'])) {
			$retorno['status'] = 0;
			$retorno['msg'] = "Preencha CPF/E-mail e Senha para acessar o Espaço Aluno";
			echo json_encode($retorno);
			return;
		}

		if (!$this->M_usuarios->logUser($_POST['login'], $_POST['senha'], 0)) {
			$retorno['status'] = 0;
			$retorno['msg'] = "E-mail/CPF ou Senha incorretos";
			echo json_encode($retorno);
			return;
		}

		$retorno['status'] = 1;
		$retorno['msg'] = "Logado com sucesso";
		echo json_encode($retorno);
		return;
	}

	function logout()
	{
		$this->M_usuarios->logout();
		return redirect('site');
	}

	function Cursos()
	{
		if (!$this->M_usuarios->isLoggedSite()) {
			return redirect("site/espacoaluno/login");
		}

		$loads = $this->M_config->getLoads(1);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB = array();
		$cursos = array();
		$cursos = $this->getCursosInscritos($this->session->idusuario);
		$infoB['cursos'] = $cursos;

		$this->load->view("site/common/topo_aluno.php", $infoH);
		$this->load->view("site/meus_cursos.php", $infoB);
		$this->load->view("site/common/fim_aluno.php");
	}

	function Curso($idinscricao=null)
	{
		if (!$this->M_usuarios->isLoggedSite()) {
			return redirect("site/espacoaluno/login");
		}

		if (!$idinscricao) {
			return redirect("site/espacoaluno/cursos");
		}

		$loads = $this->M_config->getLoads(1);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB = array();
		$idusuario = $this->session->idusuario;
		$curso = $this->M_inscricoes->getInscricao(array(
			'id' => $idinscricao,
			'cwhere' => "inscricoes.`idusuario` = {$idusuario}"
		))[0];
		$investimento = $this->M_investimentos->getInvestimentoInscricao(array(
			'cwhere' => "idinscricao = {$idinscricao} AND idusuario = {$idusuario}"
		))[0];
		$infoB['curso'] = $curso;
		$infoB['financeiro'] = $investimento;

		$this->load->view("site/common/topo_aluno.php", $infoH);
		$this->load->view("site/curso_aluno.php", $infoB);
		$this->load->view("site/common/fim_aluno.php");
	}

	function Agenda()
	{
		if (!$this->M_usuarios->isLoggedSite()) {
			return redirect("site/espacoaluno/login");
		}

		$loads = $this->M_config->getLoads(1);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB = array();
		$hoje = date('Y-m-d', time());
		$ids_turmas = $this->M_inscricoes->getTurmasInscritas($this->session->idusuario);

		if (count($ids_turmas)) {
			$infoB['agenda'] = $this->M_eventos->getAgenda(array(
				"cwhere" => "eventos.`idturma` IN (".implode("," ,$ids_turmas).") AND dias_eventos.`inicio` >= '{$hoje}'"
			));
		}

		$this->load->view("site/common/topo_aluno.php", $infoH);
		$this->load->view("site/agenda_alunos.php", $infoB);
		$this->load->view("site/common/fim_aluno.php");
	}

	private function getCursosInscritos($idaluno=null)
	{
		if (!$idaluno) {
			return null;
		}

		$lista_turmas = $this->M_inscricoes->getTurmasAluno($idaluno);
		$cursos = array();

		foreach ($lista_turmas as $turma) {
			$cursos[] = array(
				'curso' => $this->M_cursos->getCurso(array('id' => $turma->idcurso))[0],
				'inscricao' => $turma
			);
		}

		return $cursos;
	}
}