<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Show the registration and login forms
    public function showAuthForm()
    {
        return view('auth'); // Make sure to use your Blade view
    }

    // Handle the registration request
    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to dashboard or intended page
        return redirect()->intended('/dashboard');
    }

    // Handle the login request
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful
            return redirect()->intended('/dashboard'); // Redirect to the intended page (or a default one)
        } else {
            // Authentication failed
            throw ValidationException::withMessages([
                'email' => ['These credentials do not match our records.'],
            ]);
        }
    }

    // Handle logout request
    public function logout()
    {
        Auth::logout(); // Log out the user
        return redirect('/'); // Redirect to the home page
    }
}
