<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SigninUserController extends Controller
{
    // Show signin form
    public function create()
    {
        return view('auth.signin');
    }

    // Handle email login
    public function store(Request $request)
    {
        // Validate email
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;

        // Check if user exists
        $user = User::where('email', $email)->first();

        if (!$user) {
            // User not found
            return back()->withErrors([
                'email' => 'Invalid email or create an account'
            ])->withInput();
        }

        // If user exists, login user (no password)
        Auth::login($user);

        // Redirect to home page
        return redirect('/'); // home page
    }

    // Logout
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}