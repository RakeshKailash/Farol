<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_dias_eventos");
		$this->load->model("m_aulas");
		$this->load->model("m_turmas");
		$this->load->model("m_eventos");
		$this->load->model("m_investimentos");
		$this->load->model("m_inscricoes");
		$this->load->library("Parserlib");
		$this->load->library("Scripts_loader", "", "sl");
	}

	function index() {
		$inscricao = $this->m_inscricoes->getInscricao(array('id' => "11"))[0];
		$infoB['userdata'] = $inscricao;
		$infoB['userdata']->investimento = $this->m_investimentos->getInvestimentoInscricao(array('cwhere' => "idinscricao = {$inscricao->idinscricao}"))[0];
		echo "<pre>";
		var_dump($infoB['userdata']);
		echo "</pre>";
		die;
		
	}

	function seleciona()
	{
		$resultados = mysqli_query(mysqli_connect("localhost", "root", "", "farolterapeutico"),"SELECT SUM(valor) AS debito, SUM(vlrPago) AS pago, (SUM(valor)-SUM(vlrPago)) AS devedor FROM financeiro2017 WHERE alunoId = 620");
		while ($row = $resultados->fetch_object()){
			echo "<pre>";
			var_dump($row);
			echo "</pre>";
		}
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
		echo "<pre>";
		var_dump($investimentos);
		echo "</pre>";
		return true;
	}

	function td()
	{
		$idevento = 19;
		$aula = $this->m_eventos->getEventos(array('id' => $idevento))[0];
		$primeira_aula = $this->m_eventos->getEventos(array('cwhere' => "eventos.`idturma` = {$aula->idturma}", 'orderby' => 'idevento ASC', 'limit' => 1))[0];
		if ($aula->idevento == $primeira_aula->idevento) {
			echo 1;
			return;
		}

		echo 0;
	}

	function orderResults($results=array())
	{
		uksort($final_array, function($a, $b) use ($final_array) {
			if ($final_array[$a]['descricao'] > $final_array[$b]['descricao']) {
				return 1;
			}
			if ($final_array[$a]['descricao'] < $final_array[$b]['descricao']) {
				return -1;
			}
			if ($final_array[$a]['descricao'] == $final_array[$b]['descricao']) {
				return 0;
			}
		});
	}
}