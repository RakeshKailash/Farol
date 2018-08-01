<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_alunos extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getAluno($opts=array())
	{
		$query = array();
		$query[] = "SELECT * FROM alunos";

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$query[] = "WHERE idaluno IN (".implode(",", $opts['id']).")";
			} else {
				$query[] = "WHERE idaluno = {$opts['id']}";
			}
		}

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

	function insertAluno($data)
	{
		if (!isset($data) || gettype($data) != "array") {
			return false;
		}

		$query = $this->db->insert("alunos", $data);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}

	function updateAluno($idaluno, $data)
	{
		if (!isset($idaluno) || !isset($data) || gettype($data) != "array") {
			return false;
		}

		$this->db->where('idaluno', $idaluno);
		$query = $this->db->update('alunos', $data);

		if (!$query) {
			return false;
		}

		return $this->getAluno(array('id' => $idaluno));
	}

	function deleteAluno($idaluno, $completeremove=0)
	{
		if (!isset($idaluno)) {
			return false;
		}

		$this->db->where('idaluno', $idaluno);

		if (!$completeremove) {
			$query = $this->db->update("alunos", array('status' => 0));
		} else {
			$query = $this->db->delete("alunos");
		}

		return !!$query;
	}
}