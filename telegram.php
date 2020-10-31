<?php

require __DIR__ . "/vendor/autoload.php";
require 'back/functions.php';

//Add at the top this in your code Unlimited execution time

ini_set('max_execution_time', 0);
ini_set("memory_limit", "-1");

define('BOT_TOKEN', '1319527547:AAH2yobgbMYLTsKs0o92Ulkq346mOLsOuno');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');

//Also, you can add unlimited memory usage

//Ativar webhook
//https://api.telegram.org/bot1319527547:AAH2yobgbMYLTsKs0o92Ulkq346mOLsOuno/setwebhook?url=https://alstwo.com.br/relSJAGRO_bot/telegram.php

//Inativar webhook
//https://api.telegram.org/bot1319527547:AAH2yobgbMYLTsKs0o92Ulkq346mOLsOuno/setwebhook?url=


  
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
