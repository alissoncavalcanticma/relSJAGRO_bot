<?php

function processMessage($message) {
        
        // processa a mensagem recebida
        $message_id = $message['message_id'];
        $chat_id = $message['chat']['id'];
        
        if (isset($message['text'])) {
        
        $text = $message['text'];//texto recebido na mensagem

        if (strpos($text, "/start") === 0) {
            //envia a mensagem ao usuário
            //Criar função pra verificar e retornar o ID para a pessoas solicitar o acesso às funções do BOT
            
            sendMessage("sendMessage", array(
                'chat_id' => $chat_id,
                'text' => 'Olá, '.$message['from']['first_name'].'! Eu sou um bot de abastecimento do posto da São José. Para começar, escolha abaixo:',
                'reply_markup' => array(
                        'keyboard' => array(
                            array(
                                'ABASTECER',
                                'CONSULTAR'
                            )/*,
                            array(
                                '3. Opção 3',
                                '4. Opção 4'
                            ),
                            array(
                                'Relatório 11',
                                'Relatório 12'
                            )*/
                        ),
                'one_time_keyboard' => true)));

        } else if ($text === "ABASTECER") {
            sendMessage("sendMessage", array(
                'chat_id' => $chat_id,
                'parse_mode' => 'HTML',
                'text' => getResult('AB', $text)
            ));
        }else if ($text === "CONSULTAR") {
                sendMessage("sendMessage", array(
                    'chat_id' => $chat_id,
                    'parse_mode' => 'HTML',
                    'text' => getResult('CS', $text)
                ));
        }else if ($text === "CONSULTAR") {
            sendMessage("sendMessage", array(
                'chat_id' => $chat_id,
                'parse_mode' => 'HTML',
                'text' => getResult('CS', $text)
            ));
        }else {
            sendMessage("sendMessage", array(
                'chat_id' => $chat_id,
                'parse_mode' => 'HTML',
                'text' => 'Desculpe, não entendi o comando, tente novamente!'
        ));
        }
    }
}


function sendMessage($method, $parameters) {
   
    $options = array(

        'http' => array(
                'method'  => 'POST',
                'content' => json_encode($parameters),
                'header'=>  "Content-Type: application/json\r\n" ."Accept: application/json\r\n"
        )
    );

    $context  = stream_context_create( $options );
    file_get_contents(API_URL.$method, false, $context );
}

function getResult($rel, $title){

        $out = $title."\r\n";
        
        if($rel=="CS"){
            $out .= " = Digite a matrícula: =";
        }else if($rel=="CS.MAT"){
            $out .= "O funcionário XXX, de matrícula xxx.xxx.xxx\r\n
            ainda tem XX Litros de abastecimento";
        }else{
            $out .= 'Não existe';
        }
    
    return $out;
    
}

?>