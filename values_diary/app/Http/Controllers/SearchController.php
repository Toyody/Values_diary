<?php

namespace App\Http\Controllers;

use App\Value;
use App\Post;
use Auth;
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

        $values = Value::where('user_id', Auth::id())
            ->latest()
            ->limit(12)
            ->get();

        $data = [
            
            'posts' => $query->latest()->paginate(15),
            'keyword' => $keyword,
            'title' => 'キーワード：' . $keyword,
            'sentence' => '「' . $keyword . '」に一致する日記はありません',
            'values' => $values,


        ];
        return view('posts.index', $data);
    }

    public function valueSearchIndex(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Post::query();

        $query->where('value_tags', 'like', '%'.$keyword.'%');

        $values = Value::where('user_id', Auth::id())
            ->latest()
            ->limit(12)
            ->get();

        $data = [
            
            'posts' => $query->latest()->paginate(15),
            'keyword' => $keyword,
            'title' => '価値観：' . $keyword,
            'sentence' => '「' . $keyword . '」についての日記はまだありません',
            'values' => $values,

        ];
        return view('posts.index', $data);
    }

    public function dateSearchIndex(Request $request)
    {

        $keyword = $request->input('keyword');
        $query = Post::query();

        $query->where('created_at', 'like', '%'.$keyword.'%');

        // 表記用に日付のハイフンをスラッシュに置き換える
        $converted_keyword = str_replace('-', '/', $keyword);

        $values = Value::where('user_id', Auth::id())
            ->latest()
            ->limit(12)
            ->get();

        $data = [
            
            'posts' => $query->latest()->paginate(15),
            'keyword' => $keyword,
            'title' => '日付：' . $converted_keyword,
            'sentence' => '「' . $converted_keyword . '」の日記はありません',
            'values' => $values,

        ];
        return view('posts.index', $data);

    }
}
