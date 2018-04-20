<?php
use FTCBotCore\Broker\MessageFactory;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$data = unserialize(file_get_contents('./config/received-data.php'));

MessageFactory::fromRawMessage($data);
