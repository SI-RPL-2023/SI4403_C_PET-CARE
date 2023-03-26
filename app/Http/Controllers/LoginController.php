<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials, $request->remember)) {
            $user = Auth::getUser(); 
            $request->session()->regenerate();
            
            if($user->role === 'pet-owner') {
                return redirect()->intended('/');
            } elseif($user->role === 'vet') {
                return redirect()->intended('/vetdashboard');
            } else {
                return redirect()->intended('/dashboard');
            }
        }

        return back()->with('login-failed', 'Login failed');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
