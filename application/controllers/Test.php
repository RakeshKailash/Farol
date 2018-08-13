<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_dias_eventos");
		$this->load->model("m_aulas");
		$this->load->model("m_turmas");
		$this->load->model("m_eventos");
		$this->load->library("Parserlib");
		$this->load->library("Scripts_loader", "", "sl");
	}

	function index() {
		// $turma = $this->m_turmas->getTurma(array('id' => 8))[0];
		// $aula = $this->m_aulas->getAulas(array('cwhere' => "idturma = {$turma->idturma}", 'limit' => 1))[0];
		// $idaula = $aula->idaula;
		// $dias = $this->m_dias_eventos->getDiasEventos(array('cwhere' => "idaula = {$idaula}", 'orderby' => 'inicio ASC'));

		// $test = array('turma' => $turma, 'aula' => $aula, 'dias' => $dias);

		// foreach ($test['dias'] as &$dia) {
		// 	$dia->inicio = $this->parserlib->formatDatetime($dia->inicio);
		// 	$dia->fim = $this->parserlib->formatDatetime($dia->fim);
		// }
		$test = $this->m_eventos->getEventos();
		echo "<pre>";
		var_dump($test);
		echo "</pre>";
		
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