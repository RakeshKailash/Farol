<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_config");
		$this->load->model("m_usuarios");
		$this->load->model("m_cursos");
		$this->load->model("m_turmas");
		if (!$this->m_usuarios->isLogged()) {
			return redirect("sistema/login");
		}
	}

	function visualizar ($id=null) {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$cursos = isset($id) && $id != null ? $this->m_cursos->getCurso($id) : $this->m_cursos->getCurso();

		foreach ($cursos as $curso) {
			$turmas_opts = array('cwhere' => "idcurso = {$curso->idcurso}", 'orderby' => 'idturma DESC');
			$turma = $this->m_turmas->getTurma($turmas_opts);

			$curso->turma_recente = $turma != null ? $turma[0]->identificacao : "";
			$curso->idturma = $turma != null ? $turma[0]->idturma : "";
		}

		$infoB['cursos'] = $cursos;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/cursos/listar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function novo() {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/cursos/criar.php");
		$this->load->view("sistema/common/fim.php");
	}

	function inserir() {
		$data = $_POST;
		if ($this->form_validation->run('cadastro_cursos') == FALSE) {
			$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
			$this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Cursos/novo");
		}
		
		$data = $this->prepareData($data);
		$this->m_cursos->insertCurso($data);
		return redirect("sistema/Cursos");
	}

	function editar($id=null) {
		if (!$id) {
			return redirect("sistema/Cursos");
		}

		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$userdata = $this->m_cursos->getCurso(array('id' => $id))[0];

		$infoB['userdata'] = $userdata;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/cursos/editar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function atualizar() {
		$data = $_POST;
		$idcurso = $this->input->post("idref");
		$errors = "";

		if ($this->form_validation->run('cadastro_cursos') == FALSE) {
			$errors = validation_errors("<p class='error'>", "</p>");
		}

		if ($errors != "") {
			$this->session->set_flashdata('errors', $errors);
			// $this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Cursos/".$idcurso);
		}

		unset($data['idref']);
		$data = $this->prepareData($data);
		$this->m_cursos->updateCurso($idcurso, $data);
		return redirect("sistema/Cursos");
	}

	function prepareData($data=null)
	{
		if (!$data) {
			return null;
		}

		$data['nome'] = $this->parserlib->titleCase($data['nome']);
		$data['descricao'] = $this->parserlib->mb_ucfirst($data['descricao']);
		return $data;
	}

}