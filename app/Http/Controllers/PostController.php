<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request){

        $this->middleware('auth');
        $user = Auth::user();

        if($user === null){
            return redirect()->to('/login');
        }
        $user_id = $user->id;
        $data = array_merge(['user_id' => $user_id], $this->validatePostData($request));
        $post = Post::create($data);

        return redirect()->to('posts/'.$post->id);
    }

    public function update(Request $request){
        $this->middleware('auth');

        if($request->has('id')){
            $post = Post::find($request->id);
            $post->update($this->validatePostData());
        }
        return redirect()->back();
    }

    public function create(){
        $this->middleware('auth');
        return view('post/create');
    }

    public function show(Post $post){
        return views('posts/show', compact('post'));
    }

    public function index(){
        $posts = Post::all();
        return view('posts/index', compact('posts'));
    }

    public function edit(Post $post){
        $this->middleware('auth');
        return view('posts/edit', compact('post'));
    }

    private function validatePostData(Request $request){

        $request->validate([
            'image' => 'nullable|image|max:'.config('POST_IMAGE_SIZE', '2048'),
        ]);

        $image = $request->file('image');
        $storage_image_name = null;

        if($image != null){
            $storage_image_name = time().'_'.$image->getClientOriginalName();
            $image->storeAs('images', $storage_image_name, 'public');
        }

        $data = $request->validate([
            'title' => 'required|min:3|max:'.config('POST_TITLE_LENGTH', '30'),
            'content' => 'required|min:'.config('POST_MIN_LENGTH', '50'). '|max:'.config('POST_MAX_LENGTH', '5000'),
        ]);

        $data = array_merge($data, ['image' => $storage_image_name]);
        return $data;
    }
}
