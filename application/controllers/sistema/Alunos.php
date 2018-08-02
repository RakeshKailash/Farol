<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alunos extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_config");
		$this->load->model("m_alunos");
		$this->load->library("Parserlib");
		$this->load->library("Scripts_loader", "", "sl");
	}


	function visualizar ($id=null) {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$infoB['alunos'] = isset($id) && $id != null ? $this->m_alunos->getAluno($id) : $this->m_alunos->getAluno();
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/alunos/visualizar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function novo() {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/alunos/criar.php");
		$this->load->view("sistema/common/fim.php");
	}

	function inserir() {
		$data = $_POST;
		$this->m_alunos->insertAluno($data);
		return redirect("sistema/Alunos");
	}

	function editar($id=null) {
		if (!$id) {
			return redirect("sistema/Alunos");
		}

		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$infoB['aluno'] = $this->m_alunos->getAluno(array('id' => $id))[0];
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/alunos/editar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function atualizar() {
		$idaluno = $this->input->post("idref");
		$data = $_POST;
		unset($data['idref']);
		$this->m_alunos->updateAluno($idaluno, $data);
		return redirect("sistema/Alunos");
	}

	function ativar($id=null) {
		if (!$id) {
			return redirect("sistema/Alunos");
		}

		$data = array(
			'status' => 1
		);

		$this->m_alunos->updateAluno($id, $data);
		return redirect("sistema/Alunos");
	}

	function desativar($id=null) {
		if (!$id) {
			return redirect("sistema/Alunos");
		}

		$this->m_alunos->deleteAluno($id);
		return redirect("sistema/Alunos");
	}

	function excluir($id=null) {
		if (!$id) {
			return redirect("sistema/Alunos");
		}

		$this->m_alunos->deleteAluno($id, 1);
		return redirect("sistema/Alunos");
	}
}