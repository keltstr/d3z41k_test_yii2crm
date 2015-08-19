<?php

namespace backend\controllers;

use Yii;

class WssController
{
    public function __construct() {
    }

    public function start() {
    //open server socket
    $socket = stream_socket_server("tcp://:0.0.0.0:8080", $errno, $errstr);
    
    if (!$socket) {
        die("error: stream_socket_server: $errorString ($errorNumber)\r\n");
    }

    $connects = [];
    while (true) {
    //формируем массив прослушиваемых сокетов:
    $read = $connects;
    $read []= $socket;
    $write = $except = null;

    if (!stream_select($read, $write, $except, null)) {//ожидаем сокеты доступные для чтения (без таймаута)
        break;
    }

    if (in_array($socket, $read)) {//есть новое соединение
        //принимаем новое соединение и производим рукопожатие:
        if (($connect = stream_socket_accept($socket, -1)) && $info = $this->handshake($connect)) {
            $connects[] = $connect;//добавляем его в список необходимых для обработки
            $this->onOpen($connect, $info);//вызываем пользовательский сценарий
        }
        unset($read[ array_search($socket, $read) ]);
    }

    foreach($read as $connect) {//обрабатываем все соединения
        $data = fread($connect, 100000);

        if (!$data) { //соединение было закрыто
            fclose($connect);
            unset($connects[ array_search($connect, $connects) ]);
            $this->onClose($connect);//вызываем пользовательский сценарий
            continue;
        }

        $this->onMessage($connect, $data);//вызываем пользовательский сценарий
        }
    }

        fclose($server);
    }
    public function handshake($connect) {
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

    public function onOpen($connect, $info) {
       echo "\n";
       // fwrite($connect, encode('Hello new Test!'));
    }

    public function onClose($connect) {
        //echo "\n";
        
    }

    public function onMessage($connect, $data) {
        //echo "transmit\n";
        echo $data;
    }
}
