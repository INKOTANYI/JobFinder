<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

// Increase memory limit programmatically
ini_set('memory_limit', '1024M');

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
