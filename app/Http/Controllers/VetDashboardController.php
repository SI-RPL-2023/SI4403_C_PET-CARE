<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class VetDashboardController extends Controller
{
    public function index() {
        $appointments = Appointment::where('vet_id', auth()->user()->vet->vet_id)->where('status', 'Upcoming')->get();

        return view('vet.appointment', compact('appointments'));
    }

    public function articles() {
        $articles = Article::where('vet_id', auth()->user()->vet->vet_id)->get();

        return view('vet.articles', compact('articles'));
    }

    public function create() {
        return view('vet.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'body' => 'required'
        ]);
        
        $slug = SlugService::createSlug(Article::class, 'slug', $request->title);
        $image = explode('.', $request->file('image')->getClientOriginalName())[0];
        $image = $image . '-' . time() . '.' . $request->file('image')->extension();
        $request->file('image')->storeAs('images/articles/', $image);

        $data['slug'] = $slug;
        $data['excerpt'] = Str::limit(strip_tags($request->body), 250);
        $data['image'] = $image;
        $data['vet_id'] = auth()->user()->vet->vet_id;
        Article::create($data);

        return redirect('/vetdashboard/articles')->with('success', 'New article has been added');
    }

    public function destroy(Article $article) {
        Storage::delete('images/vets/' . $article->image);
        Article::destroy($article->id);

        return redirect('/vetdashboard/articles')->with('success', 'Article has been deleted');
    }

    public function edit() {
        return view('vet.edit');
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required',
            'phone' => 'numeric',
            'location' => 'required',
            'about' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'location' => $request->location,
            'about' => $request->about
        ];

        if($request->file('image')) {
            Storage::delete('images/vets/' . auth()->user()->vet->image);

            $image = explode('.', $request->file('image')->getClientOriginalName())[0];
            $image = $image . '-' . time() . '.' . $request->file('image')->extension();
            $request->file('image')->storeAs('images/vets/', $image);

            $data['image'] = $image;
        };

        if($request->new_password !== null && $request->confirm_new_password !== null) {
            $request->validate([
                'new_password' => 'min:8',
                'confirm_new_password' => 'min:8|same:new_password'
            ]);

            User::where('id', auth()->user()->id)->update(['password' => bcrypt($request->new_password)]);
            auth()->user()->vet->update($data);
        } else {
            auth()->user()->vet->update($data);
        }

        return redirect('/vetdashboard/editprofile')->with('success', 'Your profile has been updated');
    }
}
