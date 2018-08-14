<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_usuarios extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function getUsuario($opts=array())
	{
		$query = array();
		$query[] = "SELECT * FROM usuarios";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "idusuario IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "idusuario = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "idusuario NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "idusuario != {$opts['!id']}";
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

	function insertUsuario($data)
	{
		if (!isset($data) || gettype($data) != "array") {
			return false;
		}

		$data['senha'] = $this->hash_password($data['senha']);

		$query = $this->db->insert("usuarios", $data);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}

	function updateUsuario($idusuario, $data)
	{
		if (!isset($idusuario) || !isset($data) || gettype($data) != "array") {
			return false;
		}

		if (isset($data['senha'])) {
			$data['senha'] = $this->hash_password($data['senha']);
		}

		$this->db->where('idusuario', $idusuario);
		$query = $this->db->update('usuarios', $data);

		if (!$query) {
			return false;
		}

		return $this->getUsuario(array('id' => $idusuario));
	}

	function deleteUsuario($idusuario, $completeremove=0)
	{
		if (!isset($idusuario)) {
			return false;
		}

		$this->db->where('idusuario', $idusuario);

		if (!$completeremove) {
			$query = $this->db->update("usuarios", array('status' => 0));
		} else {
			$query = $this->db->delete("usuarios");
		}

		return !!$query;
	}

	function isLogged()
	{
		$user_logged = $this->session->userdata();
		if ((isset($user_logged['cpf']) && $user_logged['cpf'] != null) || (isset($user_logged['email']) && $user_logged['email'] != null) ) {
			return true;
		}

		return false;
	}

	function logUser($login=null, $password=null)
	{
		if (!$password || !$login) {
			return false;
		}

		$userauth = $this->authUser($login, $password);

		if ($userauth == false) {
			return false;
		}

		$userdata = array(
			'idusuario' => $userauth->idusuario,
			'nome' => $userauth->nome,
			'data_nascimento' => $userauth->data_nascimento,
			'email' => $userauth->email,
			'cpf' => $userauth->cpf
		);

		$this->session->set_userdata($userdata);
		return true;
	}

	function logout()
	{
		session_destroy();
	}

	private function authUser ($login, $password)
	{
		if (! $login || !$password)
		{
			return 0;
		}


		$query_options = array(
			'cwhere' => "(cpf = '{$login}' OR email = '{$login}') AND acesso > 2"
		);

		$query = $this->getUsuario($query_options);

		if (!$query) {
			return false;
		}

		$user_info =  isset($query[0]->login) || isset($query[0]->email) ? $query[0] : null;

		if (! $user_info)
		{
			return false;
		}

		$verify = password_verify($password, $user_info->senha);

		if (!$verify) {
			return false;
		}

		return $user_info;
	}

	public function createUser ($userData=null)
	{
		if (! $userData) {
			return false;
		}

		if (! $userData['senha']) {
			return false;
		}

		$userData['senha'] = $this->hash_password($userData['senha']);

		if (!$this->db->insert('usuarios', $userData)) {
			return false;
		}

		return $this->db->insert_id();
	}

	private function hash_password ($password)
	{
		if (! $password) {
			return false;
		}

		$hashed_pass = password_hash($password, PASSWORD_BCRYPT);
		return $hashed_pass;
	}
}