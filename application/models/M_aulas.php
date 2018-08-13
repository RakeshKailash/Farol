<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_aulas extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getAulas($opts=array())
	{
		$query = array();
		$query[] = "SELECT eventos.`idevento`, eventos.`idturma`, eventos.`idprofessor`, eventos.`nome`, eventos.`descricao`, eventos.`status`, professores.`nome` AS nome_professor, professores.`sobrenome` AS sobrenome_professor, turmas.`identificacao` AS nome_turma FROM eventos JOIN professores ON professores.`idprofessor` = eventos.`idprofessor` JOIN turmas ON turmas.`idturma` = eventos.`idturma`";
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

		$where = empty($where) ? "WHERE tipo = 1" : $where." AND tipo = 1";

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

	function insertDiasAulas($data=null)
	{
		if (!isset($data) || gettype($data) != "array") {
			return false;
		}

		$query = $this->db->insert("dias_eventos", $data);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}

	function getDatas()
	{
		$eventos = $this->getDiasEventos();
		$datas = array();
		$inicio = "";
		$fim = "";

		foreach ($eventos as $evento) {
			$inicio = $this->parserlib->dtExtractDate($evento->inicio);
			$fim = $this->parserlib->dtExtractDate($evento->fim);

			$datas[] = $inicio;
			
			if ($inicio != $fim) {
				$datas[] = $fim;
			}
		}

		return (array)$datas;
	}

	function insertAula($data)
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

	function updateAula($idaula, $data)
	{
		if (!isset($idaula) || !isset($data) || gettype($data) != "array") {
			return false;
		}

		$this->db->where('eventos.`idevento`', $idaula);
		$query = $this->db->update('eventos', $data);

		if (!$query) {
			return false;
		}

		return $this->getAulas(array('id' => $idaula));
	}

	function deleteAula($idaula, $completeremove=0)
	{
		if (!isset($idaula)) {
			return false;
		}

		$this->db->where('eventos.`idevento`', $idaula);

		if (!$completeremove) {
			$query = $this->db->update("eventos", array('status' => 0));
		} else {
			$query = $this->db->delete("eventos");
		}

		return !!$query;
	}
}