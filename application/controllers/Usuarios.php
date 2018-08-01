<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_config");
		$this->load->model("m_usuarios");
		$this->load->library("Parserlib");
		$this->load->library("Scripts_loader", "", "sl");
	}


	function visualizar ($id=null) {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$infoB['usuarios'] = isset($id) && $id != null ? $this->m_usuarios->getUsuario($id) : $this->m_usuarios->getUsuario();
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/usuarios/visualizar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function novo() {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/usuarios/criar.php");
		$this->load->view("sistema/common/fim.php");
	}

	function inserir() {
		$data = $_POST;
		$this->m_usuarios->insertUsuario($data);
		return redirect("Usuarios");
	}

	function editar($id=null) {
		if (!$id) {
			return redirect("Usuarios");
		}

		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$infoB['usuario'] = $this->m_usuarios->getUsuario(array('id' => $id))[0];
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/usuarios/editar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function atualizar() {
		$idusuario = $this->input->post("idref");
		$data = $_POST;
		unset($data['idref']);
		$this->m_usuarios->updateUsuario($idusuario, $data);
		return redirect("Usuarios");
	}

	function ativar($id=null) {
		if (!$id) {
			return redirect("Usuarios");
		}

		$data = array(
			'status' => 1
		);

		$this->m_usuarios->updateUsuario($id, $data);
		return redirect("Usuarios");
	}

	function desativar($id=null) {
		if (!$id) {
			return redirect("Usuarios");
		}

		$this->m_usuarios->deleteUsuario($id);
		return redirect("Usuarios");
	}

	function excluir($id=null) {
		if (!$id) {
			return redirect("Usuarios");
		}

		$this->m_usuarios->deleteUsuario($id, 1);
		return redirect("Usuarios");
	}
}