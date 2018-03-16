<?php

namespace App;

use GuzzleHttp\Psr7\ServerRequest;
use Lencse\Application\Bootstrap;

require_once __DIR__ . '/../vendor/autoload.php';

var_dump(123); exit;

$request = new ServerRequest(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI']
);

$request = $request->withQueryParams($_GET);

$config = require __DIR__ . '/../config/config.php';
$bootstrap = new Bootstrap($config);
$app = $bootstrap->createApplication();

$response = $app->run($request);

foreach ($response->getHeaders() as $header => $headerValues) {
    foreach ($headerValues as $value) {
        header($header . ': ' . $value);
    }
}

echo $response->getBody();
