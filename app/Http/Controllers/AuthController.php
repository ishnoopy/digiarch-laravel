<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Model
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email_address', $email)->first();
        var_dump($user->is_admin);
        if ($user && password_verify($password, $user->password)) {
            // Authentication passed...
            session(['user_id' => $user->id]);

            if ($user->is_admin == 1) {
                session(['is_admin' => true]); 
                return redirect()->route('admin-dashboard');
            } else {
                session(['is_admin' => false]);
                return redirect()->route('dashboard');
            }
        }

        return redirect()->route('login')->withErrors(['error' => 'Invalid credentials.'])->withInput();
    }

    public function signup(Request $request) {
        $credentials = $request->only('first_name', 'last_name', 'email', 'password');

        // Check if email already exists.
        $existingUser = User::where('email_address', $credentials['email'])->first();
        if ($existingUser) {
            return redirect()->route('signup')->withErrors(['email' => 'Email already taken.'])->withInput();
        }

        $user = User::create([
            'first_name' => $credentials['first_name'],
            'last_name' => $credentials['last_name'],
            'email_address' => $credentials['email'],
            'password' => password_hash($credentials['password'], PASSWORD_DEFAULT),
            'is_admin' => 0
        ]);

        return redirect()->route('signup')->with('success', 'Account created successfully.');
    }

    public function logout() {
        session()->flush();
        return redirect()->route('login');
    }
}