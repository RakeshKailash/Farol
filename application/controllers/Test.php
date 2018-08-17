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
		// $test = $this->m_eventos->getEventos();

		// foreach ($test as &$rec) {
		// 	$rec->dias = $this->m_dias_eventos->getDiasEventos
		// }
		// echo "<pre>";
		// var_dump($test);
		// echo "</pre>";


		echo "<pre>";
		var_dump($this->m_eventos->getAgenda());
		echo "</pre>";
		
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