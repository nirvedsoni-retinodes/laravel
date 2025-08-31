<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is /maintenance, we will "scream" so loud that
| prevents any other functionality from working. You'll get a blank
| white page.
|
| If you don't want this to happen, just comment out the checks below.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application instance, we can handle the incoming
| request through the kernel, and send the associated response back
| to the client's browser allowing them to enjoy the creative and
| wonderful application we have prepared for them.
|
*/

$request = Request::capture();

$response = $app->handle($request);

$response->send();

$app->terminate($request, $response);
