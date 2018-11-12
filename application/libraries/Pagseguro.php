<?php defined('BASEPATH') OR exit('No direct script access allowed');
header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");

/**
 * summary
 */
class Pagseguro
{
	const AGUARDANDO_PAGAMENTO	= 1;
	const EM_ANALISE		 	= 2;
	const PAGA 					= 3;
	const DISPONIVEL 			= 4;
	const EM_DISPUTA 			= 5;
	const DEVOLVIDA 			= 6;
	const CANCELADA 			= 7;
	const DEBITADO 				= 8;
	const RETENCAO_TEMPORARIA 	= 9;

	//Definindo o ambiente (production ou test)
	const ENVIRONMENT = "test";

	function submitPayment($pagamento=array(), $credenciais=array())
	{
    	//Definindo as credenciais
		$email = $credenciais->email;
		$token = $credenciais->token;

    	//URL da chamada para o PagSeguro
		$url = array(
			"production" => "https://ws.pagseguro.uol.com.br/v2/checkout/?email=" .$email ."&token=".$token,
			"test" => "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/?email=" .$email ."&token=".$token
		);

    	//Dados da compra
		$dadosCompra['currency'] = "BRL";
		$dadosCompra['itemId1'] = $pagamento->investimento->idinvestimento;
		$dadosCompra['itemDescription1'] = "Curso: " . $pagamento->curso->nome . " | " . $pagamento->turma->identificacao;
		$dadosCompra['itemAmount1'] = (string) $pagamento->forma_investimento->total;
		$dadosCompra['itemQuantity1'] = "1";

    	//Transformando os dados da compra no formato da URL
		$dadosCompra = http_build_query($dadosCompra);

    	//Realizando a chamada
		$curl = curl_init($url[Self::ENVIRONMENT]);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $dadosCompra);
		curl_setopt($curl, CURLOPT_HTTPHEADER, Array('Content-Type: application/x-www-form-urlencoded; charset=UTF-8'));
		$respostaPagSeguro = curl_exec($curl);
		$http = curl_getinfo($curl);

		if($http['http_code'] != "200"){
    		//Criando um log de erro.
			$data = date("Y_m_d");
			$hora = date("H:i:s T");
			$arquivo = fopen(RAIZ."logs/error/LogErroPagSeguro.$data.txt", "ab");
			fwrite($arquivo,"Log de erro\\\\r\\\\n");
			fwrite($arquivo,"HTTP: ".$http['http_code']." \\\\r\\\\n");
			fwrite($arquivo,"Data: ".$data." \\\\r\\\\n");
			fwrite($arquivo,"Hora: ".$hora." \\\\r\\\\n");
			if($http['http_code'] == "401"){
				echo $http['http_code'];
				fwrite($arquivo,"Erro:".$respostaPagSeguro." \\\\r\\\\n");
				fwrite($arquivo,"Esta mensagem de erro é ocasionada quando as credenciais (e-mail e token) da chamada estão erradas.\\\\r\\\\n");
			} else {
				curl_close($curl);
				$respostaPagSeguro= simplexml_load_string($respostaPagSeguro);

				foreach ($respostaPagSeguro->error as $key => $erro) {
					fwrite($arquivo,"-----------------------------------------------------------------------------------------------------------\\\\r\\\\n");
					fwrite($arquivo,"Código do erro: ".$erro->code." \\\\r\\\\n");
					fwrite($arquivo,"Mensagem: ".$erro->message." \\\\r\\\\n");
					fwrite($arquivo,"-----------------------------------------------------------------------------------------------------------\\\\r\\\\n");
				}
				fwrite($arquivo,"Neste caso, você precisa verificar se os dados foram passados de acordo com a documentação do PagSeguro.\\\\r\\\\n");
			}
			fwrite($arquivo,"________________________________________________________________________________________________________________ \\\\r\\\\n");
			fclose($arquivo);
			return false;
		}

		$respostaPagSeguro= simplexml_load_string($respostaPagSeguro);
		return $respostaPagSeguro->code;
	}

	function getNotificationDetails($notification_code=null, $credenciais=array())
	{
		$email = $credenciais->email;
		$token = $credenciais->token;

		$url = array(
			"production" => "https://ws.pagseguro.uol.com.br/v3/transactions/notifications/".$notification_code."?email=" .$email ."&token=".$token,
			"test" => "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/".$notification_code."?email=" .$email ."&token=".$token
		);
		
		$curl = curl_init($url[Self::ENVIRONMENT]);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, Array('Content-Type: application/x-www-form-urlencoded; charset=UTF-8'));
		$respostaPagSeguro = curl_exec($curl);
		$http = curl_getinfo($curl);

		if($http['http_code'] != "200"){
    		//Criando um log de erro.
			$data = date("Y_m_d");
			$hora = date("H:i:s T");
			$arquivo = fopen(RAIZ."logs/error/LogErroPagSeguro.$data.txt", "ab");
			fwrite($arquivo,"Log de erro\\\\r\\\\n");
			fwrite($arquivo,"HTTP: ".$http['http_code']." \\\\r\\\\n");
			fwrite($arquivo,"Data: ".$data." \\\\r\\\\n");
			fwrite($arquivo,"Hora: ".$hora." \\\\r\\\\n");
			if($http['http_code'] == "401"){
				echo $http['http_code'];
				fwrite($arquivo,"Erro:".$respostaPagSeguro." \\\\r\\\\n");
				fwrite($arquivo,"Esta mensagem de erro é ocasionada quando as credenciais (e-mail e token) da chamada estão erradas.\\\\r\\\\n");
			} else {
				curl_close($curl);
				$respostaPagSeguro= simplexml_load_string($respostaPagSeguro);

				foreach ($respostaPagSeguro->error as $key => $erro) {
					fwrite($arquivo,"-----------------------------------------------------------------------------------------------------------\\\\r\\\\n");
					fwrite($arquivo,"Código do erro: ".$erro->code." \\\\r\\\\n");
					fwrite($arquivo,"Mensagem: ".$erro->message." \\\\r\\\\n");
					fwrite($arquivo,"-----------------------------------------------------------------------------------------------------------\\\\r\\\\n");
				}
				fwrite($arquivo,"Neste caso, você precisa verificar se os dados foram passados de acordo com a documentação do PagSeguro.\\\\r\\\\n");
			}
			fwrite($arquivo,"________________________________________________________________________________________________________________ \\\\r\\\\n");
			fclose($arquivo);
			return false;
		}

		$respostaPagSeguro = simplexml_load_string($respostaPagSeguro);
		return $respostaPagSeguro;
	}

}