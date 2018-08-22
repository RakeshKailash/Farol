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
		// if (isset($_GET['preid'])) {
		// 	$preiddata = array('idcurso' => $_GET['preid']);
		// 	$this->session->set_flashdata('formdata', $preiddata);
		// }

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

		// if (isset($data['forma'])) {
		// 	for ($i=0;$i<count($data['forma']);$i++) {
		// 		if ($data['forma'][$i] == 1) {	
		// 			$investimento = array(
		// 				'forma' => $data['forma'][$i], 
		// 				'total' => $this->parserlib->unformatMoney($data['total'][$i]), 
		// 				'data_vencimento' => $this->parserlib->unformatDate($data['data_vencimento'][$i]), 
		// 				'idinscricao' => $idinscricao
		// 			);
		// 		}

		// 		if ($data['forma'][$i] == 2) {	
		// 			$investimento = array(
		// 				'forma' => $data['forma'][$i], 
		// 				'total' => $this->parserlib->unformatMoney($data['total'][$i]), 
		// 				'parcelas' => $data['parcelas'][$i], 
		// 				'valor_parcela' => $this->parserlib->unformatMoney($data['valor_parcela'][$i]),
		// 				'idinscricao' => $idinscricao
		// 			);
		// 		}

		// 		if ($data['forma'][$i] == 3) {	
		// 			$investimento = array(
		// 				'forma' => $data['forma'][$i], 
		// 				'total' => $this->parserlib->unformatMoney($data['total'][$i]), 
		// 				'parcelas' => $data['parcelas'][$i], 
		// 				'valor_parcela' => $this->parserlib->unformatMoney($data['valor_parcela'][$i]), 
		// 				'dia_vencimento' => $data['dia_vencimento'][$i], 
		// 				'idinscricao' => $idinscricao
		// 			);
		// 		}

		// 		if ($data['forma'][$i] == 4) {	
		// 			$investimento = array(
		// 				'forma' => $data['forma'][$i], 
		// 				'total' => $this->parserlib->unformatMoney($data['total'][$i]), 
		// 				'idinscricao' => $idinscricao
		// 			);
		// 		}

		// 		$this->form_validation->reset_validation();
		// 		$this->form_validation->set_data($investimento);
		// 		if ($this->form_validation->run('investimento_'.$data['forma'][$i]) == FALSE) {
		// 			$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
		// 			$this->session->set_flashdata('formdata', $data);
		// 			return redirect("sistema/Inscricoes/novo");
		// 		}

		// 		if (!$this->m_investimentos->insertInvestimento($investimento)) {
		// 			$this->session->set_flashdata('errors', "<p class='error'>Erro ao registrar as formas de investimento.</p>");
		// 			$this->session->set_flashdata('formdata', $data);
		// 			return redirect("sistema/Inscricoes/novo");
		// 		}
		// 	}
		// }

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
		$infoB['cursos'] = $this->m_cursos->getCurso();

		$userdata = $this->m_inscricoes->getInscricao(array('id' => $id))[0];

		$infoB['userdata'] = $userdata;

		$userdata->data_limite_inscricao = $this->parserlib->formatDate($userdata->data_limite_inscricao);
		
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

	function getInvestimento($idturma=null)
	{
		if (!$idturma) {
			echo null;
			return;
		}

		$investimentos = $this->m_investimentos->getInvestimento(array('cwhere' => "forma_investimento.`idturma` = {$idturma}"));

		foreach ($investimentos as &$investimento) {
			$investimento->total = $this->parserlib->formatMoney($investimento->total);
			$investimento->valor_parcela = $this->parserlib->formatMoney($investimento->valor_parcela);
			$investimento->data_vencimento = $this->parserlib->formatDate($investimento->data_vencimento);
		}

		echo json_encode($investimentos);
		return true;
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