<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alunos extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("M_config");
		$this->load->model("M_alunos");
		$this->load->library("Parserlib");
		$this->load->library("Scripts_loader", "", "sl");
		if (!$this->M_usuarios->isLogged()) {
			return redirect("sistema/login");
		}
	}


	function visualizar ($id=null) {
		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$infoB['alunos'] = isset($id) && $id != null ? $this->M_alunos->getAluno($id) : $this->M_alunos->getAluno();
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/alunos/listar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function novo() {
		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/alunos/criar.php");
		$this->load->view("sistema/common/fim.php");
	}

	function inserir() {
		$data = $_POST;
		$this->M_alunos->insertAluno($data);
		return redirect("sistema/Alunos");
	}

	function editar($id=null) {
		if (!$id) {
			return redirect("sistema/Alunos");
		}

		$loads = $this->M_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$infoB['aluno'] = $this->M_alunos->getAluno(array('id' => $id))[0];
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/alunos/editar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function atualizar() {
		$idaluno = $this->input->post("idref");
		$data = $_POST;
		unset($data['idref']);
		$this->M_alunos->updateAluno($idaluno, $data);
		return redirect("sistema/Alunos");
	}

	function ativar($id=null) {
		if (!$id) {
			return redirect("sistema/Alunos");
		}

		$data = array(
			'status' => 1
		);

		$this->M_alunos->updateAluno($id, $data);
		return redirect("sistema/Alunos");
	}

	function desativar($id=null) {
		if (!$id) {
			return redirect("sistema/Alunos");
		}

		$this->M_alunos->deleteAluno($id);
		return redirect("sistema/Alunos");
	}

	function excluir($id=null) {
		if (!$id) {
			return redirect("sistema/Alunos");
		}

		$this->M_alunos->deleteAluno($id, 1);
		return redirect("sistema/Alunos");
	}
}