<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("M_config");
		$this->load->model("M_usuarios");
		$this->load->model("M_professores");
		$this->load->model("M_cursos");
		$this->load->model("M_aulas");
		$this->load->model("M_eventos");
		if (!$this->M_usuarios->isLogged()) {
			return redirect("sistema/login");
		}
	}

	function visualizar ($id=null) {
		if (!$this->M_permissoes->checkPermission("agenda", "visualizar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para visualizar eventos.</p>");
			return redirect("sistema");
		}

		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$infoB['agenda'] = $this->M_eventos->getAgenda();
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/agenda/listar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function novo() {
		if (!$this->M_permissoes->checkPermission("agenda", "criar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para criar eventos.</p>");
			return redirect("sistema");
		}

		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/professores/criar.php");
		$this->load->view("sistema/common/fim.php");
	}

	function inserir() {
		if (!$this->M_permissoes->checkPermission("agenda", "criar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para criar eventos.</p>");
			return redirect("sistema");
		}

		$data = $_POST;
		if ($this->form_validation->run('cadastro_professores') == FALSE) {
			$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
			$this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Professores/novo");
		}
		
		$this->M_professores->insertProfessor($data);
		return redirect("sistema/Professores");
	}

	function editar($id=null) {
		if (!$this->M_permissoes->checkPermission("agenda", "editar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para editar eventos.</p>");
			return redirect("sistema");
		}

		if (!$id) {
			return redirect("sistema/Professores");
		}

		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$userdata = $this->M_professores->getProfessores(array('id' => $id))[0];

		$infoB['userdata'] = $userdata;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/professores/editar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function atualizar() {
		if (!$this->M_permissoes->checkPermission("agenda", "editar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para editar eventos.</p>");
			return redirect("sistema");
		}
		
		$data = $_POST;
		$idprofessor = $this->input->post("idref");
		$errors = "";

		if ($this->form_validation->run('atualizacao_professores') == FALSE) {
			$errors = validation_errors("<p class='error'>", "</p>");
		}

		$query_options = array(
			'!id' => $idprofessor,
			'cwhere' => "email = '{$data['email']}'"
		);

		$email_result = $this->M_professores->getProfessores($query_options);

		if (sizeof($email_result) > 0) {
			$errors .= "<p class='error'>O campo E-mail já existe, ele deve ser único.</p>";
		}

		if ($errors != "") {
			$this->session->set_flashdata('errors', $errors);
			// $this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Professores/".$idprofessor);
		}

		unset($data['idref']);
		$this->M_professores->updateProfessor($idprofessor, $data);
		return redirect("sistema/Professores");
	}

}