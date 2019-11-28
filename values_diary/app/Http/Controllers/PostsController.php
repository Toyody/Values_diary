<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;
use Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())
            ->latest()
            ->paginate(15);

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーションチェック

        $post = new Post;
        $post->user_id = Auth::id();
        $post->value_tag = $request->value_tag;
        $post->actions_for_value = $request->actions_for_value;
        $post->score = $request->score;
        $post->good_things = $request->good_things;
        $post->troubles = $request->troubles;
        $post->memo = $request->memo;

        $post->save();

        session()->flash('flash_message', '投稿が完了しました');

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->firstOrFail();

        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $post->value_tag = $request->value_tag;
        $post->actions_for_value = $request->actions_for_value;
        $post->score = $request->score;
        $post->good_things = $request->good_things;
        $post->troubles = $request->troubles;
        $post->memo = $request->memo;

        $post->save();

        session()->flash('flash_message', '日記を編集しました');

        return redirect()->route('posts.show', ['post' => $post]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
