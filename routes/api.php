<?php

/** @var Illuminate\Routing\Router $router */

use App\Http\Controllers\ShowApplicationInformation;

$router->get('/', ShowApplicationInformation::class);
