<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use App\Value;
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

        $values = Value::where('user_id', Auth::id())
            ->latest()
            ->limit(12)
            ->get();

        $data = [
            'posts' => $posts,
            'title' => '日記一覧',
            'sentence' => '日記はまだありません',
            'values' => $values,
        ];

        return view('posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $values = Value::where('user_id', Auth::id())->get();

        $data = [
            'values' => $values,
        ];

        return view('posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $array = $request->value_tags;
        $str = implode('、', $array);
        $post = Post::create([
            'user_id' => Auth::id(),
            'value_tags' => $str,
            'actions_for_value' => $request->actions_for_value,
            'score' => $request->score,
            'good_things' => $request->good_things,
            'troubles' => $request->troubles,
            'memo' => $request->memo,
        ]);
        $post->values()->attach($str);

        session()->flash('flash_message', '投稿が完了しました');

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) {
            abort(403);
        }

        $values = Value::where('user_id', Auth::id())->get();

        $data = [
            'values' => $values,
            'post' => $post,
        ];

        return view('posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if (Auth::user()->id !== $post->user_id) {
            abort(403);
        }
        $values = Value::where('user_id', Auth::id())->get();

        $data = [
            'values' => $values,
            'post' => $post,
        ];

        return view('posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Post                     $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $array = $request->value_tags;
        $str = implode('、', $array);

        $post->update([
            'value_tags' => $str,
            'actions_for_value' => $request->actions_for_value,
            'score' => $request->score,
            'good_things' => $request->good_things,
            'troubles' => $request->troubles,
            'memo' => $request->memo,
        ]);

        $post->values()->attach($str);

        session()->flash('flash_message', '日記を編集しました');

        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->trashed()) {
            $post->forceDelete();

            session()->flash('flash_message', '日記を削除しました');

            return redirect()->route('trashed-posts.index');
        }

        $post->delete();

        session()->flash('flash_message', '日記をゴミ箱に入れました');

        return redirect()->route('posts.index');
    }

    /**
     * ゴミ箱の日記一覧.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(15);

        $values = Value::where('user_id', Auth::id())
            ->latest()
            ->limit(12)
            ->get();

        $data = [
            'posts' => $trashed,
            'title' => 'ゴミ箱',
            'sentence' => 'ゴミ箱は空です',
            'values' => $values,
        ];

        return view('posts.index', $data);
    }

    /**
     * ゴミ箱内の日記を復元.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function restoreTrashedPost(Post $post)
    {
        $post->restore();

        session()->flash('flash_message', '日記を復元しました');

        return redirect()->route('trashed-posts.index');
    }

    /**
     * ゴミ箱内の日記を全削除.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function clearTrashedPost(Request $request)
    {
        Post::onlyTrashed()->forceDelete();
        session()->flash('flash_message', 'ゴミ箱を空にしました');

        return redirect()->route('trashed-posts.index');
    }
}
