<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function index(){
        $posts = Post::all();
        return view('list', compact('posts'));
    }

    public function show($id){
        $post = post::find($id);
        // if (auth()->user()->can('view', $post)) {
        //     //
        //     return view('show', compact('post'));
        // }else{
        //     abort(403);
        // }
        // $this->authorize('view', $post);
        return view('show', compact('post'));
    }

    public function create(){
        if (auth()->user()->can('create', Post::class)) {
            // Executes the "create" method on the relevant policy...
            dd('create post');
        }else{
            abort(403);
        }
    }
}
