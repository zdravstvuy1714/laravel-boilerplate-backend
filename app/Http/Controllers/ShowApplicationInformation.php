<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

final class ShowApplicationInformation
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'service_name' => config('app.name'),
        ]);
    }
}
