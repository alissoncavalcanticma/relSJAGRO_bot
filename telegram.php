<?php

require __DIR__ . "/vendor/autoload.php";

$app = new \PhBotLib\Api\ApiConnectTelegram([
    'token' => '1319527547:AAH3hLsu7SwanQl6SWdYkRhaKTeYwJ_YG8Y'
]);

try {
    $request = $app->getUpdates();
    //$obj = json_decode($request);


    $response = json_decode(json_encode($request), true);

    $length = count($response["result"]);

    //obtém a última atualização recebida pelo bot
    $update = $response["result"][$length-1];

    echo $update['message']['text'];

    //var_dump($request['0']['result']['']);
    //var_dump($request);
    //$xml = json_decode(json_encode($request),true);
    //echo $xml[0]['update_id'];
    /*foreach($xml['message']['text'] as $text){
        echo $text;
    }
    */
    /*
    if($xml[3]['message']['text'] == 'oi'){
        $data = [
            'chat_id' => 1166641089,
            'text'    => 'Text!'
        ];
        $app->sendMessage($data);

    };
    */
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

