<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_investimentos extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getInvestimento($opts=array())
	{
		$query = array();
		$query[] = "SELECT * FROM forma_investimento";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "idinvestimento IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "idinvestimento = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "idinvestimento NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "idinvestimento != {$opts['!id']}";
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

	function getInvestimentoInscricao($opts=array())
	{
		$query = array();
		$query[] = "SELECT * FROM investimentos_inscricoes";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "idinvestimento IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "idinvestimento = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "idinvestimento NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "idinvestimento != {$opts['!id']}";
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

		$investimentos = $result->result();

		foreach ($investimentos as &$investimento) {
			$investimento->forma = $this->getInvestimento(array('id' => "{$investimento->idforma}"))[0];

			if ($investimento->forma->forma == 2) {
				$investimento->forma->parcelas = $this->getParcelas(array('cwhere' => "idinvestimento = {$investimento->idinvestimento}"));
			}
		}

		return $investimentos;
	}

	function getParcelas($opts=array())
	{
		$query = array();
		$query[] = "SELECT * FROM parcelas_investimentos";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "idparcela IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "idparcela = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "idparcela NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "idparcela != {$opts['!id']}";
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

	function insertInvestimento($data)
	{
		if (!isset($data) || gettype($data) != "array") {
			return false;
		}

		$query = $this->db->insert("forma_investimento", $data);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}

	function updateInvestimento($idinvestimento, $data)
	{
		if (!isset($idinvestimento) || !isset($data) || gettype($data) != "array") {
			return false;
		}

		$this->db->where('idinvestimento', $idinvestimento);
		$query = $this->db->update('investimentos', $data);

		if (!$query) {
			return false;
		}

		return $this->getInvestimentos(array('id' => $idinvestimento));
	}

	function deleteInvestimento($idinvestimento, $completeremove=0)
	{
		if (!isset($idinvestimento)) {
			return false;
		}

		$this->db->where('idinvestimento', $idinvestimento);

		if (!$completeremove) {
			$query = $this->db->update("forma_investimento", array('status' => 0));
		} else {
			$query = $this->db->delete("forma_investimento");
		}

		return !!$query;
	}

	function insertInvestimentoInscricao($investimento)
	{
		if (!isset($investimento)) {
			return false;
		}

		// $investimento = array(
		// 	'idinscricao' => $data['idinscricao'],
		// 	'idusuario' => $data['idusuario'],
		// 	'idforma' => $forma_investimento->idinvestimento
		// );

		$query = $this->db->insert("investimentos_inscricoes", $investimento);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}

	function insertParcelas($idinvestimento, $qnt_parcelas)
	{
		if (!isset($idinvestimento) || !isset($qnt_parcelas)) {
			return false;
		}

		$info_parcela = array();
		$investimento = $this->getInvestimentoInscricao(array('id' => $idinvestimento))[0];
		$forma_investimento = $this->getInvestimento(array('id' => $investimento->idforma))[0];
		$parcelamento_completo = $this->parserlib->getParcelamento($forma_investimento);
		$parcelas_inserir = array();

		for($i=0;$i<$qnt_parcelas;$i++) {
			$parcelas_inserir[] = array(
				'idinvestimento' => $investimento->idinvestimento,
				'valor' => $parcelamento_completo[(string)$qnt_parcelas]->valor_comum
			);
		}


		$parcelas_inserir[0]['valor'] = $parcelamento_completo[(string)$qnt_parcelas]->valor_diferente;
		$query = $this->db->insert_batch('parcelas_investimentos', $parcelas_inserir);

		return !!$query;
	}
}