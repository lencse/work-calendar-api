<?php

$appRoot = dirname(__DIR__);

require_once $appRoot . '/vendor/autoload.php';
require_once 'helpers.php';


if (file_exists($appRoot . '/.env')) {
    $dotenv = new \Dotenv\Dotenv($appRoot);
    $dotenv->load();
}

$config = require $appRoot . '/config/config.php';

if ('true' === $config['sentry']['enabled']) {
    $ravenClient = new \Raven_Client($config['sentry']['dsn'], $config['sentry']['config']);
    $ravenClient->install();
}

\Lencse\Application\Bootstrap::init($config);
