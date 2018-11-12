<?php
header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagseguro extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("M_investimentos");
		$this->load->model("M_inscricoes");
	}

	function notificar()
	{
		// $this->load->library("pagseguro");
		$data = array(
			"notification_code" => isset($_POST['notificationCode']) ? $_POST['notificationCode'] : "erro",
			"notification_type" => isset($_POST['notificationType']) ? $_POST['notificationType'] : "erro"
		);
		$this->db->insert("notificacoes_pagseguro", $data);
		return true;
	}

	// $notificacao = $this->pagseguro->getNotificationDetails($_POST['notificationCode'], (object) array("email" => "marcelo.boemeke@gmail.com", "token" => "3A53E4A6ABB246DFA4832F31051EB511"));
		// $data = array(
		// 	"notification_code" => isset($_POST['notificationCode']) ? $_POST['notificationCode'] : "erro",
		// 	"notification_type" => isset($_POST['notificationType']) ? $_POST['notificationType'] : "erro"
		// );
		// $data = array(
		// 	"notification_code" => "a",
		// 	"notification_type" => "batata"
		// );
		// $this->db->insert("notificacoes_pagseguro", $data);

}