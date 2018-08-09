<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dias_eventos extends CI_Model {
	function __construct() {
		parent::__construct();
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

	function insertEvento($data)
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

	function updateEvento($id, $data)
	{
		if (!isset($id) || !isset($data) || gettype($data) != "array") {
			return false;
		}

		$this->db->where('id', $id);
		$query = $this->db->update('dias_eventos', $data);

		if (!$query) {
			return false;
		}

		return $this->getDiasEventos(array('id' => $id));
	}

	function deleteEvento($id, $completeremove=0)
	{
		if (!isset($id)) {
			return false;
		}

		$this->db->where('id', $iddiaevento);

		if (!$completeremove) {
			$query = $this->db->update("dias_eventos", array('status' => 0));
		} else {
			$query = $this->db->delete("dias_eventos");
		}

		return !!$query;
	}
}