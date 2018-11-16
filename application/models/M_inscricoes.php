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
		cursos.`nome` AS nome_curso,
		usuarios.`nome` AS nome_usuario 
		FROM
		inscricoes 
		LEFT JOIN eventos 
		ON eventos.`idevento` = inscricoes.`idevento` 
		JOIN turmas 
		ON turmas.`idturma` = inscricoes.`idturma` 
		JOIN usuarios 
		ON usuarios.`idusuario` = inscricoes.`idusuario`
		JOIN cursos
		ON cursos.`idcurso` = turmas.`idcurso`";
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
		} else {
			$query[] = "ORDER BY inscricoes.`idinscricao` ASC";
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

	function getTurmasAluno($idaluno=null)
	{
		if (!$idaluno) {
			return null;
		}

		$lista_ids = array();

		$inscricoes_aluno = $this->getInscricao(array(
			"cwhere" => "inscricoes.`idusuario` = {$idaluno} AND inscricoes.`status` != 3"
		));

		return $inscricoes_aluno;
	}

	function insertHistoricoInscricao($data)
	{
		if (!isset($data) || gettype($data) != "array") {
			return false;
		}

		$query = $this->db->insert("historico_inscricoes", $data);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}

	// function getInvestimentoInscricao($opts=array())
	// {
	// 	$query = array();
	// 	$query[] = "SELECT 
	// 	invin.`idinvestimento`,
	// 	invin.`idinscricao`,
	// 	invin.`idusuario`,
	// 	invin.`idforma`,
	// 	invin.`data_cadastro`,
	// 	invin.`parcelas`,
	// 	forminv.`idturma`,
	// 	forminv.`total`,
	// 	forminv.`dia_vencimento`,
	// 	forminv.`data_vencimento`,
	// 	forminv.`tipo`
	// 	FROM investimentos_inscricoes AS invin
	// 	JOIN forma_investimento AS forminv
	// 	ON forminv.`idinvestimento` = invin.`idforma`";
	// 	$where = null;
	// 	$cond = null;

	// 	if (isset($opts['id'])) {
	// 		if (gettype($opts['id']) == "array") {
	// 			$cond = "invin.`idinscricao` IN (".implode(",", $opts['id']).")";
	// 		} else {
	// 			$cond = "invin.`idinscricao` = {$opts['id']}";
	// 		}
	// 		$where = "WHERE ".$cond;
	// 	}

	// 	if (isset($opts['!id'])) {
	// 		if (gettype($opts['!id']) == "array") {
	// 			$cond = "invin.`idinscricao` NOT IN (".implode(",", $opts['!id']).")";
	// 		} else {
	// 			$cond = "invin.`idinscricao` != {$opts['!id']}";
	// 		}

	// 		$where = $where != null ? $where." AND ".$cond : "WHERE ".$cond;
	// 	}

	// 	if (isset($opts['cwhere'])) {
	// 		$cond = $opts['cwhere'];
	// 		$where = $where != null ? $where." AND ".$cond : "WHERE ".$cond;
	// 	}

	// 	$query[] = $where;

	// 	if (isset($opts['groupby'])) {
	// 		$query[] = "GROUP BY {$opts['groupby']}";
	// 	}

	// 	if (isset($opts['orderby'])) {
	// 		$query[] = "ORDER BY {$opts['orderby']}";
	// 	}

	// 	if (isset($opts['limit'])) {
	// 		$query[] = "LIMIT {$opts['limit']}";
	// 	}

	// 	$query = implode(" ", $query);
	// 	$result = $this->db->query($query);

	// 	if (!$result) {
	// 		return false;
	// 	}

	// 	$retorno = $result->result();

	// 	foreach ($retorno as $inv) {
	// 		if ($inv->)
	// 	}

	// 	return $retorno;
	// }
}