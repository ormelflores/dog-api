<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeApiController extends Controller
{
    // Like process
    public function store(LikeRequest $request): JsonResponse
    {
        $likes = auth()->user()->likes();

        // Check if the user has already like 3 dogs.
        if ($likes->count() < 3)
        {
            $likes->create(['dog' => json_encode($request->dog)]);

            return response()->json([
                'message' => 'Success!',
            ], 201);
        }
        else
        {
            return response()->json([
                'message' => 'Maximum like exceed.',
                'errors' => [
                    'details' => 'You are only limited to like three dogs.',
                ],
            ], 433);
        }
    }
}
