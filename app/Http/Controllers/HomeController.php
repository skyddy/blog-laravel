<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('users')->join('posts', 'users.id', '=', 'posts.author')->paginate(10);
        return view('home', ['posts' => $posts]);
    }

    /**
     * Loads Post adding/editing form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPostForm() {
        return view('post/post_form');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createPost(Request $request){
        $post = Post::create(array(
            'title' => Input::get('title'),
            'description' => Input::get('description'),
            'author' => Auth::user()->id
        ));
        return redirect()->route('home')->with('success', 'Post has been successfully added!');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPost($id){
        $post = Post::find($id);
        return view('post/post_detail', ['post' => $post]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editPost($id, Request $request){
        $post = Post::find($id);
        if ($request->isMethod('get')){
            return view('post/post_edit', ['post' => $post]);
        }
        $post->title = Input::get('title');
        $post->description = Input::get('description');
        $post->save();
        return redirect()->route('home')->with('success', 'Post has been successfully added!');
    }

    public function deletePost($id){
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('home')->with('success', 'Post has been successfully deleted!');
    }

}
