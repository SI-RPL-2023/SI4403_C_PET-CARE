<?php

namespace App\Http\Controllers;

use App\Models\Vet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminVetsController extends Controller
{
    public function index() {
        $vets = Vet::with('user')->get();

        return view('admin.vets.index', compact('vets'));
    }

    public function create() {
        return view('admin.vets.create');
    }

    public function store(Request $request) {
        $request->validate([
            'email' => 'required|email:dns',
            'name' => 'required',
            'phone' => 'required|numeric',
            'image' => 'required',
            'location' => 'required',
            'about' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password'
        ]);

        $image = explode('.', $request->file('image')->getClientOriginalName())[0];
        $image = $image . '-' . time() . '.' . $request->file('image')->extension();
        $request->file('image')->storeAs('images/vets/', $image);
        
        $id = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'vet'
        ])->id;

        Vet::create([
            'user_id' => $id,
            'vet_id' => 'VET' . rand(111, 999), 
            'name' => $request->name,
            'phone' => $request->phone,
            'location' => $request->location,
            'about' => $request->about,
            'image' => $image
        ]);

        return redirect('/dashboard/vets')->with('success', 'New vet has been added');
    }

    public function destroy(Vet $vet) {
        Storage::delete('images/vets/' . $vet->image);
        User::destroy($vet->user->id);

        return redirect('/dashboard/vets')->with('success', 'Vet has been deleted');
    }
}
