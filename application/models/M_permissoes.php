<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_permissoes extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->defineModulos();
		$this->defineAcoes();
	}

	function getPermissao($opts=array())
	{
		$query = array();
		$query[] = "SELECT 
		permissoes.`idpermissao`,
		permissoes.`idusuario`,
		permissoes.`idmoduloacao`,
		usuarios.`nome` AS usuario 
		FROM
		permissoes 
		JOIN usuarios 
		ON usuarios.`idusuario` = permissoes.`idusuario`";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "idpermissao IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "idpermissao = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "idpermissao NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "idpermissao != {$opts['!id']}";
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

		$permissoes = $result->result();

		foreach ($permissoes as &$permissao) {
			$moduloacao = $this->getModuloAcao(array('id' => $permissao->idmoduloacao))[0];
			$permissao->moduloacao = $moduloacao;
		}

		return $permissoes;
	}

	function getModulo($opts=array())
	{
		$query = array();
		$query[] = "SELECT * FROM modulos";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "idmodulo IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "idmodulo = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "idmodulo NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "idmodulo != {$opts['!id']}";
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

	function getAcao($opts=array())
	{
		$query = array();
		$query[] = "SELECT * FROM acoes";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "idacao IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "idacao = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "idacao NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "idacao != {$opts['!id']}";
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

	function getModuloAcao($opts=array())
	{
		$query = array();
		$query[] = "SELECT 
		modulo_acao.`idmoduloacao`,
		modulo_acao.`idmodulo`,
		modulo_acao.`idacao`,
		modulos.`descricao` AS modulo,
		acoes.`descricao` AS acao 
		FROM
		modulo_acao 
		JOIN modulos 
		ON modulos.`idmodulo` = modulo_acao.`idmodulo` 
		JOIN acoes 
		ON acoes.`idacao` = modulo_acao.`idacao`";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "idmoduloacao IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "idmoduloacao = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "idmoduloacao NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "idmoduloacao != {$opts['!id']}";
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

	function getListaPermissoes()
	{
		$modulos = $this->getModulo();
		$result = array();

		foreach ($modulos as $modulo) {
			$moduloacoes = $this->getModuloAcao(array('cwhere' => "modulo_acao.`idmodulo` = {$modulo->idmodulo}"));
			$modulo->mod_acoes = $moduloacoes;
			$result[$modulo->idmodulo] = $modulo;
		}

		return $result;
	}

	function insertPermissao($data)
	{
		if (!isset($data) || gettype($data) != "array") {
			return false;
		}

		$query = $this->db->insert("permissoes", $data);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}


	function setPermissoes($idusuario=null, $lista=array())
	{
		if (!$idusuario || !count($lista)) {
			return false;
		}

		if (isset($lista['negados']) && !!sizeof($lista['negados'])) {
			$sql = "DELETE 
			FROM
			permissoes 
			WHERE idusuario = {$idusuario} 
			AND idmoduloacao IN (".implode(",", $lista['negados']).")";

			$result = $this->db->query($sql);
			if (!$result) {
				return false;
			}
		}

		if (isset($lista['permitidos']) && !!sizeof($lista['permitidos'])) {
			foreach ($lista['permitidos'] as $idmodacao) {
				$registros = $this->getPermissao(array('cwhere' => "permissoes.`idusuario` = {$idusuario} AND permissoes.`idmoduloacao` = {$idmodacao}"));
				if (count($registros) <= 0) {
					$data_insert = array(
						'idusuario' => $idusuario,
						'idmoduloacao' => $idmodacao
					);

					$result = $this->insertPermissao($data_insert);

					if (!$result) {
						return false;
					}
				}
			}
		}

		return true;
	}

	function setSessionPermissoes()
	{
		$permissoes_usuario = $this->M_permissoes->getPermissao(array('cwhere' => "permissoes.`idusuario` = {$this->session->idusuario}"));
		$permissoes = array();

		foreach ($permissoes_usuario as $permissao) {
			$modacao = $this->getModuloAcao(array('id' => $permissao->idmoduloacao))[0];
			$permissoes[$modacao->idmodulo][$modacao->idacao] = true;
		}

		$_SESSION['permissoes'] = $permissoes;
	}

	// function updatePermissao($idpermissao, $data)
	// {
	// 	if (!isset($idpermissao) || !isset($data) || gettype($data) != "array") {
	// 		return false;
	// 	}

	// 	$this->db->where('idpermissao', $idpermissao);
	// 	$query = $this->db->update('permissoes', $data);

	// 	if (!$query) {
	// 		return false;
	// 	}

	// 	return $this->getPermissao(array('id' => $idpermissao));
	// }

	function deletePermissao($idpermissao)
	{
		if (!isset($idpermissao)) {
			return false;
		}

		$this->db->where('idpermissao', $idpermissao);
		$query = $this->db->delete("permissoes");

		return !!$query;
	}


	function checkPermission($modulo=null, $acao=null)
	{
		if (!$modulo || !$acao) {
			return false;
		}

		return !!(isset($_SESSION['permissoes'][constant('MD_'.strtoupper($modulo))][constant('AC_'.strtoupper($acao))]));
	}

	private function defineModulos()
	{
		$this->db->select("idmodulo, descricao");
		$this->db->from("modulos");
		$modulos = $this->db->get()->result();

		foreach ($modulos as $modulo) {
			define('MD_'.strtoupper($modulo->descricao), $modulo->idmodulo);
		}
	}

	private function defineAcoes()
	{
		$this->db->select("idacao, descricao");
		$this->db->from("acoes");
		$acoes = $this->db->get()->result();

		foreach ($acoes as $acao) {
			define('AC_'.strtoupper($acao->descricao), $acao->idacao);
		}
	}
}