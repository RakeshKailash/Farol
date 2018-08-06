<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professores extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_config");
		$this->load->model("m_usuarios");
		$this->load->model("m_professores");
		if (!$this->m_usuarios->isLogged()) {
			return redirect("sistema/login");
		}
	}

	function visualizar ($id=null) {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$users = isset($id) && $id != null ? $this->m_professores->getProfessores($id) : $this->m_professores->getProfessores();

		// foreach ($users as &$value) {
		// 	$value->data_nascimento = $this->parserlib->formatDate($value->data_nascimento);
		// }

		$infoB['professores'] = $users;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/professores/listar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function novo() {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/professores/criar.php");
		$this->load->view("sistema/common/fim.php");
	}

	function inserir() {
		$data = $_POST;
		if ($this->form_validation->run('cadastro_professores') == FALSE) {
			$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
			$this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Professores/novo");
		}
		
		$this->m_professores->insertProfessor($data);
		return redirect("sistema/Professores");
	}

	function editar($id=null) {
		if (!$id) {
			return redirect("sistema/Professores");
		}

		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$userdata = $this->m_professores->getProfessores(array('id' => $id))[0];

		$infoB['userdata'] = $userdata;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/professores/editar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function atualizar() {
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

		$email_result = $this->m_professores->getProfessores($query_options);

		if (sizeof($email_result) > 0) {
			$errors .= "<p class='error'>O campo E-mail já existe, ele deve ser único.</p>";
		}

		if ($errors != "") {
			$this->session->set_flashdata('errors', $errors);
			// $this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Professores/".$idprofessor);
		}

		unset($data['idref']);
		$this->m_professores->updateProfessor($idprofessor, $data);
		return redirect("sistema/Professores");
	}

}