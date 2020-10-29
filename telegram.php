<?php

require __DIR__ . "/vendor/autoload.php";

//Add at the top this in your code Unlimited execution time

ini_set('max_execution_time', 0);
ini_set("memory_limit", "-1");

define('BOT_TOKEN', '1319527547:AAH3hLsu7SwanQl6SWdYkRhaKTeYwJ_YG8Y');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');

//Also, you can add unlimited memory usage

//Ativar webhook
//https://api.telegram.org/bot1319527547:AAH3hLsu7SwanQl6SWdYkRhaKTeYwJ_YG8Y/setwebhook?url=https://alstwo.com.br/relSJAGRO_bot/telegram.php

//Inativar webhook
//https://api.telegram.org/bot1319527547:AAH3hLsu7SwanQl6SWdYkRhaKTeYwJ_YG8Y/setwebhook?url=

function getResult($rel, $title){

	$out = "Resultado - ".$title;

	if($rel=="RELGER"){
		$out .= 'Relatório de entrada geral
        26/10/2020
        ================
        TC Analisada : 5686.41
        ================
        TC Entregue : 6908.78
        ================
        Porcentagem de TC analisada : 82.31%
        ================
        Total de cargas entregues : 459
        ================
        Frente 1
        
        POLCANA : 10.91
        AR : 1.12
        FIBRA : 15.46
        PUREZA : 80.59
        BRIX : 17.48
        ATR : 110.79
        TMP: 51.39
        ================';
	}else{
		$out .= 'Relatório XYZ
        27/10/2020
        Frente 1
        ================
        PIEDADE: 57.43
        ATR: 146.57
        Densidade: 14
        ================
        DAGUA: 1004.48
        ATR: 118.84
        Densidade: 14
        ================
        TAPIPIRÉ: 22.40
        ATR: 123.54
        Densidade: 11
        ================
        CAMPINAS: 405.02
        ATR: 132.2
        Densidade: 16
        ================';
	}

	return $out;
}

function processMessage($message) {
    // processa a mensagem recebida
    $message_id = $message['message_id'];
    $chat_id = $message['chat']['id'];
    if (isset($message['text'])) {
      
      $text = $message['text'];//texto recebido na mensagem
  
      if (strpos($text, "/start") === 0) {
          //envia a mensagem ao usuário
          //Criar função pra verificar e retornar o ID para a pessoas solicitar o acesso às funções do BOT
        sendMessage("sendMessage", array('chat_id' => $chat_id, "text" => 'Olá, '. $message['from']['first_name'].
          '! Eu sou um bot de relatórios da São José. Para começar, escolha qual Relatório você deseja ver:', 'reply_markup' => array(
          'keyboard' => array(array('Relatório Geral', 'Relatório por frente'),array('Relatório do dia anterior','Relatório XYZ'),array('Relatório 11','Relatório 12')),
          'one_time_keyboard' => true)));
      } else if ($text === "Relatório Geral") {
        sendMessage("sendMessage", array('chat_id' => $chat_id, "text" => getResult('RELGER', $text)));
      } else if ($text === "Relatório por frente") {
        sendMessage("sendMessage", array('chat_id' => $chat_id, "text" => getResult('RELF', $text)));
      } else if ($text === "Relatório do dia anterior") {
        sendMessage("sendMessage", array('chat_id' => $chat_id, "text" => getResult('RELDA', $text)));
      } else if ($text === "Relatório XYZ") {
        sendMessage("sendMessage", array('chat_id' => $chat_id, "text" => getResult('RELXYZ', $text)));
      } else {
        sendMessage("sendMessage", array('chat_id' => $chat_id, "text" => 'Desculpe, mas não entendi essa mensagem. :('));
      }
    } else {
      sendMessage("sendMessage", array('chat_id' => $chat_id, "text" => 'Desculpe, mas só compreendo mensagens em texto'));
    }
  }


  function sendMessage($method, $parameters) {
       
        $options = array(
        'http' => array(
        'method'  => 'POST',
        'content' => json_encode($parameters),
        'header'=>  "Content-Type: application/json\r\n" .
                    "Accept: application/json\r\n"
        )
        );
  
        $context  = stream_context_create( $options );
        file_get_contents(API_URL.$method, false, $context );
  }
  
    $update_response = file_get_contents("php://input");

    $update = json_decode($update_response, true);

    if (isset($update["message"])) {
    processMessage($update["message"]);
    }


  //obtém as atualizações do bot
  /*
  $update_response = file_get_contents(API_URL."getupdates");
  
  $response = json_decode($update_response, true);
  
  $length = count($response["result"]);
  
  //obtém a última atualização recebida pelo bot
  $update = $response["result"][$length-1];
  
  if (isset($update["message"])) {
    processMessage($update["message"]);
  }
  */





/*$app = new \PhBotLib\Api\ApiConnectTelegram([
    'token' => '1319527547:AAH3hLsu7SwanQl6SWdYkRhaKTeYwJ_YG8Y'
]);*/
    
/*
    $request = $app->getUpdates('offset = NULL');

    $xml = json_decode(json_encode($request),true);
    
    $chat_id = $xml['0']['message']['chat']['id'];
    */
    /*
    do {
        //sleep(1); // Determina que a próxima iteração sera feita daqui a 60 segundos
        $request = $app->getUpdates('offset = NULL');

        $xml = json_decode(json_encode($request),true);

        $length = count($xml);


        if($xml[$length-1]['update_id'] !== $update_id){
            $update_id = $xml[$length-1]['update_id'];
            $text = strtoupper($xml[$length-1]['message']['text']);

            switch ($text) {
                case "OI":
                    $data = [
                        'chat_id' => 1166641089,
                        'parse_mode' => 'HTML',
                        'text'    => "Olá, meu nome é bot!"
                        //'text'    => "Olá, meu nome é <b>bot</b>\nEscolha uma opção:\n1- teste 1\n2 - teste 2"
                        
                    ];
                    $app->sendMessage($data);
                    /*
                    do {
                        $app->sendMessage($data);

                        $request = $app->getUpdates('offset = NULL');
                        //$obj = json_decode($request);

                        $xml = json_decode(json_encode($request),true);

                        $length = count($xml);


                        if($xml[$length-1]['update_id'] === $update_id){
                            $update_id = $xml[$length-1]['update_id'];
                            $text = $xml[$length-1]['message']['text'];
                            switch ($text) {
                                case "UM":
                                    echo "oi"; die();
                                    $data = [
                                        'chat_id' => $chat_id,
                                        'text'    => 'Escolheu teste 1'
                                    ];
                                    $app->sendMessage($data);
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                            
                        }die();
                    } while (true);
                    *//*
                    break;
                case "TUDO BEM?":
                    $data = [
                        'chat_id' => 1166641089,
                        'text'    => 'Tudo sim, e você?'
                    ];
                    $app->sendMessage($data);
                    break;
                case "TUDO CERTO":
                    $data = [
                        'chat_id' => 1166641089,
                        'text'    => 'Que bom! Em que posso te ajudar?'
                    ];
                    $app->sendMessage($data);
                    break;
                case "ESTOU COM FOME!":
                    $data = [
                        'chat_id' => 1166641089,
                        'text'    => 'Te vira vagabundo! kkk'
                    ];
                    $app->sendMessage($data);
                    break;
                case "REL":
                        $data = [
                            'chat_id' => 1166641089,
                            'parse_mode' => 'HTML',
                            'text'    => 'Relatório de entrada toneladas por frente
                            26/10/2020
                            ================
                            Frente 1 
                            Qt cana :208.04 ton
                            TMP: 56.60 
                            ATR : 119.89
                            ================
                            ================
                            Frente 2 
                            Qt cana :501.42 ton
                            TMP: 57.07 
                            ATR : 124.83
                            ================
                            ================
                            Frente 3 
                            Qt cana :703.43 ton
                            TMP: 48.68 
                            ATR : 131.70
                            ================
                            ================
                            Frente 5 
                            Qt cana :90.25 ton
                            ATR : 132.74
                            ================
                            ================
                            Frente 99(Fornec)
                            Qt cana :69.44 ton
                            TMP: 70.30 
                            ATR : 123.15
                            ================
                            ================
                            Total TC : 1573 ton'
                        ];
                        $app->sendMessage($data);
                        break;
                default:
                    $data = [
                        'chat_id' => 1166641089,
                        'text'    => 'Comando inválido, repita por favor!'
                    ];
                    $app->sendMessage($data);
                    break;
            }
        }else{
            echo "Erro!";
            //return $update_id = '0';

        }
    } while (true);
    

*/
/*  
    $updates = getUpdateOffset();

        if($updates) {


            $mensagens = $updates;

            foreach ($mensagens as $mensagem) {

                $id     = $mensagem['chat']['id'];
                $nome   = $mensagem['from']['first_name'];
                $texto  = $mensagem['text'];

                if($texto === '/start'){

                    if(sendMessage($id, 'Olá, ' . $nome)) {
                        echo 'Mensagem enviada';
                    }
                }

            }

        }


*/

?>
