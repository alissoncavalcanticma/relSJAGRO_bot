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
                'text' => 'Olá, '.$message['from']['first_name'].'! Eu sou um bot de relatórios da São José. Para começar, escolha qual Relatório você deseja ver:',
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
            ================';
        }else{
            $out .= 'Não existe';
        }
    
    return $out;
    
}

?>