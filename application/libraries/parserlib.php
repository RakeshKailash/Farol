<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * summary
 */
class Parserlib
{
	public function clearr($vals, $key)
	{
		if (!$vals || !sizeof($vals) || !$key) {
			return false;
		}

		$narr = array();

		foreach ($vals as $val) {
			array_push($narr, $val[$key]);
		}

		return $narr;
	}

	public function usrAccessParse($accessCode=null)
	{
		if($accessCode == null) {
			return false;
		}
		
		switch ($accessCode) {
			case 1:
				return "Usuário";
				break;
			case 2:
				return "Aluno";
				break;
			case 3:
				return "Funcionário";
				break;
			case 4:
				return "Administrador";
				break;
			case 5:
				return "Desenvolvedor";
				break;
			default:
				return null;
				break;
		}
	}

	public function formatDate($data=null)
	{
		if (!$data) {
			return null;
		}

		$data = str_replace(" ", "", $data);
		$selector = "~^(\d{4})-(\d{2})-(\d{2})$~";

		if (preg_match($selector, $data)) {
			$clear = preg_replace($selector, '\3-\2-\1', $data);
			return $clear;
		}

		$clear = preg_replace("~[^\d]~", "", $data);
		$clear = preg_replace("~^(\d{4})(\d{2})(\d{2})$~", '\3-\2-\1', $clear);

		return $clear;
	}

	public function unformatDate($data=null)
	{
		if (!$data) {
			return null;
		}

		$data = str_replace(" ", "", $data);
		$selector = "~^(\d{2})/(\d{2})/(\d{4})$~";

		if (preg_match($selector, $data)) {
			$clear = preg_replace($selector, '\3-\2-\1', $data);
			return $clear;
		}

		$clear = preg_replace("~[^\d]~", "", $data);
		$clear = preg_replace("~^(\d{2})(\d{2})(\d{4})$~", '\3-\2-\1', $clear);

		return $clear;
	}
}