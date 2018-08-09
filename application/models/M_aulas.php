<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_aulas extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getAulas($opts=array())
	{
		$query = array();
		$query[] = "SELECT aulas.`idaula`, aulas.`idturma`, aulas.`idprofessor`, aulas.`descricao`, aulas.`status`, professores.`nome` AS nome_professor, professores.`sobrenome` AS sobrenome_professor, turmas.`identificacao` AS nome_turma FROM aulas JOIN professores ON professores.`idprofessor` = aulas.`idprofessor` JOIN turmas ON turmas.`idturma` = aulas.`idturma`";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "aulas.`idaula` IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "aulas.`idaula` = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "aulas.`idaula` NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "aulas.`idaula` != {$opts['!id']}";
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

		$aulas = $result->result();

		foreach ($aulas as &$aula) {
			$opts_query = array(
				'cwhere' => "dias_eventos.`idaula` = {$aula->idaula}",
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

		$query = $this->db->insert("aulas", $data);

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

		$this->db->where('aulas.`idaula`', $idaula);
		$query = $this->db->update('aulas', $data);

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

		$this->db->where('aulas.`idaula`', $idaula);

		if (!$completeremove) {
			$query = $this->db->update("aulas", array('status' => 0));
		} else {
			$query = $this->db->delete("aulas");
		}

		return !!$query;
	}
}