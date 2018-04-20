<?php

use Zend\ServiceManager\Config as ServiceConfig;
use Zend\ServiceManager\ServiceManager;
use Zend\Config\Config;

// Load configuration
$config = require __DIR__.'/config.php';

// Build container
$container = new ServiceManager();
(new ServiceConfig($config['dependencies']))->configureServiceManager($container);

// Inject config
$container->setService('config', $config);



return $container;