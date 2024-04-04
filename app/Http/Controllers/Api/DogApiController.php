<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DogApiController extends Controller
{
    // Display available breed of dogs
    public function index(): JsonResponse
    {
        $response = Http::get("https://dog.ceo/api/breeds/list/all");

        $filtered_result = collect($response->json()['message']);

        // Filter result to display dog as a key and breed as a value.
        $available_dog_breeds = collect($filtered_result)->flatMap(function ($value, $key) {
            return collect($value)->map(function ($item) use ($key) {
                return [$item => $key];
            });
        })->collapse();

        return response()->json([
            'data' => $available_dog_breeds,
            'message' => 'Success'
        ], 200);
    }

    // Get random image from api
    public function randomImage(): JsonResponse
    {
        try
        {
            $response = Http::get("https://dog.ceo/api/breeds/image/random");

            return response()->json([
                'data' => $response->json()['message'],
                'message' => 'Success'
            ], 200);
        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => [
                    'details' => $e->getMessage(),
                ],
            ], 433);
        }
    }
}
