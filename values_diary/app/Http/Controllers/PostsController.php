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

        $data = [
            'posts' => $posts,
            'title' => '投稿一覧',
            'sentence' => '日記はまだありません',
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
        $post = Post::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

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
        $post = Post::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

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

        $data = [
            'posts' => $trashed,
            'title' => 'ゴミ箱',
            'sentence' => 'ゴミ箱は空です',
        ];

        return view('posts.index', $data);
    }

    /**
     * ゴミ箱内の日記を復元.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function restoreTrashedPost(Request $request)
    {
        Post::onlyTrashed()->restore();

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
