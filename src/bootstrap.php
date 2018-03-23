<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once 'constants.php';

if (file_exists((string) APP_ROOT . '/.env')) {
    $dotenv = new \Dotenv\Dotenv((string) APP_ROOT);
    $dotenv->load();
}
