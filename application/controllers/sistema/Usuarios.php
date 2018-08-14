<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_config");
		$this->load->model("m_usuarios");
		if (!$this->m_usuarios->isLogged()) {
			return redirect("sistema/login");
		}
	}

	function visualizar ($id=null) {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);

		$users = isset($id) && $id != null ? $this->m_usuarios->getUsuario($id) : $this->m_usuarios->getUsuario();

		foreach ($users as &$value) {
			$value->data_nascimento = $this->parserlib->formatDate($value->data_nascimento);
		}

		$infoB['usuarios'] = $users;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/usuarios/listar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function novo() {
		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB['estados'] = $this->m_config->getEstados();

		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/usuarios/criar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function inserir() {
		$data = $_POST;
		if ($this->form_validation->run('cadastro_usuarios') == FALSE) {
			$this->session->set_flashdata('errors', validation_errors("<p class='error'>", "</p>"));
			$this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Usuarios/novo");
		}
		
		unset($data['confirma_senha']);

		$data = $this->prepareUserdata($data);
		
		$this->m_usuarios->insertUsuario($data);
		return redirect("sistema/Usuarios");
	}

	function editar($id=null) {
		if (!$id) {
			return redirect("sistema/Usuarios");
		}

		$loads = $this->m_config->getLoads(2);
		$loads = $this->parserlib->clearr($loads, "src");
		$infoH['loads'] = $this->sl->setScripts($loads);
		$infoB['estados'] = $this->m_config->getEstados();

		$userdata = $this->m_usuarios->getUsuario(array('id' => $id))[0];
		$userdata->data_nascimento = $this->parserlib->formatDate($userdata->data_nascimento);

		$infoB['userdata'] = $userdata;
		
		$this->load->view("sistema/common/topo.php", $infoH);
		$this->load->view("sistema/usuarios/editar.php", $infoB);
		$this->load->view("sistema/common/fim.php");
	}

	function atualizar() {
		$data = $_POST;
		$idusuario = $this->input->post("idref");
		$errors = "";

		if ($this->form_validation->run('atualizacao_usuarios') == FALSE) {
			$errors = validation_errors("<p class='error'>", "</p>");
		}

		$query_options = array(
			'!id' => $idusuario,
			'cwhere' => "email = '{$data['email']}'"
		);

		$email_result = $this->m_usuarios->getUsuario($query_options);

		if (sizeof($email_result) > 0) {
			$errors .= "<p class='error'>O campo E-mail já existe, ele deve ser único.</p>";
		}

		$query_options = array(
			'!id' => $idusuario,
			'cwhere' => "cpf = '{$data['cpf']}'"
		);

		$cpf_result = $this->m_usuarios->getUsuario($query_options);

		if (sizeof($cpf_result) > 0) {
			$errors .= "<p class='error'>O campo CPF já existe, ele deve ser único.</p>";
		}

		if (isset($data['senha']) && $data['senha'] != "") {
			if ($data['senha'] != $data['confirma_senha']) {
				$errors .= "<p class='error'>Para atualizar o campo Senha, ele deve ser idêntico ao campo Repita a senha</p>";
			}
		} else {
			unset($data['senha']);
		}

		if ($errors != "") {
			$this->session->set_flashdata('errors', $errors);
			// $this->session->set_flashdata('formdata', $data);
			return redirect("sistema/Usuarios/".$idusuario);
		}

		unset($data['idref']);
		unset($data['confirma_senha']);
		$data = $this->prepareUserdata($data);
		$this->m_usuarios->updateUsuario($idusuario, $data);
		return redirect("sistema/Usuarios");
	}

	function ativar($id=null) {
		if (!$id) {
			return redirect("sistema/Usuarios");
		}

		$data = array(
			'status' => 1
		);

		$this->m_usuarios->updateUsuario($id, $data);
		return redirect("sistema/Usuarios");
	}

	function desativar($id=null) {
		if (!$id) {
			return redirect("sistema/Usuarios");
		}

		$this->m_usuarios->deleteUsuario($id);
		return redirect("sistema/Usuarios");
	}

	function excluir($id=null) {
		if (!$id) {
			return redirect("sistema/Usuarios");
		}

		$this->m_usuarios->deleteUsuario($id, 1);
		return redirect("sistema/Usuarios");
	}

	function prepareUserdata($data=null)
	{
		if (!$data) {
			return null;
		}

		$data['data_nascimento'] = $this->parserlib->unformatDate($data['data_nascimento']);
		$data['nome'] = $this->parserlib->titleCase($data['nome']);
		$data['email'] = $this->parserlib->titleCase($data['email']);
		$data['cidade'] = $this->parserlib->titleCase($data['cidade']);
		$data['bairro'] = $this->parserlib->titleCase($data['bairro']);
		$data['rua'] = $this->parserlib->titleCase($data['rua']);
		$data['complemento'] = $this->parserlib->mb_ucfirst($data['complemento']);
		$data['email'] = mb_strtolower($data['email']);
		$data['atividade'] = $this->parserlib->titleCase($data['atividade']);
		$data['cpf'] = $this->parserlib->removeNumMasks($data['cpf']);
		$data['cep'] = $this->parserlib->removeNumMasks($data['cep']);
		$data['whatsapp'] = $this->parserlib->removeNumMasks($data['whatsapp']);
		$data['fone_1'] = $this->parserlib->removeNumMasks($data['fone_1']);
		$data['fone_2'] = $this->parserlib->removeNumMasks($data['fone_2']);
		$data['fone_3'] = $this->parserlib->removeNumMasks($data['fone_3']);
		return $data;
	}
}