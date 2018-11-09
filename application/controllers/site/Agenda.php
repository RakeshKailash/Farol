<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("M_config");
		$this->load->model("M_eventos");
		$this->load->model("M_cursos");
		$this->load->model("M_usuarios");
		$this->load->model("M_turmas");
		$this->load->model("M_investimentos");
		$this->load->model("M_inscricoes");
		$this->load->library("Parserlib");
		$this->load->library("Pagseguro");
		$this->load->library("Scripts_loader", "", "sl");
	}

	function index() {
		$loads = $this->M_config->getLoads(1);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB['agenda'] = $this->M_eventos->getAgenda();

		$this->load->view("site/common/topo.php", $infoH);
		$this->load->view("site/agenda.php", $infoB);
		$this->load->view("site/common/fim.php");
	}

	function getTurmaPost($idturma=null)
	{
		if (!$idturma) {
			return null;
		}

		$turma = $this->M_turmas->getTurma(array('id' => $idturma))[0];
		$curso = $this->M_cursos->getCurso(array('id' => $turma->idcurso))[0];
		$investimento = $this->M_investimentos->getInvestimento(array('cwhere' => "idturma = {$idturma}"));

		$retorno = array(
			'turma' => $turma,
			'curso' => $curso,
			'investimento' => $investimento,
			'html' => $this->load->view("sistema/common/investimentos", array('formas_investimento' => $investimento), true)
		);

		echo json_encode($retorno);
		return true;
	}

	function inscrever()
	{
		$retorno = array();

		if (!$this->M_usuarios->isLoggedSite()) {
			$retorno['status'] = 0;
			$retorno['msg'] = "Faça o login para se inscrever";
			echo json_encode($retorno);
			return;
		}

		$data = $_POST;
		$data_insc['idusuario'] = $this->session->idusuario;
		$data_insc['idturma'] = $data['idturma'];

		$this->form_validation->set_data($data_insc);
		if ($this->form_validation->run('inscricoes_site') == FALSE) {
			$retorno['status'] = 0;
			$retorno['msg'] = validation_errors("<p class='error'>", "</p>");
			echo json_encode($retorno);
			return;
		}

		$idinscricao = $this->M_inscricoes->insertInscricao($data_insc);

		if (!$idinscricao) {
			$retorno['status'] = 0;
			$retorno['msg'] = "Erro ao cadastrar a inscrição";
			echo json_encode($retorno);
			return;
		}

		$forma_investimento = $this->M_investimentos->getInvestimento(array('cwhere' => "idturma = {$data['idturma']} AND forma = {$data['forma_investimento']}"))[0];

		$investimento = array(
			'idinscricao' => $idinscricao,
			'idusuario' => $this->session->idusuario,
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
					$retorno['status'] = 0;
					$retorno['msg'] = "Erro ao cadastrar as parcelas do investimento";
					echo json_encode($retorno);
					return;
				}
			}

			if ($data['forma_investimento'] == 3) {
				$result = $this->M_investimentos->insertMensalidades($idinvestimento);
				if (!$result) {
					$retorno['status'] = 0;
					$retorno['msg'] = "Erro ao cadastrar as mensalidades do investimento";
					echo json_encode($retorno);
					return;
				}
			}

			if ($data['forma_investimento'] == 4) {
				$investimento = $this->M_investimentos->getInvestimentoInscricao(array('id' => $idinvestimento))[0];
				$forma_investimento = $this->M_investimentos->getInvestimento(array('id' => $investimento->idforma))[0];
				$turma = $this->M_turmas->getTurma(array('id' => $forma_investimento->idturma))[0];
				$curso = $this->M_cursos->getCurso(array('id' => $turma->idcurso))[0];
				
				$credenciais = $this->M_investimentos->getCredenciaisPagseguro(array('cwhere' => 'ativo = 1'))[0];

				$pagamento = new stdClass();

				$pagamento->investimento = $investimento;
				$pagamento->forma_investimento = $forma_investimento;
				$pagamento->turma = $turma;
				$pagamento->curso = $curso;

				$codigo = $this->pagseguro->submitPayment($pagamento, $credenciais);

				if (!$codigo) {
					$retorno['status'] = 0;
					$retorno['msg'] = "Erro ao comunicar com o PagSeguro";
					echo json_encode($retorno);
					return;
				}

				if (!$this->M_investimentos->insertSolicitacaoPagseguro($idinvestimento, $codigo)) {
					$retorno['status'] = 0;
					$retorno['msg'] = "Erro ao registrar a solicitação";
					echo json_encode($retorno);
					return;
				}

				$retorno['token'] = $codigo;
				$retorno['forma'] = $forma_investimento->forma;
			}
		}

		$retorno['status'] = 1;
		$retorno['msg'] = "Inscrição realizada com sucesso!";
		echo json_encode($retorno);
		return;
	}

	function checkLogin()
	{
		echo $this->M_usuarios->isLoggedSite() ? true : false;
		return;
	}
}