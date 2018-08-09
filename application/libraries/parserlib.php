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

	public function aulaStatusParse($status=null)
	{
		if($status == null) {
			return false;
		}
		
		switch ($status) {
			case 0:
				return "Cancelada";
				break;
			case 1:
				return "Agendada";
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
			$clear = preg_replace($selector, '\3/\2/\1', $data);
			return $clear;
		}

		$clear = preg_replace("~[^\d]~", "", $data);
		$clear = preg_replace("~^(\d{4})(\d{2})(\d{2})$~", '\3/\2/\1', $clear);

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

	public function formatTime($hora=null)
	{
		if (!$hora) {
			return null;
		}

		$hora = str_replace(" ", "", $hora);
		$selector = "~^(\d{2}):(\d{2}):(\d{2})$~";

		if (preg_match($selector, $hora)) {
			$clear = preg_replace($selector, '\1:\2h', $hora);
			return $clear;
		}

		$clear = preg_replace("~[^\d]~", "", $hora);
		$clear = preg_replace("~^(\d{2})(\d{2})(\d{2})$~", '\1:\2h', $clear);

		return $clear;
	}

	public function unformatTime($hora=null)
	{
		if (!$hora) {
			return null;
		}

		$hora = str_replace(" ", "", $hora);
		$selector = "~^(\d{2}):(\d{2})h$~";

		if (preg_match($selector, $hora)) {
			$clear = preg_replace($selector, '\1:\2:00', $hora);
			return $clear;
		}

		$clear = preg_replace("~[^\d]~", "", $hora);
		$clear = preg_replace("~^(\d{2})(\d{2})$~", '\1:\2:00', $clear);

		return $clear;
	}

	public function formatDatetime($data=null)
	{
		if (!$data) {
			return null;
		}

		// $data = str_replace(" ", "", $data);
		$selector = "~^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$~";

		if (preg_match($selector, $data)) {
			$clear = preg_replace($selector, '\3/\2/\1, \4:\5h', $data);
			return $clear;
		}

		$clear = preg_replace("~[^\d]~", "", $data);
		$clear = preg_replace("~^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$~", '\3/\2/\1, \4:\5h', $clear);

		return $clear;
	}

	public function unformatDatetime($data=null)
	{
		if (!$data) {
			return null;
		}

		// $data = str_replace(" ", "", $data);
		$selector = "~^(\d{2})/(\d{2})/(\d{4}), (\d{2}):(\d{2})h$~";

		if (preg_match($selector, $data)) {
			$clear = preg_replace($selector, '\3-\2-\1 \4:\5:00', $data);
			return $clear;
		}

		$clear = preg_replace("~[^\d]~", "", $data);
		$clear = preg_replace("~^(\d{2})(\d{2})(\d{4})(\d{2})(\d{2})$~", '\3-\2-\1 \4:\5:00', $clear);

		return $clear;
	}

	public function unformatMoney($money=null)
	{
		if (!$money) {
			return null;
		}

		$money = str_replace(".", "", $money);
		$money = str_replace(",", ".", $money);

		$money = (float) $money;
		$money = number_format($money, 2, '.', '');
		return $money;
	}

	public function formatDaterange($data=null, $data_2=null)
	{
		if (!$data || !$data_2) {
			return null;
		}

		$selector = "~^(\d{2}/\d{2}/\d{4}), (\d{2}:\d{2})h$~";

		$date_1 = preg_replace($selector, '\1', $data);
		$date_2 = preg_replace($selector, '\1', $data_2);
		$time_1 = preg_replace($selector, '\2', $data);
		$time_2 = preg_replace($selector, '\2', $data_2);

		if ($date_1 == $date_2) {
			$result = $date_1.", ".$time_1."h - ".$time_2."h";
			return $result;
		}

		return $date_1.", ".$time_1."h - ".$date_2.", ".$time_2."h";
	}

	public function dtExtractDate($data=null, $formatted=true, $format=false)
	{
		if (!$data) {
			return null;
		}

		if (!$formatted) {
			$data = $this->unformatDatetime($data);
		}

		$selector = "~^(\d{4}-\d{2}-\d{2}) (\d{2}:\d{2}:\d{2})$~";

		if (preg_match($selector, $data)) {
			$clear = preg_replace($selector, '\1', $data);
			return $format ? $this->formatDate($clear) : $clear;
		}

		$clear = preg_replace("~[^\d]~", "", $data);
		$clear = preg_replace("~^(\d{4})(\d{2})(\d{2})(\d{2}\d{2}\d{2})$~", '\1-\2-\3', $clear);

		return $format ? $this->formatDate($clear) : $clear;
	}

	public function dtExtractTime($data=null, $formatted=true, $format=false)
	{
		if (!$data) {
			return null;
		}

		if (!$formatted) {
			$data = $this->unformatDatetime($data);
		}

		$selector = "~^(\d{4}-\d{2}-\d{2}) (\d{2}:\d{2}:\d{2})$~";

		if (preg_match($selector, $data)) {
			$clear = preg_replace($selector, '\2', $data);
			return $format ? $this->formatTime($clear) : $clear;
		}

		$clear = preg_replace("~[^\d]~", "", $data);
		$clear = preg_replace("~^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})$~", '\4:\5:\6', $clear);

		return $format ? $this->formatTime($clear) : $clear;
	}

	function resume($text=null, $start=0, $end=50)
	{
		if (!$text) {
			return null;
		}

			return ($end - $start) >= strlen($text) ? substr($text, $start, $end) : substr($text, $start, $end)."...";
	}
}