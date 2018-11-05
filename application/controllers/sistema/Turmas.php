<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turmas extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("M_config");
		$this->load->model("M_usuarios");
		$this->load->model("M_turmas");
		$this->load->model("M_uploads");
		$this->load->model("M_professores");
		$this->load->model("M_cursos");
		$this->load->model("M_aulas");
		$this->load->model("M_investimentos");
		$this->load->model("M_inscricoes");
		if (!$this->M_usuarios->isLogged()) {
			return redirect("sistema/login");
		}
	}

	function visualizar ($id=null) {
		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$turmas = isset($id) && $id != null ? $this->M_turmas->getTurma($id) : $this->M_turmas->getTurma();

		foreach ($turmas as $turma) {
			$curso_opts = array('id' => $turma->idcurso);
			$curso = $this->M_cursos->getCurso($curso_opts);
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
		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB['professores'] = $this->M_professores->getProfessores();
		$infoB['cursos'] = $this->M_cursos->getCurso();
		if (isset($_GET['preid'])) {
			$preiddata = array('idcurso' => $_GET['preid']);
			$this->session->set_flashdata('formdata', $preiddata);
		}

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/turmas/criar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function inserir() {
		$data = $_POST;
		$turma = array(
			'idcurso' => $data['idcurso'], 
			'identificacao' => $data['identificacao'],
			'vagas' => $data['vagas'],
			'taxa_inscricao' => $data['taxa_inscricao'],
			'data_limite_inscricao' => $data['data_limite_inscricao'],
			'aula_unica' => isset($data['aula_unica']) ? $data['aula_unica'] : 0,
			'status' => $data['status']
		);
		$investimento = array();

		$this->form_validation->set_data($turma);
		if ($this->form_validation->run('cadastro_turmas') == FALSE) {
			$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
			$this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Turmas/novo");
		}
		
		$turma = $this->prepareData($turma);
		$idturma = $this->M_turmas->insertTurma($turma);

		if (isset($data['forma'])) {
			for ($i=0;$i<count($data['forma']);$i++) {
				if ($data['forma'][$i] == 1) {	
					$investimento = array(
						'forma' => $data['forma'][$i], 
						'total' => $this->parserlib->unformatMoney($data['total'][$i]), 
						'data_vencimento' => $this->parserlib->unformatDate($data['data_vencimento'][$i]), 
						'idturma' => $idturma
					);
				}

				if ($data['forma'][$i] == 2) {	
					$investimento = array(
						'forma' => $data['forma'][$i], 
						'total' => $this->parserlib->unformatMoney($data['total'][$i]), 
						'parcelas' => $data['parcelas'][$i], 
						'valor_parcela' => $this->parserlib->unformatMoney($data['valor_parcela'][$i]),
						'idturma' => $idturma
					);
				}

				if ($data['forma'][$i] == 3) {	
					$investimento = array(
						'forma' => $data['forma'][$i], 
						'total' => $this->parserlib->unformatMoney($data['total'][$i]), 
						'parcelas' => $data['parcelas'][$i], 
						'valor_parcela' => $this->parserlib->unformatMoney($data['valor_parcela'][$i]), 
						'dia_vencimento' => $data['dia_vencimento'][$i], 
						'idturma' => $idturma
					);
				}

				if ($data['forma'][$i] == 4) {	
					$investimento = array(
						'forma' => $data['forma'][$i], 
						'total' => $this->parserlib->unformatMoney($data['total'][$i]), 
						'idturma' => $idturma
					);
				}

				$this->form_validation->reset_validation();
				$this->form_validation->set_data($investimento);
				if ($this->form_validation->run('investimento_'.$data['forma'][$i]) == FALSE) {
					$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
					$this->session->set_flashdata('formdata', $data);
					return redirect("sistema/Turmas/novo");
				}

				if (!$this->M_investimentos->insertInvestimento($investimento)) {
					$this->session->set_flashdata('errors', "<p class='error'>Erro ao registrar as formas de investimento.</p>");
					$this->session->set_flashdata('formdata', $data);
					return redirect("sistema/Turmas/novo");
				}
			}
		}

		if (isset($data['aula_unica']) && !!$data['aula_unica']) {
			$data_aula = array(
				'idprofessor' => $data['idprofessor'], 
				'idturma' => $idturma, 
				'tipo' => '1',
				'nome' => $data['nome'],
				'descricao' => null
			);
			$diasAulas = array();

			$this->form_validation->reset_validation();
			$this->form_validation->set_data($data_aula);

			if ($this->form_validation->run('cadastro_aulas') == FALSE) {
				$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
				$this->session->set_flashdata('formdata', $data);
				return redirect("sistema/Turmas/novo");
			}

			$data_aula['nome'] = $this->parserlib->titleCase($data_aula['nome']);
			$idaula = $this->M_aulas->insertAula($data_aula);

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
						$this->session->set_flashdata('formdata', $data);
						return redirect("sistema/Turmas/novo");
					}

					if (!$this->M_aulas->insertDiasAulas($diasAulas)) {
						$this->session->set_flashdata('errors', "<p class='error'>Erro ao registrar os dias da aula.</p>");
						$this->session->set_flashdata('formdata', $data);
						return redirect("sistema/Turmas/novo");
					}
				}
			}
		}

		return redirect("sistema/Turmas");
	}

	function editar($id=null) {
		if (!$id) {
			return redirect("sistema/Turmas");
		}

		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB['cursos'] = $this->M_cursos->getCurso();

		$opts_query = array('cwhere' => "forma_investimento.`idturma` = {$id}");
		$infoB['investimentos'] = $this->M_investimentos->getInvestimento($opts_query);

		$infoB['aulas'] = $this->M_aulas->getAulas(array('cwhere' => "eventos.`idturma` = {$id}"));
		
		$infoB['inscricoes'] = $this->M_inscricoes->getInscricao(array('cwhere' => "inscricoes.`idturma` = {$id} AND inscricoes.`status` = 2"));

		$infoB['materiais'] = $this->M_uploads->getMateriais(array('cwhere' => "material_turma.`idturma` = {$id}"));

		$userdata = $this->M_turmas->getTurma(array('id' => $id))[0];
		$infoB['userdata'] = $userdata;

		if (!$userdata->status_reg) {
			return redirect("sistema/Turmas");
		}

		$userdata->data_limite_inscricao = $this->parserlib->formatDate($userdata->data_limite_inscricao);
		
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
		$data = $this->prepareData($data);
		$this->M_turmas->updateTurma($idturma, $data);
		return redirect("sistema/Turmas");
	}

	function excluir($id=null)
	{
		if (!$id) {
			return redirect("sistema/Turmas");
		}

		$this->M_turmas->deleteTurma($id);
		$aulas = $this->M_aulas->getAulas(array(
			'cwhere' => "eventos.`idturma` = {$id}"
		));

		foreach ($aulas as $aula) {
			$this->M_aulas->deleteAula($aula->idevento);
		}

		return redirect("sistema/Turmas");
	}

	function prepareData($data=null)
	{
		if (!$data) {
			return null;
		}

		$data['identificacao'] = $this->parserlib->mb_ucfirst($data['identificacao']);
		$data['data_limite_inscricao'] = $this->parserlib->unformatDate($data['data_limite_inscricao']);
		return $data;
	}

	function addMaterial($idturma=null, $idupload=null)
	{
		if (!$idturma || !$idupload) {
			echo false;
			return;
		}

		if (!$this->M_turmas->addMaterial($idturma, $idupload)) {
			echo false;
			return;
		}

		echo true;
		return;
	}

}