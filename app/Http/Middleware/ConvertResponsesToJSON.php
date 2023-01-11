<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConvertResponsesToJSON
{
    protected ResponseFactory $factory;

    public function __construct(ResponseFactory $factory)
    {
        $this->factory = $factory;
    }

    public function handle(Request $request, Closure $next): JsonResponse
    {
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
