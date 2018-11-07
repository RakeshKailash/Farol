<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cursos extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getCurso($opts=array())
	{
		$query = array();
		$query[] = "SELECT * FROM cursos";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "idcurso IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "idcurso = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "idcurso NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "idcurso != {$opts['!id']}";
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
			$query[] = "ORDER BY cursos.`idcurso` ASC";
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

	function insertCurso($data)
	{
		if (!isset($data) || gettype($data) != "array") {
			return false;
		}

		$query = $this->db->insert("cursos", $data);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}

	function updateCurso($idcurso, $data)
	{
		if (!isset($idcurso) || !isset($data) || gettype($data) != "array") {
			return false;
		}

		$this->db->where('idcurso', $idcurso);
		$query = $this->db->update('cursos', $data);

		if (!$query) {
			return false;
		}

		return $this->getCurso(array('id' => $idcurso));
	}

	function deleteCurso($idcurso, $completeremove=0)
	{
		if (!isset($idcurso)) {
			return false;
		}

		$this->db->where('idcurso', $idcurso);

		if (!$completeremove) {
			$query = $this->db->update("cursos", array('status' => 0));
		} else {
			$query = $this->db->delete("cursos");
		}

		return !!$query;
	}
}