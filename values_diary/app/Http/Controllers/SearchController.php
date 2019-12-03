<?php

namespace App\Http\Controllers;

use App\Value;
use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Post::query();

        if (isset($keyword) && $keyword !== '')
        {
            $query->where('value_tags', 'like', '%'.$keyword.'%')
                ->orWhere('actions_for_value', 'like', '%'.$keyword.'%')
                ->orWhere('score', 'like', '%'.$keyword.'%')
                ->orWhere('good_things', 'like', '%'.$keyword.'%')
                ->orWhere('troubles', 'like', '%'.$keyword.'%')
                ->orWhere('memo', 'like', '%'.$keyword.'%');
        }
        else
        // 検索ワードが空欄の場合は投稿一覧にリダイレクト
        {
            return redirect()->route('posts.index');
        }

        $data = [
            
            'posts' => $query->latest()->paginate(15),
            'keyword' => $keyword,
            'title' => '検索結果：' . $keyword,
            'sentence' => '検索キーワード「' . $keyword . '」に一致する日記はありません',
            'values' => Value::all(),


        ];
        return view('posts.index', $data);
    }

    public function valueSearchIndex(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Post::query();

        $query->where('value_tags', 'like', '%'.$keyword.'%');

        $data = [
            
            'posts' => $query->latest()->paginate(15),
            'keyword' => $keyword,
            'title' => '価値観：' . $keyword,
            'sentence' => '「' . $keyword . '」についての日記はまだありません',
            'values' => Value::all(),

        ];
        return view('posts.index', $data);
    }
}
