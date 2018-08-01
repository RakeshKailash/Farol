<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("m_alunos");
		$this->load->library("Parserlib");
		$this->load->library("Scripts_loader", "", "sl");
	}

	function index() {
		$aluno = array(
			'nome' => "Outro Eu",
			'sobrenome' => "Mesmo",
			'email' => "eu@mesmo.com.br",
			'status' => 1,
			'data_nascimento' => '02/10/1998',
			'ocupacao' => 'Testador',
			'uf' => 'BA',
			'cidade' => 'Salvador',
			'bairro' => 'Dali',
			'rua' => 'Asfaltada',
			'numero' => 11,
			'cep' => '96090340',
			'fone_1' => "1111",
			'fone_2' => "22222"
		)
		;
		echo "<pre>";
		var_dump($this->m_alunos->deleteAluno(3, 1));
		echo "</pre>";
	}
}