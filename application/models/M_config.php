<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_config extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function getLoads($place=4)
	{
		$where = $place == 4 ? "" : "place = '{$place}' OR place = '3'";
		$this->db->select("src");
		$this->db->where($where);

		$result = $this->db->get("loadfiles")->result_array();
		return $result;
	}

	public function getEstados()
	{
		return array(
			array('sigla' => 'AC', 'nome' => 'Acre'),
			array('sigla' => 'AL', 'nome' => 'Alagoas'),
			array('sigla' => 'AP', 'nome' => 'Amapá'),
			array('sigla' => 'AM', 'nome' => 'Amazonas'),
			array('sigla' => 'BA', 'nome' => 'Bahia'),
			array('sigla' => 'CE', 'nome' => 'Ceará'),
			array('sigla' => 'DF', 'nome' => 'Distrito Federal'),
			array('sigla' => 'ES', 'nome' => 'Espírito Santo'),
			array('sigla' => 'GO', 'nome' => 'Goiás'),
			array('sigla' => 'MA', 'nome' => 'Maranhão'),
			array('sigla' => 'MT', 'nome' => 'Mato Grosso'),
			array('sigla' => 'MS', 'nome' => 'Mato Grosso do Sul'),
			array('sigla' => 'MG', 'nome' => 'Minas Gerais'),
			array('sigla' => 'PA', 'nome' => 'Pará'),
			array('sigla' => 'PB', 'nome' => 'Paraíba'),
			array('sigla' => 'PR', 'nome' => 'Paraná'),
			array('sigla' => 'PE', 'nome' => 'Pernambuco'),
			array('sigla' => 'PI', 'nome' => 'Piauí'),
			array('sigla' => 'RJ', 'nome' => 'Rio de Janeiro'),
			array('sigla' => 'RN', 'nome' => 'Rio Grande do Norte'),
			array('sigla' => 'RS', 'nome' => 'Rio Grande do Sul'),
			array('sigla' => 'RO', 'nome' => 'Rondônia'),
			array('sigla' => 'RR', 'nome' => 'Roraima'),
			array('sigla' => 'SC', 'nome' => 'Santa Catarina'),
			array('sigla' => 'SP', 'nome' => 'São Paulo'),
			array('sigla' => 'SE', 'nome' => 'Sergipe'),
			array('sigla' => 'TO', 'nome' => 'Tocantins')
		);
	}

}