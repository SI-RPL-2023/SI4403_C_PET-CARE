<?php

namespace App\Http\Controllers;

use App\Models\PetOwner;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        $id = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'pet-owner'
        ])->id;
        
        PetOwner::create([
            'user_id' => $id,
            'pet_owner_id' => 'POW' . rand(111, 999), 
            'name' => $request->name
        ]);

        return redirect('/login')->with('success', 'Registration is successful, please login');
    }
}
