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
				return "Funcionário";
				break;
			case 2:
				return "Administrador";
				break;
			case 3:
				return "Desenvolvedor";
				break;
			default:
				return null;
				break;
		}
	}
}