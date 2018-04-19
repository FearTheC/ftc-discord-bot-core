<?php // .pomm_cli_bootstrap.php

use \PommProject\Foundation\Pomm;
var_dump(__DIR__);
$loader = require __DIR__.'/vendor/autoload.php';
$loader->add(null, __DIR__);

return new Pomm(['core' =>
    [
        'dsn' => 'pgsql://postgres:password@core-db:5432/discord_bot',
        'class:session_builder' => '\PommProject\ModelManager\SessionBuilder',
    ]
]);
