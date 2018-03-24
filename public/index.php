<?php

namespace App;

use GuzzleHttp\Psr7\ServerRequest;
use Lencse\Application\Bootstrap;

require_once __DIR__ . '/../bootstrap/bootstrap.php';

$app = Bootstrap::createApplication();

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
