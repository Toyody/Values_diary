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
            'sentence' => '※まだ日記を書いていないので円グラフがありません',
            'values' => $values,
        ];

        return view('graph', $data);
    }
}
