<?php

declare(strict_types=1);

/** @var Illuminate\Routing\Router $router */

use App\Http\Controllers\ShowApplicationInformation;

$router->get('/', ShowApplicationInformation::class);
