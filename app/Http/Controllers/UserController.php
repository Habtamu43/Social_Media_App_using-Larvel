<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function show(User $user)
    {
        // Optionally, you can load additional data here, like posts made by the user.
        return Inertia::render('UserProfile', [
            'user' => $user,
            // 'posts' => $user->posts, // If you want to include user posts
        ]);
    }
}

