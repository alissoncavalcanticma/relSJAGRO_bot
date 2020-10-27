<?php

require __DIR__ . "/vendor/autoload.php";

//Add at the top this in your code Unlimited execution time

ini_set('max_execution_time', 0);

define('BOT_TOKEN', '1319527547:AAH3hLsu7SwanQl6SWdYkRhaKTeYwJ_YG8Y');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');

//Also, you can add unlimited memory usage

ini_set("memory_limit", "-1");

function processMessage($message) {
    // processa a mensagem recebida
    $message_id = $message['message_id'];
    $chat_id = $message['chat']['id'];
    if (isset($message['text'])) {
      
      $text = $message['text'];//texto recebido na mensagem
  
      if (strpos($text, "/start") === 0) {
          //envia a mensagem ao usuário
        sendMessage("sendMessage", array('chat_id' => $chat_id, "text" => 'Olá, '. $message['from']['first_name'].
          '! Eu sou um bot que informa o resultado do último sorteio da Mega Sena. Será que você ganhou dessa vez? Para começar, escolha qual loteria você deseja ver o resultado', 'reply_markup' => array(
          'keyboard' => array(array('Mega-Sena', 'Quina'),array('Lotofácil','Lotomania')),
          'one_time_keyboard' => true)));
      } else if ($text === "Mega-Sena") {
        sendMessage("sendMessage", array('chat_id' => $chat_id, "text" => getResult('megasena', $text)));
      } else if ($text === "Quina") {
        sendMessage("sendMessage", array('chat_id' => $chat_id, "text" => getResult('quina', $text)));
      } else if ($text === "Lotomania") {
        sendMessage("sendMessage", array('chat_id' => $chat_id, "text" => getResult('lotomania', $text)));
      } else if ($text === "Lotofacil") {
        sendMessage("sendMessage", array('chat_id' => $chat_id, "text" => getResult('lotofacil', $text)));
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
  
  //obtém as atualizações do bot
  $update_response = file_get_contents(API_URL."getupdates");
  
  $response = json_decode($update_response, true);
  
  $length = count($response["result"]);
  
  //obtém a última atualização recebida pelo bot
  $update = $response["result"][$length-1];
  
  if (isset($update["message"])) {
    processMessage($update["message"]);
  }
  
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
