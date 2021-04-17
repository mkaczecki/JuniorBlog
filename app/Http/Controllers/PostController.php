<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request){
        $user_id = Auth::user()->id;
        $data = array_merge(['user_id' => $user_id], $this->validatePostData($request));
        $post = Post::create($data);
        return redirect()->to('posts/'.$post->id);
    }

    public function update(Post $post, Request $request){
        $post->update($this->validatePostData($request));
        return redirect()->to('/posts/'.$post->id);
    }

    public function create(){
        return view('posts/create');
    }

    public function show(Post $post){
        $updated = $this->postUpdateString($post->updated_at);
        return view('posts/show', compact('post', 'updated'));
    }

    public function index(){
        $posts = Post::orderBy('updated_at', 'desc')->paginate(5);
        $updated = $this->updated($posts);
        return view('posts/index', compact('posts', 'updated'));
    }

    public function edit(Post $post){
        return view('posts/edit', compact('post'));
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect()->to('/posts/manage');
    }

    public function manage(){
        $user = Auth::user();
        $posts = $user->posts()->paginate(5);
        $updated=$this->updated($posts);
        return view('posts/management', compact('posts', 'updated'));
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
            'title' => 'required|min:3|max:'.config('POST_TITLE_LENGTH', '100'),
            'content' => 'required|min:'.config('POST_MIN_LENGTH', '50'). '|max:'.config('POST_MAX_LENGTH', '5000'),
        ]);

        $data = array_merge($data, ['image' => $storage_image_name]);
        return $data;
    }

    private function postUpdateString($datetime){
        $stringDate="";
        $date = date_create($datetime);
        $dateFormat = date_format($date,"d M Y ");
        $timeFormat = date_format($date, 'H:i');
        $stringDate = "Last update: ".$dateFormat." at ".$timeFormat;
        return $stringDate;
    }

    private function updated($posts){
        $updated = array();
        foreach ($posts as $post){
            $updated[$post->id] =  $this->postUpdateString($post->updated_at);
        }
        return $updated;
    }
}
