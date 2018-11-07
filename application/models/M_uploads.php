<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_uploads extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function insertUpload($data)
	{
		if (!isset($data) || gettype($data) != "array") {
			return false;
		}

		$query = $this->db->insert("material_upload", $data);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}

	public function insertTeacherPicture($data)
	{
		if (!isset($data) || gettype($data) != "array") {
			return false;
		}

		$query = $this->db->insert("imagens_professores", $data);

		if (!$query) {
			return false;
		}

		return $this->db->insert_id();
	}

	public function caminho_pasta () {
		return str_replace('\\', DIRECTORY_SEPARATOR, FCPATH);
	}

	public function uploadFile ($campo=null, $pasta=null, $info=array())
	{
		if (! $campo || ! $pasta || ! count($info)) {
			return false;
		}

		$path = "uploads/".$pasta;
		$idsInsert = array();
		$insertid = "";

		if (!is_dir($path))
		{
			mkdir($path);
		}

		$config_upload['upload_path'] = $this->caminho_pasta().$path;
		$config_upload['allowed_types'] = 'pdf|doc|txt|xls|csv';
		$config_upload['max_size'] = '0';
		$config_upload['max_width'] = '0';
		$config_upload['max_height'] = '0';
		$config_upload['encrypt_name'] = false;

		$this->load->library('upload', $config_upload);

		if (gettype($_FILES[$campo]['name']) == "array" && gettype($_FILES[$campo]['name']) == "object") {
			$count = count($_FILES[$campo]['name']);
		} else {
			$count = 1;
		}


		if ($count <= 0) {
			return array("ABC");
		}

		for ($i = 0; $i < $count; $i++) {
			if (gettype($_FILES[$campo]['name']) == "array" && gettype($_FILES[$campo]['name']) == "object") {
				$_FILES['arquivo_up']['name'] = $_FILES[$campo]['name'][$i];
				$_FILES['arquivo_up']['type'] = $_FILES[$campo]['type'][$i];
				$_FILES['arquivo_up']['tmp_name'] = $_FILES[$campo]['tmp_name'][$i];
				$_FILES['arquivo_up']['error'] = $_FILES[$campo]['error'][$i];
				$_FILES['arquivo_up']['size'] = $_FILES[$campo]['size'][$i];
			} else {
				$_FILES['arquivo_up']['name'] = $_FILES[$campo]['name'];
				$_FILES['arquivo_up']['type'] = $_FILES[$campo]['type'];
				$_FILES['arquivo_up']['tmp_name'] = $_FILES[$campo]['tmp_name'];
				$_FILES['arquivo_up']['error'] = $_FILES[$campo]['error'];
				$_FILES['arquivo_up']['size'] = $_FILES[$campo]['size'];
			}

			if (! $this->upload->do_upload('arquivo_up')) {
				throw new Exception($this->upload->display_errors());
				return false;
			}

			$info_file = $this->upload->data();

			$file['titulo'] = $info['titulo'];
			$file['autor'] = $info['autor'];
			$file['idusuario'] = $this->session->idusuario;
			$file['caminho_arquivo'] = $path.'/'.$info_file['file_name'];
			$file['tamanho'] = $info_file['file_size'];
			$file['hash'] = md5_file(RAIZ.$file['caminho_arquivo']);

			$insertid = $this->insertUpload($file);

			if (! $insertid)
			{
				return false;
			}

			array_push($idsInsert, $insertid);
		}

		return $idsInsert;
	}

	public function getUploads($opts=array())
	{
		$query = array();
		$query[] = "SELECT 
		material_upload.`idupload`,
		material_upload.`titulo`,
		material_upload.`autor`,
		material_upload.`data_upload`,
		material_upload.`idusuario`,
		material_upload.`caminho_arquivo`,
		material_upload.`tamanho`,
		material_upload.`hash`,
		usuarios.`nome` AS nome_usuario
		FROM material_upload
		JOIN usuarios ON usuarios.`idusuario` = material_upload.`idusuario`";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "idupload IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "idupload = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "idupload NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "idupload != {$opts['!id']}";
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
			$query[] = "ORDER BY material_upload.`idupload` ASC";
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

	public function getMateriais($opts=array())
	{
		$query = array();
		$query[] = "SELECT 
		material_turma.`idmaterial`,
		material_turma.`idupload`,
		material_turma.`idturma`,
		material_turma.`idusuario`,
		material_turma.`data`,
		material_upload.`titulo`,
		material_upload.`autor`,
		material_upload.`caminho_arquivo`,
		usuarios.`nome` AS nome_usuario 
		FROM
		material_turma 
		JOIN material_upload 
		ON material_upload.`idupload` = material_turma.`idupload` 
		JOIN usuarios 
		ON usuarios.`idusuario` = material_turma.`idusuario`";
		$where = null;
		$cond = null;

		if (isset($opts['id'])) {
			if (gettype($opts['id']) == "array") {
				$cond = "idmaterial IN (".implode(",", $opts['id']).")";
			} else {
				$cond = "idmaterial = {$opts['id']}";
			}
			$where = "WHERE ".$cond;
		}

		if (isset($opts['!id'])) {
			if (gettype($opts['!id']) == "array") {
				$cond = "idmaterial NOT IN (".implode(",", $opts['!id']).")";
			} else {
				$cond = "idmaterial != {$opts['!id']}";
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
			$query[] = "ORDER BY material_turma.`idmaterial` ASC";
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

	public function updateUpload($idup=null, $data=array())
	{
		if (!$idup || !count($data)) {
			return false;
		}

		$this->db->where('material_upload.`idupload`', $idup);
		$query = $this->db->update('material_upload', $data);

		if (!$query) {
			return false;
		}

		return $this->getUploads(array('id' => $idup));
	}

	public function uploadTeacherPicture ($campo=null, $pasta=null, $idprofessor=null)
	{
		if (! $campo || ! $pasta || ! $idprofessor) {
			return false;
		}

		$path = "uploads/".$pasta;
		$idsInsert = array();
		$insertid = "";

		if (!is_dir($path))
		{
			mkdir($path);
		}

		$config_upload['upload_path'] = $this->caminho_pasta().$path;
		$config_upload['allowed_types'] = 'jpg|jpeg|png';
		$config_upload['max_size'] = '0';
		$config_upload['max_width'] = '0';
		$config_upload['max_height'] = '0';
		$config_upload['encrypt_name'] = false;

		$this->load->library('upload', $config_upload);

		if (gettype($_FILES[$campo]['name']) == "array" && gettype($_FILES[$campo]['name']) == "object") {
			$count = count($_FILES[$campo]['name']);
		} else {
			$count = 1;
		}


		if ($count <= 0) {
			return array("ABC");
		}

		for ($i = 0; $i < $count; $i++) {
			if (gettype($_FILES[$campo]['name']) == "array" && gettype($_FILES[$campo]['name']) == "object") {
				$_FILES['arquivo_up']['name'] = $_FILES[$campo]['name'][$i];
				$_FILES['arquivo_up']['type'] = $_FILES[$campo]['type'][$i];
				$_FILES['arquivo_up']['tmp_name'] = $_FILES[$campo]['tmp_name'][$i];
				$_FILES['arquivo_up']['error'] = $_FILES[$campo]['error'][$i];
				$_FILES['arquivo_up']['size'] = $_FILES[$campo]['size'][$i];
			} else {
				$_FILES['arquivo_up']['name'] = $_FILES[$campo]['name'];
				$_FILES['arquivo_up']['type'] = $_FILES[$campo]['type'];
				$_FILES['arquivo_up']['tmp_name'] = $_FILES[$campo]['tmp_name'];
				$_FILES['arquivo_up']['error'] = $_FILES[$campo]['error'];
				$_FILES['arquivo_up']['size'] = $_FILES[$campo]['size'];
			}

			if (! $this->upload->do_upload('arquivo_up')) {
				throw new Exception($this->upload->display_errors());
				return false;
			}

			$info_pic = $this->upload->data();

			$file['idprofessor'] = $idprofessor;
			$file['caminho_arquivo'] = $path.'/'.$info_pic['file_name'];

			$insertid = $this->insertTeacherPicture($file);

			if (! $insertid)
			{
				return false;
			}

			array_push($idsInsert, $insertid);
		}

		return $idsInsert;
	}

}