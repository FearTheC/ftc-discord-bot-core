<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PhpAmqpLib\Connection\AMQPStreamConnection;
use FTCBotCore\EventHandler\MessageCreate;
use FTCBotCore\Db\DbCacheInterface;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$sm = include 'config/container.php';

// $data = unserialize(file_get_contents('received-data.php'));
// var_dump($data['data']['channels']);

// $cm = $sm->get('GUILD_CREATE');
// $cm->execute($data['data']);

// $dbCache = $container->get(DbCacheInterface::class);
// $dbCache->setGame('Heroes of the Storm', 15457372412);
// var_dump($dbCache->getGameId('Heroes of the Storm'));
// var_dump($dbCache->getGameId('heroes of the storm'));
// var_dump($dbCache->getGameId('Fornite'));

// $stopData = json_decode('{"user":{"id":"214455376869982209"},"status":"online","roles":["296206124363939840","384390423029874689"],"nick":null,"guild_id":"295923579856486400","game":null}', true);
// $startData = json_decode('{"user":{"id":"214455376869982209"},"status":"online","roles":["296206124363939840","384390423029874689"],"nick":null,"guild_id":"295923579856486400","game":{"type":0,"timestamps":{"start":1524646169270},"name":"Heroes of the Storm"}}', true);
// $handler = $container->get('PRESENCE_UPDATE');
// $handler($startData);
// $handler($stopData);



// exit();
$connection = new AMQPStreamConnection('broker', 5672, 'guest', 'guest');
$channel = $connection->channel();
$channel->queue_declare('hello', false, true, false, false);
$channel->basic_qos(null, 1, null);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function($msg) use ($sm) {
    $mess = json_decode($msg->body, true);
    echo " [x] Received ", $msg->body, "\n";
    var_dump($msg->get_properties());
    if ($sm->has($mess['event'])) {
        $handler = $sm->get($mess['event']);
        
        if ($handler($mess['data'])) {
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
// ["heartbeat":protected]=>
// int(0)
// ["last_frame":protected]=>
// float(1524667619.2845)
// ["sock":protected]=>
// NULL
// ["channel_max":protected]=>
// int(65535)
// ["frame_max":protected]=>
// int(131072)
// ["construct_params":protected]=>
// array(4) {
//     [0]=>
//     string(6) "broker"
//         [1]=>
//         int(5672)
//         [2]=>
//         string(5) "guest"
//             [3]=>
//             string(5) "guest"
// }
// ["close_on_destruct":protected]=>
// bool(true)
// ["is_connected":protected]=>
// bool(true)

// ["io":protected]=>
// object(PhpAmqpLib\Wire\IO\StreamIO)#5 (14) {
// ["protocol":protected]=>
// string(3) "tcp"
//     ["host":protected]=>
//     string(6) "broker"
//         ["port":protected]=>
//         int(5672)
//         ["connection_timeout":protected]=>
//         float(3)
//         ["read_write_timeout":protected]=>
//         float(3)
//         ["context":protected]=>
//         resource(43) of type (stream-context)
//         ["keepalive":protected]=>
//         bool(false)
//         ["heartbeat":protected]=>
//         int(0)
//         ["last_read":protected]=>
//         float(1524667619.2845)
//         ["last_write":protected]=>