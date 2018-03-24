<?php

require_once __DIR__ . '/../vendor/autoload.php';

define('APP_ROOT', realpath(__DIR__ . '/../'));

if (file_exists(APP_ROOT . '/.env')) {
    $dotenv = new \Dotenv\Dotenv((string) APP_ROOT);
    $dotenv->load();
}

$config = require __DIR__ . '/../config/config.php';

if ('true' === $config['sentry']['enabled']) {
    $ravenClient = new \Raven_Client($config['sentry']['dsn'], $config['sentry']['config']);
    $ravenClient->install();
}

\Lencse\Application\Bootstrap::init($config);
