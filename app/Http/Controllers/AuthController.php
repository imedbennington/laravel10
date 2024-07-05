<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Hash;
class AuthController extends Controller
{
    public function register (){
        return view ('auth.register');
    }

    public function store()
    {
        // Validate the request
        $validated = request()->validate([
            'name' => 'required|min:2|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);
    
        // Create a new user with the validated data
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));

    
        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Account created!');
    }

    public function login (){
        return view ('auth.login');
    }

    public function authenticate()
    {
        // Validate the request
        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // Redirect to the dashboard with a success message
        if(auth()->attempt($validated)){
            request()->session()->regenerate();
            return redirect()->route('dashboard')->with('success', 'loged in!');
        }
        return redirect()->route('login')->withErrors([
            'email'=>"no user found"
        ]);
    }
    
    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('dashboard')->with('success', 'Logged out!');
    }
}
