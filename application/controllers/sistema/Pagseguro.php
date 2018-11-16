<?php
header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagseguro extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model("M_investimentos");
		$this->load->model("M_inscricoes");
		$this->load->library("Pagsegurolib");
	}

	function notificar()
	{
		$data = array(
			"notification_code" => isset($_POST['notificationCode']) ? $_POST['notificationCode'] : "erro",
			"notification_type" => isset($_POST['notificationType']) ? $_POST['notificationType'] : "erro"
		);

		$this->M_investimentos->insertNotificacaoPagseguro($data);

		$credenciais = $this->M_investimentos->getCredenciaisPagseguro(array('cwhere' => 'ativo = 1'))[0];
		$notificacao = $this->pagsegurolib->getNotificationDetails($_POST['notificationCode'], $credenciais);
		$idinvestimento	= $notificacao->items->item->id;
		$investimento = $this->M_investimentos->getInvestimentoInscricao(array('id' => $idinvestimento))[0];
		$inscricao = $this->M_inscricoes->getInscricao(array('id' => $investimento->idinscricao))[0];
		$idinscricao = $inscricao->idinscricao;
		$status = $notificacao->status;

		$status_novo_inscricao = $inscricao->status;

		if ($status == Pagsegurolib::PAGA || $status == Pagsegurolib::DISPONIVEL) {
			if ($investimento->status == 0) {
				$this->M_investimentos->updateInvestimentoInscricao($idinvestimento, array('status' => '1'));
			}

			if ($inscricao->status != 2) {
				$status_novo_inscricao = 2;
				$this->M_inscricoes->updateInscricao($idinscricao, array('status' => '2'));
			}
		}

		if ($status != Pagsegurolib::PAGA && $status != Pagsegurolib::DISPONIVEL) {
			if ($investimento->status == 1) {
				$this->M_investimentos->updateInvestimentoInscricao($idinvestimento, array('status' => '0'));
			}

			if ($status == Pagsegurolib::AGUARDANDO_PAGAMENTO
				|| $status == Pagsegurolib::EM_ANALISE
				|| $status == Pagsegurolib::EM_DISPUTA
				|| $status == Pagsegurolib::RETENCAO_TEMPORARIA) {

				if ($inscricao->status != 1) {
					$status_novo_inscricao = 1;
					$this->M_inscricoes->updateInscricao($idinscricao, array('status' => '1'));
				}
			}
		}

		if ($status != Pagsegurolib::PAGA && $status != Pagsegurolib::DISPONIVEL) {
			if ($investimento->status == 1) {
				$this->M_investimentos->updateInvestimentoInscricao($idinvestimento, array('status' => '0'));
			}

			if ($status == Pagsegurolib::DEVOLVIDA
				|| $status == Pagsegurolib::CANCELADA
				|| $status == Pagsegurolib::DEBITADO) {

				if ($inscricao->status != 3) {
					$status_novo_inscricao = 3;
					$this->M_inscricoes->updateInscricao($idinscricao, array('status' => '3'));
				}
			}
		}

		if ($status_novo_inscricao != $inscricao->status) {
			$data_historico = array(
				'idusuario' => isset($this->session->idusuario) ? $this->session->idusuario : "0",
				'status_anterior' => $inscricao->status,
				'status_novo' => $status_novo_inscricao
			);
			if (! $this->M_inscricoes->insertHistoricoInscricao($data_historico)) {
				return false;
			}
		}


		
		return true;
	}

	// $notificacao = $this->pagsegurolib->getNotificationDetails($_POST['notificationCode'], (object) array("email" => "marcelo.boemeke@gmail.com", "token" => "3A53E4A6ABB246DFA4832F31051EB511"));
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