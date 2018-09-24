<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biblioteca extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_config");
		$this->load->model("m_usuarios");
		// $this->load->model("m_aulas");
		$this->load->model("m_turmas");
		$this->load->model("m_cursos");
		// $this->load->model("m_professores");
		$this->load->model("m_uploads");
		if (!$this->m_usuarios->isLogged()) {
			return redirect("sistema/login");
		}
	}

	function visualizar ($id=null) {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$opts_biblio = array(
			'orderby' => "idupload ASC"
		);

		if (isset($id) && $id != null) {
			$opts_biblio['id'] = $id;
		}

		$materiais = $this->m_uploads->getUploads($opts_biblio);

		// foreach ($users as &$value) {
		// 	$value->data_nascimento = $this->parserlib->formatDate($value->data_nascimento);
		// }

		$infoB['materiais'] = $materiais;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/biblioteca/listar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function novo() {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/biblioteca/criar.php");
		$this->load->view("sistema/common/fim.php");
	}

	function upload($field=null)
	{
		if (!$field || !isset($_POST)) {
			return redirect("sistema/Turmas");
		}

		$data = $_POST;

		$this->form_validation->set_data($data);
		if ($this->form_validation->run('upload_material') == FALSE) {
			$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
			$this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Biblioteca/novo");
		}

		$material_info = array(
			'titulo' => $data['titulo'],
			'autor' => $data['autor']
		);

		$subir = $this->m_uploads->uploadFile($field, "material", $material_info);

		if (!$subir) {
			$this->session->set_flashdata('errors', "<p class='error'>Erro ao carregar o arquivo selecionado</p>");
			$this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Biblioteca/novo");
		}

		return redirect("sistema/Biblioteca");
	}

	function editar($id=null) {
		if (!$id) {
			return redirect("sistema/Biblioteca");
		}

		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$userdata = $this->m_uploads->getUploads(array('id' => $id))[0];

		$infoB['userdata'] = $userdata;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/biblioteca/editar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function atualizar() {
		$data = $_POST;
		$idup = $this->input->post("idref");
		$errors = "";

		if ($this->form_validation->run('atualizacao_material') == FALSE) {
			$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
			return redirect("sistema/Biblioteca/".$idup);
		}

		$insert_data = array(
			'autor' => $data['autor'],
			'titulo' => $data['titulo']
		);

		$this->m_uploads->updateUpload($idup, $insert_data);
		return redirect("sistema/Biblioteca");
	}

	function download($idup=null) {
		if (!$idup) {
			return redirect("sistema/Biblioteca");
		}

		$userdata = $this->m_uploads->getUploads(array('id' => $idup))[0];
		if (!$userdata) {
			$this->session->set_flashdata('errors', "<p class='error'>Erro ao localizar o arquivo para download</p>");
			return redirect("sistema/Biblioteca/".$idup);
		}

		$nome = preg_replace("~^.*\/(.*)$~", "$1", $userdata->caminho_arquivo);
		$caminho = RAIZ.$userdata->caminho_arquivo;

		header('Content-type: application/pdf');
		header('Content-Disposition: attachment; filename="'.$nome.'"');
		readfile($caminho);
		return redirect("sistema/Biblioteca/".$idup);
	}

	function compareInputFile($field=null)
	{
		if (!$field || !isset($_FILES[$field]['tmp_name'])) {
			echo "batata";
			return;
		}
		// echo json_encode($_FILES);

		$upload = $_FILES[$field]['tmp_name'];
		$hash = md5_file($upload);

		$samefiles = $this->m_uploads->getUploads(array('cwhere' => "`hash` = '{$hash}'"));

		echo !count($samefiles);
		return;
	}

	function getMateriais($idmaterial=null)
	{
		$opts_biblio = array();

		if ($idmaterial) {
			$opts_biblio['id'] = $idmaterial;
		}

		$materiais = $this->m_uploads->getUploads($opts_biblio);

		if (!$materiais) {
			echo false;
			return;
		}

		echo json_encode($materiais);
		return;
	}

}