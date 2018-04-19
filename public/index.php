<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PhpAmqpLib\Connection\AMQPStreamConnection;
use GuzzleHttp\Client;
use FTCBotCore\Broker\MessageFactory;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';


$discordHttpClient = new Client();

$dict = require 'config/newfile.php';

$connection = new AMQPStreamConnection('broker', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('hello', false, false, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";
$callback = function($msg) use ($discordHttpClient, $dict) {
    $rawMess = json_decode($msg->body, true);
    
    $mess = MessageFactory::fromRawMessage($rawMess);
    
    if ($mess->getMessageType() == 'GUILD_CREATE' && isset($mess->data->content)) {
        $data = $mess->data;
        
        if (substr($data->content, 0, 1) == '!') {
            $res = $discordHttpClient->request('POST', 'https://discordapp.com/api/v6/channels/'.$data->channel_id.'/messages',
                [
                    'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bot NDMyMjg5NTU3MzA4NzY4MjY2.DbVtTA.H45OL_4BNlX8v6LsG81kd6F4BLY',
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'content' => 'Je ne répond pas aux ordres HEY '.strtoupper($dict[array_rand($dict)]).' DE <@'.$data->author->id. '> !!',
                    ]
                ]);
        }
    }
    echo " [x] Received ", $msg->body, "\n";
};
$channel->basic_consume('hello', '', false, true, false, false, $callback);
while(count($channel->callbacks)) {
    $channel->wait();
}
$channel->close();
$connection->close();
