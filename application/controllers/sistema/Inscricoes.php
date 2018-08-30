<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscricoes extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model("m_config");
		$this->load->model("m_usuarios");
		$this->load->model("m_inscricoes");
		$this->load->model("m_professores");
		$this->load->model("m_cursos");
		$this->load->model("m_turmas");
		$this->load->model("m_aulas");
		$this->load->model("m_investimentos");
		if (!$this->m_usuarios->isLogged()) {
			return redirect("sistema/login");
		}
	}

	function visualizar ($id=null)
	{
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$inscricoes = isset($id) && $id != null ? $this->m_inscricoes->getInscricao($id) : $this->m_inscricoes->getInscricao();

		foreach ($inscricoes as $inscricao) {
			$curso_opts = array('id' => $inscricao->idcurso);
			$curso = $this->m_cursos->getCurso($curso_opts);
			if ($curso != null) {
				$inscricao->nome_curso = $curso[0]->nome;
			}
		}

		$infoB['inscricoes'] = $inscricoes;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/inscricoes/listar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function novo()
	{
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB['turmas'] = $this->m_turmas->getTurma();
		$infoB['cursos'] = $this->m_cursos->getCurso();
		$infoB['usuarios'] = $this->m_usuarios->getUsuario(array('cwhere' => 'acesso > 1'));

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/inscricoes/criar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function inserir()
	{
		$data = $_POST;
		$inscricao = array(
			'idevento' => null,
			'idusuario' => $data['idusuario'],
			'idturma' => $data['idturma']
		);
		$investimento = array();

		$this->form_validation->set_data($inscricao);
		if ($this->form_validation->run('cadastro_inscricoes') == FALSE) {
			$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
			$this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Inscricoes/novo");
		}
		
		// $inscricao = $this->prepareData($inscricao);
		$idinscricao = $this->m_inscricoes->insertInscricao($inscricao);

		return redirect("sistema/Inscricoes/investimento/".$idinscricao);
	}

	function investimento($idinscricao=null)
	{
		if (!$idinscricao) {
			return redirect("sistema/Inscricoes");
		}

		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$inscricao = $this->m_inscricoes->getInscricao(array('id' => $idinscricao))[0];
		$inscricao->curso = $this->m_cursos->getCurso(array('id' => $inscricao->idcurso))[0];
		$infoB['inscricao'] = $inscricao;
		$infoB['formas_investimento'] = $this->getInvestimento($inscricao->idturma);

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/inscricoes/investimento.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function inserir_investimento()
	{
		if (!isset($_POST['idinscricao'])) {
			return redirect("sistema/Inscricoes");
		}

		$data = $_POST;
		$forma_investimento = $this->m_investimentos->getInvestimento(array('cwhere' => "idturma = {$data['idturma']} AND forma = {$data['forma_investimento']}"))[0];

		$investimento = array(
			'idinscricao' => $data['idinscricao'],
			'idusuario' => $data['idusuario'],
			'idforma' => $forma_investimento->idinvestimento
		);

		if ($data['forma_investimento'] == 2) {
			$investimento['parcelas'] = $data['qnt_parcelas'];
		}

		$idinvestimento = $this->m_investimentos->insertInvestimentoInscricao($investimento);

		if (!!$idinvestimento) {
			if ($data['forma_investimento'] == 2) {
				$result = $this->m_investimentos->insertParcelas($idinvestimento, $data['qnt_parcelas']);
				if (!$result) {
					$this->session->set_flashdata('errors', "<p class='error'>Erro ao cadastrar as parcelas do investimento.</p>");
					return redirect("sistema/Inscricoes");
				}
			}
		}

		return redirect("sistema/Inscricoes");
	}

	function editar($id=null)
	{
		if (!$id) {
			return redirect("sistema/Inscricoes");
		}

		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$inscricao = $this->m_inscricoes->getInscricao(array('id' => "{$id}"))[0];
		$inscricao->curso = $this->m_cursos->getCurso(array('id' => $inscricao->idcurso))[0];
		$infoB['userdata'] = $inscricao;
		$infoB['userdata']->investimento = $this->m_investimentos->getInvestimentoInscricao(array('cwhere' => "idinscricao = {$inscricao->idinscricao}"))[0];

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/inscricoes/editar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function atualizar()
	{
		$data = $_POST;
		$idinscricao = $this->input->post("idref");
		$errors = "";

		if ($this->form_validation->run('cadastro_inscricoes') == FALSE) {
			$errors = validation_errors("<p class='error'>", "</p>");
		}

		if ($errors != "") {
			$this->session->set_flashdata('errors', $errors);
			// $this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Inscricoes/".$idinscricao);
		}

		unset($data['idref']);
		$data = $this->prepareData($data);
		$this->m_inscricoes->updateInscricao($idinscricao, $data);
		return redirect("sistema/Inscricoes");
	}

	private function getInvestimento($idturma=null)
	{
		if (!$idturma) {
			return null;
		}

		$investimentos = $this->m_investimentos->getInvestimento(array('cwhere' => "forma_investimento.`idturma` = {$idturma}"));

		return $investimentos;
	}

	function prepareData($data=null)
	{
		// if (!$data) {
		// 	return null;
		// }

		// $data['identificacao'] = $this->parserlib->mb_ucfirst($data['identificacao']);
		// $data['data_limite_inscricao'] = $this->parserlib->unformatDate($data['data_limite_inscricao']);
		// return $data;
	}

}