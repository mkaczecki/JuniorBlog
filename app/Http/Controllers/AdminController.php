<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private $postController;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->postController = new PostController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function create(){
        return $this->postController->create();
    }
    public function edit(Post $post){
        return $this->postController->edit($post);
    }
    public function store(Request $request){
        return $this->postController->store($request);
    }
    public function manage(){
        return $this->postController->manage();
    }
    public function update(Post $post, Request $request){
        return $this->postController->update($post, $request);
    }
    public function destroy(Post $post){
        return $this->postController->destroy($post);
    }
}
