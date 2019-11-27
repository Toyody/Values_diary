<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Value;
use Auth;
use Illuminate\Http\Request;

class ValuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = Value::where('user_id', Auth::user()->id)
            ->limit(10)
            ->latest()
            ->get();

        return view('values.index', ['values' => $values]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('values.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //バリデーションチェック

        $value = new Value;
        $value->user_id = Auth::user()->id;
        $value->value = $request->value;
        $value->reason = $request->reason;

        $value->save();

        session()->flash('flash_message', '価値観を追加しました');

        return redirect('/values');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $value = Value::find($id);
        return view('values.edit', ['value' => $value]);
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
        $value = Value::find($id);
        $value->value = $request->value;
        $value->reason = $request->reason;

        $value->save();

        session()->flash('flash_message', '価値観を編集しました');

        return redirect('/values');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $value = Value::findOrFail($id);
        $value->delete();
        session()->flash('flash_message', '価値観を削除しました');
        return redirect('/values');
    }
}
