<?php

namespace fronend\controllers;

use Yii;
use frontend\models\Wsclient;

class WsclientController extends Wsclient
{

	private $socket = null;
 
	public function __construct($host, $port)
	{
		$this->connect($host, $port);	
	}
 
	public function __destruct()
	{
		$this->disconnect();
	}
 	private function encode($payload, $type = 'text', $masked = true) {
        $frameHead = [];
        $frame = '';
        $payloadLength = strlen($payload);

        switch ($type) {
            case 'text':
                // first byte indicates FIN, Text-Frame (10000001):
                $frameHead[0] = 129;
                break;

            case 'close':
                // first byte indicates FIN, Close Frame(10001000):
                $frameHead[0] = 136;
                break;

            case 'ping':
                // first byte indicates FIN, Ping frame (10001001):
                $frameHead[0] = 137;
                break;

            case 'pong':
                // first byte indicates FIN, Pong frame (10001010):
                $frameHead[0] = 138;
                break;
        }

        // set mask and payload length (using 1, 3 or 9 bytes)
        if ($payloadLength > 65535) {
            $payloadLengthBin = str_split(sprintf('%064b', $payloadLength), 8);
            $frameHead[1] = ($masked === true) ? 255 : 127;
            for ($i = 0; $i < 8; $i++) {
                $frameHead[$i + 2] = bindec($payloadLengthBin[$i]);
            }

            // most significant bit MUST be 0 (close connection if frame too big)
            if ($frameHead[2] > 127) {
                $this->close(1004);
                return false;
            }
        } elseif ($payloadLength > 125) {
            $payloadLengthBin = str_split(sprintf('%016b', $payloadLength), 8);
            $frameHead[1] = ($masked === true) ? 254 : 126;
            $frameHead[2] = bindec($payloadLengthBin[0]);
            $frameHead[3] = bindec($payloadLengthBin[1]);
        } else {
            $frameHead[1] = ($masked === true) ? $payloadLength + 128 : $payloadLength;
        }

        // convert frame-head to string:
        foreach (array_keys($frameHead) as $i) {
            $frameHead[$i] = chr($frameHead[$i]);
        }

        if ($masked === true) {
            // generate a random mask:
            $mask = [];
            for ($i = 0; $i < 4; $i++) {
                $mask[$i] = chr(rand(0, 255));
            }

            $frameHead = array_merge($frameHead, $mask);
        }
        $frame = implode('', $frameHead);
        // append payload to frame:
        for ($i = 0; $i < $payloadLength; $i++) {
            $frame .= ($masked === true) ? $payload[$i] ^ $mask[$i % 4] : $payload[$i];
        }

        return $frame;
    }
	public function sendData($data)
	{
		// send data:
		fwrite($this->socket, $this->encode($data) or die('Error:' . $errno . ':' . $errstr); 
	}
 
	private function connect($host, $port)
	{
		$key = $this->generateRandomString(32);
	
		$header = "GET /chat HTTP/1.1\r\n";
		$header.= "Host: localhost\r\n";
		$header.= "Upgrade: websocket\r\n";
		$header.= "Connection: Upgrade\r\n";
		$header.= "Sec-WebSocket-Key: ".$key."\r\n";
		$header.= "Sec-WebSocket-Protocol: chat, superchat\r\n";
		$header.= "Sec-WebSocket-Version: 13\r\n";
		$header.= "\r\n";
 
		$this->socket = fsockopen($host, $port, $errno, $errstr, 2); 
		fwrite($this->socket, $header) or die('Error: ' . $errno . ':' . $errstr); 	
 
		return true;
	}
 
	private function disconnect()
	{
		fclose($this->socket);
	}
 
	private function generateRandomString($length = 10, $addSpaces = true, $addNumbers = true)
	{  
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!"§$%&/()=[]{}';
		$useChars = [];
		// select some random chars:    
		for($i = 0; $i < $length; $i++)
		{
			$useChars[] = $characters[mt_rand(0, strlen($characters)-1)];
		}
		// add spaces and numbers:
		if($addSpaces === true)
		{
			array_push($useChars, ' ', ' ', ' ', ' ', ' ', ' ');
		}
		if($addNumbers === true)
		{
			array_push($useChars, rand(0,9), rand(0,9), rand(0,9));
		}
		shuffle($useChars);
		$randomString = trim(implode('', $useChars));
		$randomString = substr($randomString, 0, $length);
		return $randomString;
	}
}