<?php

declare(strict_types=1);

namespace Modules\Blog\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

final class CanReadPostsMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        return $next($request);
    }
}
