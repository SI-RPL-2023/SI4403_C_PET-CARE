<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PetOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPetOwnersController extends Controller
{
    public function index() {
        $petOwners = PetOwner::with('user')->get();

        return view('admin.petowners.index', compact('petOwners'));
    }

    public function destroy(PetOwner $petOwner) {
        if($petOwner->image != null) {
            Storage::delete('images/petowner-pp/' . $petOwner->image);
        } 
        User::destroy($petOwner->user->id);

        return redirect('/dashboard/petowners')->with('success', 'Pet owner has been deleted');
    }
}
