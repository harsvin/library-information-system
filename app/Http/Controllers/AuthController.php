<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Display the login form view
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password'); // Extract email and password from the request

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if (!$user->is_active) {
                Auth::logout();
                return redirect()->route('login')->withErrors(['Your account is inactive. Please contact the supervisor.']);
            }

            return redirect()->intended('dashboard'); // Redirect to the intended page (dashboard) after successful login
        }

        return redirect()->route('login')->withErrors('Login details are not valid');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); // Log in the newly registered user
        return redirect('dashboard');
    }
}
