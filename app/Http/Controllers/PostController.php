<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function index()
    {

        $posts = Post::all();

        return view('admin/posts.index', ['posts'=>$posts]);


    }

    public function show(Post $post)
    {


        return view('blog-post', ['post'=>$post]);

    }

    public function create()
    {

        return view('admin/posts.create');
    }

    public function store(Request $request)
    {


        $inputs = $request->validate([
            'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            'body'=>'required'
        ]);

        if(request('post_image')){

            $inputs['post_image'] = request('post_image')->store('images');

        }

        auth()->user()->posts()->create($inputs);
        Session::flash('message', 'Post has been created');
        Session::flash('type', 'success');
        return redirect()->route('post.index');

    }

    public function edit(Post $post)
    {

        return view('admin.posts.edit', ['post'=>$post]);

    }

    public function update(Post $post)
    {

        //validation, to no let user update fields as an empty data

        $inputs = request()->validate([

            'title'=>'required|min:8|max:255',
            'post_image'=>'file',
            'body'=>'required'

        ]);

        if(request('post_image')){

            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image=$inputs['post_image'];
        }
        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        //policy authorizaztion, you can only ipdate your own post, where user_id is yours id

//        $this->authorize('update', $post);

        Session::flash('message', 'Post has been updated');
        Session::flash('type', 'success');

        auth()->user()->posts()->save($post);

        return redirect()->route('post.index');



    }

    public function delete(Post $post){

        $post->delete();

        //session data for one request, it desapears immidiatelly, we getting it in view, to show to user
        Session::flash('message', 'Post has been deleted');
        Session::flash('type', 'danger');

        return back();

    }
}
