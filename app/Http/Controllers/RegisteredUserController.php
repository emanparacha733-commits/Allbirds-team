<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisteredUserController extends Controller
{
    // Show registration form
    public function create()
    {
        return view('auth.register'); // Blade file
    }

    // Handle email registration form submission
    public function store(Request $request)
    {
        // Validate email
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        // Create user (only email)
        $user = User::create([
            'email' => $request->email,
        ]);

        // Auto-login the user (optional)
        Auth::login($user);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Register Successfully!');
    }
}