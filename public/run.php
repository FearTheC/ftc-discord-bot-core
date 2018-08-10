<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use FTCBotCore\Broker\BrokerClient;
use FTCBotCore\Message\Message;
use FTCBotCore\Broker\Client\AMQPClient;
use FTC\Discord\Db\Core;
use FTC\Discord\Model\Aggregate\ErrorMessageRepository;
use FTC\Discord\Model\Aggregate\ErrorMessage;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$sm = include 'config/container.php';
$botConfig = include 'config/autoload/bot.local.php';
$dbConfig = (include 'config/autoload/db.local.php')['core-db'];



function alertOwner($discordClient, $ownerId)
{
    
    $error = error_get_last();
    $errorMsg = sprintf('%s > %s:%s', $error['message'], $error['file'], $error['line']);
    $discordClient->sendDM($ownerId, 'I\'ve stopped working'."\n".$errorMsg);
}

register_shutdown_function('alertOwner', $sm->get('discord-http-client'), $botConfig['owner_id']);

$waitUponThirdServiceStart = function($sm, string $serviceName) {
    printf("Reaching for service %s\n", $serviceName);
    $config = $sm->get('config')[$serviceName];


    while (($connection = @fsockopen(trim($config['host']), (int) trim($config['port']))) === false) {
        if (!isset($string)) {
            printf('Waiting for %s service startup  ', $serviceName);
        }
            sleep(1);
    }

    fclose($connection);
    printf('%s service started up'.PHP_EOL, ucfirst($serviceName));
};

$waitUponThirdServiceStart($sm, 'broker');
$waitUponThirdServiceStart($sm, 'core-db');


/**
 * @var AMQPClient $broker
 */
$broker = $sm->get(BrokerClient::class);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function(Message $message) use ($sm) {
    echo " [x] Received '".$message->__toString().PHP_EOL;
    
    if ($sm->has($message->getEventType())) {
        try {
            $handler = $sm->get($message->getEventType());
            $result = $handler($message);
        } catch(Exception $e) {
            $errorRepo = $sm->get(ErrorMessageRepository::class);
            $errorMessage = ErrorMessage::createFromScalarTypes(
                null,
                (int) $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine(),
                (string) $message
                );
            $errorRepo->save($errorMessage);
            printf("\033[31m ERROR: %s \n %s \033[0m \n", (string) $e, (string) $message);
            return false;
        }
    }
    
    return true;
};


while(true) {
    try {
        $broker->consume($callback);
    } catch(PDOException $e) {
        var_dump(get_class($e));
        var_dump($e->getMessage());
        var_dump($e->getTraceAsString());
        die();
    } catch (Exception $e) {
        var_dump(get_class($e));
        var_dump($e->getMessage());
        var_dump($e->getTraceAsString());
        echo "CONNECTION WITH BROKER LOST !\n";
        sleep(2);
        
        $waitUponThirdServiceStart($sm, 'broker');
        $broker->reconnect();
    }
};
