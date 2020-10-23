<?php

require __DIR__ . "/vendor/autoload.php";

$app = new \PhBotLib\Api\ApiConnectTelegram([
    'token' => '1319527547:AAH3hLsu7SwanQl6SWdYkRhaKTeYwJ_YG8Y'
]);
    
    /*
    while (true) {


        $request = $app->getUpdates();

        $xml = json_decode(json_encode($request),true);

        if($xml[3]['message']['text'] == 'oi'){
            $data = [
                'chat_id' => 1166641089,
                'text'    => 'Text!'
            ];
            $app->sendMessage($data);
    
        };
        sleep(200); // Determina que a próxima iteração sera feita daqui a 60 segundos
    }
    */

    $request = $app->getUpdates();
    //$obj = json_decode($request);

    $xml = json_decode(json_encode($request),true);

    $length = count($xml);

    //obtém a última atualização recebida pelo bot
    $update = $xml[$length-1]['message']['text'];

    //echo $update;
    if($update === 'oi'){
        $data = [
            'chat_id' => 1166641089,
            'text'    => 'Olá, meu nome é bot!'
        ];
        $app->sendMessage($data);
    }else{
        $data = [
            'chat_id' => 1166641089,
            'text'    => 'Não Entendi, pode repetir?'
        ];
        $app->sendMessage($data);

    }
    //$request = $app->getUpdates();
    //var_dump($request['0']['result']['']);
    //var_dump($request);
    //$xml = json_decode(json_encode($request),true);
    //echo $xml[0]['update_id'];
    /*foreach($xml['message']['text'] as $text){
        echo $text;
    }
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
    /*
    
    echo $xml[3]['message']['text'];

    for($x = 1; $x <= count($xml); $x++){
        echo $xml[$x]['message']['text']."<br>";
    }
    
    if($xml[3]['message']['text'] == 'oi'){
        $data = [
            'chat_id' => 1166641089,
            'text'    => 'Text!'
        ];
        //$app->sendMessage($data);

    };
} catch (\Exception $exception) {
    echo $exception->getMessage();
}

//json_decode($request, true);
//json_decode($request, true)['result'];

/*
$data = [
    'chat_id' => 1166641089,
    'text'    => 'Ó a mensagem'
];

try {
    $request = $app->sendMessage($data);
} catch (\Exception $exception) {
    echo $exception->getMessage();
}
//var_dump($request);
 */
?>
