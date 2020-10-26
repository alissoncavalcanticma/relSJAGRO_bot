<?php

require __DIR__ . "/vendor/autoload.php";

$app = new \PhBotLib\Api\ApiConnectTelegram([
    'token' => '1319527547:AAH3hLsu7SwanQl6SWdYkRhaKTeYwJ_YG8Y'
]);
    
/*
    $request = $app->getUpdates('offset = NULL');

    $xml = json_decode(json_encode($request),true);
    
    $chat_id = $xml['0']['message']['chat']['id'];
    */
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
                        'text'    => "Olá, meu nome é <b>bot!</b>"
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
                    */
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
                        'text'    => 'Você é casado, come sua mulher! kkkkk'
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
