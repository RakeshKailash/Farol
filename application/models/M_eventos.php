<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_eventos extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getEventos($opts=array())
	{
		$query = array();
		$query[] = "SELECT * FROM eventos";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "idevento IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "idevento = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "idevento NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "idevento != {$opts['!id']}";
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