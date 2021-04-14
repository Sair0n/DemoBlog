<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Storage;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->with('comments')->paginate(6);
        return view('index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('postform');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $post = $request->validated();
        $post['desc'] = mb_substr($post['text'], 0, 300, 'UTF-8');
        $post['user_id'] = auth()->user()->id;
        if($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time(). '.' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $post['img'] = $filename;
        }

        Post::create($post);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Post $post)
    {
        return view('post')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Post $post)
    {
        abort_if( !(auth()->user()->id == $post->user_id), 403);
        return view('postform-edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PostRequest $request, Post $post)
    {
        //dd($post);

        $post->title = $request->input('title');
        $post->text = $request->input('text');
        $post->desc = mb_substr($request->input('text'), 0, 300, 'UTF-8');

        if($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time(). '.' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $post->img = $filename;
        }

        $post->save();

        return redirect('posts/'.$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        abort_if( !(auth()->user()->id == $post->user_id), 403);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
