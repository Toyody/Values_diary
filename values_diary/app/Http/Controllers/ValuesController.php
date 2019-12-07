<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ValueRequest;
use App\Value;
use Auth;
use Illuminate\Http\Request;

// use Illuminate\Validation\Rule;

class ValuesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = Value::where('user_id', Auth::id())
            ->latest()
            ->paginate(12);

        $data = [
            'values' => $values,
            'sentence' => '価値観はまだありません',
        ];

        return view('values.index', $data);
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
    public function store(ValueRequest $request)
    {
        $value = new Value();
        $value->create([
            'user_id' => Auth::id(),
            'value' => $request->value,
            'reason' => $request->reason,
        ]);

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
        $value = Value::where('id', $id)->firstOrFail();

        return view('values.show', ['value' => $value]);
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
    public function update(ValueRequest $request, $id)
    {
        // dd(Rule::unique('values', 'value')->ignore($id));

        // $this->validate($request,[
        //     'value' => [
        //     'required',
        //     'string',
        //     'max:24',
        //     Rule::unique('values', 'value')->ignore($id),
        //     ],
        //     'reason' => [
        //         'string',
        //         'max:3000',
        //     ],
        // ]);

        $value = Value::find($id);

        $value->update([
            'value' => $request->value,
            'reason' => $request->reason,
        ]);

        session()->flash('flash_message', '価値観を編集しました');

        return redirect()->route('values.show', ['value' => $value]);
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
