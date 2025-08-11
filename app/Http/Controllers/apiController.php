<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class apiController extends Controller
{
    /**
     * Return JSON with the sum of two numbers.
     */
    public function sum($a, $b): JsonResponse
    {
        // Basic validation
        if (!is_numeric($a) || !is_numeric($b)) {
            return response()->json([
                'error' => 'Both parameters must be numeric.'
            ], 400);
        }

        $sum = $a + $b;

        return response()->json([
            'a'   => (int) $a,
            'b'   => (int) $b,
            'sum' => $sum
        ], 200);
    }

}
