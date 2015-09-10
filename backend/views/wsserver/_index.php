<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\controllers\WsserverController;
use backend\models\Wsserver;
use backend\controllers\WssController;

echo Html::a("On", ['wsserver/switchon'], ['class' => 'btn btn-primary']);
echo '<br><br>';
echo Html::a("Off", ['wsserver/switchoff'], ['class' => 'btn btn-danger']);
echo '<hr>';
if(isset ($model->swt)) {
    echo '<b>'.$model->swt;
    if($model->swt == 1 or $model->swt == 0){
        $WebsocketServer = new WssController();
        $WebsocketServer->start($model->swt);
    }
		
    
}
    

/*
$socket = stream_socket_server("tcp://0.0.0.0:8000", $errno, $errstr);

if (!$socket) {
    die("$errstr ($errno)\n");
}

$connects = array();
while ($model->swt == 1) {
    //формируем массив прослушиваемых сокетов:
    $read = $connects;
    $read []= $socket;
    $write = $except = null;

    if (!stream_select($read, $write, $except, null)) {//ожидаем сокеты доступные для чтения (без таймаута)
        break;
    }

    if (in_array($socket, $read)) {//есть новое соединение
        //принимаем новое соединение и производим рукопожатие:
        if (($connect = stream_socket_accept($socket, -1)) && $info = handshake($connect)) {
            $connects[] = $connect;//добавляем его в список необходимых для обработки
            onOpen($connect, $info);//вызываем пользовательский сценарий
        }
        unset($read[ array_search($socket, $read) ]);
    }

    foreach($read as $connect) {//обрабатываем все соединения
        $data = fread($connect, 100000);

        if (!$data) { //соединение было закрыто
            fclose($connect);
            unset($connects[ array_search($connect, $connects) ]);
            onClose($connect);//вызываем пользовательский сценарий
            continue;
        }

        onMessage($connect, $data);//вызываем пользовательский сценарий
    }
}


fclose($server);

function handshake($connect) {
    $info = array();

    $line = fgets($connect);
    $header = explode(' ', $line);
    $info['method'] = $header[0];
    $info['uri'] = $header[1];

    //считываем заголовки из соединения
    while ($line = rtrim(fgets($connect))) {
        if (preg_match('/\A(\S+): (.*)\z/', $line, $matches)) {
            $info[$matches[1]] = $matches[2];
        } else {
            break;
        }
    }

    $address = explode(':', stream_socket_get_name($connect, true)); //получаем адрес клиента
    $info['ip'] = $address[0];
    $info['port'] = $address[1];

    if (empty($info['Sec-WebSocket-Key'])) {
        return false;
    }

    //отправляем заголовок согласно протоколу вебсокета
    $SecWebSocketAccept = base64_encode(pack('H*', sha1($info['Sec-WebSocket-Key'] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
    $upgrade = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
        "Upgrade: websocket\r\n" .
        "Connection: Upgrade\r\n" .
        "Sec-WebSocket-Accept:$SecWebSocketAccept\r\n\r\n";
    fwrite($connect, $upgrade);

    return $info;
}

///////////////////////////////////////////////////////////////////////////////////////

function onOpen($connect, $info) {
   echo "\n";
   // fwrite($connect, encode('Hello new Test!'));
}

function onClose($connect) {
    //echo "\n";

}

function onMessage($connect, $data) {
	//echo "transmit\n";
	echo $data;
    //echo decode($data)['payload'] . "\n";
}*/