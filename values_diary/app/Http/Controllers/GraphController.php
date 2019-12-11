<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Post;
use App\Value;
use Auth;

class GraphController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())
            ->get();

        $values = Value::where('user_id', Auth::id())
            ->get();

        $data = [
            'posts' => $posts,
            'title' => '投稿一覧',
            'sentence' => '日記はまだありません',
            'values' => $values,
        ];

        return view('graph', $data);
    }
}
