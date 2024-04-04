<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    // Display users
    public function index(): Response
    {
        return Inertia::render('Users/Index', [
            'users' => User::except(auth()->user()->id)->get(),
        ]);
    }

    // Show user info
    public function show(User $user): Response
    {
        return Inertia::render('Users/Show', [
            'user' => $user,
            'likes' => $user->likes,
        ]);
    }
}
