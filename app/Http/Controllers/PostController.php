<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = Auth::user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(3);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {

        // Get the currently authenticated user...
        $user = Auth::user();
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('upload', 'public');

       
        $image = Image::make(public_path("storage/{$imagePath}"))->resize(1200, 1200);
        $image->save();
 
        
        $user->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);



        return redirect('/profile/' . Auth::id());
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
