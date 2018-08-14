<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turmas extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_config");
		$this->load->model("m_usuarios");
		$this->load->model("m_turmas");
		$this->load->model("m_cursos");
		$this->load->model("m_aulas");
		$this->load->model("m_investimentos");
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
		$turma = array(
			'idcurso' => $data['idcurso'], 
			'identificacao' => $data['identificacao'],
			'vagas' => $data['vagas'],
			'taxa_inscricao' => $data['taxa_inscricao'],
			'data_limite_inscricao' => $data['data_limite_inscricao']
		);
		$investimento = array();

		if ($this->form_validation->run('cadastro_turmas') == FALSE) {
			$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
			$this->session->set_flashdata('formdata', $turma);
			return redirect("sistema/Turmas/novo");
		}
		
		$turma = $this->prepareData($turma);
		$idturma = $this->m_turmas->insertTurma($turma);

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
						'dia_vencimento' => $data['dia_vencimento'][$i], 
						'idturma' => $idturma
					);
				}

				if ($data['forma'][$i] == 3) {	
					$investimento = array(
						'forma' => $data['forma'][$i], 
						'total' => $this->parserlib->unformatMoney($data['total'][$i]), 
						'idturma' => $idturma
					);
				}

				if ($this->form_validation->run('investimento_'.$data['forma'][$i]) == FALSE) {
					$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
					$this->session->set_flashdata('formdata', $turma);
					return redirect("sistema/Turmas/novo");
				}

				if (!$this->m_investimentos->insertInvestimento($investimento)) {
					$this->session->set_flashdata('errors', "<p class='error'>Erro ao registrar as formas de investimento.</p>");
					$this->session->set_flashdata('formdata', $turma);
					return redirect("sistema/Turmas/novo");
				}
			}
		}

		return redirect("sistema/Turmas");
	}

	function editar($id=null) {
		if (!$id) {
			return redirect("sistema/Turmas");
		}

		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB['cursos'] = $this->m_cursos->getCurso();

		$opts_query = array('cwhere' => "forma_investimento.`idturma` = {$id}");
		$infoB['investimentos'] = $this->m_investimentos->getInvestimento($opts_query);

		$infoB['aulas'] = $this->m_aulas->getAulas(array('cwhere' => "eventos.`idturma` = {$id}"));

		$userdata = $this->m_turmas->getTurma(array('id' => $id))[0];

		$infoB['userdata'] = $userdata;

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
		$this->m_turmas->updateTurma($idturma, $data);
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

}