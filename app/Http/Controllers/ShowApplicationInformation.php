<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ShowApplicationInformation
{
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'service_name' => config('app.name'),
        ]);
    }
}
