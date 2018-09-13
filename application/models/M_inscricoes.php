<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_inscricoes extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getInscricao($opts=array())
	{
		$query = array();
		$query[] = "SELECT 
		inscricoes.`idinscricao`,
		inscricoes.`idevento`,
		inscricoes.`idturma`,
		inscricoes.`idusuario`,
		inscricoes.`data_ingresso`,
		inscricoes.`opcao`,
		inscricoes.`status`,
		eventos.`nome` AS nome_evento,
		turmas.`identificacao` AS nome_turma,
		turmas.`idcurso`,
		usuarios.`nome` AS nome_usuario 
		FROM
		inscricoes 
		LEFT JOIN eventos 
		ON eventos.`idevento` = inscricoes.`idevento` 
		JOIN turmas 
		ON turmas.`idturma` = inscricoes.`idturma` 
		JOIN usuarios 
		ON usuarios.`idusuario` = inscricoes.`idusuario` ";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "inscricoes.`idinscricao` IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "inscricoes.`idinscricao` = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "inscricoes.`idinscricao` NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "inscricoes.`idinscricao` != {$opts['!id']}";
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

	function insertInscricao($data)
	{
		if (!isset($data) || gettype($data) != "array") {
			return false;
		}

		$query = $this->db->insert("inscricoes", $data);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}

	function updateInscricao($idinscricao, $data)
	{
		if (!isset($idinscricao) || !isset($data) || gettype($data) != "array") {
			return false;
		}

		$this->db->where('inscricoes.`idinscricao`', $idinscricao);
		$query = $this->db->update('inscricoes', $data);

		if (!$query) {
			return false;
		}

		return $this->getInscricao(array('id' => $idinscricao));
	}

	function deleteInscricao($idinscricao, $completeremove=0)
	{
		if (!isset($idinscricao)) {
			return false;
		}

		$this->db->where('inscricoes.`idinscricao`', $idinscricao);

		if (!$completeremove) {
			$query = $this->db->update("inscricoes", array('status' => 0));
		} else {
			$query = $this->db->delete("inscricoes");
		}

		return !!$query;
	}

	function getTurmasInscritas($idaluno=null)
	{
		if (!$idaluno) {
			return null;
		}

		$lista_ids = array();

		$inscricoes_aluno = $this->getInscricao(array(
			"cwhere" => "inscricoes.`idusuario` = {$idaluno} AND inscricoes.`status` = 2"
		));

		foreach ($inscricoes_aluno as $insc) {
			$lista_ids[] = $insc->idturma;	
		}

		return $lista_ids;
	}
}