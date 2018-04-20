#!/usr/bin/env php
<?php

use Symfony\Component\Console\Application;
use FTCBotCore\CLI\Command\CreateCommand;
use PommProject\Foundation\Pomm;

function includeIfExists($file)
{
    if (file_exists($file)) {
        return include $file;
    }
}

if (
    (!$loader = includeIfExists(__DIR__ . '/../vendor/autoload.php'))
    && (!$loader = includeIfExists(__DIR__ . '/../../../autoload.php'))
) {
    die(
        'You must set up the project dependencies, run the following commands:' . PHP_EOL
        . 'curl -s http://getcomposer.org/installer | php' . PHP_EOL
        . 'php composer.phar install' . PHP_EOL
    );
}


$application = new Application();
$application->add(new CreateCommand);
$application->run();
