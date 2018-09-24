<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_turmas extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getTurma($opts=array())
	{
		$query = array();
		$query[] = "SELECT * FROM turmas";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "turmas.`idturma` IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "turmas.`idturma` = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "turmas.`idturma` NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "turmas.`idturma` != {$opts['!id']}";
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

	function insertTurma($data)
	{
		if (!isset($data) || gettype($data) != "array") {
			return false;
		}

		$query = $this->db->insert("turmas", $data);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}

	function updateTurma($idturma, $data)
	{
		if (!isset($idturma) || !isset($data) || gettype($data) != "array") {
			return false;
		}

		$this->db->where('idturma', $idturma);
		$query = $this->db->update('turmas', $data);

		if (!$query) {
			return false;
		}

		return $this->getTurmas(array('id' => $idturma));
	}

	function deleteTurma($idturma, $completeremove=0)
	{
		if (!isset($idturma)) {
			return false;
		}

		$this->db->where('idturma', $idturma);

		if (!$completeremove) {
			$query = $this->db->update("turmas", array('status' => 0));
		} else {
			$query = $this->db->delete("turmas");
		}

		return !!$query;
	}

	function addMaterial($idturma=null, $idupload=null)
	{
		if (!$idturma || !$idupload) {
			return false;
		}

		$data = array(
			'idupload' => $idupload,
			'idturma' => $idturma,
			'idusuario' => $this->session->idusuario
		);

		$query = $this->db->insert("material_turma", $data);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}
}