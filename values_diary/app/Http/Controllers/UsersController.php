<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (Auth::user()->id !== $user->id) {
            abort(403);
        }
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->id !== $user->id) {
            abort(403);
        }

        // テストユーザーは編集できないようにリダイレクト
        if ($user->id == 2) {
            return redirect()->route('users.show', ['user' => $user]);
        }

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User                     $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->name = $request->name;

        if ($request->delete_image) {
            // Storage::delete('public/images/' . $user->profile_image);
            $user->profile_image = null;
        }

        if ($request->hasfile('profile_image')) {
            $image = $request->file('profile_image');
            $path = Storage::disk('s3')->putFile('/', $image, 'public');
            $user->profile_image = Storage::disk('s3')->url($path);
        }

        $user->email = $request->email;
        $user->ideal = $request->ideal;

        $user->save();

        session()->flash('flash_message', 'プロフィールを編集しました');

        return redirect()->route('users.show', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
    }
}
