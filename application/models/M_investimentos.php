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

		$query = $this->db->insert("invstimentos_inscricoes", $investimento);

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

		$investimento = $this->getInvestimentos(array('id' => $idinvestimento))[0];

		$parcelamento = $this->getParcelamento($investimento);
	}
}