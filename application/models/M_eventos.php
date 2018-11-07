<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_eventos extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getEventos($opts=array())
	{
		$query = array();
		$query[] = "SELECT eventos.`idevento`, eventos.`idturma`, eventos.`idprofessor`, eventos.`nome`, eventos.`descricao`, eventos.`status`, eventos.`tipo`, turmas.`data_limite_inscricao`, professores.`nome` AS nome_professor, turmas.`identificacao` AS nome_turma, turmas.`status` AS status_turma FROM eventos LEFT JOIN professores ON professores.`idprofessor` = eventos.`idprofessor` LEFT JOIN turmas ON turmas.`idturma` = eventos.`idturma` LEFT JOIN dias_eventos ON (dias_eventos.`idevento` = eventos.`idevento` AND dias_eventos.`inicio`= ( SELECT MIN(inicio) FROM dias_eventos WHERE dias_eventos.`idevento` = eventos.`idevento`))";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "eventos.`idevento` IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "eventos.`idevento` = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "eventos.`idevento` NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "eventos.`idevento` != {$opts['!id']}";
			}

			$where = $where != null ? $where." AND ".$cond : "WHERE ".$cond;
		}

		if (isset($opts['cwhere'])) {
			$cond = $opts['cwhere'];
			$where = $where != null ? $where." AND ".$cond : "WHERE ".$cond;
		}

		$query[] = $where;

		if (isset($opts['groupby'])) {
			$query[] = "GROUP BY {$opts['groupby']}";
		}

		if (isset($opts['orderby'])) {
			$query[] = "ORDER BY {$opts['orderby']}";
		} else {
			$query[] = "ORDER BY eventos.`idevento` ASC";
		}

		if (isset($opts['limit'])) {
			$query[] = "LIMIT {$opts['limit']}";
		}

		$query = implode(" ", $query);
		$result = $this->db->query($query);

		if (!$result) {
			return false;
		}

		$aulas = $result->result();

		foreach ($aulas as &$aula) {
			$opts_query = array(
				'cwhere' => "dias_eventos.`idevento` = {$aula->idevento}",
				'orderby' => "inicio ASC"
			);
			$query = $this->getDiasEventos($opts_query);
			if (!!$query) {
				foreach ($query as $dia) {
					$dia->inicio = $this->parserlib->formatDatetime($dia->inicio);
					$dia->fim = $this->parserlib->formatDatetime($dia->fim);
				}
				$aula->dias = $query;
			}
		}

		return $aulas;
		
	}

	function getDiasEventos($opts=array())
	{
		$query = array();
		$query[] = "SELECT * FROM dias_eventos";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "id IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "id = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "id NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "id != {$opts['!id']}";
			}

			$where = $where != null ? $where." AND ".$cond : "WHERE ".$cond;
		}

		if (isset($opts['cwhere'])) {
			$cond = $opts['cwhere'];
			$where = $where != null ? $where." AND ".$cond : "WHERE ".$cond;
		}

		$query[] = $where;

		if (isset($opts['groupby'])) {
			$query[] = "GROUP BY {$opts['groupby']}";
		}

		if (isset($opts['orderby'])) {
			$query[] = "ORDER BY {$opts['orderby']}";
		}

		if (isset($opts['limit'])) {
			$query[] = "LIMIT {$opts['limit']}";
		}

		$query = implode(" ", $query);
		$result = $this->db->query($query);

		if (!$result) {
			return false;
		}

		return $result->result();
	}

	function getDescricaoAula($idturma=null)
	{
		if (!$idturma) {
			return false;
		}

		$this->db->where('idturma', $idturma);
		$result = $this->db->get("turmas");

		if (!$result) {
			return false;
		}

		$turma = $result->result()[0];
		$this->db->where('idcurso', $turma->idcurso);
		$result = $this->db->get("cursos");

		if (!$result) {
			return false;
		}

		$curso = $result->result()[0];
		$descricao = "";

		if ($turma->identificacao != null) {
			return $curso->nome . " - Turma " . $turma->identificacao;
		}

		return $curso->nome;
	}

	function getAgenda($opts=array())
	{
		$eventos = $this->getEventos($opts);
		if (!sizeof($eventos)) {
			return $eventos;
		}
		$eventos = $this->orderAgenda($eventos);
		$agenda = array();


		foreach ($eventos as &$evento) {
			if (isset($evento->dias[0])) {
				$ano = $this->parserlib->dtGetPortion("y", $evento->dias[0]->inicio);
				$mes = $this->parserlib->dtGetPortion("m", $evento->dias[0]->inicio);
				if (!array_key_exists($ano, $agenda)) {
					$agenda[$ano] = array();
				}

				if (!array_key_exists($mes, $agenda[$ano])) {
					$agenda[$ano][$mes] = array();
				}
				
				$agenda[$ano][$mes][] = $evento;
			}

			if ($evento->tipo == 1) {
				$descricao = $this->getDescricaoAula($evento->idturma);

				if ($evento->nome != null) {
					$descricao .= " | ".$evento->nome;
				}

				$evento->nome = $descricao;
			}

			$status = null;
			$evento->aceitar_matriculas = 0;
			
			if ($this->isFirstClass($evento->idevento) == false) {
				if ($evento->status_turma == 1) {
					$status = " ";
				}

				if ($evento->status_turma == 2 && date('Y-m-d') > $evento->data_limite_inscricao) {
					$status = "Em curso";
				} else {
					$status = " ";
				}
			}

			if ($evento->status_turma == 1 && $status == null) {
				$status = "Aguarde";
			}

			if ($evento->status_turma == 2 && $status == null) {
				if (date('Y-m-d') > $evento->data_limite_inscricao) {
					$status = "Em curso";
				} else {
					$status = $this->parserlib->formatDate($evento->data_limite_inscricao);
					// $evento->nome = "<b>".$evento->nome."</b>";
					$evento->aceitar_matriculas = 1;
				}
			}

			if ($evento->status_turma == 3 && $status == "") {
				$status = "Encerrado";
			}

			$evento->inscricao_status = $status;

		}

		return $agenda;
	}

	function orderAgenda($eventos=array())
	{
		if (!$eventos) {
			return false;
		}

		$inicio_a = "";
		$inicio_b = "";

		uksort($eventos, function($a, $b) use ($eventos) {
			$inicio_a = $eventos[$a]->dias[0]->inicio;
			$inicio_b = $eventos[$b]->dias[0]->inicio;

			$inicio_a = $this->parserlib->dtExtractDate($this->parserlib->unformatDatetime($inicio_a));
			$inicio_b = $this->parserlib->dtExtractDate($this->parserlib->unformatDatetime($inicio_b));
			if ($inicio_a > $inicio_b) {
				return 1;
			}
			if ($inicio_a < $inicio_b) {
				return -1;
			}
			if ($inicio_a == $inicio_b) {
				return 0;
			}
		});

		return $eventos;
	}

	function isFirstClass($idevento=null)
	{
		if (!$idevento) {
			return false;
		}

		$aula = $this->getEventos(array('id' => $idevento))[0];
		$primeira_aula = $this->getEventos(array('cwhere' => "eventos.`idturma` = {$aula->idturma}", 'orderby' => 'idevento ASC', 'limit' => 1))[0];
		if ($aula->idevento == $primeira_aula->idevento) {
			return true;
		}

		return false;
	}

	function insertEvento($data)
	{
		if (!isset($data) || gettype($data) != "array") {
			return false;
		}

		$query = $this->db->insert("eventos", $data);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}

	function updateEvento($idevento, $data)
	{
		if (!isset($idevento) || !isset($data) || gettype($data) != "array") {
			return false;
		}

		$this->db->where('idevento', $idevento);
		$query = $this->db->update('eventos', $data);

		if (!$query) {
			return false;
		}

		return $this->getEventos(array('id' => $idevento));
	}

	function deleteEvento($idevento, $completeremove=0)
	{
		if (!isset($idevento)) {
			return false;
		}

		$this->db->where('idevento', $idevento);

		if (!$completeremove) {
			$query = $this->db->update("eventos", array('status' => 0));
		} else {
			$query = $this->db->delete("eventos");
		}

		return !!$query;
	}
}