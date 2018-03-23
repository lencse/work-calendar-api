<?php

namespace App;

use GuzzleHttp\Psr7\ServerRequest;
use Lencse\Application\Bootstrap;

require_once __DIR__ . '/../src/bootstrap.php';

$config = require __DIR__ . '/../config/config.php';

$ravenClient = new \Raven_Client($config['sentry']['dsn'], $config['sentry']['config']);
$ravenClient->install();

$bootstrap = new Bootstrap($config);
$app = $bootstrap->createApplication();

$request = new ServerRequest(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);

$request = $request->withQueryParams($_GET);

$response = $app->run($request);

foreach ($response->getHeaders() as $header => $headerValues) {
    foreach ($headerValues as $value) {
        header($header . ': ' . $value);
    }
}

echo $response->getBody();
