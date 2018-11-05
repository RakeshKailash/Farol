<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aulas extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("M_config");
		$this->load->model("M_usuarios");
		$this->load->model("M_aulas");
		$this->load->model("M_turmas");
		$this->load->model("M_cursos");
		$this->load->model("M_professores");
		if (!$this->M_usuarios->isLogged()) {
			return redirect("sistema/login");
		}
	}

	function visualizar ($id=null) {
		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$opts_aula = array(
			'orderby' => "idevento ASC"
		);

		if (isset($id) && $id != null) {
			$opts_aula['id'] = $id;
		}

		$aulas = $this->M_aulas->getAulas($opts_aula);

		// foreach ($users as &$value) {
		// 	$value->data_nascimento = $this->parserlib->formatDate($value->data_nascimento);
		// }

		$infoB['aulas'] = $aulas;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/aulas/listar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function novo() {
		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB['professores'] = $this->M_professores->getProfessores();
		$opts_turmas = array('cwhere' => "turmas.status != 3");
		$infoB['turmas'] = $this->M_turmas->getTurma($opts_turmas);
		if (isset($_GET['preid'])) {
			$preiddata = array('idturma' => $_GET['preid']);
			$this->session->set_flashdata('formdata', $preiddata);
		}

		foreach ($infoB['turmas'] as &$turma) {
			$idcurso = $turma->idcurso;
			$curso = $this->M_cursos->getCurso(array('id' => $idcurso))[0];
			$turma->nome_curso = $curso->nome;
		}

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/aulas/criar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function inserir() {
		$data = $_POST;
		$aula = array(
			'idprofessor' => $data['idprofessor'], 
			'idturma' => $data['idturma'], 
			'tipo' => '1',
			'nome' => $data['nome'],
			'descricao' => $data['descricao']
		);
		$diasAulas = array();

		if ($this->form_validation->run('cadastro_aulas') == FALSE) {
			$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
			$this->session->set_flashdata('formdata', $aula);
			return redirect("sistema/Aulas/novo");
		}
		
		$aula = $this->prepareData($aula);
		$idaula = $this->M_aulas->insertAula($aula);

		if (isset($data['data_inicio'])) {
			for ($i=0;$i<count($data['data_inicio']);$i++) {
				$inicio = $data['data_inicio'][$i].", ".$data['hora_inicio'][$i]."h";
				$fim = $data['data_inicio'][$i].", ".$data['hora_fim'][$i]."h";
				$almoco_inicio = $data['data_inicio'][$i].", ".$data['almoco_inicio'][$i]."h";
				$almoco_fim = $data['data_inicio'][$i].", ".$data['almoco_fim'][$i]."h";
				$diasAulas = array(
					'idevento' => $idaula,
					'inicio' => $this->parserlib->unformatDatetime($inicio),
					'fim' => $this->parserlib->unformatDatetime($fim),
					'almoco_inicio' => $data['almoco_inicio'][$i] != "" ? $this->parserlib->unformatDatetime($almoco_inicio) : null,
					'almoco_fim' => $data['almoco_inicio'][$i] != "" ? $this->parserlib->unformatDatetime($almoco_fim) : null
				);

				$this->form_validation->reset_validation();
				$this->form_validation->set_data($diasAulas);

				if ($this->form_validation->run('dias_aulas') == FALSE) {
					$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
					$this->session->set_flashdata('formdata', $aula);
					return redirect("sistema/Aulas/novo");
				}

				if (!$this->M_aulas->insertDiasAulas($diasAulas)) {
					$this->session->set_flashdata('errors', "<p class='error'>Erro ao registrar os dias da aula.</p>");
					$this->session->set_flashdata('formdata', $aula);
					return redirect("sistema/Aulas/novo");
				}
			}
		}

		return redirect("sistema/Aulas");
	}

	function editar($id=null) {
		if (!$id) {
			return redirect("sistema/Aulas");
		}

		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$userdata = $this->M_aulas->getAulas(array('id' => $id))[0];

		$infoB['userdata'] = $userdata;
		$infoB['professores'] = $this->M_professores->getProfessores();
		$opts_turmas = array('cwhere' => "turmas.status != 3");
		// $infoB['dias_aulas'] = $this->M_aulas->getAulas($opts_turmas);
		$infoB['turmas'] = $this->M_turmas->getTurma($opts_turmas);

		foreach ($infoB['turmas'] as &$turma) {
			$idcurso = $turma->idcurso;
			$curso = $this->M_cursos->getCurso(array('id' => $idcurso))[0];
			$turma->nome_curso = $curso->nome;
		}
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/aulas/editar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function atualizar() {
		$data = $_POST;
		$idaula = $this->input->post("idref");
		$errors = "";

		if ($this->form_validation->run('atualizacao_aulas') == FALSE) {
			$errors = validation_errors("<p class='error'>", "</p>");
		}

		$query_options = array(
			'!id' => $idaula,
			'cwhere' => "email = '{$data['email']}'"
		);

		$email_result = $this->M_aulas->getAulas($query_options);

		if (sizeof($email_result) > 0) {
			$errors .= "<p class='error'>O campo E-mail já existe, ele deve ser único.</p>";
		}

		if ($errors != "") {
			$this->session->set_flashdata('errors', $errors);
			// $this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Aulas/".$idaula);
		}

		unset($data['idref']);
		$data = $this->prepareData($data);
		$this->M_aulas->updateAula($idaula, $data);
		return redirect("sistema/Aulas");
	}

	function get_datas()
	{
		$datas = $this->M_aulas->getDatas();
		echo json_encode($datas);
		return;
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