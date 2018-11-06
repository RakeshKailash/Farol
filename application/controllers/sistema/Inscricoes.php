<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inscricoes extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model("M_config");
		$this->load->model("M_usuarios");
		$this->load->model("M_inscricoes");
		$this->load->model("M_professores");
		$this->load->model("M_cursos");
		$this->load->model("M_turmas");
		$this->load->model("M_aulas");
		$this->load->model("M_investimentos");
		if (!$this->M_usuarios->isLogged()) {
			return redirect("sistema/login");
		}
	}

	function visualizar ($id=null)
	{
		if (!$this->M_permissoes->checkPermission("inscricoes", "visualizar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para visualizar inscrições.</p>");
			return redirect("sistema");
		}

		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$inscricoes = isset($id) && $id != null ? $this->M_inscricoes->getInscricao($id) : $this->M_inscricoes->getInscricao();

		foreach ($inscricoes as $inscricao) {
			$curso_opts = array('id' => $inscricao->idcurso);
			$curso = $this->M_cursos->getCurso($curso_opts);
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
		if (!$this->M_permissoes->checkPermission("inscricoes", "criar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para criar inscrições.</p>");
			return redirect("sistema");
		}

		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB['turmas'] = $this->M_turmas->getTurma();
		$infoB['cursos'] = $this->M_cursos->getCurso();
		$infoB['usuarios'] = $this->M_usuarios->getUsuario(array('cwhere' => 'acesso > 1'));

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/inscricoes/criar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function inserir()
	{
		if (!$this->M_permissoes->checkPermission("inscricoes", "criar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para criar inscrições.</p>");
			return redirect("sistema");
		}

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
		$idinscricao = $this->M_inscricoes->insertInscricao($inscricao);

		return redirect("sistema/Inscricoes/investimento/".$idinscricao);
	}

	function investimento($idinscricao=null)
	{
		if (!$this->M_permissoes->checkPermission("inscricoes", "editar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para editar inscrições.</p>");
			return redirect("sistema");
		}

		if (!$idinscricao) {
			return redirect("sistema/Inscricoes");
		}

		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$inscricao = $this->M_inscricoes->getInscricao(array('id' => $idinscricao))[0];
		$inscricao->curso = $this->M_cursos->getCurso(array('id' => $inscricao->idcurso))[0];
		$infoB['inscricao'] = $inscricao;
		$infoB['formas_investimento'] = $this->getInvestimento($inscricao->idturma);

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/inscricoes/investimento.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function inserir_investimento()
	{
		if (!$this->M_permissoes->checkPermission("inscricoes", "editar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para editar inscrições.</p>");
			return redirect("sistema");
		}

		if (!isset($_POST['idinscricao'])) {
			return redirect("sistema/Inscricoes");
		}

		$data = $_POST;
		$forma_investimento = $this->M_investimentos->getInvestimento(array('cwhere' => "idturma = {$data['idturma']} AND forma = {$data['forma_investimento']}"))[0];

		$investimento = array(
			'idinscricao' => $data['idinscricao'],
			'idusuario' => $data['idusuario'],
			'idforma' => $forma_investimento->idinvestimento
		);

		if ($data['forma_investimento'] == 2 || $data['forma_investimento'] == 3) {
			$investimento['parcelas'] = $data['qnt_parcelas'];
		}

		$idinvestimento = $this->M_investimentos->insertInvestimentoInscricao($investimento);

		if (!!$idinvestimento) {
			if ($data['forma_investimento'] == 2) {
				$result = $this->M_investimentos->insertParcelas($idinvestimento, $data['qnt_parcelas']);
				if (!$result) {
					$this->session->set_flashdata('errors', "<p class='error'>Erro ao cadastrar as parcelas do investimento.</p>");
					return redirect("sistema/Inscricoes");
				}
			}

			if ($data['forma_investimento'] == 3) {
				$result = $this->M_investimentos->insertMensalidades($idinvestimento);
				if (!$result) {
					$this->session->set_flashdata('errors', "<p class='error'>Erro ao cadastrar as mensalidades do investimento.</p>");
					return redirect("sistema/Inscricoes");
				}
			}
		}

		return redirect("sistema/Inscricoes");
	}

	function editar($id=null)
	{
		if (!$this->M_permissoes->checkPermission("inscricoes", "editar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para editar inscrições.</p>");
			return redirect("sistema");
		}

		if (!$id) {
			return redirect("sistema/Inscricoes");
		}

		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$inscricao = $this->M_inscricoes->getInscricao(array('id' => "{$id}"))[0];
		$inscricao->curso = $this->M_cursos->getCurso(array('id' => $inscricao->idcurso))[0];
		$infoB['userdata'] = $inscricao;
		$infoB['userdata']->investimento = $this->M_investimentos->getInvestimentoInscricao(array('cwhere' => "idinscricao = {$inscricao->idinscricao}"))[0];

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/inscricoes/editar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function atualizar()
	{
		if (!$this->M_permissoes->checkPermission("inscricoes", "editar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para editar inscrições.</p>");
			return redirect("sistema");
		}

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
		$this->M_inscricoes->updateInscricao($idinscricao, $data);
		return redirect("sistema/Inscricoes");
	}

	private function getInvestimento($idturma=null)
	{
		if (!$this->M_permissoes->checkPermission("inscricoes", "visualizar")) {
			$this->session->set_flashdata('errors', "<p>Você não tem permissão para visualizar inscrições.</p>");
			return redirect("sistema");
		}

		if (!$idturma) {
			return null;
		}

		$investimentos = $this->M_investimentos->getInvestimento(array('cwhere' => "forma_investimento.`idturma` = {$idturma}"));

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