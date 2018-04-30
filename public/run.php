<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use FTCBotCore\Broker\BrokerClient;
use FTCBotCore\Discord\Message;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$sm = include 'config/container.php';

$broker = $sm->get(BrokerClient::class);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function(Message $message) use ($sm) {
    echo " [x] Received '".$message->getEventType().": ", json_encode($message->getData()).PHP_EOL;

    if ($sm->has($message->getEventType())) {
        $handler = $sm->get($message->getEventType());
        
        if ($handler($message)) {
            return true;
        }
    }

    return true;
};

$broker->consume($callback);
