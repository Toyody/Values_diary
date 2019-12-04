<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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
            'title' => '投稿一覧',
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
    public function store(Request $request)
    {
        // バリデーションチェック

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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::withTrashed()
            ->where('id', $id)
            ->firstOrFail();
        
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

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
     * @param int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $array = $request->value_tags;
        $str = implode('、', $array);

        $post = Post::find($id);
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
