<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turmas extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_config");
		$this->load->model("m_usuarios");
		$this->load->model("m_turmas");
		$this->load->model("m_cursos");
		if (!$this->m_usuarios->isLogged()) {
			return redirect("sistema/login");
		}
	}

	function visualizar ($id=null) {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$turmas = isset($id) && $id != null ? $this->m_turmas->getTurma($id) : $this->m_turmas->getTurma();

		foreach ($turmas as $turma) {
			$curso_opts = array('id' => $turma->idcurso);
			$curso = $this->m_cursos->getCurso($curso_opts);
			if ($curso != null) {
				$turma->curso = $curso[0]->nome;
			}
		}

		$infoB['turmas'] = $turmas;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/turmas/listar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function novo() {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB['cursos'] = $this->m_cursos->getCurso();

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/turmas/criar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function inserir() {
		$data = $_POST;
		if ($this->form_validation->run('cadastro_turmas') == FALSE) {
			$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
			$this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Turmas/novo");
		}
		
		$this->m_turmas->insertTurma($data);
		return redirect("sistema/Turmas");
	}

	function editar($id=null) {
		if (!$id) {
			return redirect("sistema/Turmas");
		}

		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$userdata = $this->m_turmas->getTurma(array('id' => $id))[0];

		$infoB['userdata'] = $userdata;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/turmas/editar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function atualizar() {
		$data = $_POST;
		$idturma = $this->input->post("idref");
		$errors = "";

		if ($this->form_validation->run('cadastro_turmas') == FALSE) {
			$errors = validation_errors("<p class='error'>", "</p>");
		}

		if ($errors != "") {
			$this->session->set_flashdata('errors', $errors);
			// $this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Turmas/".$idturma);
		}

		unset($data['idref']);
		$this->m_turmas->updateTurma($idturma, $data);
		return redirect("sistema/Turmas");
	}

}