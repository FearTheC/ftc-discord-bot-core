<?php
use FTCBotCore\Broker\MessageFactory;
use FTCBotCore\Command\CountMembers;
use FTCBotCore\Discord\Message\MessageCreate as Message;
use FTCBotCore\EventHandler\MessageCreate;
use FTCBotCore\Discord\Message\GuildMemberAdd;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$container = require 'config/container.php';

