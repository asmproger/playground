<?php
/**
 * Created by PhpStorm.
 * User: sovkutsan
 * Date: 6/26/18
 * Time: 10:27 AM
 */

const WEBSOCKERT_SECRET_STR = '258EAFA5-E914-47DA-95CA-C5AB0DC85B11';


/**
 * Class Frame for WebSockets frame
 */
class Frame
{
    protected $rawFrame = '';

    protected $firstByte = 0;
    protected $secondByte = 0;
    protected $thirdByte = 0;

    protected $isFinal = false;
    protected $isMasked = false;
    protected $opcode = null;
    protected $type = null;
    protected $length = 0;
    protected $mask = null;

    public function __construct($rawFrame = '')
    {
        $this->rawFrame = $rawFrame;
        $this->decodeFrame();
    }

    public function setRawFrame($rawFrame = '') {
        $this->rawFrame = $rawFrame;
        $this->decodeFrame();
    }

    public function decodeFrame() {
        if(!$this->rawFrame) {
            return;
        }

        /*$this->firstByte = sprintf('%08b', ord($this->rawFrame[0]));
        $this->secondByte = sprintf('%08b', ord($this->rawFrame[1]));*/

        $this->firstByte = ord($this->rawFrame[0]);
        $this->secondByte = ord($this->rawFrame[1]);

        $this->isFinal = $this->firstByte ^ 128;
        $this->opcode = $this->firstByte & 15;

        $this->isMasked = ($this->secondByte & 128) == 128;

        $this->type = $this->detectType();
        $this->length = $this->detectLength();

        print_r([
            'first   :' => sprintf('%08b', $this->firstByte),
            'mask    :' => sprintf('%08b', 15),
            'isFinal :' => $this->isFinal,
            'opcode  :' => $this->opcode . ' ' . gettype($this->opcode),
            'type    :' => $this->type,
            'masked  :' => $this->isMasked,
            'len     :' => $this->length,
            'wtf     :' => $this->secondByte & 127
        ]);

    }


    protected $offset = 0;

    private function detectLength() {
        $length = $this->secondByte & 127;

        if($length > 127) {
            throw new Exception('Invalid length value');
        }

        switch($length) {
            case 126:
                $this->length = ord(substr($this->rawFrame,2, 2));
                break;
            case 127:
                $this->length = ord(substr($this->rawFrame,2, 8));
                break;
            default:
                $this->length = $length;
        }
        print_r([
            'len1       :' => $length,
            'len        :' => $this->length,
            'thirdByte  :' => sprintf('%08b', $this->thirdByte),
            'mask       :' => sprintf('%08b', 192),
            'l_main     :' => sprintf('%08b', $this->length),
        ]);
    }


    private function detectType() {
        switch ($this->opcode) {
            case 0:
                $this->type = 'continue';
                break;
            case 1:
                $this->type = 'text';
                break;
            case 2:
                $this->type = 'binary';
                break;
            case 8:
                $this->type = 'close';
                break;
            case 9:
                $this->type = 'ping';
                break;
            case 10:
                $this->type = 'pong';
                break;
            default:
                throw new Exception('Undefined opcode - ' . $this->opcode);
        }
        /*
0x1 обозначает текстовый фрейм.
0x2 обозначает двоичный фрейм.
0x3-7 зарезервированы для будущих фреймов с данными.
0x8 обозначает закрытие соединения этим фреймом.
0x9 обозначает PING.
0xA обозначает PONG.
0xB-F зарезервированы для будущих управляющих фреймов.
0x0 обозначает фрейм-продолжение для фрагментированного сообщения. Он интерпретируется, исходя из ближайшего предыдущего ненулевого типа.
         */
    }
}

function getHeaders($stream, $wsOnly = true)
{
    $result = [];
    while ($line = trim(fgets($stream))) {
        if (strlen($line) < 5) {
            break;
        }

        if ($wsOnly && strpos(strtolower($line), 'websocket') === false) {
            continue;
        }

        $tmpLine = explode(':', $line);
        if (count($tmpLine)) {
            $result[$tmpLine[0]] = $tmpLine[1];
        } else {
            $result[] = $line;
        }
    }

    return $result;
}

function getResponseHeaders($headers)
{
    $accept = getAccept(trim($headers['Sec-WebSocket-Key']));
    $responseHeaders = [
        'HTTP/1.1 101 Switching Protocols',
        'Upgrade: websocket',
        'Connection: Upgrade',
        "Sec-WebSocket-Accept: {$accept}"
    ];
    if (isset($headers['Sec-WebSocket-Protocol'])) {
        $responseHeaders[] = "Sec-WebSocket-Protocol: {$headers['Sec-WebSocket-Protocol']}";
    }

    $responseHeadersStr = implode(PHP_EOL, $responseHeaders);
    $responseHeadersStr .= PHP_EOL . PHP_EOL;

    return $responseHeadersStr;
}

function handshake($connect)
{
    $headers = getHeaders($connect, true);

    if (!count($headers)) {
        print_r('  WRONG  ');
        return false;
    }

    // ok, this is ws request. lets handshake with our client
    $responseHeaders = getResponseHeaders($headers);

    return fwrite($connect, $responseHeaders);
}

function getAccept($webSocketSecretKey)
{
    return base64_encode(sha1($webSocketSecretKey . WEBSOCKERT_SECRET_STR, true));
}

// lets try open our socket on some ip & port
// this ip and port should be used on client, no this script addr!!!

$socket = stream_socket_server("tcp://127.0.0.1:1915", $errno, $errstr);

if (!$socket) {
    die("$errstr ($errno)\n");
}

$approvedConnects = [];
$connects = [];
while (true) {

    $read = $connects;
    $read [] = $socket;
    $write = $except = null;

    if (!stream_select($read, $write, $except, null)) {//ожидаем сокеты доступные для чтения (без таймаута)
        print_r('  WTF  ');
        break;
    }

    if (in_array($socket, $read)) {//есть новое соединение
        //принимаем новое соединение и производим рукопожатие:
        if (($connect = stream_socket_accept($socket, -1)) && $info = handshake($connect)) {
            $connects[] = $connect;//добавляем его в список необходимых для обработки
            print_r('  onOpen!!!  ' . PHP_EOL);
        }
        unset($read[array_search($socket, $read)]);
    }

    foreach ($read as $connect) {//обрабатываем все соединения
        $data = fread($connect, 100000);

        if (!$data) { //соединение было закрыто
            fclose($connect);
            unset($connects[array_search($connect, $connects)]);
            print_r('  onClose!!!  ' . PHP_EOL);
            continue;
        }

        onMessage($data);
    }

}

function onMessage($data)
{
    $frame = new Frame($data);
}

die(' ok ');

// let's wait for connect ot our socket
//while ($connect = stream_socket_accept($socket, -1)) {
//
//    // handshaked already
//    if(in_array($connect, $approvedConnects)) {
//        print_r(' connected ' . PHP_EOL);
//        $info = fgets($connect, 1000);
//        print_r($info);
//    } else {
//        print_r(' handshake ' . PHP_EOL);
//        // this is ws server, so we should check if we have websockets headers here
//        $headers = getHeaders($connect, true);
//
//        if (!count($headers)) {
//            print_r('  WRONG  ');
//            continue;
//        }
//
//        // ok, this is ws request. lets handshake with our client
//        $responseHeaders = getResponseHeaders($headers);
//
//        fwrite($connect, $responseHeaders);
//        $approvedConnects[] = $connect;
//    }
//
//
//    print_r([
//        $approvedConnects
//    ]);
//}

fclose($socket);