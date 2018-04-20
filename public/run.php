<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PhpAmqpLib\Connection\AMQPStreamConnection;
use FTCBotCore\EventHandler\MessageCreate;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$sm = include 'config/container.php';

$data = unserialize(file_get_contents('received-data.php'));
var_dump($data['data']['channels']);

$cm = $sm->get('GUILD_CREATE');
$cm->execute($data['data']);

exit();
$connection = new AMQPStreamConnection('broker', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('hello', false, true, false, false);
$channel->basic_qos(null, 1, null);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function($msg) use ($sm) {
    $mess = json_decode($msg->body, true);
    echo " [x] Received ", $msg->body, "\n";
    
    if ($sm->has($mess['event'])) {
        $handler = $sm->get($mess['event']);
        
        if ($handler->execute($mess['data'])) {
            echo "DONE";
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        }
    } else {
        $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
    }
};

$channel->basic_consume('hello', '', false, false, false, false, $callback);
while(count($channel->callbacks)) {
    $channel->wait();
}
$channel->close();
$connection->close();
