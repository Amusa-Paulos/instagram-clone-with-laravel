<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManagerStatic as Image;


class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $id = Auth::id();
        $posts = DB::table('posts')->orderBy('created_at', 'DESC')->where('user_id', $user->id)->get();
        // $user = User::findOrFail($user);

        
        $follows = Auth::user() ? Auth::user()->following->contains($user->id) : false;
        // $postsCount = $posts->count();
        $postsCount = Cache::remember('count.posts.' . $user->id, now()->addSeconds(30), function () use ($posts) {
            return $posts->count();
        });

        // $followersCount = $user->profile->followers->count();
        $followersCount = Cache::remember('count.followers.' . $user->id, now()->addSeconds(30), function () use ($user) {
            return $user->profile->followers->count();
        });
        // $followingCount = $user->following->count();
        $followingCount = Cache::remember('count.following.' . $user->id, now()->addSeconds(30), function () use ($user) {
            return $user->following->count();
        });
        
        return view('profile.index',[
            'user' => $user,
            'posts' => $posts,
            'follows' => $follows,
            'postsCount' => $postsCount,
            'followersCount' => $followersCount,
            'followingCount' => $followingCount
        ]);
        // return view('home');
    }
    

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profile.edit', compact('user'));
    }

    public function update(User $user)
    {

        $data = request()->validate([
            'title' => 'required',
            'discription' => 'required',
            'url' => 'url',
            'image' => ''
        ]);

        $imageArr = [];
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->resize(1000, 1000);
            $image->save(); 
            
            $imageArr = ['image' => $imagePath];
        }

        Auth::user()->profile->update(array_merge($data, $imageArr));

        return redirect('/profile/' . $user->id);
    }
}
