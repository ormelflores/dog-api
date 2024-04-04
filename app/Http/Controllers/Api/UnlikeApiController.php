<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnlikeRequest;
use Illuminate\Http\JsonResponse;

class UnlikeApiController extends Controller
{
    // Unlike dog process
    public function store(UnlikeRequest $request): JsonResponse
    {
        $likes = auth()->user()->likes();

        $liked = $likes->liked($request->dog['name'], $request->dog['breed']);
    
        // Check if the dog is included on likes.
        if ($liked->count() > 0)
        {
            $liked->delete();

            return response()->json([
                'message' => 'Success!',
            ], 201);
        }
        else
        {
            return response()->json([
                'message' => 'Not Found.',
                'errors' => [
                    'details' => 'Selected dog does not found on the favorites.',
                ],
            ], 433);
        }
    }
}
