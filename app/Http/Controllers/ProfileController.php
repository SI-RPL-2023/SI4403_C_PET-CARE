<?php

namespace App\Http\Controllers;

use App\Models\PetOwner;
use App\Models\User;
use Illuminate\Http\Request;
// use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index() {
        return view('petowner.profile.myprofile');
    }

    public function edit() {
        return view('petowner.profile.edit-myprofile');
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required',
            'birth_date' => 'date',
            'phone' => 'numeric',
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'address' => $request->address
        ];

        if($request->file('image')) {
            Storage::delete('images/petowner-pp/' . auth()->user()->petOwner->image);

            $image = explode('.', $request->file('image')->getClientOriginalName())[0];
            $image = $image . '-' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('images/petowner-pp/', $image);

            $data['image'] = $image;
        };

        if($request->new_password !== null && $request->confirm_new_password !== null) {
            $request->validate([
                'new_password' => 'min:8',
                'confirm_new_password' => 'min:8|same:new_password'
            ]);

            User::where('id', auth()->user()->id)->update(['password' => bcrypt($request->new_password)]);
            auth()->user()->petOwner->update($data);
        } else {
            auth()->user()->petOwner->update($data);
        }

        return redirect('/myprofile')->with('success', 'Your profile has been updated');
    }
}