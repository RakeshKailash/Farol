<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_professores extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getProfessores($opts=array())
	{
		$query = array();
		$query[] = "SELECT * FROM professores";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "idprofessor IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "idprofessor = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "idprofessor NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "idprofessor != {$opts['!id']}";
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

	function insertProfessor($data)
	{
		if (!isset($data) || gettype($data) != "array") {
			return false;
		}

		$query = $this->db->insert("professores", $data);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}

	function updateProfessor($idprofessor, $data)
	{
		if (!isset($idprofessor) || !isset($data) || gettype($data) != "array") {
			return false;
		}

		$this->db->where('idprofessor', $idprofessor);
		$query = $this->db->update('professores', $data);

		if (!$query) {
			return false;
		}

		return $this->getProfessores(array('id' => $idprofessor));
	}

	function deleteProfessor($idprofessor)
	{
		if (!isset($idprofessor)) {
			return false;
		}

		$this->db->where('idprofessor', $idprofessor);
		$query = $this->db->update("professores", array('status' => 0));

		return !!$query;
	}
}