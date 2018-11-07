<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professores extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("M_config");
		$this->load->model("M_usuarios");
		$this->load->model("M_professores");
		$this->load->model("M_uploads");
		if (!$this->M_usuarios->isLogged()) {
			return redirect("sistema/login");
		}
	}

	function visualizar () {
		if (!$this->M_permissoes->checkPermission("professores", "visualizar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para visualizar professores.</p>");
			return redirect("sistema");
		}

		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$professores = $this->M_professores->getProfessores();

		// foreach ($users as &$value) {
		// 	$value->data_nascimento = $this->parserlib->formatDate($value->data_nascimento);
		// }

		$infoB['professores'] = $professores;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/professores/listar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function novo() {
		if (!$this->M_permissoes->checkPermission("professores", "criar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para criar professores.</p>");
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
		if (!$this->M_permissoes->checkPermission("professores", "criar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para criar professores.</p>");
			return redirect("sistema");
		}

		$data = $_POST;
		if ($this->form_validation->run('cadastro_professores') == FALSE) {
			$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
			$this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Professores/novo");
		}
		
		$data = $this->prepareData($data);
		$idprofessor = $this->M_professores->insertProfessor($data);

		if (! empty($_FILES) && !!$idprofessor) {
			if (! $this->M_uploads->uploadTeacherPicture("imagem_professor", "equipe", $idprofessor)) {
				$this->session->set_flashdata('errors', "<p class='error'>Erro ao registrar a imagem.</p>");
				return redirect("sistema/Professores");
			}
		}

		return redirect("sistema/Professores");
	}

	function editar($id=null) {
		if (!$this->M_permissoes->checkPermission("professores", "editar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para editar professores.</p>");
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
		if (!$this->M_permissoes->checkPermission("professores", "editar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para editar professores.</p>");
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
		$data = $this->prepareData($data);
		$this->M_professores->updateProfessor($idprofessor, $data);

		if (! empty($_FILES) && !!$idprofessor) {
			if (! $this->M_uploads->uploadTeacherPicture("imagem_professor", "equipe", $idprofessor)) {
				$this->session->set_flashdata('errors', "<p class='error'>Erro ao registrar a imagem.</p>");
				return redirect("sistema/Professores");
			}
		}

		return redirect("sistema/Professores");
	}

	function excluir($id=null) {
		if (!$this->M_permissoes->checkPermission("professores", "excluir")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para excluir professores.</p>");
			return redirect("sistema");
		}

		if (!$id) {
			return redirect("sistema/Professores");
		}

		$this->M_professores->deleteProfessor($id);
		return redirect("sistema/Professores");
	}

	function prepareData($data=null)
	{
		if (!$data) {
			return null;
		}

		$data['nome'] = $this->parserlib->titleCase($data['nome']);
		$data['email'] = mb_strtolower($data['email']);
		$data['whatsapp'] = $this->parserlib->removeNumMasks($data['whatsapp']);
		$data['fone_1'] = $this->parserlib->removeNumMasks($data['fone_1']);
		$data['fone_2'] = $this->parserlib->removeNumMasks($data['fone_2']);
		$data['fone_3'] = $this->parserlib->removeNumMasks($data['fone_3']);
		return $data;
	}

}